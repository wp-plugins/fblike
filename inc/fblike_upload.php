<?php
    /**
    *   image handler. requires php5's json_encode.
    */
    class Image
    {
        public  $image_path = null,
                $image_url = null;

        /**
        * php4 construct. pointless, requires php5 anyway but what the hell.
        *
        * @param string $image_source
        * @return Image
        */
        function Image( $image_source )
        {
            $args = func_get_args();
            call_user_func_array( array( &$this, '__construct' ), $args );
        }

        /**
        * php5 construct
        *
        * @param string $image_source
        * @return Image
        */
        function __construct( $image_source )
        {
            if( file_exists( str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $image_source ) ) )
            {
                $this->image_url = $image_source;
                $this->image_path = $image_source;
            }
        }
    }

    # check post is set, instantiate object
    if( isset( $_POST['image'] ) && ! empty( $_POST['image'] ) )
        $i = new Image( $_POST['image'] );

    # check if object exists and return
    if( is_a( $i, 'Image' ) && ! is_null( $i->image_path ) && ! is_null( $i->image_url ) )
        if( function_exists( 'json_encode' ) )
            echo json_encode( $i );
?>