<?php

return array(

    /**
     * Edit this file in order to configure the additional
     * image sizes your application need.
     * @link http://codex.wordpress.org/Function_Reference/add_image_size
     *
     * @key string The size name.
     * @param int $width The image width.
     * @param int $height The image height.
     * @param bool|array $crop Crop option. Since 3.9, define a crop position with an array.
     * @param bool $media Add to media selection dropdown. Make it also available to media custom field.
     */
    'livre_small'                       => array( 80, 80, true ),
    'livre_blog_masonry'                => array( 345, 9999, false ),
    'livre_shop_catalog_square'         => array( 400, 400, true ),
    'livre_featured_book'               => array( 800, 9999, true ),
    'livre_author_highlight'            => array( 500, 700, true),
    'livre_collection'                  => array( 500, 500, true),
    'livre_slider_small'                => array( 192, 75, true),
    'livre_slider_large'                => array( 915, 360, true),
    // 'livre_single_post'                 => array( 981, 960, true),
    'livre_blog_list'                   => array( 200, 200, true ),
    'livre_blog_masonry_gallery'        => array( 600, 400, true ),
    'livre_blog_thumbnails_gallery'     => array( 990, 640, true ),


);