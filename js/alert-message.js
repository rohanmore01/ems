$(document).ready(function(){

    $('.succ').on('click',function(){
    $('#success h1,#success p,#success .succ').css({display:'none'});

    $('#success').animate({
      width:'0',
    },250,function(){
      $('#success .icon').animate({
        borderRadius:'50%',
      },250,function(){

        $('#success .icon').animate({
          opacity:0
        },250);
      });
    });
  });
  
});