/*
 File Name: client-details.js
 */
//-------------------------------------------------------------------------------------------


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
      
      //toast message on submit review
      $(document).on('click', '#review-submit-btn', function () {
            Toast.fire({
                  icon: 'success',
                  title: 'Review Submitted'
                });
      });


        




})