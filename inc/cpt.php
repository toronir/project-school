<?php

function add_cpt()
{


    $argsOffersCategories = [
        'labels' => [
            'name' => 'Oferta fuction'
        ],
        'hierarchical' => true,

    ];

    register_taxonomy('offers_categories', ['oferta'], $argsOffersCategories);

    $subscriptionArgs = [
        'labels' => [
            'name' => 'Kandydaci'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-id',
        'supports' => ['title']
    ];



    $languagesArgs = [
        'labels' => [
            'name' => 'Oferowane języki'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-translation',
        'supports' => ['title', 'editor', 'thumbnail']
    ];

    $ofertaArgs = [
        'labels' => [
            'name' => 'Oferta'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-align-left',
        'supports' => ['title', 'editor', 'text', 'thumbnail']
    ];

    $levelsArgs = [
        'labels' => [
            'name' => 'Oferowane poziomy nauczania'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-awards',
        'supports' => ['title', 'editor']
    ];

    $aboutArgs = [
        "labels" => [
            "name" => "O nas"
        ],
        "public" => true,
        "menu_icon" => "dashicons-list-view",
        "supports" => ["title", "editor"]
    ];

    $testimonialsArgs = [
        "labels" => [
            "name" => "Opinie klientów"
        ],
        "public" => true,
        "menu_icon" => "dashicons-format-chat",
        "supports" => ["title", "editor", "image"]
    ];

    $teachersArgs = [
        "labels" => [
            "name" => "Lektorzy"
        ],
        "public" => true,
        "menu_icon" => "dashicons-welcome-learn-more",
        "supports" => ["title", "editor", "image"]
    ];

    register_post_type('teachers', $teachersArgs);
    register_post_type('testimonials', $testimonialsArgs);
    register_post_type('about', $aboutArgs);
    register_post_type('oferta', $ofertaArgs);
    register_post_type('languages', $languagesArgs);
    register_post_type('levels', $levelsArgs);
    register_post_type('subscription', $subscriptionArgs);
}


add_action('init', 'add_cpt');