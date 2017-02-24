  (function(){
  	$('div[api="comment"]').append('<div id="SOHUCS"></div>');
    var appid = 'cyr74LmTP',
    conf = 'prod_e855c133ac38e1b4d136b6a4c12c4826';
    var doc = document,
    s = doc.createElement('script'),
    h = doc.getElementsByTagName('head')[0] || doc.head || doc.documentElement;
    s.type = 'text/javascript';
    s.charset = 'utf-8';
    s.src =  'http://assets.changyan.sohu.com/upload/changyan.js?conf='+ conf +'&appid=' + appid;
    h.insertBefore(s,h.firstChild);
    window.SCS_NO_IFRAME = true; // 是否有下面悬浮评论，注释掉就没有了
  })()