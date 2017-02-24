DROP TABLE IF EXISTS `iv_badwords`;
CREATE TABLE IF NOT EXISTS `iv_badwords` (
  `badword` varchar(255) NOT NULL default '',
  `replacement` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`badword`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_fans`;
CREATE TABLE IF NOT EXISTS `iv_fans` (
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(15) NOT NULL,
  `who` mediumint(8) unsigned NOT NULL default '0',
  `whosname` char(15) NOT NULL default '',
  `addtime` int(10) unsigned NOT NULL default '0',
  KEY `uid` (`uid`,`addtime`),
  KEY `who` (`who`,`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_members`;
CREATE TABLE IF NOT EXISTS `iv_members` (
  `uid` mediumint(8) unsigned NOT NULL auto_increment,
  `is_admin` tinyint(1) unsigned NOT NULL default '0',
  `username` char(15) NOT NULL default '',
  `password` char(32) NOT NULL default '',
  `gender` tinyint(1) NOT NULL default '0',
  `regip` char(15) NOT NULL default '',
  `regdate` int(10) unsigned NOT NULL default '0',
  `lastvisit` int(10) unsigned NOT NULL default '0',
  `lastactivity` int(10) unsigned NOT NULL default '0',
  `credits` int(10) NOT NULL default '0',
  `email` char(40) NOT NULL default '',
  `bday` date NOT NULL default '0000-00-00',
  `newpm` tinyint(1) unsigned NOT NULL default '0',
  `notes` mediumint(8) unsigned NOT NULL default '0',
  `fans` mediumint(8) unsigned NOT NULL default '0',
  `follows` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_notes`;
CREATE TABLE IF NOT EXISTS `iv_notes` (
  `nid` int(10) unsigned NOT NULL auto_increment,
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(15) NOT NULL default '',
  `note` text NOT NULL,
  `dateline` int(10) unsigned NOT NULL default '0',
  `from` enum('www','3g','wap','api') NOT NULL default 'www',
  `refer_id` int(10) unsigned NOT NULL default '0',
  `refers` mediumint(8) unsigned NOT NULL default '0',
  `comments` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`nid`),
  KEY `uid` (`uid`),
  KEY `refer_id` (`refer_id`),
  KEY `refers` (`refers`,`dateline`),
  KEY `comments` (`comments`,`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_note_attaches`;
CREATE TABLE IF NOT EXISTS `iv_note_attaches` (
  `aid` int(10) unsigned NOT NULL auto_increment,
  `nid` int(10) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `attachtype` enum('link','img','file') NOT NULL default 'file',
  `dateline` int(10) unsigned NOT NULL default '0',
  `filename` varchar(100) NOT NULL default '',
  `filetype` varchar(50) NOT NULL default '',
  `filesize` int(10) unsigned NOT NULL default '0',
  `attachment` varchar(300) NOT NULL default '',
  `downloads` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`aid`),
  KEY `nid` (`nid`),
  KEY `uid` (`uid`,`attachtype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_note_comments`;
CREATE TABLE IF NOT EXISTS `iv_note_comments` (
  `mid` int(10) unsigned NOT NULL auto_increment,
  `nid` int(10) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(15) NOT NULL default '',
  `dateline` int(10) unsigned NOT NULL default '0',
  `comment` text NOT NULL,
  `from` enum('www','3g','wap','api') NOT NULL default 'www',
  PRIMARY KEY  (`mid`),
  KEY `uid` (`uid`,`nid`),
  KEY `nid` (`nid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_note_mentioned`;
CREATE TABLE IF NOT EXISTS `iv_note_mentioned` (
  `nid` int(10) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  KEY `uid` (`uid`,`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_pms`;
CREATE TABLE IF NOT EXISTS `iv_pms` (
  `pmid` int(10) unsigned NOT NULL auto_increment,
  `msgfrom` char(15) NOT NULL default '',
  `msgfromid` mediumint(8) unsigned NOT NULL default '0',
  `msgto` char(15) NOT NULL default '',
  `msgtoid` mediumint(8) unsigned NOT NULL default '0',
  `folder` enum('inbox','outbox') default NULL,
  `new` tinyint(1) NOT NULL default '0',
  `subject` varchar(75) NOT NULL default '',
  `dateline` int(10) unsigned NOT NULL default '0',
  `message` text NOT NULL,
  PRIMARY KEY  (`pmid`),
  KEY `msgtoid` (`msgtoid`,`folder`,`dateline`),
  KEY `msgfromid` (`msgfromid`,`folder`,`dateline`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_sessions`;
CREATE TABLE IF NOT EXISTS `iv_sessions` (
  `sid` char(6) character set utf8 collate utf8_bin NOT NULL default '',
  `ip1` tinyint(3) unsigned NOT NULL default '0',
  `ip2` tinyint(3) unsigned NOT NULL default '0',
  `ip3` tinyint(3) unsigned NOT NULL default '0',
  `ip4` tinyint(3) unsigned NOT NULL default '0',
  `uid` mediumint(8) unsigned NOT NULL default '0',
  `username` char(15) NOT NULL default '',
  `lastactivity` int(10) unsigned NOT NULL default '0',
  `seccode` char(5) NOT NULL default '',
  `pageviews` smallint(6) unsigned NOT NULL default '0',
  UNIQUE KEY `sid` (`sid`),
  KEY `uid` (`uid`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_settings`;
CREATE TABLE IF NOT EXISTS `iv_settings` (
  `variable` varchar(32) NOT NULL default '',
  `value` text NOT NULL,
  PRIMARY KEY  (`variable`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_tag2note`;
CREATE TABLE IF NOT EXISTS `iv_tag2note` (
  `tagname` char(20) NOT NULL default '',
  `nid` int(10) unsigned NOT NULL default '0',
  KEY `tagname` (`tagname`),
  KEY `nid` (`nid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `iv_tags`;
CREATE TABLE IF NOT EXISTS `iv_tags` (
  `tagname` char(20) NOT NULL default '',
  `updateline` int(10) NOT NULL default '0',
  `total` mediumint(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`tagname`),
  KEY `total` (`total`,`updateline`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
