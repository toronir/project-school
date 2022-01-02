<?php

$start_heading = get_field('start_heading');
$start_desc = get_field('start_desc');
$start_btn_1 = get_field('start_btn_1');
$start_btn_2 = get_field('start_btn_2');
$start_bg = get_field('start_bg');


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
<div className="container" data-aos="fade-up">
    <div className="row justify-content-center">
        <div>
            <h1>HELLO</h1>
        </div>
        <div class="col-lg-8 col-xl-7 col-xxl-6">
            <?php echo do_shortcode('[contact-form-7 id="204" title="Send your email"]') ?>
        </div>
    </div>
</div>
<!-- End end -->



<?php get_footer(); ?>