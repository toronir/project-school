<?php
/*
Template name: Lektorzy
*/

$teachers_heading = get_field("teachers_heading");
$teachers_desc = get_field("teachers_desc");
$teachers = get_posts([
    "numberposts" => -1,
    "post_type" => "teachers"
]);
// $teacher_ experience = get_field("teacher_ experience");
// $teacher_cert = get_field("teacher_cert");
// $teacher_language = get_field("teacher_language");
// $teacher_email = get_field("teacher_email");

?>
<?php get_header(); ?>

<!-- start description about teachers -->
<section id="teachers" class="teachers">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-7">
                <?php if ($teachers_heading) : ?>
                    <h2 class="teachers--heading"><?= $teachers_heading; ?></h2>
                <?php endif; ?>

                <?php if ($teachers_desc) : ?>
                    <p class="teachers--description"><?= $teachers_desc; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- end description about teachers -->

<!-- Start teachers list -->
<section id="teachers-list" class="teachers-list">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($teachers as $teacher) : ?>
                <div class="col-xxl-4 col-xl-6 col-sm-12 mb-4">
                    <img src="<?= get_field("teacher_img", $teacher->ID) ?>">
                </div>
                <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4">
                    <div><h3><?= $teacher->post_title; ?></h3></div>
                    <div><?= $teacher->post_content; ?></div>
                    <div><strong><?= get_field("teacher_experience", $teacher->ID) ?></strong></div>
                    <div><strong><?= get_field("teacher_cert", $teacher->ID) ?></strong></div>
                    <div><?= get_field("teacher_language", $teacher->ID) ?></div>
                    <div><p><?= get_field("teacher_email", $teacher->ID) ?></p></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- End teachers list -->

<?php get_footer(); ?>

