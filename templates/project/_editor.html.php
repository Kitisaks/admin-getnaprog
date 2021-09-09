<link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/default.min.css">

<div id="text-editor" class="pb-12 h-screen w-full">
  <div id="rich-editor"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js" type="text/javascript" charset="utf-8"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js" type="text/javascript" charset="utf-8"></script>
<script defer type="text/javascript">
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
  rich_editor.insertText(0, '<?= $GLOBALS["page"]["p_content"] ?>');

</script>