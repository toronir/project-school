<?php

$start_heading = get_field('start_heading');
$start_desc = get_field('start_desc');
$start_btn = get_field('start_btn');
$start_bg = get_field('start_bg');

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
    // 'tax_query' => [
    //     [
    //         'taxonomy'=> 'languages_categories'
    //     ]
    // ]
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
            <div class="col">
                <?php if ($start_heading) : ?>
                <h1 class="start--heading text-center">
                    <?php echo $start_heading ?>
                </h1>
                <?php endif; ?>
            </div>

        </div>
        <div class="row my-5">
            <div class="col-lg-7">
                <?php if ($start_desc) : ?>
                <p class="start--description">
                    <?php echo $start_desc ?>
                </p>
                <?php endif; ?>

            </div>
            <div class="col-lg-5">
                <?php if ($start_btn) : ?>
                <a href="<?php echo $start_btn['url'] ?>" class="btn-gold-primary d-inline">
                    <?php echo $start_btn['title'] ?>
                </a>
                <?php endif; ?>
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
            <div class="d-flex">
                <div>
                    <h3><?= $first_form ?></h3>
                    <p><?= $form_desc_1 ?></p>
                </div>

                <?php if ($second_form) : ?>
                <div>
                    <h3><?= $second_form ?></h3>
                    <p><?= $form_desc_2 ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- End forms -->

<!-- Start languages -->
<section id="languages" class="languages" data-aos="zoom-in-up" data-aos-once='true'>
    <div class="container">

        <h2 class='py-5 text-center'><?php echo $languages_title?></h2>
        <div class="languages--box d-flex ">


            <?php if ($languages_query->have_posts()) : ?>

            <?php while ($languages_query->have_posts()) : ?>
            <?php $languages_query->the_post(); ?>
            <div class="languages--box__item">
                <div class='languages--img'>
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail'); ?>" alt=""
                        class="img-fluid">
                    <h3><?php echo get_the_title(); ?></h3>
                </div>
                <div>
                    <?php the_content(); ?>
                </div>
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

        <div class="levels--box d-flex ">

            <?php if ($levels_query->have_posts()) : ?>

            <?php while ($levels_query->have_posts()) : ?>
            <?php $levels_query->the_post(); ?>

            <div class="levels--box__item">
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

        <div class="wrapper">
            <?php if ($start_offer_button_1) : ?>
            <a class='btn-gold-primary'
                href="<?php echo $start_offer_button_1['url']?>"><?php echo $start_offer_button_1['title']?></a>
            <?php endif; ?>

            <?php if ($start_offer_button_2) : ?>
            <a class='btn-gold-secondary'
                href="<?php echo $start_offer_button_2['url']?>"><?php echo $start_offer_button_2['title']?></a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
<!-- End more -->



<?php get_footer(); ?>