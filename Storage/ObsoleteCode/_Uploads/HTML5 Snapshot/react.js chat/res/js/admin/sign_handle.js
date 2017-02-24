
var Sign = {
  signOut: function(){
    localStorage.clear();
  }
};

$(function(){
  if(!('localStorage' in window && null !== window['localStorage'])){
    alert('您的浏览器版本过旧，请跟上时代更新浏览器');
    return;
  }

  if('/m-y-admin/' != window.location.pathname && (!localStorage['uid'] || !localStorage['token'])){
    window.location.href= '/m-y-admin/';
  }



});