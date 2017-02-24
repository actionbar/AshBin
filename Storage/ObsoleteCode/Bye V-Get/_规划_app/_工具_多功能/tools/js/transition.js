function fadein(){
mytransition.innerHTML=''
if (cur!='x'){
mytransition.filters.revealTrans.Transition=cur
mytransition.filters.revealTrans.apply()
mytransition.innerHTML='<p align="center"><a href="http://tools.kqiqi.com"><font face="Verdana">客齐齐实用查询工具-http://tools.kqiqi.com</font></a></p><big><big><p align="center"><a href="http://tools.kqiqi.com"><img src="../images/logo.gif" border="0"></a></p><p align="center"><font face="Verdana">客齐齐实用查询工具！</font></p>'
mytransition.filters.revealTrans.play()
}
else{
mytransition.filters.blendTrans.apply()
mytransition.innerHTML='<p align="center"><a href="http://tools.kqiqi.com"><font face="Verdana">客齐齐实用查询工具-http://tools.kqiqi.com</font></a></p><big><big><p align="center"><a href="http://tools.kqiqi.com"><img src="../images/logo.gif" border="0"></a></p><p align="center"><font face="Verdana">客齐齐实用查询工具！</font></p>'
mytransition.filters.blendTrans.play()
}
}