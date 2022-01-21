<?php
/*
Template name: Logowanie
*/

$login_img = get_field('login_img');

get_header();

?>

<?php if (!is_user_logged_in()) : ?>
<section id="login" class="login login-left">
    <div class="container">
        <div class="row">
            <div class="col-md-5 login-right-box">
                <h1 class="login--heading">Zaloguj się</h1>
                <div class="login-form">
                    <div class="show-login-form">
                        <?php
                        $args = array(
                            'redirect' => '/work-on/moje-konto',
                            'label_username' => __( 'Login' ),
                            'remember' => false
                        ); ?>
                        <?php wp_login_form( $args ); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-7 login-left-box" style="background-image: url('<?= $login_img; ?>')" ></div>
        </div>
    </div>
</section>
    
    <?php else : ?>
    
    <section id="login-heading" class="login-heading">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-7">      
                    <h1 class="login-heading--heading">Jesteś zalogowany</h1>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php get_footer(); ?>