<?php
/*
Template name: Zalogowane konto
*/

//test
// update_field('user_saved_courses', '', wp_get_current_user()->ID);
// update_field('user_visited_courses', '', wp_get_current_user()->ID);

//start
$logged_in_start_img = get_field('logged_in_start_img');
$logged_in_start_title = get_field('logged_in_start_title');

//dane
$logged_in_data_title = get_field('logged_in_data_title');
$logged_in_user_data = wp_get_current_user();

//saved
$logged_in_saved_title = get_field('logged_in_saved_title');


//zmiana danych
$new_email_value = $_POST['mail'];
$new_phone_value = $_POST['phone'];

if ($_POST['hidden-data-input'] == 'change_data') {
    //mail
    if ($logged_in_user_data->user_email !== $new_email_value ) {
        global $wpdb;
        $wpdb->update(
            $wpdb->users, 
            ['user_email' => $new_email_value], 
            ['ID' => $logged_in_user_data->ID]
        );
    };
    //telefon
    if (get_field('user_phone_number', $logged_in_user_data->ID) !== $new_phone_value ) {
        update_field('user_phone_number', $new_phone_value, $logged_in_user_data->ID );
    }
};
//
//nowa wartość telefonu
$user_phone = get_field('user_phone_number', $logged_in_user_data->ID);

//zmiana hasła
$real_password = get_userdata($logged_in_user_data->ID)->user_pass;
$old_password = $_POST['old-password'];
$password_match = wp_check_password( $old_password, $real_password, $logged_in_user_data->ID );
$new_password_1 = $_POST['new-password-1'];
$new_password_2 = $_POST['new-password-2'];
if ($_POST['hidden-data-input'] == 'change_password') {
    if ($password_match) {
        if ($new_password_1 == $new_password_2) {
            wp_set_password($new_password_1, $logged_in_user_data->ID);
        }
    }
}


//visited pages
$logged_in_visited_title = get_field('logged_in_visited_title');
$string_visited_course_ID = get_field('user_visited_courses', $logged_in_user_data->ID);
$array_visited_course_ID = explode(",", $string_visited_course_ID);

//czyszczenie visited pages
if ($_POST['clean'] == 'clean-visited-pages') {
    update_field('user_visited_courses', '', $logged_in_user_data->ID);
}
//

//wyświetlanie visited pages
$visitedArgs = [
    'post_type' => 'oferta',
    'post_status' => 'publish',
    'post__in' => $array_visited_course_ID,
    'orderby' => 'post__in',
    'numberposts' => 6,
];

$visited_courses = get_posts($visitedArgs);
//


// saved pages
$string_saved_course_ID = get_field('user_saved_courses', $logged_in_user_data->ID);
$array_saved_course_ID = explode(",", $string_saved_course_ID);

//czyszczenie saved pages
if ($_POST['clean'] == 'clean-saved-pages') {
    update_field('user_saved_courses', '', $logged_in_user_data->ID);
};
//

//czyszczenie jednego saved page
$course_to_delete = $_POST['course_ID'];
if ($_POST['delete'] == 'delete-saved-course') {
    $ID_course_to_delete = array_search($course_to_delete, $array_saved_course_ID);
    unset($array_saved_course_ID[$ID_course_to_delete]);
    $new_string_saved_courses_ID = implode(",", $array_saved_course_ID);
    update_field('user_saved_courses', $new_string_saved_courses_ID, $logged_in_user_data->ID);
}

//wyświetlanie saved pages
$savedArgs = [
    'post_type' => 'oferta',
    'post_status' => 'publish',
    'post__in' => $array_saved_course_ID,
    'orderby' => 'post__in',
    'paged' => get_query_var('paged'),
    'posts_per_page' => 4,
];

$saved_courses = new WP_Query($savedArgs);
//

// try


get_header();
?>

<!-- start my account logged in -->
<section id="logged-in--start" class="logged-in--start" style="background-image: url('<?= $logged_in_start_img ?>')" ;>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="logged-in--start__text">
                    <?php if ($logged_in_start_title) : ?>
                    <h1><?= $logged_in_start_title ?></h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end my account logged -->

