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
$isLogIn = true;

$lng = [
    'post_type' => 'oferta',

];

$args = [
    'post_type' => 'oferta',
    'meta_query' => [],

    'paged' => get_query_var('paged'),
];


if ($customFieldLenguageKey || $customFieldLevelKey || $customFieldTypeKey) {
    $args = [
        'post_type' => 'oferta',
        'meta_query'    => array(
            'relation'        => 'OR',
            array(
                'key'        => 'lenguage',
                'value'        => $customFieldLenguageKey,

            ),
            array(
                'key'        => 'chose_course_type',
                'value'        => $customFieldTypeKey,
            ),
            array(
                'key'        => 'courses_level',
                'value'        => $customFieldLevelKey,
            )
        )
    ];
}
// if ($customFieldLenguageKey || $customFieldLevelKey || $customFieldTypeKey) {
//     $args = [
//         'post_type' => 'oferta',
//         'meta_query'    => array(
//             'relation'        => 'OR',
//             array(
//                 'key'        => 'lenguage',
//                 'value'        => $customFieldLenguageKey,

//             ),
//             array(
//                 'key'        =>'chose_course_type',
//                 'value'        => $customFieldTypeKey,
//             ),
//             array(
//                 'key'        => 'courses_level',
//                 'value'        => $customFieldLevelKey,
//             )
//         )
//     ];
// }


$oferta_query = new WP_Query($args);
$lng_query = new WP_Query($lng);

?>




<section class="start start__subpage bg-light">
    <div class="container">
        <div class="row justify-content-center">




        </div>
    </div>
    </div>
</section>


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

    <!-- Side Menu start -->
    <div class="row m-5 offers  ">
        <div class="col-lg-3">
            <nav class="offers--nav">
                <ul class="">
                    <form>
                        <a class='row p-1'>
                            <p>Type</p>

                            <select name='languages_select' class="form-select" aria-label="Default select example">
                                <option value="" disabled selected>Choose language</option>
                                <?php if ($lng_query->have_posts()) : ?>
                                    <?php while ($lng_query->have_posts()) : ?>
                                        <?php $lng_query->the_post();
                                        $vari = 0; ?>
                                        <?php foreach ($lenguages as $lenguage) : ?>
                                            <?php if ($lenguage === get_field('lenguage')) $vari++; ?>
                                        <?php endforeach; ?>
                                        <?php if ($vari < 1) : ?>
                                            <?php array_push($lenguages, get_field('lenguage')); ?>
                                            <option value="<?php echo get_field('lenguage') ?>"><?php echo get_field('lenguage') ?> </option>
                                        <?php endif; ?>


                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                            </br>
                        </a>

                        <a class='row p-1'>
                            <p>Level</p>


                            <select name='levels_select' class="form-select" aria-label="Default select example">
                                <option value="" disabled selected>Choose level</option>
                                <?php if ($lng_query->have_posts()) : ?>
                                    <?php while ($lng_query->have_posts()) : ?>
                                        <?php $lng_query->the_post();
                                        $vari = 0; ?>
                                        <?php foreach ($levels as $level) : ?>
                                            <?php if ($level === get_field('courses_level')) $vari++; ?>
                                        <?php endforeach; ?>
                                        <?php if ($vari < 1) : ?>
                                            <?php array_push($lenguages, get_field('courses_level')); ?>
                                            <option value="<?php echo get_field('courses_level') ?>"><?php echo get_field('courses_level') ?> </option>
                                        <?php endif; ?>


                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                            </br>
                        </a>

                        <a class='row p-1'>
                            <p>Type</p>


                            <select name='types_select' class="form-select" aria-label="Default select example">
                                <option value="" disabled selected>Choose type</option>
                                <option value="Online">Online</option>
                                <option value="Offline">Offline</option>
                            </select>
                            </br>
                        </a>
                        <button class="button_gold" type='submit'>Submit</button>
                    </form>
                </ul>
            </nav>
        </div>

        <!-- Side Menu end -->


        <div class="row col-lg-9 ">
            <?php if ($oferta_query->have_posts()) : ?>
                <?php while ($oferta_query->have_posts()) : ?>
                    <?php $oferta_query->the_post(); ?>
                    <?php if (get_field('chose_course_type') === 'Online' || $isLogIn) : ?>

                       
                            <div class="col-lg-2  ">

                                <img class="thumnail" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="" class="img-fluid">
                            </div>
                            <div class="col-lg-10 gap-3 d-grid ">
                                <h2><?php echo get_the_title(); ?></h2>
                                <div class="">
                                    <p><?php echo get_the_excerpt(); ?></p>
                                </div>
                                <div class="d-flex justify-content-between align-items-end ">
                                    <p>Courses type: <?php echo get_field('chose_course_type'); ?></p>
                                    <a href="<?php echo get_the_permalink(); ?>" class="button_gold ">Czytaj więcej <i class="fas fa-ardiv-right ml-1 small"></i></a>
                                </div>
                            </div>
                      


                    <?php endif; ?>
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
        </div>
</section>



<?php get_footer(); ?>