<div>
  <label for="title" class="text-sm leading-6 font-semibold text-gray-900 flex justify-between">
    <span>Body :</span><mark class="px-2">ctrl+s to save</mark>
  </label>
  <div id="code-editor" class="w-full h-screen"></div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js" type="text/javascript" charset="utf-8"></script>
  <script defer type="text/javascript">
    // Code text editor
    let code_editor = ace.edit("code-editor");
    code_editor.setTheme("ace/theme/monokai");
    code_editor.session.setMode("ace/mode/php");
    code_editor.session.setUseWrapMode(true);
    code_editor.session.mergeUndoDeltas = true;
    code_editor.session.setValue(`<?= $GLOBALS["template"]["t_content"] ?>`);
    document.getElementById('code-editor').style.fontSize = '14px';
    code_editor.commands.addCommand({
      name: 'save',
      bindKey: {
        win: "Ctrl-S",
        "mac": "Cmd-S"
      },
      exec: function(editor) {
        // Return response
        function reqListener() {
          let response = JSON.parse(this.responseText);
          if (response.status == true) {
            let popup = document.getElementById('popup-success');
            alertText(popup, response);
          } else {
            let popup = document.getElementById('popup-fail');
            alertText(popup, response);
          }
        }
        // Alert response in popup
        function alertText(popup, response) {
          let text = popup.querySelector('.popup-info');
          popup.style.display = "block";
          text.innerHTML = response.info;
        }
        var content = editor.session.getValue();
        var xhr = new XMLHttpRequest();
        var params = 'content=' + content + '&_csrf_token=<?= $_SESSION["_csrf_token"] ?>&id=<?= $GLOBALS["template"]["t_id"] ?>';
        xhr.addEventListener('load', reqListener);
        xhr.open('PATCH', '/design/<?= $GLOBALS["template"]["t_id"] ?>', true);
        //Send the proper header information along with the request
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(params);
      }
    });
  </script>
</div>