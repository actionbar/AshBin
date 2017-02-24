


(function () {
    function f() {
    }

    f.prototype = {
        o: function () {
            Y.a();
        },
        /* F: function (a, f, y, z) {  // for(var i  in array)    i 不是 array元素，而只是数字0 1 2.。。，所以自定义一个 F()函数
            if (a)for (var i in a)f(a[i], i);
        },
 */
        /* V-Get 跳转链接 */
        L: function (l, d) {
            d = '(' + (d || 'v-get.com|weigeti.com|kepou.com|luexu.com|gupou.com') + ')$';
            l = l.replace(/^https?\:\/\//, '');
            //防止 thunder://  ftp:// 这种情况
            if (l.match(/^\w+\:\/\/.+$/))return l;
            if (!l.match(/.+\..+/))return '#';
            if (!l.split('/')[0].match(RegExp(d.replace('.', '\.')))) {
                l = encodeURIComponent(l);
                l = 'http://www.v-get.com/l.htm?l=' + l;
            }

            l = ('://' == l.substr(5, 7)) ? l : ('http://' + l);
            return l
        },
        $L: function (h) {  // 还原 www.v-get.com/l.htm?l=，适用于标签a，以及 l.htm内部跳转
            var l = 'www.v-get.com/l.htm?l=';

            if (h.indexOf(l) > -1) {  // 必须要判断，适用于网页内链接
                h = h.replace(/%\w{2}/g, function (a) {
                    return String.fromCharCode('0x' + parseInt(a.substr(1)))
                });
                return h.replace(l, '')
            }
        },

        A: function (o, t) {

            /* //对所有 http://s.v-get.com/l?l= 进行js化，无法使用js的才跳转302
             //A(o,t,x,y) A('id','_blank')  A('','_blank',2,5) 所有A,从第二个到第5个A才变成 '_blank'
             每个这个函数的a,都会生成   <a href="" _target="_target">
             如果 已经 A();  然后又对d 使用  A(d,'_self');  这时候再使用 A(G(d)) ==== A(G(d),'_blank')就无效了，
             A(id,'_');  这是设置不可修改的_blank ，或者已经被修改成_self后，再修改回_blank的a
             必须使用  A(G(d),'_');
             1.  A(G(d),'_'); 在 A(G(d),'_self') 前;
             t='_' 成立 所以  i.target=k;  _blank='_'
             执行 A(G(d),'_self')  因为 _blank =='_' 所以不执行
             2. 在后  i.target='_self'; _blank='_self';
             t='_' 成立，执行  i.target=k; _blank='_';
             */
            var k = '_blank', h, g, j = "javascript:", e;
            t = t || '';

            $(o || 'a').each(function (i, a) {
                g = a.target || k;
                h = a.href.replace(/^(.*)\#*$/, '$1');

                // 链接以javascript:开头、链接是当前链接，或者以#结尾
                if (j == h.substr(0, 11) || !a.href || h == document.URL.replace(/(.+)\#*$/, '$1')) {
                    a.href = j + ';'
                }
                // 没有设置_blank="_" 属性的，或者没有设置target的
                else if ('undefined' == $(a).attr(k) && ('_' == t || k == a.target)) {
                    a.target = t || k;
                    $(a).attr(k, t); // 设置 _blank= _/_blank
                    // 设置 v-get 链接
                    a.href = Y.$L(a.href);
                    // 设置title  显示a的 title,取消 <a><img>dfasf&lt;</img></a>的 <img> 和  &lt;等情况
                    if (!a.title) {
                        e = $(a).html();
                        Y.F([
                            ['<[^>]+alt="([^"]+)"[^>]*>', '$1'],
                            ['<[^>]+>', ''],
                            ['&#34;', '"'],
                            ['&#39;', "'"],
                            ['&lt;', '<'],
                            ['&gt;', '>']
                        ], function (u) {
                            e = e.replace(RegExp(u[0], "g"), u[1])
                        });
                        a.title = e ? e : '';
                    }
                }
            });
        },
        D: function (d, t, f) {  /* d 是class id   t=mouseover【默认】/click
         <div id="service-info-cda" class="a">
         <a href="#" class="service-info-cda">产品介绍</a><a href="#">功能参数</a><a href="#">模版展示</a><a href="#">成功案例</a><a href="#" >常见问题</a><a href="#">增值服务</a><a href="#">支付说明</a>
         </div>

         <div id="service-info-cda-c"> <div class="service-info-cda-1"><div class="service-info-cda-2"> */
            $('.' + d).not(':first-child').hide();

            function x(a) {
                $(a).attr({"href": "javascript:;"});


                if (!$(a).hasClass(d + '-a')) {
                    $('#' + d + '-a a').removeClass(d + '-a');
                    $(a).addClass(d + '-a');
                    $('.' + d).hide();
                    $('.' + d).eq($('#' + d + '-a a').index(a)).show();
                }
                f && f(a);
            }

            'click' == t ? $('#' + d + '-a a').click(function () {
                x(this)
            }) : $('#' + d + '-a a').mouseover(function () {
                x(this)
            });
        },


//setCookie(c_name,value,d)==清空cookie就直接day=0 day只能是0-31就行  getCookie(c_name)  这里 v可以为0
//网吧换用户会清空cookie，所以cookie用天最好。这
//setDate是天，这里以天为单位
//K(k,v,t) 有就是 设置cookie(参数，值，实效时间)

        /*
         传递参数时需要使用encodeURIComponent，这样组合的url才不会被#等特殊字符截断。
        最多使用的应为encodeURIComponent，它是将中文、韩文等特殊字符转换成utf-8格式的url编码，所以如果给后台传递参数需要使用encodeURIComponent时需要后台解码对utf-8支持（form中的编码方式和当前页面编码方式相同）

         escape不编码字符有69个：*，+，-，.，/，@，_，0-9，a-z，A-Z

         encodeURI不编码字符有82个：!，#，$，&，'，(，)，*，+，,，-，.，/，:，;，=，?，@，_，~，0-9，a-z，A-Z

         encodeURIComponent不编码字符有71个：!， '，(，)，*，-，.，_，~，0-9，a-z，A-Z
         */
// $cookie_name, $value, $expire_seconds, $path = '/', $domain = false, $secure = false, $do_urlencode = true
        K: function (k, v, d, p, l, s, e) {
            var x = document.cookie, c, e, t = new Date();
            if ('undefined' != typeof(v)) {  // 可以是 '' 0 false
                // d 可能为负数，表示cookie 失效
                t.setDate(t.getDate() + ('number' == typeof(d) ? d : 9));
                document.cookie = k + "=" + encodeURIComponent(v) + ";expires=" + t.toGMTString()
            }
            else {
// document.cookie 是元素，所以直接判断
                if (x) {
                    c = $x(x, k + "=");
                    if (c > -1) {
                        c = c + L(k) + 1;
                        e = $x(x, ";", c);
                        if (e < 0)e = L(x);
                        return decodeURIComponent(x.substring(c, e))
                    }
                }
                return ""

            }
        },


    }


    window.Y = new f(); //内部使用，避免重复
    
// 必须要加载完毕后执行
    $(document).ready(function () {
        Y.o()
    });
})();