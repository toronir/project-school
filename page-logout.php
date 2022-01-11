<?php
/*
Template name: Wyloguj
*/

$logout_img = get_field('logout_img');

// wp_loginout( , false);
echo wp_logout_url(home_url());

get_header();

?>

<section id="logout" class="logout">
    <div class="container">
        <div class="row">
            <div class="col-md-8 logout-left-box" style="background-image: url('<?= $logout_img; ?>')"></div>
            <div class="col-md-4 logout-right-box">
                <h1 class="logout--heading">Czas na przerwę!</h1>
                <div class="logout--btn"><a href="<?php echo wp_logout_url( home_url()); ?>"
                        class="btn btn-warning">Wyloguj się</a></div>
                <div class="logout-form">
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>