<?php if(!defined('HDWIKI_ROOT')) exit('Access Denied');?>
<?php ob_end_clean();?>
<?php ob_start();?>
<?php @header("Expires: -1");?>
<?php @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);?>
<?php @header("Pragma: no-cache");?>
<?php @header("Content-type: application/xml; charset=$charset");?>
<?php echo '<?xml version="1.0" encoding="'.WIKI_CHARSET.'"?>';?>
<root>
<?php if(isset($piclist)) { ?>
	<list><![CDATA[<?php foreach((array)$piclist as $key=>$data) {?>
		<li id="li_<?php echo $key?>" onclick="pic.change_pic(<?php echo $data['id']?>,<?php echo $key?>)"><a href="javascript:void(0);" class="a-img1"><img src="<?php echo $data['attachment']?>" alt="<?php echo $data['description']?>" /></a></li>
		<?php }?>]]></list>
<?php } ?>
<?php if(isset($pic)) { ?>
	<pic><data0><![CDATA[<img src="<?php echo $pic['attachment']?>"/> ]]></data0><data1><![CDATA[<?php echo $pic['description']?>]]></data1><data2><![CDATA[<?php echo $pic['fileborder']?>]]></data2><data3><![CDATA[<?php echo $pic['filesize']?>]]></data3><data4><![CDATA[<?php echo $pic['filetype']?>]]></data4><data5><![CDATA[ <a href="?user-space-<?php echo $pic['uid']?>" target="_blank"><?php echo $pic['username']?></a> ]]></data5></pic>
<?php } ?>
</root>
