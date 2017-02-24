<?php
//0=pass 1=编辑等级==控制前台编辑类型select 2=网站id
//同一个编辑一个时间内一个站点，就算是同时做高级编辑，帐号也要换一个
//以后编辑注册一律采用 @v-get.com  前面是纯英文+数字用户名，
//这样查询用户数据库的时候，就比较方法了
//编辑密码char(12)
$Usercheck=array('e'=>array('a123EF34VDA',9,'{"c8":[{"v9":2,"v5":40,"v1":20,"v0":10}]}'),'_'=>array('_',9,'{"c9999999":[{"v9":2,"v5":40,"v1":20,"v0":10}]}'),'editor'=>array('EDTmodwxFVW',0,'{"c3":[{"v9":2,"v5":40,"v1":20,"v0":10}]}'),'ningjing'=>array('Fw3Df20Md',0,'{"c100":[{"v9":2,"v5":40,"v1":20,"v0":10}]}'));
//0=$VGETID  1 插入网址
$CUScheck=array(100=>array('VGETID1IdwVd','http://localhost/tool/e.v-get.com_editor/_forcus1_discuz_utf8.php'),3=>array('WuLIu30NVsm2','http://localhost/tool/e.v-get.com_editor/_forcus2_wuliu.v-get.com.php'),8=>array('E8vDwosdnwVd','http://localhost/tool/e.v-get.com_editor/_forcus2_e.v-get.com.php'));
?>