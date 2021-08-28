<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<div id="text-editor" class="pb-12 h-96 w-full">
  <div id="rich-editor"></div>
</div>
<div id="code-editor" class="hidden w-full h-96"></div>
<script src="https://cdn.quilljs.com/1.3.6/quill.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
  let code_editor = ace.edit("code-editor");
  code_editor.setTheme("ace/theme/twilight");
  code_editor.session.setOptions({
    mode: "ace/mode/php",
    tabSize: 4,
    useSoftTabs: true
  });
  code_editor.session.setUseWrapMode(true);
  code_editor.session.mergeUndoDeltas = true;
  code_editor.session.insert(0, '<?= $GLOBALS["page"]["page_content"] ?>');
  document.getElementById('code-editor').style.fontSize = '14px';

  let rich_toolbars = [
    ['bold', 'italic', 'underline'],
    [{
      'list': 'ordered'
    }, {
      'list': 'bullet'
    }],
    [{
      'indent': '-1'
    }, {
      'indent': '+1'
    }],
    [{
      'header': [1, 2, 3, 4, 5, 6, false]
    }],
    ['image', 'video'],
    [{
      'color': []
    }, {
      'background': []
    }],
    [{
      'align': []
    }],
    ['clean']
  ];

  let rich_options = {
    modules: {
      toolbar: rich_toolbars
    },
    placeholder: 'Write content here... (Should be more than 100 words)',
    theme: 'snow'
  };

  let rich_editor = new Quill('#rich-editor', rich_options);
  rich_editor.insertText(0, '<?= $GLOBALS["page"]["page_content"] ?>');
</script>