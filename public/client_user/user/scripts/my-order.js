/*
 filename: my-order.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

  const confirmbox = Swal.mixin({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
  });

  $(document).on('click', '.od_approve', function () {
    confirmbox.fire({
      showLoaderOnConfirm: true,
      preConfirm: () => {
        $(this).remove();
        $('.od_status').addClass('approved').removeClass('pending').text('Completed');
      }
    });
  })
  
      //Close modal by click ESC key
      /* $(document).on('keyup' , function(e){
          if (e.keyCode === 27 ){
            $('#viewordermodal').modal('hide');
          }
      }) */   
    
    })
    