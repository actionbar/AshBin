function chicks(where){
jsstr=String.fromCharCode(60)
if(where.value.indexOf('↓')!=-1)
{

where.value=where.value.replace('加密↓','解密↑')
txt1.disabled=true;txt1.style.backgroundColor='dddddd'
txt2.disabled=false;txt2.style.backgroundColor='white'
ok2.disabled=false;ok2.focus();
ok1.disabled=true;len1.disabled=true;len2.disabled=false;
if(where.id=='js1'){
txt2.value='<script>document.write(unescape(\''+escape(txt1.value)+'\'))'+jsstr+'/script>'
txt1.value=""}
else{
txt2.value='<textarea style="display:none" id=YUZI>'+vbsstr+'</textarea>'+jsstr+'script language=vbs>document.write(strreverse(YUZI.value))'+String.fromCharCode(60)+'/script>'
txt1.value=""}

}else{

where.value=where.value.replace('解密↑','加密↓')
txt1.disabled=false;txt1.style.backgroundColor='white'
txt2.disabled=true;txt2.style.backgroundColor='dddddd'
ok2.disabled=true;txt1.focus();ok1.disabled=false;len1.disabled=false;len2.disabled=true;
if(where.id=='js1'){txt1.value=unescape(txt2.value.replace('<script>document.write(unescape(\'','').replace('\'))'+jsstr+'/script>',''))
txt2.value=""}
else{
txt1.value=vbstr
txt2.value=""}

}}
function runpath(whattxt){
msg1=open('','','')
msg1.document.open()
msg1.document.write(whattxt)
msg1.document.close()
}