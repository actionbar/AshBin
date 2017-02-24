<?php

class TplLayouts{
    function layoutIndex($head_pre, $content){ // 默认layoutA 就是这个，每个 $content文件开头都必须先指定layout

        $CTpl = new \C\Tpl();
        // 下面开头连接 . 的编写规范，请参考 http://www.luexu.com/rules/all.xml


        $head = $head_pre . $CTpl->embed([
                Url_s::_JQ,
                Url_s::_CSS,
                Url_s::_JS,
                Url_s::WWW_CSS,
                Url_s::WWW_JS,
            ]);
        $head .= '<script>' . $CTpl->inc('sso/misc/if_logined_jump.js') .'</script>';


        $body = $CTpl->inc('u.htm') . '
                <div class="w-v">
                    <div class="w">
                        <div class="v">
          ' . $content . '
                        </div>
          ' . $CTpl->inc('b.htm') . '
                    </div>
                </div>
          ' . $CTpl->embed([
                Url_s::WWW_JS,
                Url_s::_FORM_JS
            ]);

        return [
            'head' => $head,
            'body' => $body
        ];
    }

    function layoutEdit($head_pre, $content){ // 默认layoutA 就是这个，每个 $content文件开头都必须先指定layout
        $CTpl = new \C\Tpl();
        // 下面开头连接 . 的编写规范，请参考 http://www.luexu.com/rules/all.xml

        $head = $head_pre . $CTpl->embed([
                Url_s::_JQ,
                Url_s::_CSS,
                Url_s::_JS,
                Url_s::WWW_CSS,
            ]);


        $body = $CTpl->inc('u_logined.php') . '
                <div class="w-v">
                    <div class="w">
                        <div class="v">
          ' . $content . '
                        </div>
          ' . $CTpl->inc('b.htm') . '
                    </div>
                </div>
        ' . $CTpl->embed([
                Url_s::WWW_JS,
                Url_s::_FORM_JS,
            ]);

        return [
            'head' => $head,
            'body' => $body
        ];
    }
}

?>