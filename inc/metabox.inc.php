<?php global $post; ?>
<div id="fblike-metabox" class="fblike-meta">
    <p>Configure the Title and Image Thumbnail that will appear on a users profile if they like this post.</p>
    <p>
        <label style="margin-right:10px; position:relative; top:-1px;" for="xfbml-meta-title">Title</label>
        <input type="text" name="fblike_xfbml_meta_title" id="xfbml-meta-title" value="<?php echo esc_attr( $post->post_title ); ?>" style="width:84%;" />
    </p>
    <p id="media-buttons" class="hide-if-no-js" style="padding:5px; margin:0;">
        <label style="margin-right:10px; position:relative; top:-1px;" for="xfbml-meta-image">Image</label>
        <input type="text" size="18" name="fblike_xfbml_image" id="fblike-xfbml-image" value="<?php echo esc_attr( get_post_meta( $post->ID, 'fblike_xfbml_image', 1 ) ); ?>" />
        <?php $this->select_image_button(); ?><br />
        <em style="padding-top:5px; font-size:.9em; color:#666;">100x100 max size. larger images will be cropped.</em>
    </p>
    <p>
        <img src="<?php echo plugins_url('/i/preview.png', __FILE__ ); ?>" alt="Profile Preview" />
    </p>
</div>
