<?php

function add_cpt()
{

    $argsFunctionsCategories = [
        'labels' => [
            'name' => 'Kategor fuction'
        ],
        'hierarchical'=>true,

    ];

    $argsCarieraCategories = [
        'labels' => [
            'name' => 'Cariera fuction'
        ],
        'hierarchical'=>true,

    ];
 
 register_taxonomy('function_categories',['functions'],$argsFunctionsCategories);
 register_taxonomy('cariera_categories',['cariera'],$argsCarieraCategories);


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

    $carieraArgs = [
        'labels' => [
            'name' => 'Cariera'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title', 'editor', 'text']
    ];

    register_post_type('functions', $functionArgs);
    register_post_type('testimon', $testimmArgs);
    register_post_type('subscription', $subscriptionArgs);
    register_post_type('cariera', $carieraArgs);
}


add_action('init', 'add_cpt');
