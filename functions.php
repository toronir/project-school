<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('main', get_template_directory_uri() . '/dist/main.css', [], '1.3');

    wp_enqueue_script('main', get_template_directory_uri() . '/dist/main.js', ['jquery'], '1.3', true);

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

add_action('after_setup_theme', function () {
    register_nav_menus([
        'main_menu' => 'Header navigation',
        'logged_in' => 'Header login',
        'logged_out' => 'Header logout',
        'footer_nav_1' => 'Footer navigation 1',
    ]);
});

// start font awesome icon in menu
add_filter('wp_nav_menu_objects', function ($items) {
    foreach ($items as &$item) {
        $icon = get_field('fa_icons', $item);
        if ($icon) {
            $item->title = $item->title . '<i class="' . $icon . ' icons-menu"></i>';
        }
    }
    return $items;
});
// end font awesome icon in menu

add_action('init', function () {
    register_sidebar([
        'name' => 'Primary sidebar',
        'id' => 'sidebar-1',
        'before_widget' => '<section class="my-widget">',
        'after_widget' => '</section>',

    ]);
});

add_theme_support('post-thumbnails');

include 'inc/theme-options.php';
include 'inc/cpt.php';
include 'inc/api.php';


function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}


// Add user by change post status in Subcription
add_action('publish_subscription', function ($post_id, $post) {
    $updated_post = get_post($post_id, ARRAY_A);
    $telephone_meta = get_post_meta($post_id, 'subscription_telephone', true);
    $pass =  get_post_meta($post_id, 'subscription_user_password', true);
    $firstName =  get_post_meta($post_id, 'subscription_first_name', true);
    $secondName =  get_post_meta($post_id, 'subscription_second_name', true);
    $birthday =  get_post_meta($post_id, 'subscription_user_birthday', true);
    $user_id = wp_create_user($updated_post['post_title'], $pass, $updated_post['post_title']);
    update_field('user_name', $firstName,  $user_id);
    update_field('user_surname', $secondName,  $user_id);
    update_field('user_phone_number', $telephone_meta,  $user_id);
    update_field('user_birthday', $birthday,  $user_id);
    wp_delete_post($post_id, true);
    wp_redirect(admin_url('edit.php?post_type=subscription'));
    exit;
}, 10, 2);


function wpse_cpt_enqueue($hook_suffix)
{
    $cpt = 'subscription';

    if (in_array($hook_suffix, array('post.php', 'post-new.php'))) {
        $screen = get_current_screen();

        if (is_object($screen) && $cpt == $screen->post_type) {

            add_filter(
                'gettext',
                function ($translated, $text_domain, $original) {
                    if ($translated === 'Opublikuj') {
                        return __('Dodaj nowego użytkownika', 'print-my-blog');
                    }
                    return $translated;
                },
                10,
                3
            );
        }
    }
}

add_action('admin_enqueue_scripts', 'wpse_cpt_enqueue');

function acf_load_color_field_choices($field)
{

    // reset choices
    $field['choices'] = array();

    // get the textarea value from options page without any formatting
    $choices = get_field('my_select_values', 'option', false);

    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);

    // remove any unwanted white space
    $choices = array_map('trim', $choices);

    // loop through array and add to field 'choices'
    if (is_array($choices)) {

        foreach ($choices as $choice) {

            $field['choices'][$choice] = $choice;
        }
    }

    // return the field
    return $field;
}


//Change wp_mail content type
function wp_set_content_type()
{
    return "text/html";
}
add_filter('wp_mail_content_type', 'wp_set_content_type');
