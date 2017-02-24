IP地址查询
演示地址：http://tbip.sinaapp.com
1.IP地址查询php版，采用淘宝IP地址库，非常的精准。并且会随着淘宝IP地址库实时更新。所以您获得的数据将会是最新的。
2.此代码非常简单。完全免费开源，可进行二次开发及修改等。
3.此文件分为两个版本，（1）通用版（2）sina SAE专版

.htaccess 通用版伪静态规则 其它规则请参考下面的进行修改
RewriteEngine on
RewriteRule ^(.*)$ index.php?id=$1 [L]

sina SAE专版伪静态规则
- rewrite: if (!is_dir() && !is_file() && path ~ "/(.*)" ) goto "index.php?$1"

如果不支持伪静态请看以下修改方法
打开index.php
找到第一行的
$weblink="http://".$weburl."/";
修改为
$weblink="http://".$weburl."/?";

新浪SAE免费php空间申请地址:http://sae.sina.com.cn/activity/invite/101149/weibo
新浪SAE免费php空间注册功略:http://hbwanghai.blog.163.com/blog/static/199297147201222310226519/


最新代码公布地址:http://xiaogg.ctdisk.com/u/349707/437278


推荐其它ip查询工具，http://ip.1tt.net 采用纯真IP库
