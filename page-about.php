<?php
/*
Template name: O nas
*/

$about_us_picture = get_field("about_us_picture");
$about_us_header = get_field("about_us_header");
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
<section id="about-us-picture" class="about-us-picture" 
    <?php if ($about_us_picture) : ?> style="background-image: url('<?php echo $about_us_picture; ?>') <?php endif;?>;">
    <div class="img-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 about-us-title">
                    <div class="about-us-title">
                        <?php if ($about_us_header) : ?>
                            <h1><?= $about_us_header ?></h1>
                        <?php endif; ?>
                    </div>
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

<?php get_footer(); ?>