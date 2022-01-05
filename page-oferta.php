<?php
/*

Template name: Oferta

*/




get_header();

$lenguages = [];
$customFieldLenguageKey =  $_GET['customFieldLenguageKey'] ? $_GET['customFieldLenguageKey'] : '';
$customFieldLenguageValue = $_GET['customFieldLenguageValue'] ? $_GET['customFieldLenguageValue'] : '';

$customFieldCategoryKey =  $_GET['customFieldCategoryKey'] ? $_GET['customFieldCategoryKey'] : '';
$customFieldCategoryValue = $_GET['customFieldCategoryValue'] ? $_GET['customFieldCategoryValue'] : '';

$oferta_lable = get_field('oferta_lable');
$oferta_discript = get_field('oferta_discript');
$isLogIn = false;

$lng = [
    'post_type' => 'oferta',

];

$args = [
    'post_type' => 'oferta',
    'meta_query' => [],

    'paged' => get_query_var('paged'),
];

if ($customFieldLenguageValue) {
    $args = [
        'post_type' => 'oferta',
        'meta_key' => $customFieldLenguageKey,
        'meta_value' => $customFieldLenguageValue,
    ];
}
if ($customFieldCategoryValue) {
    $args = [
        'post_type' => 'oferta',
        'meta_key' => $customFieldCategoryKey,
        'meta_value' => $customFieldCategoryValue,
    ];
}
if ($customFieldCategoryValue && $customFieldLenguageValue) {
    $args = [
        'post_type' => 'oferta',
        'meta_query'	=> array(
            'relation'		=> 'OR',
            array(
                'key'		=> $customFieldLenguageKey,
                'value'		=> $customFieldLenguageValue,

            ),
            array(
                'key'		=> $customFieldCategoryKey,
                'value'		=> $customFieldCategoryValue,
            )
        )
    ];
}


$oferta_query = new WP_Query($args);
$lng_query = new WP_Query($lng);

?>



<section class="start start__subpage bg-light">
    <div class="container">
        <div class="row justify-content-center">

            <?php if ($lng_query->have_posts()) : ?>
            <?php while ($lng_query->have_posts()) : ?>
            <?php $lng_query->the_post();
                    $vari = 0; ?>


            <?php foreach ($lenguages as $lenguage) : ?>
            <?php if ($lenguage === get_field('lenguage'))
                            $vari++;

                        ?>
            <?php endforeach; ?>
            <?php if ($vari < 1) : ?>

            <?php array_push($lenguages, get_field('lenguage'));
                        ?>
            <div class="col-1">
                <form class="advanced-search-form">
                    <input type="hidden" name="customFieldLenguageValue" value="<?php echo get_field('lenguage') ?>">
                    <input type="hidden" name="customFieldLenguageKey" value="lenguage">
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="<?php echo get_field('lenguage') ?>">
                    </div>
                </form>

            </div>


            <?php endif; ?>



            <?php endwhile; ?>
            <?php endif; ?>


        </div>
    </div>
    </div>
</section>


<!-- testimonials do zmiany -->
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


    <div class="row m-5  ">
        <div class="col-lg-3">
            <nav class="offers--nav">
                <ul class="">
                    <a class='row p-1'>
                        <p>Type</p>
                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="online">
                            <input type="hidden" name="customFieldCategoryKey" value="chose_course_type">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="online">
                            </div>
                        </form>
                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="offline">
                            <input type="hidden" name="customFieldCategoryKey" value="chose_course_type">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="offline">
                            </div>
                        </form>
                        </br>
                    </a>

                    <a class='row p-1'>
                        <p>Level</p>
                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="A1">
                            <input type="hidden" name="customFieldCategoryKey" value="courses_level">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="A1">
                            </div>
                        </form>
                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="A2">
                            <input type="hidden" name="customFieldCategoryKey" value="courses_level">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="A2">
                            </div>
                        </form>

                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="B1">
                            <input type="hidden" name="customFieldCategoryKey" value="courses_level">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="B1">
                            </div>
                        </form>
                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="B2">
                            <input type="hidden" name="customFieldCategoryKey" value="courses_level">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="B2">
                            </div>
                        </form>

                        <form class="advanced-search-form">
                            <input type="hidden" name="customFieldCategoryValue" value="C1">
                            <input type="hidden" name="customFieldCategoryKey" value="courses_level">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="C1">
                            </div>
                        </form>



                        </br>
                    </a>
                </ul>
            </nav>









        </div>
        <div class="col-lg-9 ">
            <?php if ($oferta_query->have_posts()) : ?>
            <?php while ($oferta_query->have_posts()) : ?>
            <?php $oferta_query->the_post(); ?>
            <?php if (get_field('chose_course_type') === 'Online' || $isLogIn) : ?>

            <div class="col-lg-4">

                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="" class="img-fluid">
            </div>
            <div class="col-lg-8 gap-3 d-grid">
                <h2><?php echo get_the_title(); ?></h2>
                <div>
                    <p><?php echo get_the_excerpt(); ?></p>

                    <a href="<?php echo get_the_permalink(); ?>" class="btn btn-primary">Czytaj więcej <i
                            class="fas fa-arrow-right ml-1 small"></i></a>
                </div>

                <div class="align-self-center">
                    <p>Courses type: <?php echo get_field('chose_course_type'); ?></p>
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