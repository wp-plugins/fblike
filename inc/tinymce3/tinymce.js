function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertfblike() {
	var tagtext;
    var ls = document.getElementById('layout-style');
    var layout_style = ls[ ls.selectedIndex ].value;
    var sf = document.getElementById('show-faces');
    var show_faces = sf.checked;
    var v = document.getElementById('verb');
    var verb = v[v.selectedIndex].value;
    var f = document.getElementById('font');
    var font = f[f.selectedIndex].value;
    var cs = document.getElementById('color-scheme');
    var color_scheme = cs[cs.selectedIndex].value;

	tagtext = "[fblike layout_style='"+layout_style+"' show_faces='"+show_faces+"' verb='"+verb+"' font='"+font+"' color_scheme='"+color_scheme+"']";

    if(window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Peforms a clean up of the current editor HTML.
		//tinyMCEPopup.editor.execCommand('mceCleanup');
		//Repaints the editor. Sometimes the browser has graphic glitches.
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}