<?php

/*
Template name: Informacje 
*/

get_header(); ?>

 <!-- Start start -->
 <section class="info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="info--heading"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>
<!-- End start -->

    <!-- Start about-content -->
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="info--description">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End about-content -->


<?php get_footer(); ?>