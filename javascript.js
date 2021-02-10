$(function(){
  $(".tab").eq(0).addClass("active");//最初のtabにactiveを追加
  $(".panel").eq(0).addClass("show");//最初のpanelにshowを追加
})
$(".tab").click(function(){
  var $th = $(this).index();
  $(".tab").removeClass("active");
  $(".panel").removeClass("show");
  $(this).addClass("active");
  $(".panel").eq($th).addClass("show");
});
