/* 文章的编辑器 */
(function(){
function f(){}
f.prototype={
    jsonSeq:function(json, strOrCount){  // 对json排序，按照后面的数字排序  strOrCount 默认返回字符串数组[中国,日本]
        // var json={'中国':2000,'日本':10340,'韩国':200,'朝鲜':1,'美国':2000,'台湾':200}
        //var json = {'x':200,'a':200,'b':3,'c':30,'d':1000 ,'中国':200};
var arr = [];
for(var i in json){

   var o = {};
   o[i] = json[i];

   arr.push({
      'v' : json[i],
      'e' : o
   });

}
arr.sort(function(a,b){return b.v - a.v});



var r={};
for(var i = 0; i < arr.length; i ++){
   var oe = arr[i]["e"];
   for(var e in oe){
   r[e]=oe[e];
     
   }  
}
//console.log(r);
return r;
    },
    isInArr:function(str, a, index){  // index =ture 就是比较 id，如 {'中国':100} 就是中国，如没有index，那么就是100
        //var l=arr.length;

        for(var i in a){
            if(str==(index?i:a[i]))return true;
            //if(i==(l-1)&&str!=arr[i])return false
            /*这里不能用三元，因为不符合，不用返回的。否则不符合就返回了，一直不符合*/
        }
        return false;
    },

    splitToArr:function(str){
        var arr=[];
        for(var k in str.replace('，',',').split(',')){
            if(k.length>1 && !yzxVE.isInArr(k,arr)){
                arr.push(k);
            }
        }
    return arr;
    },

    descriptionMousedown:function(){
        
        $('textarea[name="sved"]').mousedown(function(){
          var f=$("#ueditor_0").contents().find("body").html();
          if(f.length>50 && !/[？\?。\.！\!]$/.test($(this).val())){
            
            f=f.replace(/<[^>]+>/gi,'');
            f=f.substr(0,85);
            f=f.replace(/([？\?。\.！\!])[^？\?。\.！\!]+/,'$1');
            $(this).val(f);
          }
        });
        
    },
    keywordsAuto:function(str,o){ // 避免性能，keywords完全自动获取
        /* 这里n 加括号，是为下面替换用的，而不是为了test */
          /* 这里n 加括号，是为下面替换用的，而不是为了test */
        var a=[], n='([^a-zA-Z\/\%\.\<\>\"\'\?\&\%\=\_\-])',z=function(k){return RegExp(n+(k.replace(/([\+\-\$])/g,'\\$1'))+n,'ig')}, kv='',k_json={};  // k_json 就是关键词数量的json  
        o=o?o:$('input:hidden[name="svek"]');
        str=str||api_keywords;
        
        Y.F(str.split(','),function(k){k.length>0 && !yzxVEF.isInArr(k,a) && a.push(k);});
        $('input:submit').click(function(){
             for(var i in a){
                var k=a[i];
                var count=$('textarea[name="content"]').val().match(z(k));
            
                if(count)k_json[k]=count.length;
                

               }

           //console.log(k_json);
            var seq=yzxVEF.jsonSeq(k_json);
            if(seq){
                console.log(seq);
                for(var k in seq){
                    if(yzxVE.utf8len(kv+k)<60 && kv.indexOf(k)<0){
                        kv+=","+k;
                     // 将隐藏的textarea文章中关键词替换成大小写符合的，并防止 .html 等被替换
                    $('textarea[name="content"]').val($('textarea[name="content"]').val().replace(z(k),'$1'+k+'$2'));
                     }

                }
                kv=yzxVE.blurFilter(kv, 'keywords');
                $(o).val(VE.utf8len(kv)>60?kv.replace(/,[^,]+,*$/,''):kv);

            }
        });
    },
    originAlter:function(){
        var o='#sve-s input[name="sveorigin"]',u='#sve-s input[name="sveoriginurl"]',n='#sve-s input[name="sveoriginname"]',origin=$(o).val();

    
        if(origin){
         /\"/.test(origin) && $(u).val(origin.replace(/^.+href=\"([^\"]+)\".+$/,'$1'));
         $(n).val(origin.replace(/<[^>]+>/g,''));

        }

        $('#sve-s input[name^="sveorigin"]').blur(function(){
            $(o).val(/^http\:\/\//.test($(u).val())?('<a href="'+$(u).val()+'">'+$(n).val()+'</a>'):$(n).val());
        });
    },

   
}





window.yzxVEF=new f(); //内部使用，避免重复
window.VEF=window.yzxVEF;

})();