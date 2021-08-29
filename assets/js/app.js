$(function () {

  //== Setup for csrf_token
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('head meta[name="csrf-token"]').attr('content')
    }
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
    $('body .popup').fadeOut("normal");
    return false;
  });

  //== close alert
  $('body').on('click', '#alert-cancel', function(){  
    $('body #alert-del').fadeOut("normal");
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

  //== close notice
  $('body').on('click', '#notice-close', function() {
    $('body #notice').fadeOut('normal');
    return false;
  })

  // //== Side menu new project
  // $('body').on('click', '.side-next', function () {
  //   alert("kuy");

  //   return false;
  // });

  //== Previw File upload
  function image_preview(file, size, preview_img, preview_url = false) {
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
          preview_url.html('name: ' + file.name + ', size: ' + file.size + ' Byte');
        } else if (file.size >= 1000 && file.size < 1000000) {
          preview_url.html('name: ' + file.name + ', size: ' + file.size / 1000 + ' KB');
        } else if (file.size >= 1000000) {
          preview_url.html('name: ' + file.name + ', size: ' + file.size / 1000000 + ' MB');
        }
      }
      preview_img.show();
      reader.readAsDataURL(file);
    } else {
      if (preview_url) {
        if (size < 1000) {
          preview_url.html("<b class='text-red-600'>maximum</b> image size is " + size + " Byte");
        } else if (size >= 1000 && size < 1000000) {
          preview_url.html("<b class='text-red-600'>maximum</b> image size is " + size / 1000 + " KB");
        } else if (size >= 1000000) {
          preview_url.html("<b class='text-red-600'>maximum</b> image size is " + size / 1000000 + " MB");
        }
      }
    }
  }

  //favicon preview
  $('body').on('change', '#favicon-upload', function () {
    let target_id = $(this).attr('data-id');
    //params for usez
    let size = $(this).attr('max-size');
    let preview_img = $("body span[id='" + target_id + "']");
    let preview_url = $("body p[id='" + target_id + "']");
    let file = $(this)[0].files[0];
    image_preview(file, size, preview_img, preview_url);
    return false;
  });

  $('body').on('change', '#cover-image-upload', function () {
    let target_id = $(this).attr('data-id');
    //params for use;
    let size = $(this).attr('max-size');
    let preview_img = $("body div[id='" + target_id + "']");
    let preview_url = $("body p[id='" + target_id + "']");
    let file = $(this)[0].files[0];
    image_preview(file, size, preview_img, preview_url);
    return false;
  });

  //== Open code editor
  $('body').on('click', '#toggle-code-editor', function () {
    $('body #code-editor').toggleClass('hidden');
    $('body #text-editor').toggleClass('hidden block');
    return false;
  });

  //== Tags separate
  $("#tags input").on({
    focusout : function() {
      let txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
      if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this}).addClass('inline-flex rounded-sm items-center py-0.5 pl-2.5 pr-1 text-sm font-medium bg-indigo-100 text-indigo-700').append(`
      <button type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:outline-none focus:bg-indigo-500 focus:text-white">
      <span class="sr-only">Remove large option</span>
        <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
          <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
        </svg>
      </button>`
      );
      this.value = "";
    },
    keyup : function(ev) {
      // if: comma|enter (delimit more keyCodes with | pipe)
      if(/(188|13)/.test(ev.which)) $(this).focusout(); 
    }
  });
  $('#tags').on('click', 'span button', function() {
    $(this).closest('#tags span').remove();
  });






});