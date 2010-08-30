<?php

    /**
     *  Plugin Name: FBLike
     *  Description: Add facebook like/recommend button to posts
     *  Plugin URI: http://travisballard.com/wordpress/fblike-wordpress-plugin/
     *  Author: Travis Ballard
     *  Author URI: http://www.travisballard.com
     *  Version: 1.3.3
     */

    /**
    *   TODO:
    *
    *   [x] Show on Archive Pages
    *   [x] Add support for the_excerpt
    *   [ ] Get thumbnail uploader working. need to find a way to use my own send_to_editor func
    *   [ ] Work on comment form showing out of container. lose container?
    */

    class FBLike
    {
        var $option_name = 'fblike',
            $options = null,
            $default_options = array(
                # automatically add like button
                'disabled' => '', # empty, not enabled by default

                # button options
                'layout_style' => 'standard',
                'show_faces' => 'true',
                'width' => 450,
                'verb' => 'like',
                'font' => 'arial',
                'color_scheme' =>'light',

                # xfbml
                'use_xfbml' => '', # empty, not enabled by default
                'xfbml_appid' => '', # empty, not enabled by default
                'xfbml_include_sdk' => 'on',

                # display
                'position' => 'before',
                'container_css' => 'height:25px; overflow:hidden;',
                'show_on_home' => 'on',
                'show_on_pages' => 'on',
                'show_on_posts' => 'on',
                'show_on_archives' => 'on',
                'show_on_search' => 'on',
                'show_on_excerpts' => 'on',

                # additional meta on individual posts
                'use_meta' => 'on',
                'meta_thumbnail' => 'on',
                'meta_title' => 'on',
                'meta_post_name' => 'on'
            ),
            $tinymce_button = null;

        /**
        * php4 construct
        */
        function FBLike()
        {
            $args = func_get_args();
            call_user_func_array( array( &$this, '__construct' ), $args );
        }

        /**
        * construct
        */
        function __construct()
        {
            # tinymce button
            require_once( dirname( __FILE__ ) . '/inc/tinymce3/tinymce.php' );
            $this->tinymce_button = new fblike_tinymce_button();

            # get options, add if needed
            if( ! $this->options = get_option( $this->option_name ) )
            {
                add_option( $this->option_name, $this->default_options );
                $this->options = get_option( $this->option_name );
            }

            # admin actions
            if( is_admin() ) add_action( 'admin_menu', array( &$this, 'add_menu_item' ) );
            if( is_admin() ) add_action( 'admin_init', array( &$this, 'register_settings' ) );
            //if( is_admin() ) add_action( 'admin_menu', array( &$this, 'add_meta_box' ) ); # next release, not working yet
            if( is_admin() ) add_action('wp_ajax_fblike', array( &$this, 'shortcode_window' ) );
            //if( is_admin() ) add_action('wp_ajax_fblike_upload', array( &$this, 'upload_image' ) );

            # global actions
            add_action( 'the_posts', array( &$this, 'filter_posts' ) );

            # shortcode
            add_shortcode( 'fblike', array( &$this, 'shortcode' ) );

            # load sdk if needed
            if( $this->options['use_xfbml'] == 'on' && ! is_admin() )
                add_action( 'wp_footer', array( &$this, 'javascript_sdk' ) );

            # js for meta uploader - not working yet
            //if( is_admin() ) wp_enqueue_script( 'fblike-upload', plugins_url( '/inc/js/fblike.js', __FILE__ ), array( 'thickbox', 'media-upload' ), '1.0' );
        }

        /**
        * create menu item
        */
        function add_menu_item()
        {
            add_options_page( 'FBLike', 'FBLike', 'administrator', 'fblike', array( &$this, 'dashboard' ) );
        }

        /**
        * register plugin settings
        */
        function register_settings()
        {
            register_setting( 'fblike_options', 'fblike' );
        }

        /**
        * plugin dashboard
        */
        function dashboard()
        {
            $this->load( 'dashboard' );
        }

        /**
        * filter posts based on settings
        *
        * @param mixed $posts
        */
        function filter_posts( $posts )
        {
            # show on home page?
            if( is_front_page() && isset( $this->options['show_on_home'] ) && $this->options['show_on_home'] == 'on' )
            {
                add_filter( 'the_content', array( &$this, 'add_fblike' ) );

                # excerpts?
                if( isset( $this->options['show_on_excerpts'] ) && $this->options['show_on_excerpts'] == 'on' )
                    add_action( 'the_excerpt', array( &$this, 'add_fblike' ) );
            }

            # show on individual pages?
            if( is_page() && isset( $this->options['show_on_pages'] ) && $this->options['show_on_pages'] == 'on' )
            {
                add_filter( 'the_content', array( &$this, 'add_fblike' ) );

                # excerpts?
                if( isset( $this->options['show_on_excerpts'] ) && $this->options['show_on_excerpts'] == 'on' )
                    add_action( 'the_excerpt', array( &$this, 'add_fblike' ) );
            }

            # show on individual posts?
            if( is_single() && isset( $this->options['show_on_posts'] ) && $this->options['show_on_posts'] == 'on' )
            {
                add_filter( 'the_content', array( &$this, 'add_fblike' ) );

                # excerpts?
                if( isset( $this->options['show_on_excerpts'] ) && $this->options['show_on_excerpts'] == 'on' )
                    add_action( 'the_excerpt', array( &$this, 'add_fblike' ) );
            }

            # show on search?
            if( is_search() && isset( $this->options['show_on_search'] ) && $this->options['show_on_search'] == 'on' )
            {
                add_filter( 'the_content', array( &$this, 'add_fblike' ) );

                # excerpts?
                if( isset( $this->options['show_on_excerpts'] ) && $this->options['show_on_excerpts'] == 'on' )
                    add_action( 'the_excerpt', array( &$this, 'add_fblike' ) );
            }

            # show on archives?
            if( is_archive() && isset( $this->options['show_on_archives'] ) && $this->options['show_on_archives'] == 'on' )
            {
                add_filter( 'the_content', array( &$this, 'add_fblike' ) );

                # excerpts?
                if( isset( $this->options['show_on_excerpts'] ) && $this->options['show_on_excerpts'] == 'on' )
                    add_action( 'the_excerpt', array( &$this, 'add_fblike' ) );
            }

            return $posts;
        }

        /**
        * load a template file from plugin folder if it exists
        *
        * @param string $template_file - no extension or folder, just name.
        */
        function load( $template_file )
        {
            # work with basename, keep path cwd
            $template_file = basename( $template_file );

            # add dir and extension. make sure no extension passed. if it is, trim.
            if( strstr( $template_file, '.' ) )
                $template_file = sprintf( '%s/inc/%s.inc.php', dirname( __FILE__ ), substr( $template_file, 0, strpos( $template_file, '.' ) ) );
            else
                $template_file = sprintf( '%s/inc/%s.inc.php', dirname( __FILE__ ), $template_file );

            # check file exists in cwd
            if( file_exists( $template_file ) )
                if( is_readable( $template_file ) )
                    include( $template_file );
        }

        /**
        * generate code to use for output. Iframe or XFBML
        *
        * @param string $layout_style
        * @param string $show_faces
        * @param string $width
        * @param string $verb
        * @param string $font
        * @param string $color_scheme
        *
        * @return string $fblike - html code
        */
        function generate_output( $layout_style, $show_faces, $width, $verb, $font, $color_scheme )
        {
            global $post;

            # set height to auto if show faces is enabled.
            $style = $show_faces == 'on' ? ' style="height:auto;"' : ' style="height:25px;"';

            # container css isnt empty, rebuild style. allow previous height to be overwritten by user
            if( isset( $this->options['container_css'] ) && ! empty( $this->options['container_css'] ) )
                $style = sprintf( ' style="%s%s"', $show_faces == 'on' ? 'height:auto; ' : 'height:25px; ', $this->options['container_css'] );

            # return iframe if not using xfbml. or if using xfbml and no appid is set
            if( $this->options['use_xfbml'] != 'on' || $this->options['use_xfbml'] == 'on' && empty( $this->options['xfbml_appid'] ) )
            {
                $fblike = sprintf(
                    '<div class="fblike"%s><iframe src="http://www.facebook.com/plugins/like.php?href=%s&amp;layout=%s&amp;show_faces=%s&amp;width=%d&amp;action=%s&amp;font=%s&amp;colorscheme=%s" scrolling="no" frameborder="0" allow Transparency="true" style="border:none; overflow:hidden; width:%dpx;"></iframe></div>',
                    $style,
                    urlencode( apply_filters( 'fblike_permalink', get_permalink( $post->ID ) ) ),
                    $layout_style,
                    $show_faces ? 'true' : 'false',
                    $width,
                    $verb,
                    $font,
                    $color_scheme,
                    $width
                );
            }
            else
            {
                $fblike = sprintf(
                    '<div class="fblike"%s><fb:like href="%s" layout="%s" show_faces="%s" width="%d" action="%s" font="%s" colorscheme="%s" /></div>',
                    $style,
                    urlencode( apply_filters( 'fblike_permalink', get_permalink( $post->ID ) ) ),
                    $layout_style,
                    $show_faces ? 'true' : 'false',
                    $width,
                    $verb,
                    $font,
                    $color_scheme
                );
            }

            return $fblike;
        }

        /**
        * hooked function for the_content
        *
        * @param string $content
        */
        function add_fblike( $content )
        {
            global $post;

            # return if disabled
            if( isset( $this->options['disabled'] ) && $this->options['disabled'] == 'on' ) return $content;

            $fblike = $this->generate_output(
                $this->options['layout_style'],
                $this->options['show_faces'],
                $this->options['width'],
                $this->options['verb'],
                $this->options['font'],
                $this->options['color_scheme']
            );

            # before/after ?
            if( $this->options['position'] == 'after' )
                return $content . $fblike;
            else
                return $fblike . $content;
        }

        /**
        * load Facebook's javascript sdk into site
        */
        function javascript_sdk()
        {
            # check that user wants it included
            if( ! isset( $this->options['xfbml_include_sdk'] ) || $this->options['xfbml_include_sdk'] != 'on' ) return;

            ob_start(); # overhead caused by this is pretty much insignificant, so fugg it.
            ?>
            <div id="fb-root"></div>
            <script>
              window.fbAsyncInit = function() { FB.init({appId: '<?php echo $this->options['xfbml_appid']; ?>', status: true, cookie: true, xfbml: true}); };
              (function() {
                var e = document.createElement('script');
                e.async = true;
                e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
              }());
            </script>
            <?php

            $sdk = ob_get_clean();
            echo $sdk;
        }

        /**
        * shortcode
        *
        * @param mixed $args
        */
        function shortcode( $args )
        {
            global $post;

            extract(
                shortcode_atts(
                    array(
                        'layout_style' => 'standard',
                        'show_faces' => '',
                        'width' => 450,
                        'verb' => 'like',
                        'font' => 'arial',
                        'color_scheme' => 'light'
                    ),
                    $args
                )
            );

            # array containing valid args for each variable
            $accepted_args = array(
                'layout_style' => array( 'standard', 'button_count' ),
                'verb' => array( 'like', 'recommend' ),
                'font' => array( 'arial', 'lucida grande', 'segoe ui', 'tahoma', 'trebuchet ms', 'verdana' ),
                'color_scheme' => array( 'light','dark', 'evil' )
            );

            # check if valid, default if not.
            $layout_style = in_array( strtolower( $layout_style ), $accepted_args['layout_style'] ) ? $layout_style : $this->options['layout_style'];
            $show_faces = (bool)$show_faces ? 'on' : '';
            $width = is_numeric( $width ) ? (int)$width : (int)$this->options['width'];
            $verb = in_array( strtolower( $verb ), $accepted_args['verb'] ) ? $verb : $this->options['verb'];
            $font = in_array( strtolower( $font ), $accepted_args['font'] ) ? $font : $this->options['font'];
            $color_scheme = in_array( strtolower( $color_scheme ), $accepted_args['color_scheme'] ) ? $color_scheme : $this->options['color_scheme'];

            return $this->generate_output( $layout_style, $show_faces, $width, $verb, $font, $color_scheme );
        }

        /**
        * load ajax popup window for shortcode.
        */
        function shortcode_window()
        {
            require_once( dirname( __FILE__ ) . '/inc/tinymce3/window.php' );
            die();
        }

        /**
        * add meta box
        */
        function add_meta_box()
        {
            add_meta_box( 'fblike', 'FBLike', array( &$this, 'meta_box' ), 'post', 'side', 'high' );
        }

        /**
        * load metabox content
        *
        * @param mixed $post
        */
        function meta_box( $post )
        {
            $this->load( 'metabox' );
        }

        /**
        * ajax upload
        */
        function upload_image($post)
        {
            require_once( dirname( __FILE__ ) . '/inc/fblike_upload.php' );
            die();
        }

        /**
        * select image button
        */
        function select_image_button() {
            global $post_ID, $temp_ID;
            $uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);

            $media_upload_iframe_src = "media-upload.php?fblike=1&amp;post_id=$uploading_iframe_ID";
            $context = apply_filters('media_buttons_context', __('%s'));

            $image_upload_iframe_src = apply_filters('image_upload_iframe_src', "$media_upload_iframe_src&amp;type=image");
            $image_title = __('Upload Image');

            $out = '<a href="'.$image_upload_iframe_src.'&amp;TB_iframe=true" title="'.$image_title.'" onclick="show_image_uploader(\'fblike-xfbml-image\', \''.get_bloginfo('url').'/wp-admin/admin-ajax.php?action=fblike_upload\'); return false;"><img src="images/media-button-image.gif" alt="'.$image_title.'" /></a>';
            printf($context, $out);
        }
    }

	$fblike = new FBLike();

    /**
    * use this function to call the button via php inside 'the loop'
    */
    function fblike()
    {
        global $fblike, $post;

        echo $fblike->generate_output(
            $fblike->options['layout_style'],
            $fblike->options['show_faces'],
            $fblike->options['width'],
            $fblike->options['verb'],
            $fblike->options['font'],
            $fblike->options['color_scheme']
        );
    }
?>
