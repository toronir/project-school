<?php
/*
Template name: Zalogowane konto
*/

//start
$logged_in_start_img = get_field('logged_in_start_img');
$logged_in_start_title = get_field('logged_in_start_title');

//dane
$logged_in_data_title = get_field('logged_in_data_title');
$logged_in_password_title = get_field('logged_in_password_title');
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
if (is_user_logged_in()) {
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
    'numberposts' => 7,
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

<?php if (is_user_logged_in()) : ?>

<!-- start data -->
<section id="logged-in--data" class="logged-in--data">

    <?php if ($_POST['hidden-data-input'] == 'change_data') : ?>
    <div class="container--alerts alert alert-success text-center" style='margin-top: 3rem' role="alert">Pomyślnie
        zmieniłeś dane!
    </div>
    <?php elseif ($_POST['hidden-data-input'] == 'change_password') : ?>
    <?php if ($password_match) : ?>
    <?php if ($new_password_1 == $new_password_2) : ?>
    <div class="container--alerts alert alert-success text-center" style='margin-top: 3rem' role="alert">Pomyślnie
        zmieniłeś
        hasło!</div>
    <?php else: ?>
    <div class="container--alerts alert alert-warning text-center" style='margin-top: 3rem' role="alert">Podane hasła
        różnią
        się</div>
    <?php endif; ?>
    <?php else: ?>
    <div class="container--alerts alert alert-danger text-center" style='margin-top: 3rem' role="alert">Wprowadź
        poprawne hasło
    </div>
    <?php endif; ?>
    <?php endif; ?>

    <div class="container--data">
        <div class="row justify-content-center">
            <div class="col-12 col-md-4 logged-in--data__title ">
                <?php if ($logged_in_data_title) : ?>
                <h2><?= $logged_in_data_title ?></h2>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-8 logged-in--data__change">
                <form class='form-data' method="POST">
                    <div class='mt-0'>
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

                    <button class='btn-gold-primary' type='submit'>Zmień dane</button>

                </form>
            </div>
            <div class="col-12 col-md-4 logged-in--data__title mt-lg-4">
                <?php if ($logged_in_password_title) : ?>
                <h2 class='text-center text-md-left'><?= $logged_in_password_title ?></h2>
                <?php endif; ?>
            </div>
            <div class="col-12 col-md-8 logged-in--data__change mt-lg-4">
                <form class='form-password' method='POST'>
                    <input type="hidden" name='hidden-data-input' value='change_password'>
                    <div class='mt-0'>
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
                    <button class='btn-gold-primary' type='submit'>Zmień hasło</button>
                </form>

            </div>

        </div>
        <p class='text-center'>Dołączono: <span><?php echo $logged_in_user_data->user_registered?></span></p>
    </div>

</section>
<!-- start data -->

<!-- start kursy -->
<section id="logged-in-courses" class="logged-in-courses">
    <div class="container">
        <div class="row justify-content-center">
            <!-- start saved courses -->
            <div class="col-12 col-xl-8 logged-in-saved-courses position-relative p-0 pb-5" style='height: 100%'>

                <h2 class='mt-5 text-center'><?php echo $logged_in_saved_title?></h2>

                <?php if (get_field('user_saved_courses',$logged_in_user_data->ID)) : ?>

                <form method='POST' class="clean-saved-form">
                    <input type="hidden" name="clean" value="clean-saved-pages">
                    <div class="form-group">
                        <button type="submit"><i class="fas fa-trash-alt"></i><span> Wyczyść listę</span></button>
                    </div>
                </form>

                <?php while ($saved_courses->have_posts()) : ?>
                <?php $saved_courses->the_post(); ?>

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

                <div class="logged-in-saved-courses__item"
                    style='border-right: <?php echo $border_color?> solid 1.8rem'>

                    <div class="d-flex align-items-end">
                        <div class='logged-in-saved-courses__item--img'
                            style='background-image: url("<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>");'>
                        </div>
                        <div class="title mx-4">
                            <h4> <?php echo get_the_title(); ?> </h4>
                            <span>Poziom:
                                <strong><?php echo get_field('courses_level'); ?></strong></span>
                            <span class='mx-4'>Nabór: <strong><?php echo get_field('chose_course_type'); ?></strong>
                            </span>
                            <span class='d-block d-md-inline'>Czas trwania kursu:
                                <strong><?php echo get_field("courses_time", get_the_ID()) ?>h</strong></span>
                        </div>

                    </div>
                    <hr>
                    <p class='my-4'><?php echo wp_trim_words( get_the_content(), 45, ' [...]' ) ?></p>

                    <div class="buttons d-flex">

                        <div style='overflow: hidden'>
                            <form method="POST" class='form-slider d-flex gap-4'>
                                <input type="hidden" name='delete' value='delete-saved-course'>
                                <input type="hidden" name='course_ID' value='<?php echo get_the_ID()?>'>
                                <div class='btn-gold-secondary d-inline'><i class="fas fa-star"></i> Zapisano!</div>
                                <button type='submit' class='d-inline'>
                                    <span>| Usuń</span></button>
                            </form>
                        </div>

                        <a href="<?php echo get_the_permalink(); ?>" class="btn-gold-primary">Sprawdź ofertę <i
                                class="fas fa-chevron-right"></i></a>
                    </div>

                </div>

                <?php endwhile; ?>

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
                <p class='m-5 text-center' style='font-style: italic'>Brak postów do wyświetlenia.</p>
                <?php endif; ?>



                <!-- end saved courses -->
            </div>

            <div class="col-12 col-xl-4 border-left">
                <!-- start visited courses -->
                <section id="logged-in-courses" class="logged-in-courses">

                    <div class="container">

                        <h2 class='mt-5 mb-2 text-center'><?php echo $logged_in_visited_title?></h2>

                        <?php if (get_field('user_visited_courses',$logged_in_user_data->ID)) : ?>

                        <form method='POST' class="clean-visited-form">
                            <input type="hidden" name="clean" value="clean-visited-pages">
                            <div class="form-group">
                                <button type="submit"><i class="fas fa-trash-alt"></i><span> Wyczyść
                                        listę</span></button>

                            </div>
                        </form>


                        <div class="logged-in-visited-courses d-flex ">

                            <?php foreach ($visited_courses as $course) : ?>

                            <h3> <?php echo $course->post_title; ?> </h3>
                            <div class="logged-in-visited-courses__item">
                                <div class="logged-in-visited-courses__item--desc">
                                    <p> Poziom: <?php echo get_field("courses_level", $course->ID) ?> </p>
                                    <p> Czas trwania kursu: <?php echo get_field("courses_time", $course->ID) ?>h </p>
                                    <a class='btn-gold-primary' href="<?php echo $course->guid?>">Sprawdź ofertę <i
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
                        <p class='m-5 text-center' style='font-style: italic'>Brak postów do wyświetlenia.</p>
                        <?php endif; ?>

                    </div>




                </section>
                <!-- end visited courses -->
            </div>
        </div>
    </div>
</section>
<!-- end kursy -->
<?php else : ?>
<h3 class='text-center m-5'>Zaloguj się, aby przejść do strony Moje Konto.</h3>
<?php endif; ?>



<?php get_footer(); ?>