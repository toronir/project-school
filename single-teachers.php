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
    'posts_per_page' => -1,
    'paged' => get_query_var('paged')
];

$oferta_query = new WP_Query($args);

$teacher_name = get_field('teacher_name');

get_header(); ?>

<section class="single-teacher">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 lectors-desc">
                <div>
                    <h1><?php echo get_field('teacher_name'); ?></h1>
                </div>
                <div class="single-teacher--contact">
                    <?php echo get_field("teacher_email") ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="lectors-imges">
                            <img src="<?php echo get_field("teacher_img") ?>">
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4 mt-4">
                        <div class="single-teacher--contact">
                            <?php echo get_field('teacher_desc'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 lectors-courses">

                <?php if ($oferta_query->have_posts()) : ?>
                <?php while ($oferta_query->have_posts()) : ?>
                <?php $oferta_query->the_post(); ?>
                <?php if ($teacher_name === get_field('lector_name') && (get_field('chose_course_type') === 'Otwarty' || is_user_logged_in())) : ?>

                <div class="courses-box">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-xl-6 col-sm-12 mb-4">
                            <div class="lector-courses-flag">
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="flag">
                            </div>
                        </div>
                        <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4">
                            <h3><a class='' href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                            </h3>
                            <p> Poziom: <?php echo get_field("courses_level", get_the_ID()) ?> </p>
                            <p> Nabór: <?php echo get_field('chose_course_type'); ?> </p>
                            <p> <?php echo wp_trim_words( get_the_content(), 10, '...' ); ?> </p>
                        </div>
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