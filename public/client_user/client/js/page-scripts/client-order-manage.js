/*
 filename: client-order-manage.js
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

  //recschedule Swal
 /* $(document).on('click', '.btn-reschedule', function (e) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#78d278',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Reschedule'
    }).then((result) => {

      swal.fire({
        icon: 'success',
        title: 'Order Rescheduled.',
        showConfirmButton: true
      });
      // $(this).removeClass('approve').addClass('delete').text('Inactive').prepend('<i class="fa fa-fw fa-ban mr-1"></i>');
      $(this).text('Rescheduled').attr('disabled','true').css('cursor','not-allowed');
    })
  });*/

})
