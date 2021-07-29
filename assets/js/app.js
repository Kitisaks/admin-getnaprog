$(function() {

  //== Dropdown
  $('body').on('click', '.dropdown', function(){
    var id = $(this).attr('target-id');
    $('body #'+id).slideToggle('fast');
  });

  //== Login form


});



