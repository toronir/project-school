<?php
/*

Template name: Oferta

*/




get_header();



$lenguages = [];
$levels = [];

$customFieldLenguageKey =  $_GET['languages_select'] ? $_GET['languages_select'] : '';
$customFieldLevelKey =  $_GET['levels_select'] ? $_GET['levels_select'] : '';
$customFieldTypeKey =  $_GET['types_select'] ? $_GET['types_select'] : '';

$oferta_lable = get_field('oferta_lable');
$oferta_discript = get_field('oferta_discript');
$isLogIn = is_user_logged_in();

$userList = get_users( 'blog_id=0&orderby=nicename  ' );
foreach ( $userList as $user ) { 
	echo '<span>' . esc_html( $user->user_email ) . '</span>'; 
} 
$meta_q = array(
    'meta_query' => array(
        'relation' => 'AND',

    ),
);


if ($customFieldLenguageKey) {
    $new = array(
        'key' => 'lenguage',
        'value'        => $customFieldLenguageKey,
        'compare' => '=',
    );

    array_push($meta_q, $new);
}
if ($customFieldTypeKey) {
    $new = array(
        'key'     => 'chose_course_type',
        'value'   => $customFieldTypeKey,
        'compare' => '='
    );

    array_push($meta_q, $new);
}
if ($customFieldLevelKey) {
    $new = array(
        'key'     => 'courses_level',
        'value'   => $customFieldLevelKey,
        'compare' => '='
    );

    array_push($meta_q, $new);
}


$args = [
    'post_type' => 'oferta',
    'meta_query' => $meta_q,

    'paged' => get_query_var('paged'),
];



$oferta_query = new WP_Query($args);

?>


<!-- Side Menu start -->

<section class="start start__subpage bg-light">
    <div class="container">
        <div class="row m-5 offers  ">

            <nav class="offers--nav">

                <form>

                    <div class=" ">
                        <p>Languages</p>
                        <select name='languages_select' class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>Choose language</option>
                            <?php
                            $field = get_field_object('field_61d2d2687de17');
                            $choices = $field['choices']; ?>
                            <?php foreach ($choices as $choice) : ?>
                                <option value="<?php echo $choice ?>"><?php echo $choice ?> </option>
                            <?php endforeach; ?>
                        </select>
                        </br>
                    </div>


                    <div class="">
                        <p>Level</p>


                        <select name='levels_select' class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>Choose level</option>
                            <?php
                            $field = get_field_object('field_61d2d2ef7de19');
                            $choices = $field['choices']; ?>
                            <?php foreach ($choices as $choice) : ?>
                                <option value="<?php echo $choice ?>"><?php echo $choice ?> </option>
                            <?php endforeach; ?>
                        </select>
                        </br>
                    </div>

                    <div class=" ">
                        <?php if ($isLogIn) : ?>
                            <p>Type</p>
                            <select name='types_select' class="form-select" aria-label="Default select example">
                                <option value="" disabled selected>Choose type</option>
                                <?php
                                $field = get_field_object('field_61d1feddb3b0a');
                                $choices = $field['choices']; ?>
                                <?php foreach ($choices as $choice) : ?>
                                    <option value="<?php echo $choice ?>"><?php echo $choice ?> </option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                        </br>
                    </div>
                    <div class="row">
                        <button class="button_gold" type='submit'>Submit</button>
                    </div>
                </form>

            </nav>

        </div>
    </div>
</section>

<!-- Side Menu end -->
<!-- testimonials do zmiany -->
<section class=".logged-in--data">
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






    <div class="container">
        <div class="row   justify-content-center">
            <?php if ($oferta_query->have_posts()) : ?>
                <?php while ($oferta_query->have_posts()) : ?>
                    <?php $oferta_query->the_post(); ?>
                    <?php if (get_field('chose_course_type') === 'Online' || $isLogIn) : ?>

                        <div class="d-flex">
                            <div class="col-lg-2  ">

                                <img class="thumnail" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-10 gap-3 d-grid ">
                                <h2><?php echo get_the_title(); ?></h2>
                                <div class="">
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                                <div class="d-flex justify-content-between  ">
                                    <p>Courses type: <?php echo get_field('chose_course_type'); ?></p>
                                    <a href="<?php echo get_the_permalink(); ?>" class="button_gold ">Czytaj więcej <i class="fas fa-ardiv-right ml-1 small"></i></a>
                                </div>
                            </div>
                        </div>


                    <?php endif; ?>
                <?php endwhile; ?>
        </div>

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
    </div>
</section>



<?php get_footer(); ?>