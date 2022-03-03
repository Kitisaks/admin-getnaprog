tailwind.config = {
  theme: {
    extend: {
      fontFamily: {
        'sans': ['Inter var experimental'],
      },
      typography: {
        DEFAULT: {
          css: {
            strong: {
              color: 'inherit'
            }
          }
        }
      }
    },
    variants: {
      animation: ['responsive', 'motion-safe', 'motion-reduce'],
      extend: {}
    }
  }
}

$(function () {

  // Setup for csrf_token
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('head meta[name="csrf_token"]').attr('content')
    }
  });


  // Your code here...
  $('body').on('click', '#test', () => {
    alert("ok")
  })

  //
});