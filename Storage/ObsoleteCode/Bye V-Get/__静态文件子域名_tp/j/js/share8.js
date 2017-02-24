(function(){
  var param={
    url:location.href,
    type:'3',
    count:'1', /**是否显示分享数，1显示(可选)*/
    appkey:'3657814714', /**您申请的应用appkey,显示分享来源(可选)*/
    title:'', /**分享的文字内容(可选，默认为所在页面的title)*/
    pic:'', /**分享图标的路径(可选)*/
    ralateUid:'1651714954', /**关联用户的UID，分享微博会@该用户(可选)*/
    language:'zh_cn', /**设置语言，zh_cn|zh_tw(可选)*/
    dpc:1
  }
  var temp=[];for(var p in param){temp.push(p+'='+encodeURIComponent(param[p]||''))}document.write('<iframe allowTransparency="true" frameborder="0" scrolling="no" src="http://service.weibo.com/staticjs/weiboshare.html?'+temp.join('&')+'" width="72" height="16"></iframe>')
})()


