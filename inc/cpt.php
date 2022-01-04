<?php

function add_cpt()
{

//     $argsFunctionsCategories = [
//         'labels' => [
//             'name' => 'Kategor fuction'
//         ],
//         'hierarchical'=>true,

//     ];

//     $argsCarieraCategories = [
//         'labels' => [
//             'name' => 'Cariera fuction'
//         ],
//         'hierarchical'=>true,

//     ];
 
//  register_taxonomy('function_categories',['functions'],$argsFunctionsCategories);
//  register_taxonomy('cariera_categories',['cariera'],$argsCarieraCategories);


//     $functionArgs = [
//         'labels' => [
//             'name' => 'Funkcija'
//         ],
//         'public' => true,
//         'menu_icon' => 'dashicons-list-view',
//         'supports' => ['title', 'editor',]
//     ];
//     $testimmArgs = [
//         'labels' => [
//             'name' => 'Testimon'
//         ],
//         'public' => true,
//         'menu_icon' => 'dashicons-list-view',
//         'supports' => ['title', 'editor', 'text']
//     ];

//     $subscriptionArgs = [
//         'labels' => [
//             'name' => 'Subscription'
//         ],
//         'public' => false,
//         'show_ui' => true,
//         'menu_icon' => 'dashicons-list-view',
//         'supports' => ['title']
//     ];

//     $carieraArgs = [
//         'labels' => [
//             'name' => 'Cariera'
//         ],
//         'public' => true,
//         'menu_icon' => 'dashicons-list-view',
//         'supports' => ['title', 'editor', 'text']
//     ];


// $argsLanguagesCategories = [
//             'labels' => [
//                 'name' => 'Kategorie języków'
//             ],
//             'hierarchical'=>true,
    
//         ];

//          register_taxonomy('languages_categories',['languages'],$argsLanguagesCategories);


    $languagesArgs = [
        'labels' => [
            'name' => 'Oferowane języki'
        ],
        'public' => true,
        'menu_icon' => 'language',
        'supports' => ['title', 'editor', 'thumbnail']
    ];

    $ofertaArgs = [
        'labels' => [
            'name' => 'Oferta'
        ],
        'public' => true,
        'menu_icon' => 'dashicons-list-view',
        'supports' => ['title', 'editor', 'text','thumbnail']
    ];
    
    $levelsArgs = [
        'labels' => [
            'name' => 'Oferowane poziomy nauczania'
        ],
        'public' => true,
        'menu_icon' => 'language',
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
        "menu_icon" => "dashicons-format-chat",
        "supports" => ["title", "editor", "image"]
    ];
    
    register_post_type('teachers', $teachersArgs);
    register_post_type('testimonials', $testimonialsArgs);
    register_post_type('about', $aboutArgs);
    register_post_type('oferta', $ofertaArgs);
    register_post_type('languages', $languagesArgs);
    register_post_type('levels', $levelsArgs);
}


add_action('init', 'add_cpt');