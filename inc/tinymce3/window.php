<?php global $fblike; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>FBLike Shortcode Generator</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo plugins_url( '', __FILE__ ); ?>/tinymce.js"></script>
	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none; font-size:62.5%;">
	<h3>FBLike Shortcode Generator</h3>
    <form name="slideshow" action="#" style="font-size:1.2em;">
        <div class="wrap">
            <p>
                <label for="layout-style">Layout Style:</label>
                <select name="layout_style" id="layout-style" style="width:68%;padding:5px;font-size:1em;">
                    <option value="standard"<?php selected( 'standard', $fblike->options['layout_style'] ); ?>>Standard</option>
                    <option value="button_count"<?php selected( 'button_count', $fblike->options['layout_style'] ); ?>>Button Count</option>
                </select>
            </p>
            <p>
                <label for="show-faces">Show Faces: </label>
                <input type="checkbox" id="show-faces" <?php checked( 'on', $fblike->options['show_faces'] ); ?> style="padding:5px; font-size:1em;width:73.5%;" />
            </p>
            <p>
                <label for="verb">Verb to use:</label>
                <select name="verb" id="verb" style="width:68%;padding:5px;font-size:1em;">
                    <option value="recommend"<?php selected( 'recommend', $fblike->options['verb'] ); ?>>Recommend</option>
                    <option value="like"<?php selected( 'like', $fblike->options['verb'] ); ?>>Like</option>
                </select>
            </p>
            <p>
                <label for="font">Font:</label>
                <select name="font" id="font" style="width:68%;padding:5px;font-size:1em;">
                    <option value="arial"<?php selected( 'arial', $fblike->options['font'] ); ?>>Arial</option>
                    <option value="lucide grande"<?php selected( 'lucide grande', $fblike->options['font'] ); ?>>Lucida Grande</option>
                    <option value="segoe ui"<?php selected( 'segoe ui', $fblike->options['font'] ); ?>>Segoe UI</option>
                    <option value="tahoma"<?php selected( 'tahoma', $fblike->options['font'] ); ?>>Tahoma</option>
                    <option value="trebuchet ms"<?php selected( 'trebuchet ms', $fblike->options['font'] ); ?>>Trebuchet MS</option>
                    <option value="verdana"<?php selected( 'verdana', $fblike->options['font'] ); ?>>Verdana</option>
                </select>
            </p>
            <p>
                <label for="color-scheme">Color Scheme:</label>
                <select name="color_scheme" id="color-scheme" style="width:68%;padding:5px;font-size:1em;">
                    <option value="light"<?php selected( 'light', $fblike->options['color_scheme'] ); ?>>Light</option>
                    <option value="dark"<?php selected( 'dark', $fblike->options['color_scheme'] ); ?>>Dark</option>
                    <option value="evil"<?php selected( 'evil', $fblike->options['color_scheme'] ); ?>>Evil</option>
                </select>
            </p>
            <div class="mceActionPanel" style="padding:10px 0;bottom:0;">
                <div style="float: left">
                    <input type="button" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" id="cancel" />
                </div>

                <div style="float: right">
                    <input type="submit" name="insert" value="{#insert}" id="insert" onclick="insertfblike();" />
                </div>
            </div>
        </div>
    </form>
</body>
</html>
