/*
 File Name: client-listing.js
 */
//-------------------------------------------------------------------------------------------


$(document).ready(function () {

  //no of items
  var Ino = $("#search-content .search-item").length;
  $('.page_header span').text(Ino + ' Records');

  //search
  $(".search-input").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#search-content .search-item").filter(function () {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    var count =  $("#search-content .search-item").filter(':visible').length;
    $('.page_header span').text(count + ' Records');
  });

})
