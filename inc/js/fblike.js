function show_image_uploader(id, handler) {
	option = {
		id: id,
        handler: handler
	}
	tb_show('Upload FBLike Thumbnail Image', 'media-upload.php?type=image&amp;TB_iframe=true');
}

// send image url to the options field
function send_to_editor(h) {
    var r = new RegExp('<img src="([^"]+)"');
    var m = r.exec(h);
    var q = "image=" + escape( m[1] );

    jQuery.ajax({
        url: option.handler,
        type: 'POST',
        dataType: 'json',
        data: q,
        timeout: 18200,
        error: function(){
            return;
        },
        success: function( json ){
            jQuery( '#' + option.id ).val( json.image_url );
            //jQuery( '#image-preview').html('<img src="' + json.image_url + '" alt="image preview"/>');
        }
    });
	tb_remove();
}
// thickbox settings
jQuery(function($) {
	tb_position = function() {
		var tbWindow = $('#TB_window');
		var width = $(window).width();
		var H = $(window).height();
		var W = ( 720 < width ) ? 720 : width;

		if ( tbWindow.size() ) {
			tbWindow.width( W - 50 ).height( H - 45 );
			$('#TB_iframeContent').width( W - 50 ).height( H - 75 );
			tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
			if ( typeof document.body.style.maxWidth != 'undefined' )
				tbWindow.css({'top':'20px','margin-top':'0'});
			$('#TB_title').css({'background-color':'#222','color':'#cfcfcf'});
		};

		return $('a.thickbox').each( function() {
			var href = $(this).attr('href');
			if ( ! href ) return;
			href = href.replace(/&width=[0-9]+/g, '');
			href = href.replace(/&height=[0-9]+/g, '');
			$(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
		});
	};

	$(window).resize( function() { tb_position() } );
});