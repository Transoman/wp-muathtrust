(function() {
  tinymce.PluginManager.add( 'textupb', function( editor, url ) {
    // Add Button to Visual Editor Toolbar
    editor.addButton('textupb', {
      title: 'Text uppercase and blue',
      cmd: 'textupb',
      image: url + '/../images/general/small-letter.png',
    });
    editor.addCommand('textupb', function() {
      var selected_text = editor.selection.getContent({
        'format': 'html'
      });
      if ( selected_text.length === 0 ) {
        alert( 'Please select text' );
        return;
      }
      var open_column = '<span class="text-up-b">';
      var close_column = '</span>';
      var return_text = '';
      return_text = open_column + selected_text + close_column;
      editor.execCommand('mceReplaceContent', false, return_text);
      return;
    });
  });
})();