<!-- start data -->
<section id="logged-in--data" class="logged-in--data">
    <div class="container">
        <div class="row">
            <?php if ($logged_in_data_title) : ?>
            <h2><?= $logged_in_data_title ?></h2>
            <?php endif; ?>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="logged-in--data col-lg-4">
                <form class='form-data' method="POST">
                    <div>
                        <p>Login:</p>
                        <span><?php echo $logged_in_user_data->user_login?></span>
                    </div>
                    <div>
                        <p>Imię:</p>
                        <span><?php printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_firstname ) );?></span>
                    </div>
                    <div>
                        <p>Nazwisko:</p>
                        <span><?php printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_lastname ) ); ?></span>
                    </div>
                    <div>
                        <label for="mail">E-mail:</label>
                        <input type="hidden" name='hidden-data-input' value='change_data'>
                        <input type="text" name='mail' value='<?php

                            if ($_POST['hidden-data-input'] == 'change_data') {
                                echo $new_email_value;
                            } else {
                                echo  $logged_in_user_data->user_email;
                            }
                            ?>'>
                    </div>
                    <div>
                        <label for="phone">Nr telefonu:</label>
                        <input type="text" name='phone' value='<?php

                            if ($_POST['hidden-data-input'] == 'change_data') {
                                echo $new_phone_value;
                            } else {
                                print_r($user_phone);
                            }
                            ?>'>
                    </div>
                    <!-- <div class='logged-in--data__flex'></div> -->

                    <button type='submit'>Zmień dane</button>


                </form>
            </div>
            <div class="col-lg-4">
                <form class='form-password' method='POST'>
                    <input type="hidden" name='hidden-data-input' value='change_password'>
                    <div>
                        <label for="old-password">Stare hasło:</label>
                        <input type="password" name='old-password' value=''>
                    </div>
                    <div>
                        <label for="new-password-1">Nowe hasło:</label>
                        <input type="password" name='new-password-1' value=''>
                    </div>
                    <div>
                        <label for="new-password-2">Powtórz nowe hasło:</label>
                        <input type="password" name='new-password-2' value=''>
                    </div>
                    <div class='logged-in--data__flex'></div>
                    <p><?php echo $pass?></p>
                    <button type='submit'>Zmień hasło</button>
                </form>

            </div>
        </div>
        <div class="row logged-in--data__joined">
            <?php if ($_POST['hidden-data-input'] == 'change_data') : ?>
            <p class='data-change--success'>Pomyślnie zmieniłeś dane!</p>
            <?php elseif ($_POST['hidden-data-input'] == 'change_password') : ?>
            <?php if ($password_match) : ?>
            <?php if ($new_password_1 == $new_password_2) : ?>
            <p class='data-change--success'>Pomyślnie zmieniłeś hasło!</p>
            <?php else: ?>
            <p class='data-change--error'>Wprowadź poprawne hasło</p>
            <?php endif; ?>
            <?php else: ?>
            <p class='data-change--error'>Wprowadź poprawne hasło</p>
            <?php endif; ?>
            <?php endif; ?>
            <p>Dołączono: <span><?php echo $logged_in_user_data->user_registered?></span></p>
        </div>

    </div>
</section>
<!-- start data -->

<!-- start kursy -->
<div class="row justify-content-lg-center">
    <div class="col-lg-7">
        <!-- start saved courses -->
        <section id="-in-courses" class="logged-in-courses">

            <div class="container">

                <h2 class='py-5 text-center'><?php echo $logged_in_saved_title?></h2>

                <?php if (get_field('user_saved_courses',$logged_in_user_data->ID)) : ?>

                <form method='POST' class="clean-saved-form">
                    <input type="hidden" name="clean" value="clean-saved-pages">
                    <div class="form-group">
                        <button type="submit">Wyczyść listę</button>
                    </div>
                </form>

                <div class="logged-in-saved-courses d-flex ">

                    <?php while ($saved_courses->have_posts()) : ?>
                    <?php $saved_courses->the_post(); ?>

                    <div class="logged-in-saved-courses__item">
                        <div class='logged-in-saved-courses__item--img'>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt=""
                                class="img-fluid">
                            <h3> <?php echo get_the_title(); ?> </h3>

                        </div>
                        <p> <?php echo get_the_excerpt(); ?> </p>
                        <p> Poziom: <?php echo get_field("courses_level", get_the_ID()) ?> </p>
                        <p> Czas trwania kursu: <?php echo get_field("courses_time", get_the_ID()) ?>h </p>
                        <a href="<?php echo get_the_permalink()?>">Czytaj więcej...</a>
                        <form method="POST">
                            <input type="hidden" name='delete' value='delete-saved-course'>
                            <input type="hidden" name='course_ID' value='<?php echo get_the_ID() ?>'>
                            <button type='submit'>Usuń z zapisanych</button>
                        </form>

                    </div>

                    <?php endwhile; ?>


                </div>
                <div class="pagination pagination-lg justify-content-center logged-in-saved-courses--pagination">

                    <?php
                $big = 9999999;
                echo paginate_links([
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $saved_courses->max_num_pages
                ]);
                ?>

                </div>
                <?php else : ?>
                <p>Brak postów do wyświetlenia.</p>
                <?php endif; ?>

            </div>
        </section>
        <!-- end saved courses -->
    </div>

    <div class="col-lg-3 border-left">
        <!-- start visited courses -->
        <section id="logged-in-courses" class="logged-in-courses">

            <div class="container">

                <h2 class='py-5 text-center'><?php echo $logged_in_visited_title?></h2>

                <?php if (get_field('user_visited_courses',$logged_in_user_data->ID)) : ?>

                <form method='POST' class="clean-visited-form">
                    <input type="hidden" name="clean" value="clean-visited-pages">
                    <div class="form-group">
                        <button type="submit">Wyczyść listę</button>

                    </div>
                </form>


                <div class="logged-in-visited-courses d-flex ">

                    <?php foreach ($visited_courses as $course) : ?>

                    <h3> <?php echo $course->post_title; ?> </h3>
                    <div class="logged-in-visited-courses__item">
                        <div class="logged-in-visited-courses__item--desc">
                            <p> Poziom: <?php echo get_field("courses_level", $course->ID) ?> </p>
                            <p> Czas trwania kursu: <?php echo get_field("courses_time", $course->ID) ?>h </p>
                            <a href="<?php echo $course->guid?>">Czytaj więcej...</a>
                        </div>
                        <div class='logged-in-visited-courses__item--img'>
                            <img src="<?php echo get_the_post_thumbnail_url($course->ID, 'medium'); ?>" alt=""
                                class="img-fluid">
                        </div>
                    </div>

                    <?php endforeach; ?>



                </div>
                <?php else : ?>
                <p>Brak postów do wyświetlenia.</p>
                <?php endif; ?>

                <!-- <p><?php echo get_field('user_saved_courses', $logged_in_user_data->ID);?></p> -->


            </div>




        </section>
        <!-- end visited courses -->
    </div>
</div>
<!-- end kursy -->









<?php get_footer(); ?>