var s=$('fes');
E(s.fep,'change',function(){
if(/^[a-z\d]+$/.test(s.fep.value)){$('imgftp').src='_insert_imgLocalhost.php?imgfilecity='+$p(s.feb.options[s.feb.selectedIndex].text,'=')[0]+'&p='+s.fep.value;D($('imgftp'),I)}
else{D($('imgftp'))}
});
E(s.fea,'change',function(){
if(s.fea.value>0&&s.feb.value>0){$A('_insertajax.php',s.fea.value+'&b='+s.feb.value,$('cselect'));}});

E(s.feb,'change',function(){

$("feho").value=$p(this.options[this.selectedIndex].text,'=')[1]+$("feho").value;
s.fep.style.visibility="visible";
if(s.fea.value>0&&s.feb.value>0){$A('_insertajax.php',s.fea.value+'&b='+s.feb.value,$('cselect'));}



});



/* E($("fesubmit"),'click',function(){
s.fev.value=s.fev.value?s.fev.value:0;
if(L8(s.fee.value)>13||L8(s.fem.value)>13||L8(s.fep.value)>13||(L(s.fem.value)>0&&L(s.fee.value)>0&&s.fem.value!=s.fee.value)){alert('标题H超长，或m和e不相同');return O}
//RAND()*50+$V*50+$E?50:0+$M?50:0+论坛积分/10
s.feo.value=$i(Math.random()*50)+s.fev.value*50+(L(s.fee.value)>0?50:0)+(L(s.fem.value)>0?50:0);
if($i(s.fea.value)<1||$i(s.feb.value)<1||$i(s.fec.value)<1){alert('确定A B C类别');return O;}

if(L8(s.feh.value)>75||L8(s.feh.value)<9){alert('标题');return O}
if(L8(s.fed.value)>999){alert('D超长');return O}
if(L8(s.fed.value)>999){alert('D超长');return O}
if(L(s.fez.value)!=20){alert('z坐标');return O}
this.submit();

} */