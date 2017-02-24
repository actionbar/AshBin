$(function() {

  $('.l-user ul').slideUp(300);


  $('#l_user_popup').on('click', function(){
    if($('.l-user ul').is(':hidden'))
      $('.l-user ul').slideDown(300);
    else
      $('.l-user ul').slideUp(300);
  });


  $('.l-menu ul').hide();


  $('.l-menu h3').on('click', function (e) {
    $('.l-menu ul').hide(300);
    $('.l-menu').removeClass('l-menu-show');
    $(this).siblings('ul').show(300);
    $(this).parent('.l-menu').addClass('l-menu-show');

  })

});