<?php
/*
Template name: Logowanie
*/

get_header();

?>

<h1>Logowanie</h1>

<!-- <?php
    if (!is_user_logged_in()) {
        wp_login_form();
    } else {
        echo "Jesteś zalogowany";
    }
?> -->

<?php if (!is_user_logged_in()) : ?>
    <?php wp_login_form(); ?>
    
    <?php else : ?>
    Jesteś zalogowany
<?php endif ?>

<?php get_footer(); ?>