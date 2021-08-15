$(function () {

  //== Setup for csrf_token
  $.ajaxSetup({
    data: window.token
  });

  //== Clock
  clockUpdate();
  setInterval(clockUpdate, 1000);

  function clockUpdate() {
    let date = new Date()
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
    function Option(x) {
      if (x > 12) {
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
  $('body').on('click', '.dropdown', function () {
    let id = $(this).attr('target-id');
    $('body #' + id).slideToggle('fast');
    return false;
  });
  //== Readmore
  readmore();
  function readmore() {
    let str_limit = 360;
    let readmore_txt = '...เพิ่มเติม';
    let readless_txt = 'ย่อ';
    $('body .add-readmore').each(function () {
      let str_all = $(this).text();
      if (str_all.length > str_limit) {
        let first_sec = str_all.substring(0, str_limit); //original section
        let secd_sec = str_all.substring(str_limit, str_all.length); //hide section
        let str_add = first_sec + '<span class="sec-sec">' + secd_sec + '</span><span class="readmore" title="click to show more">' + readmore_txt +
          '</span><span class="readless" title="click to show less">' + readless_txt + '</span>';
        $(this).html(str_add);
      }
    });
  }
  $('body').on('click', '.readmore, .readless', function () {
    $(this).closest('body .add-readmore').toggleClass('show-less show-more');
    return false;
  });

  //== pop up status
  $('body').on('click', '.popup-close', function () {
    $('body .popup').hide();
    return false;
  });

  //== close alert
  $('body').on('click', '#alert-cancel', function () {
    $('body .alert-del').hide();
    return false;
  });

  //== sidebar menu new project
  $('body').on('click', '.project-menu', function () {
    let target = $(this).attr('data-id');
    $('body .project-menu').removeClass('bg-gray-50 text-indigo-700 hover:bg-white');
    $(this).addClass('bg-gray-50 text-indigo-700 hover:bg-white');
    $('body .show').hide();
    $('body #' + target).show();
    return false;
  });

  //== create new project form
  // $('body').on('submit', '#project-create-form', function (e) {
  //   e.preventDefault();
  //   let data = new FormData($(this)[0]);
  //   console.log(data);
  //   $.ajax({
  //     url: $(this).action,
  //     type: $(this).method,
  //     data: data,
  //     cache: false,
  //     contentType: false,
  //     processData: false,
  //     beforeSend: function () {

  //     }

  //   });
  //   return false;
  // });

  //== Side menu new project
  $('body').on('click', '.side-next', function () {
    alert("kuy");

    return false;
  });

  //== Previw File upload
  function image_preview(file, size, preview_img, preview_url=false) {
    let reader = new FileReader();
    if (file.size <= size) {
      preview_img.empty();
      reader.onload = function (e) {
        $('<img >', {
          'src': e.target.result,
          'class': 'h-full w-full'
        }).appendTo(preview_img);
      }
      if (preview_url) {
        if (file.size < 1000) {
          preview_url.html('name: '+file.name+', size: '+file.size+' Byte');
        } else if (file.size >= 1000 && file.size < 1000000) {
          preview_url.html('name: '+file.name+', size: '+file.size/1000+' KB');
        } else if (file.size >= 1000000) {
          preview_url.html('name: '+file.name+', size: '+file.size/1000000+' MB');
        }
      }
      preview_img.show();
      reader.readAsDataURL(file);
    } else {
      if (preview_url) {
        if (size < 1000) {
          preview_url.html("<b class='text-red-600'>maximum</b> image size is "+size+" Byte");
        } else if (size >= 1000 && size < 1000000) {
          preview_url.html("<b class='text-red-600'>maximum</b> image size is "+size/1000+" KB");
        } else if (size >= 1000000) {
          preview_url.html("<b class='text-red-600'>maximum</b> image size is "+size/1000000+" MB");
        }
      }
    }
  }

  //favicon preview
  $('body').on('change', '#favicon-upload', function () {
    let target_id = $(this).attr('data-id');
    //params for usez
    let size = $(this).attr('max-size');
    let preview_img = $("body span[id='"+target_id+"']");
    let preview_url = $("body p[id='"+target_id+"']");
    let file = $(this)[0].files[0];
    image_preview(file, size, preview_img, preview_url);
    return false;
  });

  $('body').on('change', '#cover-image-upload', function(){
    let target_id = $(this).attr('data-id');
    //params for use;
    let size = $(this).attr('max-size');
    let preview_img = $("body div[id='"+target_id+"']");
    let preview_url = $("body p[id='"+target_id+"']");
    let file = $(this)[0].files[0];
    image_preview(file, size, preview_img, preview_url);
    return false;
  });




});