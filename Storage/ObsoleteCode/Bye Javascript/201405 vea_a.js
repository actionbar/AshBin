(function(){
function f(){}
f.prototype={
    utf8len:function(s){
        var c,i=0,l=0; 
        for(i;i<s.length;i++){
            c=s.charCodeAt(i);
            if(c<0x007f)l++;
            else if((0x0080<=c)&&(c<=0x07ff))l+=2;
            else if((0x0800<=c)&&(c<=0xffff))l+=3;
            else l+=4;
        }
        return l;
    },
   

    tableModify:function(j){
    // j= {type:init/add/modify/cancel/update,_this:id,ajax={url:'htt'}}
        var t=j.type;
        var _td=function(a){return a.parentNode};
        var _tr=function(a){return _td(_td(a))};
        function hidden(a){ //还原
            //a=$(a)[0];
            var tr=_tr(a);
            $(tr).find('td[_td_not_modify!="1"]').each(function(i,td){
                $(td).html($(td).attr('_innerval'));
            });
            $(tr).find('a').css('display','none');
            $(tr).find('a.sve-tablemodify-a').css('display','block');
        }
        if(t=='init'){
            $('tr[svetradd="1"]').append('<td class="sve-tablemodify-td-appened"><a href="javascript:void(0)" class="sve-sort-botton-add" style="border-color:#999;border-radius:3px;background:#eee;">添加</a></td>');
            $('tbody.sve-sort-tbody tr[svetradd!="1"]').append('<td _td_not_modify="1" class="sve-tablemodify-td-appened"><a href="javascript:void(0)" class="sve-tablemodify-a">修改</a><a href="javascript:void(0)" class="sve-tablemodify-update" style="display:none">确认</a><a href="javascript:void(0)" class="sve-tablemodify-cancel" style="display:none">取消</a><span class="p"></span></td>');
            
            $('td.sve-tablemodify-td-appened a').css({'cursor':'pointer','border-radius':'3px','float':'left','border':'1px solid #ccc','margin':'0 5px','width':'34px','height':'22px','line-height':'22px','text-align':'center','text-decoration':'none'});
            $('td.sve-tablemodify-td-appened a').hover(
                function(){$(this).css({'background':'#eee'})},
                function(){$(this).css({'background':'#fff'})}
                );

        }
        if(t=='modify'){
            $('a.sve-tablemodify-a').click(function(){
                //alert(this.parentNode.parentNode);
                $(_tr(this)).find('td[_td_not_modify!="1"]').each(function(i,td){
                
                   
                    var pure_html=$(td).attr('_value') || td.innerHTML;
                    var attr='';
                    // 下面详细见 ys.js
                    Y.F(['_readonly','_type','_minlen','_maxlen','_len','_unique','_name'],function(i){
                        if($(td).attr(i)){
                            attr+=i+'="'+$(td).attr(i)+'"';
                            if('readonly'==i)attr+=' style="border:0;background:#eee;text-align:center"';
                        }
                    });
                   

                    $(td).attr('_innerval', pure_html);
                    $(td).html('<input type="text" value="'+pure_html+'" '+ attr +'>');

                });

                VE.inputFilter(); //重新设置一次
                $(_td(this)).find('a').css('display','block');
                $(this).css('display','none');
                $(_td(this)).find('span').html('');
                
            });
        }

        if(t=='cancel'){
            $('a.sve-tablemodify-cancel').click(function(){
                 hidden(this);
            });
        }

        if(t=='update'){
            $('a.sve-tablemodify-update').click(function(){
                var no_error=true,nochanged=true,tr=_tr(this), ajax_data={};
                 // input 可能是text 也可能是Hidden
                $(tr).find('input').each(function(i,input){
                    var n=$(input).attr('_name');
                    VE.emCount(input);  // 为input自动添加_error
                    no_error= '1' != $(input).attr('_error');  // ve里面的错误，
                    if(no_error){
                        var value=$(input).val();
                        // 不需要urlencode了
                        ajax_data[n]=value;
                        //ajax_data+='&'+$(input).attr('_name')+'='+encodeURIComponent(value);
                        if(value != $(_td(input)).attr('_innerval')){
                            nochanged=false;
                            $(_td(input)).attr('_innerval',value);
                        }
                    }
                    else{
                        alert(n +'：错误');
                        return false; // 停止 each
                    }
                    

                });
                if(no_error){
                    if(nochanged){hidden(this);}
                    else{
                        var span_tip=$(_td(this)).find('span')[0];
                    
                        if('undefined' != j.ajax){  // 传递来了ajax
                            var x=j.ajax;
                        //alert(ajax_data.eng);
                            $(span_tip).html('<em style="color:#f00">修改失败</em>');
                            $.ajax({
                            //type:'POST',
                                type:x.type||'GET',
                            //async:false,
                            // 必须要带 http://
                                url:x.url,
                                data:ajax_data,
                                success:function(r){
                                    x.success(r, span_tip);
                                    hidden(span_tip);
                                    $(tr).css('background','#f6fff5');
                                
                                },
                        

                            });
                        }

                    }
                }	
           });
        }
        if(t=='add'){
            $('a.sve-sort-botton-add').click(function(){
                var no_error=true, tr=_tr(this), ajax_data={};
                // input 可能是text 也可能是Hidden
                $(tr).find('input').each(function(i, input){
                    var v=$(input).val();
                    VE.emCount(input);  // 为input自动添加_error
                    var name=$(input).attr('_name');
                    
                    no_error= '1' != $(input).attr('_error');  // ve里面的错误，
                    
                    
                   

                    if($(input).attr('_unique')){  // 当前字段不可重复
                        var u=$(input).attr('_unique');
                        $('td[_unique="'+u+'"]').each(function(i, td){
                            if(v == $(td).html()){
                                no_error=false;
                                alert(name+'：'+v+' 已经重复');
                                return false;
                            }
                        });
                    }
                    if(no_error){ajax_data[name]=v;}
                    else{
                        return false; //退出$(tr).find('input').each
                    }
                 });
        //console.log(ajax_data);
            if(no_error){
                if('undefined'!=j.ajax){
                    var x=j.ajax;
                    $.ajax({
                        type:x.type||'GET',
                        //async:false,
                        // 必须要带 http://
                        url:x.url,
                        data:ajax_data,
                        success:function(r){
                            if(x.success_bool(r)){  //通过success 返回bool
                                var trHtml='<tr style="background:#fcf6f4"><td>'+r+'</td>';
                                for(var i in ajax_data){
                                    trHtml+='<td>'+ajax_data[i]+'</td>'
                                }
                                trHtml+='<td></td></tr>';
                                $(tr).after(trHtml);
                                // 下面一定是text，不要对Hidden进行清空
                                $(tr).find('input:text').val('');
                            }
                            else{alert('后台或数据库出错');}
                           
                        },
                    

                    });
                }
            }
            

        });
        }

    },





}





window.yzxVEA_A=new f(); //内部使用，避免重复
window.VEA_A=window.yzxVEA_A;

})();