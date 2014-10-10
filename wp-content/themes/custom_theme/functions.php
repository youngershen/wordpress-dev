<?php

add_filter( 'gettext_with_context', 'wpdx_disable_open_sans', 888, 4 );
function wpdx_disable_open_sans( $translations, $text, $context, $domain ) {
    if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
        $translations = 'off';
    }
    return $translations;
}


if(!function_exists('cwp_remove_script_version')) {
    function cwp_remove_script_version($src)
    {
        return remove_query_arg('ver', $src);
    }

    add_filter('script_loader_src', 'cwp_remove_script_version');
    add_filter('style_loader_src', 'cwp_remove_script_version');
}

function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style'));
}

//禁止加载WP自带的jquery.js
if ( !is_admin() ) { // 后台不禁止
    function my_init_method() {
        wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
    }
    add_action('init', 'my_init_method');
}
wp_deregister_script( 'l10n' );
//register scripts
wp_register_script( 'google', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.js' );
wp_register_script( 'local_jquery', get_template_directory_uri() . '/js/jquery/jquery.js' );
//register style
wp_register_style( 'default', get_template_directory_uri() . '/style.css' );

function customer_scripts() {
    wp_deregister_script( 'jquery' );
    wp_enqueue_script( 'local_jquery' );
    wp_enqueue_style( 'default' );
}
add_action( 'init', 'customer_scripts' );

?>