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
$new_name = $_POST['first_name'];
$new_surname = $_POST['surname'];
$new_email_value = $_POST['mail'];
$new_phone_value = $_POST['phone'];
$new_birthday = $_POST['birthday'];

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
    //imię
    if (get_field('user_name', $logged_in_user_data->ID) !== $new_name ) {
        update_field('user_name', $new_name, $logged_in_user_data->ID );
    }
    //nazwisko
    if (get_field('user_surname', $logged_in_user_data->ID) !== $new_surname ) {
        update_field('user_surname', $new_surname, $logged_in_user_data->ID );
    }
    
    //urodziny
    if (get_field('user_birthday', $logged_in_user_data->ID) !== $new_birthday ) {
        update_field('user_birthday', $new_birthday, $logged_in_user_data->ID );
    }
};
//
//warunkowa wartość telefonu
$user_phone = get_field('user_phone_number', $logged_in_user_data->ID);
//warunkowa wartość imię
$user_name = get_field('user_name', $logged_in_user_data->ID);
//warunkowa wartość nazwisko
$user_surname = get_field('user_surname', $logged_in_user_data->ID);
//warunkowa wartość urodzin
$user_birthday = get_field('user_birthday', $logged_in_user_data->ID);

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
            <div class="logged-in--data col-lg-5">
                <form class='form-data' method="POST">
                    <div>
                        <label for="mail">E-mail (login):</label>
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

                        <p>Imię:</p>
                        <input type="text" name='first_name' value='<?php

                            if ($_POST['hidden-data-input'] == 'change_data') {
                                echo $new_name;
                            } else {
                                echo $user_name;
                            }
                            ?>'>
                    </div>
                    <div>
                        <p>Nazwisko:</p>
                        <input type="text" name='surname' value='<?php

                            if ($_POST['hidden-data-input'] == 'change_data') {
                                echo $new_surname;
                            } else {
                                echo $user_surname;
                            }
                            ?>'>
                    </div>

                    <div>
                        <label for="phone">Nr telefonu:</label>
                        <input type="text" name='phone' value='<?php

                            if ($_POST['hidden-data-input'] == 'change_data') {
                                echo $new_phone_value;
                            } else {
                                echo $user_phone;
                            }
                            ?>'>
                    </div>
                    <div>
                        <label for="birthday">Data urodzenia:</label>
                        <input type="date" name='birthday' value='<?php

                            if ($_POST['hidden-data-input'] == 'change_data') {
                                echo $new_birthday;
                            } else {
                                echo $user_birthday;
                            }
                            ?>'>
                    </div>
                    <!-- <p><?php print_r($new_birthday_value) ?></p> -->


                    <!-- <div class='logged-in--data__flex'></div> -->

                    <button class='btn-gold-secondary' type='submit'>Zmień dane</button>


                </form>
            </div>
            <div class="col-lg-5">
                <form class='form-password' method='POST'>
                    <input type="hidden" name='hidden-data-input' value='change_password'>
                    <div>
                        <label for="old-password">Stare hasło:</label>
                        <input type="password" name='old-password' value='' placeholder='********'>
                    </div>
                    <div>
                        <label for="new-password-1">Nowe hasło:</label>
                        <input type="password" name='new-password-1' value='' placeholder='********'>
                    </div>
                    <div>
                        <label for="new-password-2">Powtórz nowe hasło:</label>
                        <input type="password" name='new-password-2' value='' placeholder='********'>
                    </div>
                    <div class='logged-in--data__flex'></div>
                    <p><?php echo $pass?></p>
                    <button class='btn-gold-primary' type='submit'>Zmień hasło</button>
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
            <p class='data-change--error'>Hasła różnią się</p>
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
<div class="container">
    <div class="row justify-content-lg-center">
        <div class="col-lg-8">
            <!-- start saved courses -->
            <section id="-in-courses" class="logged-in-courses" style='height: 100%'>

                <div class="container position-relative" style='height: 100%'>

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
                            <a class='btn-gold-primary' href="<?php echo get_the_permalink()?>">Czytaj więcej <i
                                    class="fas fa-chevron-right"></i></a>
                            <form method="POST">
                                <input type="hidden" name='delete' value='delete-saved-course'>
                                <input type="hidden" name='course_ID' value='<?php echo get_the_ID() ?>'>
                                <button type='submit'>Usuń z zapisanych</button>
                            </form>

                        </div>

                        <?php endwhile; ?>


                    </div>
                    <div class="pagination pagination-lg justify-content-center logged-in-saved-courses--pagination ">

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

        <div class="col-lg-4 border-left">
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
                                <a class='btn-gold-primary' href="<?php echo $course->guid?>">Czytaj więcej <i
                                        class="fas fa-chevron-right"></i></a>
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

                </div>




            </section>
            <!-- end visited courses -->
        </div>
    </div>
</div>
<!-- end kursy -->









<?php get_footer(); ?>