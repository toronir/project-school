<?php
/*
Template name: Lektorzy
*/

$meta_q = array(
    'meta_query' => array(
        'relation' => 'AND',
    ),
);

$teachers = get_posts([
    "numberposts" => -1,
    "post_type" => "teachers"
]);

$args = [
    'post_type' => 'teachers',
    'meta_query' => $meta_q,
    'paged' => get_query_var('paged'),
];

$teachers_query = new WP_Query($args);

$teachers_heading = get_field("teachers_heading");
$teachers_desc = get_field("teachers_desc");

?>

<?php get_header(); ?>

<!-- start description about teachers -->
<section id="teachers" class="teachers">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($teachers_heading) : ?>
                <h2 class="teachers--heading"><?= $teachers_heading; ?></h2>
                <?php endif; ?>

                <?php if ($teachers_desc) : ?>
                <p class="teachers--description"><?= $teachers_desc; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- end description about teachers -->

<!-- Start teachers list -->
<section id="teachers-list" class="teachers-list">
    <div class="container">
    <?php if ($teachers_query->have_posts()) : ?>
            <?php while ($teachers_query->have_posts()) : ?>
                <?php $teachers_query->the_post(); ?>
                    <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-4 col-xl-6 col-sm-12 mb-4">
                                        <img src="<?php echo get_field("teacher_img") ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row justify-content-center">
                                    <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4">
                                        <div><h3><?php echo get_field('teacher_name'); ?></h3></div>
                                        <div><strong><?php echo get_field("teacher_experience") ?></strong></div>
                                        <div><strong><?php echo get_field("teacher_cert") ?></strong></div>
                                        <div><?php echo get_field("teacher_language") ?></div>
                                        <div><p><?php echo get_field("teacher_email") ?></p></div>
                                        <a href="<?php echo get_the_permalink(); ?>" class="btn-gold-primary d-inline-block"> Poznaj mnie <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div>
            <?php endwhile; ?>

            <div class="pagination pagination-lg justify-content-center">
            <?php
                $big = 9999999;
                echo paginate_links([
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?page=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $teachers_query->max_num_pages
                ]);

            ?>
            </div>

            <?php else : ?>
            <div class='text-center'>
            <p>Niestety w tym momencie nie posiadamy lektorów.</p>

            </div>
            <?php endif;?>
        </div>    
    </div>
</section>
<!-- End teachers list -->

<?php get_footer(); ?>