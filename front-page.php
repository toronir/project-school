<?php

$logo = get_theme_mod('logo');
$start_bg = get_field('start_bg');
$start_img = get_field('start_img');
$start_heading = get_field('start_heading');
$start_desc_1 = get_field('start_desc_1');
$start_desc_2 = get_field('start_desc_2');
$start_btn_1 = get_field('start_btn_1');
$start_btn_2 = get_field('start_btn_2');
$start_earth = get_field('start_earth');

$form_title = get_field('form_title');
$first_form = get_field('first_form');
$form_desc_1 = get_field('form_desc_1');
$second_form = get_field('second_form');
$form_desc_2 = get_field('form_desc_2');

$languages_title = get_field('languages_title');
$languagesArgs = [
    'post_type' => 'languages',
    'post_status' => 'publish',
    'posts_per_page' => '50',
    'paged' => get_query_var('paged'),
];

$languages_query = new WP_Query($languagesArgs);

$levelsArgs = [
    'post_type' => 'levels',
    'post_status' => 'publish',
    'posts_per_page' => '50',
    'paged' => get_query_var('paged')
];

$levels_query = new WP_Query($levelsArgs);

$start_levels_title = get_field('start_levels_title');
$start_levels_desc = get_field('start_levels_desc');


$start_offer_title = get_field('start_offer_title');
$start_offer_desc = get_field('start_offer_desc');
$start_offer_button_1 = get_field('start_offer_button_1');
$start_offer_button_2 = get_field('start_offer_button_2');
//------------------------------------------------


$citat_text = get_field('citat_text');
$author_name = get_field('author_name');


$funckt_title = get_field('funckt_title');
$funckt_text = get_field('funckt_text');
$funct_button = get_field('funct_button');
$funckt_title_btn = get_field('funckt_title_btn');


$testi_title = get_field('testi_title');
$testi_text = get_field('testi_text');


$functions = get_posts([
    'post_type' => 'functions',
    'numberposts' => -1,
]);
$testimons = get_posts([
    'post_type' => 'testimon',
    'numberposts' => -1,
]);




get_header();

?>




<!-- Start start -->
<section id="start" class="start" <?php if ($start_bg) : ?>
    style="background-image: url('<?php echo $start_bg; ?>') <?php endif;?>;">
    <div class="container">
        <div class="row">
            <div class="col-1 col-lg-1 col-xl-2"></div>
            <div class="col-10 col-sm-12 col-md-9 col-xl-6 start--slogan" data-aos="zoom-in-up" data-aos-once='true'>

                <img class='position-absolute start--slogan-png d-none d-md-block' src="<?php echo $start_img?>" alt="">

                <h1><?php echo $start_heading?> <span
                        class="logo-name d-block d-sm-inline"><?php echo get_bloginfo('name')?>!</span>
                </h1>
                <div class='d-flex gap-3 gap-md-5 align-items-center justify-content-center my-5 mx-lg-5'>
                    <img class='start--slogan-logo' src="<?php echo $start_earth ?>" alt="">
                    <div class='catch'>
                        <p>Nie czekaj -</p>
                        <p>- Cat<span>(ch)</span> them All!</p>
                    </div>
                </div>
                <?php if ($start_desc_1) : ?>
                <h2 class='align-left mb-5'>
                    <?php echo $start_desc_1?>
                    <?php if ($start_desc_2) :?>
                    <br><?php echo $start_desc_2?>
                    <?php endif; ?>
                </h2>
                <?php endif; ?>

                <div class='justify-content-center align-items-center d-flex gap-5'>
                    <?php if ($start_btn_1) : ?>
                    <a href="<?php echo $start_btn_1['url'] ?>" class="btn-gold-primary">
                        <?php echo $start_btn_1['title'] ?>
                    </a>
                    <?php endif; ?>

                    <?php if ($start_btn_2) : ?>
                    <a class='btn-gold-secondary'
                        href="<?php echo $start_btn_2['url']?>"><?php echo $start_btn_2['title']?></a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End start -->

<!-- Start forms -->
<section id="forms" class="forms" data-aos="zoom-in-up" data-aos-once='true'>
    <div class="container">
        <div class="row">
            <h2 class='py-5 text-center'><?php echo $form_title?> </h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-10 col-md form">
                <h3 class='text-center'><?= $first_form ?></h3>
                <p><?= $form_desc_1 ?></p>
            </div>

            <?php if ($second_form) : ?>
            <div class="col-10 col-md form">
                <h3 class='text-center'><?= $second_form ?></h3>
                <p><?= $form_desc_2 ?></p>
            </div>
            <?php endif; ?>
        </div>

    </div>
</section>
<!-- End forms -->

<!-- Start languages -->
<section id="languages" class="languages" data-aos="zoom-in-up" data-aos-once='true'>
    <div class="container">
        <div class="row">
            <h2 class='py-5 text-center'><?php echo $languages_title?></h2>
        </div>
        <div class="row mb-5 justify-content-center">

            <?php if ($languages_query->have_posts()) : ?>
            <?php while ($languages_query->have_posts()) : ?>
            <?php $languages_query->the_post(); ?>

            <div class="card col-5 col-md-5 col-lg m-2 d-flex flex-column justify-content-between">
                <img class="card-img-top my-2"
                    src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail'); ?>"
                    alt="Card image cap">
                <h5 class="card-title text-center my-5"><?php echo get_the_title(); ?></h5>
            </div>

            <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- End languages -->

<!-- Start levels -->
<section id="levels" class="levels" data-aos="zoom-in-up" data-aos-once='true'>
    <div class="container">

        <h2 class='py-5 text-center'><?php echo $start_levels_title ?></h2>
        <p class='text-center mb-5'><?php echo $start_levels_desc ?></p>

        <div class="row">

            <?php if ($levels_query->have_posts()) : ?>
            <?php while ($levels_query->have_posts()) : ?>
            <?php $levels_query->the_post(); ?>

            <div class="col-12 col-md-6 col-lg-4 levels--item">
                <h3><?php echo get_the_title(); ?></h3>
                <?php the_content(); ?>
            </div>

            <?php endwhile; ?>
            <?php endif; ?>

        </div>

    </div>
</section>
<!-- End levels -->

<!-- Start more -->

<?php if ($start_offer_title) : ?>
<section id="more" class="more" data-aos="zoom-in-up" data-aos-once='true'>
    <div class="container">

        <h2 class='py-5 text-center'><?php echo $start_offer_title ?></h2>
        <p class='text-center mb-5'><?php echo $start_offer_desc ?></p>

        <div class="row justify-content-center">

            <?php if ($start_offer_button_1) : ?>
            <div class="col-5  col-lg-3">
                <a class='btn-gold-primary'
                    href="<?php echo $start_offer_button_1['url']?>"><?php echo $start_offer_button_1['title']?></a>
            </div>
            <?php endif; ?>

            <?php if ($start_offer_button_2) : ?>
            <div class="col-md-1 d-none d-md-block"></div>
            <div class="col-5 col-lg-3">
                <a class='btn-gold-secondary'
                    href="<?php echo $start_offer_button_2['url']?>"><?php echo $start_offer_button_2['title']?></a>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endif; ?>
<!-- End more -->



<?php get_footer(); ?>