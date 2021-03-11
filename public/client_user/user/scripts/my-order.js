/*
 filename: my-order.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

      //Close modal by click ESC key
      $(document).on('keyup' , function(e){
          if (e.keyCode === 27 ){
            $('#viewordermodal').modal('hide');
          }
      })   
    
    })
    