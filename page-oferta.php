<?php
/*

Template name: Oferta

*/

get_header();


$oferta_lable = get_field('oferta_lable');
$oferta_discript = get_field('oferta_discript');
$isLogIn = false;

$args = [
    'post_type' => 'oferta',
    'post_status' => 'publish',
    'paged' => get_query_var('paged'),



];
$oferta_query = new WP_Query($args);





?>



<section class="start start__subpage">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="start--heading"><?php the_title(); ?></h1>
                <div class="start--breadcrumbs">
                    <a href="<?php echo get_home_url(); ?>">Start</a>
                    <i class="fas fa-chevron-right"></i>
                    <span><?php the_title(); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="testimonials">
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($oferta_lable) : ?>
                    <h2 class="functions--heading"><?php echo $oferta_lable ?></h2>
                <?php endif; ?>
                <?php if ($oferta_discript) : ?>
                    <p class="functions--description"><?php echo $oferta_discript ?></p>
                <?php endif; ?>

            </div>
        </div>
    </div>



    <?php if ($oferta_query->have_posts()) : ?>
        <?php while ($oferta_query->have_posts()) : ?>
            <?php $oferta_query->the_post(); ?>
            <?php if (get_field('chose_course_type') === 'Online' || $isLogIn ) : ?>
                <div class="row m-5">
                    <div class="col-lg-4">

                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), array(100, 100)); ?>" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-8 gap-3 d-grid">
                        <h2><?php echo get_the_title(); ?></h2>
                        <div>
                            <p><?php echo get_the_excerpt(); ?></p>

                            <a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary">Czytaj więcej <i class="fas fa-arrow-right ml-1 small"></i></a>
                        </div>

                        <div class="align-self-center">
                            <p>Courses type: <?php echo get_field('chose_course_type'); ?></p>
                        </div>
                    </div>

                </div>
            <?php endif;
            ?>
        <?php endwhile; ?>
        <div class="pagination pagination-lg justify-content-center">
            <?php
            $big = 9999999;
            echo paginate_links([
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $oferta_query->max_num_pages
            ]);

            ?>
        </div>

    <?php else : ?>
        <div>You dont have posts</div>
    <?php endif;
    ?>
</section>



<?php get_footer(); ?>