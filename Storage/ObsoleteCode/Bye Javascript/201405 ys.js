/* 基础的编辑器内容 
 自定义属性，都以 _ 开头  ，下面修改需要同时修改 vea_a 里面的  
 data-type=" 用空格隔开 /  datetime/email/number 、 _d/tel/ mobile/ _w 【\w】   lowcase 【a-z】】"
 _blurtype="" 专门为 blur 设计的type,比如 htmlspecialchars 【替换'<>"】 / user 【/[\u4E00-\u9FA5\w]/u 非数字开头的中、英、下划线、数字】/ keywords 【/[\u4E00-\u9FA5\w,\s\-\+\.]/u ，且不能存在开头 、2个以上[,\s\+\-\.]】 /  ends  【必须以 。.？?！! 结尾】


 data-errmsg  【】错误后的报错信息

 data-counter="【input的name】"   一般用于 em ，用于统计这个input字数
 data-len    4 【4个字符】   0-6 【0-6个字符】
 data-type =  可多选

 【html已经有的，email/url/number【包括.】/range/日期选择器 (date, month, week, time, datetime, datetime-local)/search/color/range】
 ---- error【有错误】
 ---- placelen 【字数统计用汉字2字符，英文1字符】


 ---- captcha 【a-zA-Z\d】
 data-blur = blur替换， 可多选
 ---- account 【username + mail + mobile】
 --- html 【替换<>】
 ---- sk  【/[\u4E00-\u9FA5\w,\s\-\+\.]/u ，且不能存在开头 、2个以上[,\s\+\-\.]】
 ---- notrim【不取消首尾空格和换行符等，默认是取消的】

 data-unique="【不可重复的unique名称】" 若是td，就是其内部的
 data-name  一般用于 td内部新建的 input 的 name
 data-readonly  如果用于 td，就表示其内部的input readonly
 data-td_not_modify  不用修改的td
 data-innerval   td内部的input value






 */
