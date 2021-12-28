<?php 
if(!class_exists('Kirki')){
    return;
}
//Logo
Kirki::add_section('header' , [
    'title' => 'header logo',
    'priority' => 200,
]);


Kirki::add_field('header_logo', [
    'type' => 'image',
    'settings' =>'logo',
    'label' => 'Logo',
    'section' => 'header',
]);

//Social Media
Kirki::add_section('social' , [
    'title' => 'social_media',
    'priority' => 200,
]);
Kirki::add_field('social_media', [
    'type' => 'text',
    'settings' =>'linkI',
    'label' => 'Inst',
    'section' => 'social',
    'default' => '',
]);
Kirki::add_field('social_media', [
    'type' => 'text',
    'settings' =>'linkL',
    'label' => 'LinkIn',
    'section' => 'social',
    'default' => '',
]);
Kirki::add_field('social_media', [
    'type' => 'text',
    'settings' =>'linkF',
    'label' => 'FaceB',
    'section' => 'social',
    'default' => '',
]);
//Contact Info
Kirki::add_section('contacts' , [
    'title' => 'contact_info',
    'priority' => 200,
]);

Kirki::add_field('contact_info', [
    'type' => 'text',
    'settings' =>'telephoneCont',
    'label' => 'tephone',
    'section' => 'contacts',
    'default' => '',
]);
Kirki::add_field('contact_info', [
    'type' => 'text',
    'settings' =>'emailCont',
    'label' => 'email',
    'section' => 'contacts',
    'default' => '',
]);
Kirki::add_field('contact_info', [
    'type' => 'text',
    'settings' =>'firstAdrCont',
    'label' => 'First Adress',
    'section' => 'contacts',
    'default' => '',
]);
Kirki::add_field('contact_info', [
    'type' => 'text',
    'settings' =>'secondAdrCont',
    'label' => 'Second Adress',
    'section' => 'contacts',
    'default' => '',
]);

//News theme
Kirki::add_section('news' , [
    'title' => 'news_info',
    'priority' => 200,
]);

Kirki::add_field('news_info', [
    'type' => 'text',
    'settings' =>'newsTitle',
    'label' => 'News Title',
    'section' => 'news',
    'default' => '',
]);
Kirki::add_field('news_info', [
    'type' => 'textarea',
    'settings' =>'newsText',
    'label' => 'News Text',
    'section' => 'news',
    'default' => '',
]);