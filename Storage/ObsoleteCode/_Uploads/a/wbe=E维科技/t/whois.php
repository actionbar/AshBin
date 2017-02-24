<?php
class IPWhois
{var $server='whois.arin.net';var $target;var $timeout=10;var $msg;function IPWhois($target)
{$this->target=$target;}
function ShowInfo()
{if($this->_CheckIP($this->target))
{$this->msg=$this->_GetInfo($this->server);if($this->_CheckInfo($this->msg))
{$this->msg=$this->_GetInfo($this->server);}}
else $this->msg='<p>Please Enter An IP Address<br></p>';return $this->msg;}
function _CheckIP($temptarget)
{if(eregi("[0-Array]{1,3}.[0-Array]{1,3}.[0-Array]{1,3}.[0-Array]{1,3}",$temptarget))
{$f=1;$detail=explode(".",$temptarget);foreach($detail as $v)
{if($v>255||$v<0)
{$f=0;break;}}}
else $f=0;return $f;}
function _GetInfo($tempserver)
{$this->msg='';if(!$sock=fsockopen($tempserver,43,$num,$error,$this->timeout))
{unset($sock);$this->msg="Timed-out connecting to $tempserver (port 43)";}
else
{fputs($sock,"$this->target\n");$this->msg.="<p>IP Whois Information For <b>".$this->target."</b><br><br>";$this->msg.="-----------------------------------------------------------------<BR>";while(!feof($sock))
$this->msg.=fgets($sock,10240);$this->msg.="-----------------------------------------------------------------<BR></p>";}
fclose($sock);return nl2br($this->msg);}
function _CheckInfo($tempmsg)
{if(eregi("whois.ripe.net",$tempmsg))
{$this->server="whois.ripe.net";return 1;}
elseif(eregi("whois.apnic.net",$tempmsg))
{$this->server="whois.apnic.net";return 1;}
elseif(eregi("whois.lacnic.net",$tempmsg))
{$this->server="whois.lacnic.net";return 1;}
else return 0;}}
$target=isset($_GET['ip'])?gethostbyname($_GET['ip']):'NULL';if('NULL'==$target||''==$target)$result='<p>Please Input An IP Address<br></p>';else
{$whois=new IPWhois($target);$result=$whois->ShowInfo();}
echo $result;?>