(function () {

    function f() {
    }

    f.prototype = {
        formEleErrCls: 's-err',
        placeLen: function (s) {  //返回占位符长度，一个中文字符的占位是2，英文字符是1* 用于用户名长度判断，*/
            var l = 0;
            for (var i = 0; i < s.length; i++) {
                l += s.charCodeAt(i) < 0x007f ? 1 : 2;
            }
            return l;
        },
        utf8Len: function (s) {
            var c, i, l = 0;
            for (i = 0; i < s.length; i++) {
                c = s.charCodeAt(i);
                if (c < 0x007f)l++;
                else if ((0x0080 <= c) && (c <= 0x07ff))l += 2;
                else if ((0x0800 <= c) && (c <= 0xffff))l += 3;
                else l += 4;
            }
            return l;
        },
        isUsername: function (s) {
            return /^[a-zA-Z\u4e00-\u9fa5][\u4e00-\u9fa5\w\-]+[a-zA-Z\u4e00-\u9fa5]$/.test(s);
        },
        isMail: function (s) {
            return /^[\w\-\.]+\@[\w\-]+(\.[a-z]+)+$/.test(s);
        },
        isMobile: function (s) {  // 手机号形式可能很多
            return /^\d+$/.test(s);
        },
        accountType: function (s) {

            var username = 1, mail = 2, mobile = 3;
            var t = YS.isMobile(s) ? mobile : 0;
            t = YS.isMail(s) ? mail : t;
            return YS.isUsername(s) ? username : t;

        },
        trim: function (o) {
        },
        count: function (o) {
            /* count 计数 */

            function err(o) { // 不通过，就为这个input 添加一个属性 _error="1"
                $(o).addClass(YS.formEleErrCls);
            }

            function ok(o) {
                $(o).removeClass(YS.formEleErrCls);
            }

            var l = $(o).val();
            l = $(o).data('type') && /placelen/.test($(o).data('type')) ? YS.placeLen(l) : YS.utf8Len(l);
            //$('em[data-counter="' + $(o).attr('name') + '"]').html(l);
            // utf8 字数不要超标

            if ($(o).data('len')) {
                /*
                 【12】   【0-12】
                 * */
                var e = $(o).data('len');

                e = e.toString().split('-');
                var x = e.length;

                if (x > 1)
                    l > parseInt(e[1]) || l < parseInt(e[0]) ? err(o) : ok(o);
                else
                    l == parseInt(e[0]) ? ok(o) : err(o);
            }
        },
        blurTrim: function (o) {
            var s = $(o).val(), blur = $(o).data('blur');

            if (!blur || !/notrim/.test($(o).data('type'))) {
                s = s.replace(/^[\s　]+|[\s　]+$/g, '');
                s = s.replace(/\s+/g, ' ');
            }

            if (blur) {
                Y.f(blur.replace(/\s+/, ' ').split(' '), function (b) {
                    if ('html' == b) {
                        Y.f([
                            ['—', '#8212'],
                            ['\'', '#39'],
                            ['\"', 'quot'],
                            ['<', 'lt'],
                            ['>', 'gt'],
                            ['\\\\', '#92']
                        ], function (r) {
                            s = s.replace(RegExp(r[0], 'g'), '&' + r[1] + ';');
                        });
                    }
                    if ('sk' == b) {
                        s = s.replace(/[，,]+/g, ',');
                        s = s.replace(/([\s\-\+\.,])+/g, '$1');
                        s = s.replace(/^[,\s\-\+\.]+|[,\s\-\+\.]+$/g, '');
                        s = s.replace(/[^\u4E00-\u9FA5\w,\-\+\s\.]/g, '');
                    }
                });
            }
            $(o).val(s);

        },

        errTip:function(o, s){
            s = s || $(o).data('errmsg') || ($(o).attr('placeholder') + '错误！');
            var tip = $(o).parents('form').find('.s-err-tip');
            $(tip).hide(180);
            $(tip).html(s);
            $(tip).show(180);
            $(o).focus();
        },
        submit:function(o,e){
            var r =true;  // 用于返回，让提交按钮后面代码停止执行
            $(o).parents('form').find('.s-err-tip').hide(180);
            $(o).parents('form').find('input, select, textarea').each(function (i, o) {

                YS.blurTrim(o);
                YS.count(o);
                if($(o).hasClass(YS.formEleErrCls)){
                    e&&e.preventDefault();//此处阻止提交表单
                    YS.errTip(o);
                    r=false;
                    return r; // break each input/select/textarea
                }
            });
            return r;
        },
        init: function () {

            // As well as there is no class="s-err-tip" in a form, add a node p[class=s-err-tip] at the beginning.

            $('form').each(function(i, s){

                var t= $(s).find('.s-err-tip');

                t.length<1 && $(s).prepend('<p class="s-err-tip"></p>');
            });

            var o = 'input:text, input:password, textarea';
            $(o).bind('input propertychange', function () {
                var o = this;
                YS.count(o);
            });


            $(o).blur(function () {
                var o = this;
                YS.blurTrim(o);
                YS.count(o);
            });

            $('input:submit').click(function (e) {
                YS.submit($(this),e);
            });
        },


        sortHTML: function (selected_json, json, id) {  // 将json放入sorts
            //selected_json  {selectName:selectedValue}
            var html = '', pre = function (b) {
            };
            json = json || sveSortJson;

            for (var name in json) {
                html += '<select name="' + name + '">';  // name一律加前缀 sve 如果json第一个为 "":"" 就表示这个选项必填

                var j = json[name][0];
                html += 1 == j.select_necessary ? '<option></option>' : '';  // 是否是必须选择
                for (var x in j) {
                    var v = j[x];
                    if (x != 'select_necessary') {  // select_necesarry 是默认判断是否必填的
                        html += '<option value="' + v + '"';
                        html += selected_json[name] && v == parseInt(selected_json[name]) ? ' selected="selected" ' : '';
                        html += '>' + x + '</option>';
                    }
                }


                html += '</select>';
            }

            $(id || '#sve-site-sorts').html(html);
        }


    };


    window.YS = new f(); //内部使用，避免重复
    $(document).ready(function () {
        YS.init()
    });

})();