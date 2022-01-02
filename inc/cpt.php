<?php

function add_cpt()
{

    $argsFunctionsCategories = [
        'labels' => [
            'name' => 'Kategor fuction'
        ],
        'hierarchical'=>true,

    ];

    $argsOfertaCategories = [
        'labels' => [
            'name' => 'Oferta fuction'
        ],
        'hierarchical'=>true,

    ];
 
 register_taxonomy('function_categories',['functions'],$argsFunctionsCategories);
 register_taxonomy('cariera_categories',['oferta'],$argsOfertaCategories);


    $functionArgs = [
        'labels' => [
            'name' => 'Funkcija'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title', 'editor',]
    ];
    $testimmArgs = [
        'labels' => [
            'name' => 'Testimon'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title', 'editor', 'text']
    ];

    $subscriptionArgs = [
        'labels' => [
            'name' => 'Subscription'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title']
    ];

    $ofertaArgs = [
        'labels' => [
            'name' => 'Oferta'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title', 'editor', 'text','thumbnail']
    ];
    $languagesArgs = [
        'labels' => [
            'name' => 'Languages'
        ],
        'public' => false,
        'show_ui' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title','editor','thumbnail']
    ];

    register_post_type('functions', $functionArgs);
    register_post_type('languages', $languagesArgs);
    register_post_type('testimon', $testimmArgs);
    register_post_type('subscription', $subscriptionArgs);
    register_post_type('oferta', $ofertaArgs);
}


add_action('init', 'add_cpt');
