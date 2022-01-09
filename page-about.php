<?php
/*
Template name: O nas
*/

$about_us_picture = get_field("about_us_picture");
$about_us_header = get_field("about_us_header");
$learn_more_about_us = get_field("learn_more_about_us");
$about_us_heading = get_field("title_about_us");
$about_us_desc = get_field("desc_about_us");
$aboutUs = get_posts([
    "numberposts" => -1,
    "post_type" => "about"
]);
$about_us_see_courses = get_field("about_us_see_courses");
$about_us_btn_see_courses = get_field("about_us_btn_see_courses");


$title_clients_opinion = get_field("title_clients_opinion");
$testimonials_avatar = get_field("testimonials_avatar");
$language_testimonials = get_field("language_testimonials");
$testimonials = get_posts([
    "numberposts" => -1,
    "post_type" => "testimonials"
]);

?>

<?php get_header(); ?>

<!-- start about us picture -->
<section id="about-us-picture" class="about-us-picture" style="background-image: url('<?= $about_us_picture ?>')";>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 about-us-title">
                <div class="about-us-title">
                    <?php if ($about_us_header) : ?>
                        <h1><?= $about_us_header ?></h1>
                    <?php endif; ?>
                    <?php if ($learn_more_about_us) : ?>
                        <a href="<?= $learn_more_about_us["url"] ?>" target="<?= $learn_more_about_us["target"] ?>" class="btn btn-lg btn-about-us"><?= $learn_more_about_us["title"] ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end about us picture -->

<!-- Start about us -->
<section id="about-us-desc" class="about-us">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($about_us_heading) : ?>
                    <h2 class="about-us--heading"><?= $about_us_heading ?></h2>
                <?php endif; ?>

                <?php if ($about_us_desc) : ?>
                    <p class="about-us--description"><?= $about_us_desc ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">

            <?php foreach ($aboutUs as $about) : ?>
                <div class="col-xxl-4 col-xl-3 col-sm-6 about-us--item-wrapper">
                    <div class="about-us--item">
                        <div class="about-us--item-icon"><i class="<?= get_field("icon", $about->ID) ?>"></i></div>
                        <h3 class="about-us--item-heading"><?= $about->post_title; ?></h3>
                        <p class="about-us--item-description"><?= $about->post_content; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($about_us_see_courses || $about_us_btn_see_courses) : ?>
                <div class="col-xxl-4 col-xl-3 col-sm-6 about-us--item-wrapper">
                    <div class="about-us--item about-us--item__contact">
                        <?php if ($about_us_see_courses) : ?>
                            <h3 class="about-us--item-heading"><?= $about_us_see_courses ?></h3>
                        <?php endif; ?>

                        <?php if ($about_us_btn_see_courses) : ?>
                            <div>
                                <a href="<?= $about_us_btn_see_courses["url"] ?>" target="<?= $about_us_btn_see_courses["target"] ?>" class="btn btn-outline-light btn-lg"><?= $about_us_btn_see_courses["title"] ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- End about us  -->

<!-- Start testimonials -->
<section id="opinie" class="testimonials">
    <div class="container">
        <div class="row justify-content-center opinions">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($title_clients_opinion) : ?>
                    <h2 class="functions--heading"><?= $title_clients_opinion ?></h2>
                <?php endif; ?>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-1">
                <div class="testimonials--slider-nav"><i class="fas fa-chevron-left fa-2x"></i></div>
            </div>
            <div class="col-10 col-xxl-8">
                <div class="testimonials--slider">
                    <?php foreach ($testimonials as $testimonial) : ?>
                        <div class="testimonials--slider-item">
                            <div class="testimonials--slider-item-person">
                                <div><img src="<?= get_field("testimonials_avatar", $testimonial->ID) ?>"></div>
                                <div class="testimonials--user-opinions">
                                    <span><?= $testimonial->post_title; ?></span>
                                </div>
                                <div class="testimonials--slider-item-text justify-content-center"><?= $testimonial->post_content; ?></div>
                            </div>
                            Kurs: <strong><?= get_field("language_testimonials", $testimonial->ID) ?></strong>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="col-1">
                <div class="testimonials--slider-nav"><i class="fas fa-chevron-right fa-2x"></i></div>
            </div>
        </div>
    </div>
</section>
<!-- End testimonials -->

<?php get_footer(); ?>