

$(function () {
  var update_online_status_timer_start = false;

  function updateOnlineStatus(){
    $.ajax({
      method:'POST',
      url: Conf.host + '/v0/?c=Timer&a=updateUserOnlineStatus',
      contentTypes: 'application/json',
      headers:{
        'guid': navigator.userAgent,
        'token': localStorage['token']
      },

      success: function(data, status){
        console.log('已经更新了登录状态');
      },
      complete: function(XMLHttpRequest, status){

      },
      error: function(XMLHttpRequest, textStatus, errorThrow){
        signErr('定时器 ajax 访问服务器错误');
      },
      beforeSend: function(XMLHttpRequest){
        XMLHttpRequest.setRequestHeader('guid', navigator.userAgent);
      }
    });
  }
  function updateOnlineStatusTimer(){
    if(update_online_status_timer_start)
      return;
    updateOnlineStatus();
    setInterval(updateOnlineStatus, 200000);
    update_online_status_timer_start = true;
  }

  if(!('localStorage' in window && null !== window['localStorage'])){
    alert('您的浏览器版本过旧，请跟上时代更新浏览器');
    return;
  }

$('.sign-out').on('click', function(){
  localStorage.clear();
  alert('您已经安全退出');
  window.location.href= '/m-y-admin/';
});


if(localStorage['uid']){
    $('.sign-box').hide();
    $('.sign-fade-in').hide();
    if(parseInt(localStorage['doctorId']) > 0)
      updateOnlineStatusTimer();
  }

  $('.sign-box').shake(8,9,100);


  function signErr(errmsg){
    $('.sign-box').css('marginLeft', -229);
    $('.sign-box').shake(5,15,100);
    alert(errmsg)
  }

  $('#sign_form').on('submit', function(e){
    e.preventDefault();

    var acc = $(this).find('input[name="account"]').val();
    var passwd = $(this).find('input[name="passwd"]').val();

    $.ajax({
      method:'POST',
      url: Conf.host + '/v0/?c=Sso&a=signIn',
      contentTypes: 'application/json',
      headers:{
        'guid': navigator.userAgent
      },
      data:{
        account: acc, passwd: passwd
      },
      success: function(data, status){
        if(parseInt(data.errcode) > 0){
          signErr(data.errmsg);
          return;
        }

        for(var k in data.data){
          localStorage[k] = data.data[k];
        }

        if(parseInt(localStorage['doctorId']) > 0)
          updateOnlineStatusTimer();



          $('.sign-box').hide();
          $('.sign-fade-in').hide();
          window.location.href= '/m-y-admin/';

      },
      complete: function(XMLHttpRequest, status){

      },
      error: function(XMLHttpRequest, textStatus, errorThrow){
        signErr('ajax 访问服务器错误');
      },
      beforeSend: function(XMLHttpRequest){
        XMLHttpRequest.setRequestHeader('guid', navigator.userAgent);
      }
    });


  });
});

jQuery.fn.shake = function(times,offset,delay) {//次数,偏移,间隔
  this.stop().each(function() {
    var Obj = $(this);
    var marginLeft = parseInt(Obj.css('margin-left'));
    var delay = delay > 20 ? delay : 20;
    Obj.animate({'margin-left':marginLeft+offset},delay,function(){
      Obj.animate({'margin-left':marginLeft},delay,function(){
        times = times - 1;
        if(times > 0)
          Obj.shake(times,offset,delay);
      })
    });

  });
  return this;
}