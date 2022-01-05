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
                <div class="col-4">
                    <?php if($logo) : ?>
                    <a href="<?php echo bloginfo('url') ?>"><img src="<?php echo $logo?>"
                            alt="<?php bloginfo('name');?>" class="header--logo"></a>
                    <?php endif; ?>
                </div>
                <div class="col-8 col-xl-6 col-xxl-4">
                    <div class="header--menu-toggle-wrapper">
                        <i class="fas fa-bars" onclick="document.body.classList.toggle('menu-open')"></i>
                    </div>

                    <nav class="header--nav">
                        <?php echo wp_nav_menu([
                            'theme_location' => 'header_nav'
                        ]); ?>

                        <form action="<?php echo home_url(); ?>" method='GET' class="form-search">
                            <input type="text" placeholder='Szukaj' name='s' value='<?php echo get_search_query(); ?>'>
                            <button type='submit' class="btn btn-warning mb-2"> <i class="fas fa-search"></i> </button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- End header -->