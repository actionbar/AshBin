

/*以前一直用jQurey的is(":visible")来判断，这也是 @红薯 在某文中推荐的~。
 一次偶然在chrome中发现这个函数居然是消耗CPU最多的，这个函数效率很低！
 经过一翻搜寻，终于找到了它：getBoundingClientRect()——获取element实际的top、bottom、left、right定位值，我们利用它计算element的高度，如果为0，即可认为element不可见。关键是，几乎所有浏览器都支持getBoundingClientRect*/
/*function isVisible(o) {
    var rect = $(o)[0].getBoundingClientRect();
    return !!(rect.bottom - rect.top);




点击 #email-popup 或  #phone-popup，显示，点击文档消失，用下面写法
 $("#email-popup, #phone-popup").on("click", function(e){
 e.stopPropagation();
 });

 $(".email").on("click", function(e){
 e.stopPropagation();
 $("#email-popup").show("fast");
 });

 $(".phone").on("click", function(e){
 e.stopPropagation();
 $("#phone-popup").show();
 });

 $(document).on("click", function() {
 $("#email-popup, #phone-popup").hide("fast");
 });


}*/

$(".t-i dd").hide();
$(".t-i").hover(function(){
    $(".t-i dd").show(99);
});

function hideTiDd(){
    $(".t-i dd").hide(99);
}
$(".t-i").mouseleave(function(){
    setTimeout('hideTiDd()', 200);
});


$(".i-l-avt-edt").hide();

$(".i-l-avt").hover(function(){
    $(".i-l-avt-edt").show(99);
});
$(".i-l-avt").mouseleave(function(){
    $(".i-l-avt-edt").hide(99);
});


