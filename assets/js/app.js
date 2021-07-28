$(function() {

  //== Dropdown
  $('body').on('click', '.dropdown', function(){
    var id = $(this).attr('target-id');
    $('body #'+id).slideToggle('fast');
  });

  //== Login form
//   $('body').on('submit','.sign-in', function(e){
//     e.preventDefault();
//     var url = $(this).attr("action");
//     var type = $(this).attr("method");
//     var data = $(this).serialize();
//     console.log(data);
//     $.ajax({
//       type: type,
//       url: url,
//       data: data,
//       processData: false,
//       success: function(param){
//         if(param.status == true){
//           aler
//         }
//       }

//     });
  
//   });

});



