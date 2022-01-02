<?php get_header(); ?>

 <!-- Start start -->
 <section class="start start__subpage">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="start--heading"><?php the_title(); ?></h1>
                    <div class="start--breadcrumbs">
                        <a href="<?php echo get_home_url(); ?>">Start</a>
                        <i class="fas fa-chevron-right"></i>
                        <span><?php the_title(); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End start -->

    <!-- Start about-content -->
    <section class="about-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-content -->


<?php get_footer(); ?>