<?php
	!defined('IN_TW') && exit('Access Denied');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php if($expNo){echo $expNo, '详情 - ';} echo $expInfo[ 'title']; ?> - <?=$_config[ 'info'][ 'sitename']?></title>
    <meta name="keywords" content="<?php echo ($expNo?$expNo.',':''),$expInfo['keywords'];?>" />
    <meta name="description" content="<?php if($expNo){echo $expInfo['textname'],'单号：',$expNo,'详情。';} echo $expInfo['description']; ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=gbk" />
    <meta name="google-site-verification" content="-LqkCfg-ytcv9zh1okcZMaId2T3AGo5sv_awYoONQjY" />
    <link href="img/common.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/common.js" type="text/javascript" language="javascript"></script>
    <script language="javascript">
var __ready=false;
(function($) {
    $(function() {
		$('#submitbutton').val('查询').attr('disabled', false);
		window['__ready']=true;
		function ajaxSearch(){
            if (!/^[a-z\d]{5,}$/i.test($.trim($('#mailNo').val()))) {
                $('#mailNo').focus();
                return false;
            }
            if ($('#v_input') && !/^[a-z\d#\$@]+$/i.test($('#v_input').val())) {
                $('#v_input').focus();
                return false;
            }
            $('#submitbutton').val('查询中').attr('disabled', true);
            $('#sg,#tp,#ajax_html').hide();
            $('#ajax_loading').show();
            var data = $('#queryForm').formSerialize(); <?php
            if ($debug) {
                echo "return true;";
            } ?>$.post('query.do', data, showResult, 'json');
            return false;
		}
        function atachEvent() {
            var i = document.getElementById('v_input');
            var no = $.trim($('#mailNo').val());
            if (!no) {
                $('#mailNo').focus();
            } else if (i) {
                i.focus();
            } else {
                setTimeout(ajaxSearch,10);
            }
        };
        atachEvent();
        $('#queryForm').submit(ajaxSearch);
        function showResult(json) {
            $('#submitbutton').val('查询').attr('disabled', false);
            $('#ajax_loading').hide(); <?php
            if ($code == 'ems') { ?>$.get('<?=$_config['info']['siteurl']?>/<?=$code?>-' + $.trim($('#mailNo').val()) + '-ajax.html',
                function(data) {
                    $('#formContent').html(data);
                    atachEvent();
                }); <?php
            } else { ?>
                var img = document.getElementById('vImage');
                if (img) {
                    changeImage(img);
                } <?php
            } ?>
            var tiphtml = '下次可直接使用 <span id="s_url">';
            var url = '<?php echo $_config['info']['siteurl'],'/',$expName,'-';?>' + $.trim($('#mailNo').val()) + '.html';
            tiphtml += url;
            tiphtml += '</span>  进行查询，请<a href="javascript:void(0);" onclick="addFav(\'' + url + '\')">收藏</a>！';
            var html = '';
            /*Parse JSON*/
            if (json.status == 1 && (json.data.length > 0 || (json.html && json.html.length > 0))) {
                if (json.data.length > 0) {
                    html = '<table class="json_data">';
                    html += '<tr><td width="150" class="bluebg">日期</td><td class="bluebg">地点和跟踪进度</td></tr>';
                    var d = json.data;
                    for (var i = 0,
                    l = d.length; i < l; i++) {
                        html += '<tr><td>' + d[i].time + '</td><td>' + d[i].context + '</td></tr>';
                    }
                    html += '</table>';
                }
                if (json.html && json.html.length > 0) {
                    html += json.html;
                }
            } else {
                tiphtml += '<br>对不起，查询出现错误，请参阅以下提示：<br>' + json.message + '<br>注意：在查询高峰时可能会出现网速缓慢的情况，请多次查询，或是到<a href="<?=$expInfo['url ']?>" target="_blank"><?=$expInfo['textname ']?></a>官方网站查询。';
                $('#sg').show();
            }
            $('#tp').html(tiphtml).show();
            $('#ajax_html').html(html).show();
        };
		$('#showExps').click(function() {
			$('#moreexp').slideToggle('300',
			function() {
				if ($('#showexptext').text() == '其他快递查询') {
					$('#showexptext').text('隐藏部分');
				} else {
					$('#showexptext').text('其他快递查询');
				}
			});
			$('#showmoreexp').toggleClass('showmoreexp');
		});
                /*End Of Function*/
            });
        })(jQuery);
        function changeImage(o) {
            var u = o.src;
            u = u.replace(/\&t=(.*?)$/, '');
            o.src = u + '&t=' + Math.random();
            $('#v_input').val('').focus();
        }
    </script>
</head>
<body>
<?php include TW_ROOT.'./template/top.php'; ?>
<div class="header">
  <div style="width:960px; margin:auto; position: relative;">
    <div id="slogo"><a href="<?=$_config['info']['siteurl']?>/" title="<?=$_config['info']['sitename']?>">快递查询</a></div>
    <div id="tbanner">
      <script type="text/javascript">google_ad_client = "ca-pub-3195725015930868";google_ad_slot = "7358662348";google_ad_width = 728;google_ad_height = 90;</script>
      <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
    </div>
  </div>
</div>
<div class="main">
  <div class="l">
    <div class="nav"><span style="float:right"><?php if($expInfo['outlets']){printf('<a href="/outlets/%s.html">%s网点查询</a>',$expInfo['spellname'],$expInfo['textname']);}?></span>您当前位置：<a href="<?=$_config['info']['siteurl']?>/">快递查询</a>&raquo;<a href="<?=$expInfo['spellname']?>.html"><?=$expInfo['textname']?>单号查询</a><?php if($expNo){ ?>&raquo;<?=$expNo?>详情<?php } ?>
    </div>
    <!--Ad Here <div></div> -->
    <?php if($expInfo['note']){ ?>
    <div id="warning">公告：
      <?=$expInfo['note']?>
    </div>
    <?php } ?>
    <div class="sbox">
      <div id="explogo"><a href="<?=$expInfo['url']?>" style=" background-image:url(img/logo/<?=$expInfo['code']?>.jpg); " target="_blank" title="到<?=$expInfo['textname']?>官方网站" rel="nofollow">
        <?=$expInfo['textname']?>
      </a></div>
      <div>
        <div style="float:right; margin-left: 5px; border: 1px solid #ddd; height: 60px; width: 575px; font-size: 15px; line-height: 150%; vertical-align: middle;">
          <form action="query.do" method="post" id="queryForm">
            <div style="padding:2px 5px;"><span id="formContent">
              <?php require TW_ROOT.'./template/query_form.php';?>
              </span>
              <input name="button" type="submit" class="btn" id="submitbutton" style="width:65px;" value="查询" />
              <img src="img/ajaxloading.gif" width="16" height="16" id="ajax_loading" alt="快递查询中" title="快递查询中" /></span></div>
          </form>
          <div style="color:#333; padding: 0 5px; border-top: 2px solid #FFF;">客服电话：
            <?=$expInfo['tel']?>
            <g:plusone size="small"></g:plusone>
          </div>
        </div>
      </div>
    </div>
    <div class="m">
      <div class="tip" id="tp">注意：在查询高峰时可能会出现网速缓慢的情况，请稍后查询，或是到<a href="<?=$expInfo['url']?>" target="_blank">
        <?=$expInfo['textname']?>
      </a>官方网站查询。</div>
      <div id="sg" style="padding:10px;"><strong>操作建议:</strong>
        <ol style="padding:0 0 0 40px; margin:0;">
          <li>
			请核对您手中的单号是否为<span style="color:#F00; font-weight:bold"><?=$expInfo['textname']?>单号</span>；
		  </li>
          <?php if($expInfo['nodesc']){ echo '<li><strong>',$expInfo['nodesc'],'；</strong></li>';} ?>
          <li>刚发的快递，有时第二天才可查到；</li>
          <li>历史单号一段时间后会失效；</li>
          <li>[LP]开头的是淘宝内部单号，用运单号码才可查询。</li>
        </ol>
      </div>
      <div class="result" id="ajax_html"></div>
      <!--Ad Here <div></div> -->
    </div>
  </div>
  <div class="r">
    <div class="c" style="padding:15px 0 1px 10px;">
      <div class="h">查询其他快递</div>
      <div id="elist">
        <ul>
          <?php
		  $i=0;
		foreach($allexpress as $row){
			if($row['ord']==0)continue;
			if($i===15){
				echo '</ul><div style="line-height:24px;height:24px;cursor:pointer;" id="showExps"><span id="showmoreexp" class="showmoreexp"></span><span id="showexptext">其他快递查询</span></div><div id="moreexp" style="display:none;"><ul id="moreexpli">';
			}
			echo '<li><a href="',$row['spellname'],'.html">',$row['textname'],'查询</a></li>';
			++$i;
		}
	  ?>
          <li><a href="more/">其他快递公司</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div style="clear:both; border-top:1px solid #dedede;"></div>
</div>
<?php require TW_ROOT.'./template/footer.php'; ?>