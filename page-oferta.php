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

<<<<<<< Updated upstream

=======
>>>>>>> Stashed changes
//Var that yous do search category
$meta_q = array(
    'meta_query' => array(
        'relation' => 'AND',

    ),
);

// If some category was selected -> push it to $mate_q to search by more that 1 category
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

//zapisane kursy
$logged_in_user_data = wp_get_current_user();
$string_saved_course_ID = get_field('user_saved_courses', $logged_in_user_data->ID);
$array_saved_course_ID = explode(",", $string_saved_course_ID);

//dodawanie do zapisanych
$course_to_add_delete = $_POST['course_id'];

if ($_POST['save'] == 'save-course') {
    if (!(in_array($course_to_add_delete, $array_saved_course_ID))) {
        
        array_unshift($array_saved_course_ID, $course_to_add_delete);
        $new_string_saved_courses_ID = implode(",", $array_saved_course_ID);
    
        update_field('user_saved_courses', $new_string_saved_courses_ID, $logged_in_user_data->ID);
        }
    }
//usuwanie z zapisanych

if ($_POST['delete'] == 'delete-course') {
$ID_course_to_delete = array_search($course_to_add_delete, $array_saved_course_ID);
unset($array_saved_course_ID[$ID_course_to_delete]);
$new_string_saved_courses_ID = implode(",", $array_saved_course_ID);
update_field('user_saved_courses', $new_string_saved_courses_ID, $logged_in_user_data->ID);
}

//register button
$register_btn_title = get_field('offer_register_btn')['title'];
$register_btn_url = get_field('offer_register_btn')['url'];
$register_btn_target = get_field('offer_register_btn')['target'];



?>


<!-- Side Menu start -->

<section class="offer-filter">
    <div class="container">
        <?php if ($oferta_lable) : ?>
        <h2 class='m-8'>
            <?php echo $oferta_lable ?>
        </h2>
        <?php endif; ?>

        <div class="row offers justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <form>
                    <div>
                        <select name='languages_select' class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>Język</option>
                            <?php
                            $field = get_field_object('field_61d2d2687de17');
                            $choices = $field['choices']; ?>
                            <?php foreach ($choices as $choice) : ?>
                            <option value="<?php echo $choice ?>"><?php echo $choice ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <select name='levels_select' class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>Poziom</option>
                            <?php
                            $field = get_field_object('field_61d2d2ef7de19');
                            $choices = $field['choices']; ?>
                            <?php foreach ($choices as $choice) : ?>
                            <option value="<?php echo $choice ?>"><?php echo $choice ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <?php if ($isLogIn) : ?>
                    <div>
                        <select name='types_select' class="form-select" aria-label="Default select example">
                            <option value="" disabled selected>Tryb</option>
                            <?php
                                $field = get_field_object('field_61d1feddb3b0a');
                                $choices = $field['choices']; ?>
                            <?php foreach ($choices as $choice) : ?>
                            <option value="<?php echo $choice ?>"><?php echo $choice ?> </option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                    <?php endif; ?>

                    <button class="btn-gold-primary" type='submit'> <i class='fas fa-search'></i> </button>

                </form>
            </div>

        </div>
    </div>
</section>

<!-- End filter -->

<!-- Start display courses -->
<section class="offer-display">
    <div class="container">

        <?php if ($oferta_query->have_posts()) : ?>
        <?php while ($oferta_query->have_posts()) : ?>
        <?php $oferta_query->the_post(); ?>
        <?php if (get_field('chose_course_type') === 'Online' || $isLogIn) : ?>

        <?php switch (get_field("courses_level", get_the_ID())) {
        case 'A1':
            $border_color = 'rgb(76, 189, 53)';
            break;
        case 'A2':
            $border_color = 'rgb(27, 131, 41)';
            break;
        case 'B1':
            $border_color = 'rgb(51, 214, 206)';
            break;
        case 'B2':
            $border_color = 'rgb(21, 129, 148)';
            break;
        case 'C1':
            $border_color = 'rgb(235, 107, 33)';
            break;
        case 'C2':
            $border_color = 'rgb(202, 71, 19)';
        break;
        }
        ?>

        <div class="row justify-content-center ">

            <div class="col-lg-10 col-xl-8 offer-display--item"
                style='border-right: <?php echo $border_color?> solid 1.8rem'>

                <div class="d-flex align-items-end">
                    <div class="img"
                        style='background-image: url("<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>");'>
                    </div>
                    <div class="title mx-4">
                        <h4><?php echo get_the_title(); ?></h4>
                        <span>Poziom:
                            <strong><?php echo get_field('courses_level'); ?></strong></span>
                        <span class='mx-4'>Tryb: <strong><?php echo get_field('chose_course_type'); ?></strong>
                        </span>
                    </div>
                </div>

                <hr>
                <p class='my-4'><?php echo wp_trim_words( get_the_content(), 45, ' [...]' ) ?></p>

                <div class="buttons d-flex">

                    <?php if ($isLogIn) : ?>
                    <?php if (!in_array(get_the_ID(), $array_saved_course_ID)) : ?>
                    <form method="POST" class='d-inline'>
                        <input type="hidden" name='save' value='save-course'>
                        <input type="hidden" name='course_id' value='<?php echo get_the_ID()?>'>
                        <button class='btn-gold-primary save-button' type='submit'><i class="far fa-star"></i>
                            Zapisz kurs</button>
                    </form>
                    <?php else : ?>
                    <div style='overflow: hidden'>
                        <form method="POST" class='form-slider d-flex gap-4'>
                            <input type="hidden" name='delete' value='delete-course'>
                            <input type="hidden" name='course_id' value='<?php echo get_the_ID()?>'>

                            <div class='btn-gold-secondary d-inline'><i class="fas fa-star"></i> Zapisano!</div>
                            <button type='submit' class='d-inline'>
                                <span>| Usuń</span></button>

                        </form>
                    </div>
                    <?php endif; ?>
                    <?php else : ?>
                    <a href="<?php echo $register_btn_url?>" target='<?php echo $register_btn_target?>'
                        class="btn-gold-secondary"><?php echo $register_btn_title?></a>
                    <?php endif; ?>
                    <a href="<?php echo get_the_permalink(); ?>" class="btn-gold-primary">Czytaj więcej <i
                            class="fas fa-chevron-right"></i></a>
                </div>


            </div>


        </div>

        <?php endif; ?>
        <?php endwhile; ?>
    </div>
<!-- End display courses -->
    <div class="pagination pagination-lg justify-content-center">
        <?php
                $big = 9999999;
                echo paginate_links([
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?page=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $oferta_query->max_num_pages
                ]);

            ?>
    </div>

    <?php else : ?>
    <div class='text-center'>
        <p>Niestety w tym momencie nie oferujemy kursu, którego szukasz.</p>
        <p>Zmień kryteria wyszukiwania.</p>

    </div>
    <?php endif;
    ?>
    </div>
</section>



<?php get_footer(); ?>