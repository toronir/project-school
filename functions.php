<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', [], '1.0');

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/main.js', ['jquery'], '1.0', true);

    wp_localize_script('main', 'page', [
        'url' => get_home_url(),
        'desc' => get_bloginfo('description'),
        'api_url' => get_rest_url(),
        'newsletter_data' => [
            'heading' => get_theme_mod("newsletter_heading"),
            'description' => get_theme_mod("newsletter_desc")
        ]
    ]);
});

add_action('after_setup_theme',function(){
    register_nav_menus([
        'header_nav' => 'Header navigation',
        'footer_nav_1' => 'Footer navigation 1',
        'footer_nav_2' => 'Footer navigation 2',
    ]);
});
add_action('init',function(){
    register_sidebar([
        'name'=>'Primary sidebar',
        'id'=>'sidebar-1',
        'before_widget'=>'<section class="my-widget">',
        'after_widget'=>'</section>',
        
    ]);
});


add_theme_support('post-thumbnails');


include get_template_directory() . './inc/theme-options.php';
include get_template_directory() . './inc/cpt.php';
include get_template_directory() . './inc/api.php';

