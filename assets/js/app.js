$(function() {
  //== Clock
  clockUpdate();
  setInterval(clockUpdate, 1000);
  function clockUpdate() {
    let date = new Date();
    function addZero(x) {
      if (x < 10) {
        return '0' + x;
      } else {
        return x;
      }
    }
    function twelveHour(x) {
      if (x > 12) {
        return x - 12;
      } else if (x == 0) {
        return 12;
      } else {
        return x;
      }
    }
    function Option(x){
      if (x > 12){
        return 'AM';
      } else {
        return 'PM';
      }
    }
    let h = addZero(twelveHour(date.getHours()));
    let m = addZero(date.getMinutes());
    let s = addZero(date.getSeconds());
    let o = Option(date.getHours());
    $('.clock').text(h + ':' + m + ':' + s + ' ' + o);
  }

  //== Dropdown
  $('body').on('click', '.dropdown', function(){
    let id = $(this).attr('target-id');
    $('body #'+id).slideToggle('fast');
    return false;
  });

  //== Side bar
  $('body').on('click', '.close-sidebar', function(){
    $('body #close-sidebar').hide("normal", function (){ 
      $('body #open-sidebar').show("normal");
    });
    return false;
  });

  //== Readmore
  readmore();

  function readmore(){
    let str_limit = 360;
    let readmore_txt = '...เพิ่มเติม';
    let readless_txt = 'ย่อ';

    $('body .add-readmore').each(function(){ 
      let str_all = $(this).text();
      if (str_all.length > str_limit){
        let first_sec = str_all.substring(0, str_limit); //original section
        let secd_sec = str_all.substring(str_limit, str_all.length); //hide section
        let str_add = first_sec + '<span class="sec-sec">' + secd_sec + '</span><span class="readmore" title="click to show more">' + readmore_txt +
        '</span><span class="readless" title="click to show less">' + readless_txt + '</span>';
        $(this).html(str_add);
      }
    });
  }
  $('body').on('click', '.readmore, .readless', function(){
    $(this).closest('body .add-readmore').toggleClass('show-less show-more');
    return false;
  });


  //== pop up status
  $('body').on('click', '.popup-close', function(){
    $('body .popup').hide();
    return false;
  });

  //== close alert
  $('body').on('click', '#alert-cancel', function(){  
    $('body .alert-del').hide();
    return false;
  });

});



