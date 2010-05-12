<div class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields( 'fblike_options' ); $options = get_option('fblike'); ?>

        <h2>FBLike Settings</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="layout_style">Layout Style:</label></th>
                <td>
                    <select name="fblike[layout_style]" id="layout_style">
                        <option value="standard"<?php selected('standard', $options['layout_style'] ); ?>>Standard</option>
                        <option value="button_count"<?php selected('button_count', $options['layout_style'] ); ?>>Button Count</option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="show_faces">Show user icons:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_faces]" id="show_faces"<?php checked('on', $options['show_faces'] ); ?> />
                    <cite style="margin-left:15px;">Will add space below button for icons</cite>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="width">Width:</label>
                </th>
                <td>
                    <input type="text" size="3" maxlength="3" name="fblike[width]" id="width" value="<?php echo $options['width']; ?>" /><em>px</em>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="verb">Verb to display:</label></th>
                <td>
                    <select name="fblike[verb]" id="verb">
                        <option value="recommend"<?php selected('recommend', $options['verb'] ); ?>>Recommend</option>
                        <option value="like"<?php selected('like', $options['verb'] ); ?>>Like</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="font">Font:</label></th>
                <td>
                    <select name="fblike[font]" id="font">
                        <option value="arial"<?php selected('arial', $options['font'] ); ?>>Arial</option>
                        <option value="lucida grande"<?php selected('lucida grande', $options['font'] ); ?>>Lucida Grande</option>
                        <option value="segoe ui"<?php selected('segoe ui', $options['font'] ); ?>>Segoe UI</option>
                        <option value="tahoma"<?php selected('tahoma', $options['font'] ); ?>>Tahoma</option>
                        <option value="trebuchet ms"<?php selected('trebuchet ms', $options['font'] ); ?>>Trebuchet MS</option>
                        <option value="verdana"<?php selected('verdana', $options['font'] ); ?>>Verdana</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="color_scheme">Color Scheme:</label></th>
                <td>
                    <select name="fblike[color_scheme]" id="color_scheme">
                        <option value="light"<?php selected('light', $options['color_scheme'] ); ?>>Light</option>
                        <option value="dark"<?php selected('dark', $options['color_scheme'] ); ?>>Dark</option>
                        <option value="evil"<?php selected('evil', $options['color_scheme'] ); ?>>Evil</option>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label for="disable">Disable Auto-Adding:</label></th>
                <td>
                    <input type="checkbox" name="fblike[disabled]" id="disable"<?php checked('on', $options['disabled'] ); ?> />
                    <cite style="margin-left:15px;">If checked, plugin won't add buttons automatically. <br />You will need to use [fblike] shortcode in your posts or fblike() in your template loop.</cite>
                </td>
            </tr>


        </table>

        <h2 style="margin-top:40px;">Display</h2>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="position">Display Position:</label></th>
                <td>
                    <select name="fblike[position]" id="position">
                        <option value="before"<?php selected('before', $options['position'] ); ?>>Before Post</option>
                        <option value="after"<?php selected('after', $options['position'] ); ?>>After Post</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="show-on-home">Show on home page:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_on_home]" id="show-on-home"<?php checked('on', $options['show_on_home'] ); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="show-on-pages">Show on individual pages:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_on_pages]" id="show-on-pages"<?php checked('on', $options['show_on_pages'] ); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="show-on-posts">Show on individual posts:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_on_posts]" id="show-on-pposts"<?php checked('on', $options['show_on_posts'] ); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="show-on-archives">Show on archive pages:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_on_archives]" id="show-on-archives"<?php checked('on', $options['show_on_archives'] ); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="show-on-search">Show on search results:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_on_search]" id="show-on-search"<?php checked('on', $options['show_on_search'] ); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="show-on-excerpts">Show on excerpts:</label></th>
                <td>
                    <input type="checkbox" name="fblike[show_on_excerpts]" id="show-on-excerpts"<?php checked('on', $options['show_on_excerpts'] ); ?> />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="container-css">Container Inline CSS Style:</label></th>
                <td>
                    <input type="text" name="fblike[container_css]" id="container-css" value="<?php echo $this->options['container_css']; ?>" size="35" />
                    <p style="font-size:.9em; margin:o; padding:0;"><cite><strong>height:135px;</strong> is <strong style="color:red;">recommended</strong> if using XFBML method so that comment form shows correctly.</cite></p>
                </td>
            </tr>
        </table>

        <h2 style="margin-top:40px;">XFBML</h2>
        <p>
            In order you use this option you must register your site with facebook and obtain an App ID. <br/>you can register here: <a href="http://developers.facebook.com/setup/">http://developers.facebook.com/setup/</a></p>
            <p><em style="color:red;">If this does not work it is likely that your theme does not reference wp_footer() which the plugin relies on to load Facebook's JavaScript SDK.</em></p>
        </p>

        <table class="form-table">

            <tr valign="top">
                <th scope="row"><label for="use-xfbml">Use XFBML output:</label></th>
                <td>
                    <input type="checkbox" name="fblike[use_xfbml]" id="use-xfbml"<?php checked('on', $options['use_xfbml'] ); ?> />
                    <cite style="margin-left:15px;">Check to enable</cite>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="use-xfbml-sdk">Include JavaScript SDK:</label></th>
                <td>
                    <input type="checkbox" name="fblike[xfbml_include_sdk]" id="use-xfbml-sdk"<?php checked('on', $options['xfbml_include_sdk'] ); ?> />
                    <cite style="margin-left:15px;">Only uncheck this if your theme already loads the Facebook JavaScript SDK.<br />If your theme does not include the SDK (<strong>most don't</strong>) and this is unchecked, XFBML will not work.</cite>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="xfbml-appid">App ID:</label></th>
                <td>
                    <input type="text" name="fblike[xfbml_appid]" id="xfbml-appid" value="<?php echo $this->options['xfbml_appid']; ?>"/>
                    <cite style="margin-left:15px;">If you do not supply an App ID the plugin will continue to use IFrames.</cite>
                </td>
            </tr>

        </table>

        <p class="submit" style="margin-top:40px;">
            <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
        </p>

    </form>

</div>
