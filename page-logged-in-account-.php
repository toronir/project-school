<?php
/*
Template name: Zalogowane konto
*/

//start
$logged_in_start_img = get_field('logged_in_start_img');
$logged_in_start_title = get_field('logged_in_start_title');

//dane
$logged_in_data_title = get_field('logged_in_data_title');
$logged_in_user_data = wp_get_current_user();


//zmiana maila
$logged_in_new_value = $_POST['mail'];
if ($_POST['hidden-mail-input'] == 'change') {
    if (wp_get_current_user()->user_email !== $logged_in_value_email ) {
        global $wpdb;
        $wpdb->update(
            $wpdb->users, 
            ['user_email' => $logged_in_new_value], 
            ['ID' => wp_get_current_user()->ID]
        );
    }
}
//

//visited pages
$logged_in_visited_title = get_field('logged_in_visited_title');


//czyszczenie visited pages
if ($_POST['clean-visited-pages'] == 'clean') {
    update_field('user', '', 'user_1');
}
//

//wyświetlanie visited pages
$string_course_ID = get_field('user', 'user_1');
$array_course_ID = explode(",", $string_course_ID);

$args = [
    'post_type' => 'oferta',
    'post_status' => 'publish',
    'include' => $array_course_ID,
];

$courses = get_posts($args);
//



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

            <div class="logged-in--data">
                <?php if ($logged_in_data_title) : ?>
                <h2><?= $logged_in_data_title ?></h2>
                <?php endif; ?>
                <div class="wrapper form">
                    <form method="POST">
                        <div>
                            <p>Login:</p>
                            <span><?php echo $logged_in_user_data->user_login?></span>
                        </div>
                        <div>
                            <label for="name">Imię:</label>
                            <span><?php printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_firstname ) );?></span>
                            <!-- <input type="text" name='name'
                                value='<?php printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_firstname ) );?>'> -->
                        </div>
                        <div>
                            <label for="surname">Nazwisko:</label>
                            <span><?php printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_lastname ) ); ?></span>
                            <!-- <input type="text" name='surname'
                                value="<?php printf( __( '%s', 'textdomain' ), esc_html( $current_user->user_lastname ) ); ?>"> -->
                        </div>
                        <div>
                            <label for="mail">E-mail:</label>
                            <input type="hidden" name='hidden-mail-input' value='change'>
                            <input type="text" name='mail' value='<?php

                            if ($_POST['hidden-mail-input'] == 'change') {
                                echo $logged_in_new_value;
                            } else {
                                echo  $logged_in_user_data->user_email;
                            }
                            ?>'>



                        </div>
                        <button type='submit'>Zmień dane</button>


                    </form>
                    <div style="background-image: url('<?php echo get_avatar_url($logged_in_user_data->ID) ?>');">
                    </div>

                </div>
                <p>Dołączono: <span><?php echo $logged_in_user_data->user_registered?></span></p>
            </div>

        </div>
    </div>
</section>
<!-- start data -->

<!-- start visited courses -->
<section id="logged-in-courses" class="logged-in-courses">

    <div class="container">

        <h2 class='py-5 text-center'><?php echo $logged_in_visited_title?></h2>

        <?php if (get_field('user','user_1')) : ?>

        <form method='POST' class="clean-visited-form">
            <input type="hidden" name="clean-visited-pages" value="clean">
            <div class="form-group">
                <button type="submit">Wyczyść listę</button>
            </div>
        </form>


        <div class="logged-in-courses--box d-flex ">

            <!-- <?php print_r($string_course_ID) ?>
            <?php print_r($courses) ?> -->

            <?php foreach ($courses as $course) : ?>
            <!-- <?php print_r($course) ?> -->
            <div class="logged-in-courses--box__item">
                <div class='logged-in-courses--img'>
                    <img src="<?php echo get_the_post_thumbnail_url($course->ID, 'medium'); ?>" alt=""
                        class="img-fluid">
                    <h3> <?php echo $course->post_title; ?> </h3>

                </div>
                <p> <?php echo get_the_excerpt( $course->ID); ?> </p>
                <p> Poziom: <?php echo get_field("courses_level", $course->ID) ?> </p>
                <p> Czas trwania kursu: <?php echo get_field("courses_time", $course->ID) ?>h </p>
                <a href="<?php echo $course->guid?>">Czytaj więcej...</a>
            </div>
            <?php endforeach; ?>


        </div>
        <?php else : ?>
        <p>Brak postów do wyświetlenia.</p>
        <?php endif; ?>





    </div>
    </div>




</section>
<!-- end visited courses -->



<?php get_footer(); ?>




<!-- 
    Jak dodać event na kliknięcie w php
    r.szarata@wisepeople.pl
 -->