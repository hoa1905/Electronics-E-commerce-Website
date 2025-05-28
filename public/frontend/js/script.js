document.addEventListener("DOMContentLoaded", function(event) {
  var click_none = document.querySelector('#click_none_js')
  var ten_dang_nhap = document.querySelector('#ten_dang_nhap')
  var mat_khau = document.querySelector('#mat_khau')
  var form = document.querySelector('#form')
  var btn_dang_nhap = document.querySelector('#btn_dang_nhap')
  
  var alert_cart = document.querySelector('#alert_cart')
  var alert_success_profile = document.querySelector('#alert_success_profile')
  
  
  


    // btn_add_cart.addEventListener('click', function(event){
    //   alert_cart.style.display = 'block'
    // })

    // alert_cart.addEventListener('click', function(event){
    //   alert_cart.style.display = 'none'
    // })


    $('#btn_add_cart').on("click", function (e) {
      e.preventDefault();  
      alert_cart.style.display = 'block'            
      const goTo = $(this).attr("href");   
     
      setTimeout(function(){
        window.location = goTo;
      }, 1000);                           
    }); 

    
    // $('#btn_save').on("click", function (e) {
    //   e.preventDefault();  
    //   alert_success_profile.style.display = 'block'            
    //   const goTo = $(this).attr("href");   
     
    //   setTimeout(function(){
    //     window.location = goTo;
    //   }, 2000);                           
    // });



})