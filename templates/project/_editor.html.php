<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">

<div id="text-editor" class="pb-12 h-screen w-full">
  <div id="rich-editor"></div>
</div>
<div id="code-editor" class="hidden w-full h-screen"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
  //== Code text editor
  let code_editor = ace.edit("code-editor");
  code_editor.setTheme("ace/theme/monokai");
  code_editor.session.setMode("ace/mode/php");
  code_editor.session.setUseWrapMode(true);
  code_editor.session.mergeUndoDeltas = true;
  code_editor.session.insert(0, '<?= $GLOBALS["page"]["page_content"] ?>');
  document.getElementById('code-editor').style.fontSize = '14px';

  //== Rich text editor
  const rich_toolbars = [
     [{ header: [1, 2, 3, 4, 5, 6, false] }],
     ['bold', 'italic', 'underline'],
     [{ 'list': 'ordered' }, { 'list': 'bullet' }],
     [{ 'indent': '-1' }, { 'indent': '+1' }],
     [{ 'align': [] }],
     ['blockquote', 'link', 'image', 'video'],
     ['code-block'],
     ['clean']
    ];

  const rich_options = {
    modules: {
      syntax: true,
      toolbar: rich_toolbars
    },
    placeholder: 'Write content here... (Should be more than 200 words)',
    theme: 'snow'
  };

  let rich_editor = new Quill('#rich-editor', rich_options);
  rich_editor.insertText(0, '<?= $GLOBALS["page"]["page_content"] ?>');

</script>