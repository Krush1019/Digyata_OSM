/*
 filename: client-service-listing.js
 author: digyata
*/
//------------------------------------------------------------------------------------------------

$(document).ready(function () {

  const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-left',
    showConfirmButton: true,
    showCancelLink: true,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  //Close modal by click ESC key
  $(document).on('keyup' , function(e){
    if (e.keyCode === 27 ){
      $('#viewservicemodal').modal('hide');
    }
})   

  //status change
  $(document).on('click', '.s_status', function (e) {
    var status = $(this).text();
    if(status === "Active")
      status = "Blocked"
    else if (status === "Blocked")
      status = "Active"

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#78d278',
      cancelButtonColor: '#d33',
      confirmButtonText: status
    }).then((result) => {

      Toast.fire({
        icon: 'success',
        title: 'Status Changed'
      });
        if ($(this).text() === 'Active'){
          $(this).removeClass('approve').addClass('delete').text('Inactive').prepend('<i class="fa fa-fw fa-ban mr-1"></i>');
        } else {
          $(this).removeClass('delete').addClass('approve').text('Active').prepend('<i class="fa fa-fw fa-check mr-1"></i>');
        }
    })
  });

})
