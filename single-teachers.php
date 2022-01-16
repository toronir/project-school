<?php 

$teachers = get_posts([
    "numberposts" => -1,
    "post_type" => "teachers"
]);

$offer = get_posts([
    "numberposts" => -1,
    "post_type" => "oferta"
]);

$meta_q = array(
    'meta_query' => array(
        'relation' => 'AND',
    ),
);

$args = [
    'post_type' => 'oferta',
    'meta_query' => $meta_q,
    'post_status'=>'publish',
    'paged' => get_query_var('paged')
];

$oferta_query = new WP_Query($args);

$teacher_name = get_field('teacher_name');

get_header(); ?>

<section class="single-teacher">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <img src="<?php echo get_field("teacher_img") ?>">
                    </div>
                    <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4">
                        <div>
                            <h3><?php echo get_field('teacher_name'); ?></h3>
                        </div>
                        <div>
                            <p><?php echo get_field("teacher_email") ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 lectors-courses">

                <?php if ($oferta_query->have_posts()) : ?>
                <?php while ($oferta_query->have_posts()) : ?>
                <?php $oferta_query->the_post(); ?>
                <?php if ($teacher_name === get_field('lector_name') && (get_field('chose_course_type') === 'Online' || is_user_logged_in())) : ?>

                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-xl-6 col-sm-12 mb-4">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="flag">
                    </div>
                    <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4">
                        <h3> <?php echo get_the_title(); ?> </h3>
                        <p> Poziom: <?php echo get_field("courses_level", get_the_ID()) ?> </p>
                        <a class='btn-gold-primary d-inline-block' href="<?php echo get_the_permalink()?>">Czytaj więcej
                            <i class="fas fa-chevron-right"></i></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php endwhile; ?>
                <?php endif;?>
            </div>
        </div>
    </div>
</section>

<?php

get_footer(); ?>