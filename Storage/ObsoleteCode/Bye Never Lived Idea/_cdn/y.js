(function () {
    function f() {
    }

    f.prototype = {
        errId: function (j) {  // api err

        },
        t: function () {
            return new Date().getTime();
        },
        init: function () {
            // Y.a();
        },
        f: function (a, f, y, z) {  // for(var i  in array)    i 不是 array元素，而只是数字0 1 2.。。，所以自定义一个 F()函数
            if (a)
                for (var i = (y || 0); i < (z || a.length); i++)
                    f(a[i], i);
        },


        /*  window.location
         hash	 从井号 (#) 开始的 URL（锚）
         host	 主机名和当前 URL 的端口号
         hostname	 当前 URL 的主机名
         href	 完整的 URL
         pathname	 当前 URL 的路径部分
         port	 当前 URL 的端口号
         protocol	 当前 URL 的协议
         search	 从问号 (?) 开始的 URL（查询部分）*/

//获取 location.search的 某个参数  v-get.com/s?l=1&k=我爱你   location.search  就是 ?l=1
        // l()  返回  当前网址
//l ('k') ==>得到  我爱你   $k('k',I) ==>得到   %E6%88%91%E7%88%B1%E4%BD%A0
//l('k',O,'http://e.v-get.com/s?ie=utf8&sk=love');
//为了确保有时候对 没有问号的也进行这个操作，所以必须要对没有问号的情况进行判断

        l: function (k, not_decode, l) {
            l = l || window.location.search;
            if (!k)
                return l;

            k += "=";

            var r = '', p = l.split('?');

            if (p.length<2)
                return false;
           // console.log(p);

            Y.f(p[1].split('&'), function (i) {
                var x = k.length;
                if (k == i.substr(0, x))
                    r = i.substr(x);
            });

// r 可以为  '0' ，当为 '' 返回 ''，由于是截取的字符串，所以不可能为  0
            return r && (not_decode ? r : decodeURI(r))
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
                        Y.f([
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

            /*
             * hash的链接，保持链接可以访问
             <a href="#email"></a><a href="#phone"></a>
             */


            $('#' + d + ' a').each(function (i, a) {
                var h = $(a).attr("href");
                /* 替换 链接 # */
                if (window.location.hash && RegExp(window.location.hash + '$').test(h)) {
                    $('#' + d + ' a').removeClass(d + '-ao');
                    $(a).addClass(d + '-ao');
                }
                /* 替换 #  */
                if (/#$/.test(h)) {
                    $(a).attr({"href": "javascript:;"});
                }
            });


            $('.' + d + '-block').hide();

            var index_ao = $('#' + d + ' a').index($('.' + d + '-ao')[0]);
            $('.' + d + '-block').eq($('#' + d + ' a').index(index_ao)).show(90);

            function x(a) {
                if (!$(a).hasClass(d + '-ao')) {
                    $('#' + d + ' a').removeClass(d + '-ao');
                    $(a).addClass(d + '-ao');
                    $('.' + d + '-block').hide(50);

                    $('.' + d + '-block').eq($('#' + d + ' a').index(a)).show(50);
                }
                f && f(a);
            }

            'click' == t ? $('#' + d + ' a').click(function () {
                x(this)
            }) : $('#' + d + ' a').mouseover(function () {
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
// $cookie_name, $value, $expire_seconds, $path = '/', $domain = false, $secure = false, $is_value_raw = false

        cookie: function (k, v, d, p, l, s, r) {
            var x = document.cookie, c, e, t = new Date();
            if ('undefined' === typeof(v)) {
                // document.cookie 是元素，所以直接判断

                c = x ? x.split('; ') : [];

                for (var i = 0; i < c.length; i++) {
                    e = c[i].split('=');

                    if (k && k === e[0]) {
                        // 替换url里面的 + 为空格
                        return decodeURIComponent(e[1].replace(/\+/g, ' '));
                    }

                }
                return false;

            }
            else { // 可以是 '' 0 false
                // d 可能为负数，表示cookie 失效，d 可以是小数
                d = d || 9;   // 不能使用 (d||9)*86400
                d *= 864e5;
                t.setTime(t.getTime() + d);
                v = r ? v : encodeURIComponent(v);
                c = k + "=" + v + "; expires=" + t.toUTCString();
                c += p ? ('; path=' + p) : '';
                c += l ? ('; domain=' + l) : '';
                c += s ? ('; secure=' + s) : '';
                document.cookie = c;
            }
        },
        removeCookie: function (k, p, l) {
            Y.cookie(k, 0, -9, p || '', l || '');
            return !Y.cookie(k);
        },
        /*以前一直用jQurey的is(":visible")来判断，这也是 @红薯 在某文中推荐的~。
         一次偶然在chrome中发现这个函数居然是消耗CPU最多的，这个函数效率很低！
         经过一翻搜寻，终于找到了它：getBoundingClientRect()——获取element实际的top、bottom、left、right定位值，我们利用它计算element的高度，如果为0，即可认为element不可见。关键是，几乎所有浏览器都支持getBoundingClientRect*/
        isVisible: function (o, time) {
            var rect = $(o)[0].getBoundingClientRect(), vis = !!(rect.bottom - rect.top);
            if (time == undefined)
                return vis;

            vis ? $(o).hide(time) : $(o).show(time);

        },

        J: function (l, f, h, p) {
            /*
             l = javascript link(eg. ) or html node (eg. div/span..)
             f = function or attribute(eg. 'class=love' / 'id=love')
             h = html
             p = where to pend

            'div class=love',f 如果是函数，就是f(s),如果不是就是 H(s,h),o
             J(O,function(s){s.className="a";s.id="b"})
             创建 div class="a" id="b"
             J('http://e.v-get.com/a.js',function(s){})
             J('span',function(s){});
             如果 function $x(s,x,f){return s.indexOf(x,f|0)}
             b=$x(l,'.')
             */
            var j = "script", s;
            if (/[^\w]/.test(l)) {
                s = Y.J(j);
                s.readyState ? (s.onreadystatechange = function () {
                    if (s.readyState == "loaded" || s.readyState == "complete") {
                        s.onreadystatechange = null;
                        f && f(s)
                    }
                }) : (s.onload = function () {
                    f && f(s)
                });
                s.src = l;
                return s
            }
            else {
                var o = document.createElement(l || 'div'), a;
                if (f) {
                    a = f.split('=');
                    $(o).addAttr(a[0], a[1]);
                }
                h && $(o).html(h);
                p = p || document.body;
                p.appendChild(o);
                l == j && (o.type = "text/java" + j);
                return o
            }
        }


    };


    window.Y = new f(); //内部使用，避免重复

// 必须要加载完毕后执行
    $(document).ready(function () {
        Y.init()
    });
})();