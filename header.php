<?php
$logo = get_theme_mod('logo');
?>

<!DOCTYPE html>
<html lang="<?php echo get_language_attributes(); ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name');
            wp_title('|'); ?></title>


    <?php wp_head(); ?>
</head>

<body <?php body_class();?>>
    <!-- Start header -->
    <header class="header">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-4 d-flex">
                    <?php if($logo) : ?>
                    <a href="<?php echo bloginfo('url') ?>"><img src="<?php echo $logo?>"
                            alt="<?php bloginfo('name');?>" class="header--logo"></a>
                    <?php endif; ?>
                </div>
                <div class="col-8 col-xl-8 col-xxl-6">
                    <div class="header--menu-toggle-wrapper">
                        <i class="fas fa-bars" onclick="document.body.classList.toggle('menu-open')"></i>
                    </div>

<!-- start changing menu for user login and logout -->
                    <?php if (!is_user_logged_in()) : ?>
                        <nav class="header--nav">
                            <?php echo wp_nav_menu([
                                'theme_location' => 'main_menu'
                            ]); ?>
                            <?php echo wp_nav_menu([
                                'theme_location' => 'logged_out',
                                'menu_class' => 'nav-logged-out'
                            ]); ?>
                        </nav>
                        
                    <?php else : ?>
                        <nav class="header--nav">
                            <?php echo wp_nav_menu([
                                'theme_location' => 'main_menu'
                            ]); ?>
                            <?php echo wp_nav_menu([
                                'theme_location' => 'logged_in',
                                'menu_class' => 'nav-logged-in'
                            ]); ?>
                        </nav>
                    <?php endif ?>
<!-- end changing menu for user login and logout -->

                </div>
            </div>
        </div>
    </header>
    <!-- End header -->