<?php
if(!defined('IN_DISCUZ')) {exit('Access Denied');}
error_reporting(E_ALL ^ E_NOTICE);
define('IN_DISCUZ',TRUE);
define('DISCUZ_ROOT','');

loadcache('forums');

if(!$_G['setting']['rssstatus']) {exit('RSS Disabled');}
$ttl = $_G['setting']['rssttl']?$_G['setting']['rssttl']: 30;
$num = 20;
$_G['groupid'] = 7;
$_G['uid'] = 0;
$_G['username'] = $_G['member']['password'] = '';
$rssfid = empty($_GET['fid'])?0:intval($_GET['fid']);
$forumname = '';

if(empty($rssfid)) {
	foreach($_G['cache']['forums'] as $fid => $forum) {
		if(rssforumperm($forum)) {
			$fidarray[] = $fid;
		}
	}
} else {
	$forum = isset($_G['cache']['forums'][$rssfid]) && $_G['cache']['forums'][$rssfid]['type'] != 'group'?$_G['cache']['forums'][$rssfid]:array();
	if(!isset($_G['cache']['forums'][$rssfid])) {
		$forum = $_G['cache']['forums'][$rssfid] = array();
		$subforum = C::t('forum_forum')->fetch_info_by_fid($rssfid);
		if($subforum['type'] == 'sub') {
			$forum = $_G['cache']['forums'][$rssfid] = $subforum;
		}
	}
	if($forum && rssforumperm($forum)) {
		$fidarray = array($rssfid);
		$forumname = dhtmlspecialchars($_G['cache']['forums'][$rssfid]['name']);
	} else {
		exit('Specified forum not found');
	}
}

$frewriteflag = $trewriteflag = 0;
$havedomain = implode('',$_G['setting']['domain']['app']);
if(is_array($_G['setting']['rewritestatus']) && in_array('forum_forumdisplay',$_G['setting']['rewritestatus'])) {
	$frewriteflag = 1;
}
if(is_array($_G['setting']['rewritestatus']) && in_array('forum_viewthread',$_G['setting']['rewritestatus'])) {
	$trewriteflag = 1;
}

$charset = $_G['config']['output']['charset'];
dheader("Content-type: application/xml");
echo '<?xml version="1.0" encoding="utf-8"?><rss version="2.0"><channel>',
	(count($fidarray)>1?'<title>E维站长论坛</title><link>http://wuliu.v-get.com/i/</link><description>E维站长论坛，沟通网站建设者、网络营销者与企业的平台，全力为站长、技术人员和企业提供PHP/JSP/ASP.NET等技术交流以及站长交易中介服务、注册机、注册码、站长工具、建站源码软件下载等服务。</description>':"<title>$forumname _商务物流网_V-Get!</title><link>http://wuliu.v-get.com/i/topic-$rssfid-1.html</link><description>$forumname 最新 $num 条帖子</description>"
	),
	'<lastBuildDate>',gmdate('r',TIMESTAMP),'</lastBuildDate><ttl>',$ttl,'</ttl><image><url>http://tp.v-get.com/j/i/e125x33.png</url><title>商务物流网，专注网络营销！</title><link>http://wuliu.v-get.com/</link></image>';

if($fidarray) {
	$alldata = C::t('forum_rsscache')->fetch_all_by_fid($fidarray,$num);
	if($alldata) {
		foreach($alldata as $thread) {
			if(TIMESTAMP - $thread['lastupdate']>$ttl*60) {
				updatersscache($num);
				break;
			} else {
				list($thread['description'],$attachremote,$attachfile,$attachsize) = explode("\t",$thread['description']);
				if($attachfile) {
					if($attachremote) {
						$filename = $_G['setting']['ftp']['attachurl'].'forum/'.$attachfile;
					} else {
						$filename = (!strstr($_G['setting']['attachurl'],'://')?$_G['siteurl']:'').$_G['setting']['attachurl'].'forum/'.$attachfile;
					}
				}
				echo '<item><title>',$thread['subject'],'</title><link>http://wuliu.v-get.com/i/tip-',$thread[tid],'-1.html</link><description><![CDATA[',dhtmlspecialchars($thread['description']),']]></description><category>',dhtmlspecialchars($thread['forum']),'</category><author>http://wuliu.v-get.com/i/',dhtmlspecialchars($thread['author']),'</author>',($attachfile?'<enclosure url="'.$filename.'" length="'.$attachsize.'" type="image/jpeg" />':''),'<pubDate>',gmdate('r',$thread['dateline']),'</pubDate></item>';
			}
		}
	} else {
		updatersscache($num);
	}
}

echo '</channel></rss>';

function updatersscache($num) {
	global $_G;
	$processname = 'forum_rss_cache';
	if(discuz_process::islocked($processname,600)) {
		return false;
	}
	C::t('forum_rsscache')->truncate();
	require_once libfile('function/post');
	foreach($_G['cache']['forums'] as $fid => $forum) {
		if($forum['type'] != 'group') {
			$forum['name'] = addslashes($forum['name']);
			foreach(C::t('forum_thread')->fetch_all_by_fid_displayorder($fid,0,null,null,0,$num,'tid') as $thread) {
				$thread['author'] = $thread['author'] != ''?addslashes($thread['author']):'商务物流网';
				$thread['subject'] = addslashes($thread['subject']);
				$post = C::t('forum_post')->fetch_threadpost_by_tid_invisible($thread['tid']);
				$attachdata = '';
				$thread['message'] = $post['message'];
				$thread['status'] = $post['status'];
				$thread['description'] = $thread['readperm']>0 || $thread['price']>0 || $thread['status'] & 1?'':addslashes(messagecutstr($thread['message'],250 - strlen($attachdata)).$attachdata);
				C::t('forum_rsscache')->insert(array(
					'lastupdate'=>$_G['timestamp'],
					'fid'=>$fid,
					'tid'=>$thread['tid'],
					'dateline'=>$thread['dateline'],
					'forum'=>$forum['name'],
					'author'=>$thread['author'],
					'subject'=>$thread['subject'],
					'description'=>$thread['description']
				),false,true);
			}
		}
	}
	discuz_process::unlock($processname);
	return true;
}

?>