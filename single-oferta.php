<?php



$time = get_field('reading_time');
$tags = get_the_tags();
$authorId = $post->post_author;
$mode = get_field('chose_course_type');
$course_ID = get_the_ID();

        
// aktualizowanie ostatnio oglądanych
$logged_in_user_data = wp_get_current_user();

$string_seen_courses_ID = get_field('user_visited_courses', $logged_in_user_data->ID);
$array_seen_courses_ID = explode(",", $string_seen_courses_ID);

while ( have_posts() ) : the_post();
$current_post_ID = get_the_ID(); 
endwhile;

// + usuwanie ponownie odwiedzonych
if (in_array($current_post_ID, $array_seen_courses_ID)) {
    $ID_to_delete = array_search($current_post_ID, $array_seen_courses_ID);
        unset($array_seen_courses_ID[$ID_to_delete]);
}
array_unshift($array_seen_courses_ID, $current_post_ID);
//
$new_string_seen_courses_ID = implode(",", $array_seen_courses_ID);
update_field('user_visited_courses', $new_string_seen_courses_ID, $logged_in_user_data->ID);
//


// aktualizowanie zapisanych kursów - na kliknięcie

$string_saved_courses_ID = get_field('user_saved_courses', $logged_in_user_data->ID);
$array_saved_courses_ID = explode(",", $string_saved_courses_ID);

if ($_POST['save'] == 'save_course') {
    
    
    if (!(in_array($current_post_ID, $array_saved_courses_ID))) {
        
    array_unshift($array_saved_courses_ID, $current_post_ID);
    $new_string_saved_courses_ID = implode(",", $array_saved_courses_ID);

    update_field('user_saved_courses', $new_string_saved_courses_ID, $logged_in_user_data->ID);
    }
};

// usuwanie kursu z zapisanych - na kliknięcie

if ($_POST['delete'] == 'delete_course') {
    if (in_array($current_post_ID, $array_saved_courses_ID)) {
    $ID_to_delete = array_search($current_post_ID, $array_saved_courses_ID);
    unset($array_saved_courses_ID[$ID_to_delete]);

    $new_string_saved_courses_ID = implode(",", $array_saved_courses_ID);
    update_field('user_saved_courses', $new_string_saved_courses_ID, $logged_in_user_data->ID);
    }
};

if (in_array($current_post_ID, $array_saved_courses_ID)) {
    $added_course = true;
} else {
    $added_course = false;
};

// pobieranie lektora

$teachersArgs = [
    'post_type' => 'teachers',
    'post_status' => 'publish'
];

$teachers_query = get_posts($teachersArgs);


get_header();
?>

<section class="news-single">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-7 px-4">
                <div class="d-flex align-items-center">
                    <div class="img"
                        style='background-image: url("<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>");'>
                    </div>
                    <h1 class='mx-5 my-0'><?php echo get_the_title(); ?></h1>

                    <div class='flex-grow-1'></div>
                    <?php if (is_user_logged_in()) : ?>
                    <?php if (!$added_course) :?>
                    <form method="POST">
                        <input type="hidden" name='save' value='save_course'>
                        <button class='btn-gold-primary save-button' type='submit'><i class="far fa-star"></i> Zapisz
                            kurs</button>
                    </form>
                    <?php else : ?>
                    <div style='overflow: hidden'>
                        <form method="POST" class='form-slider d-flex gap-4'>
                            <input type="hidden" name='delete' value='delete_course'>
                            <div class='btn-gold-secondary d-inline'><i class="fas fa-star"></i> Zapisano!</div>
                            <button type='submit' class='d-inline'>
                                <span>| Usuń</span></button>
                        </form>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
                <hr>
                <div class='text-center'>
                    <span>Poziom:
                        <strong><?php echo get_field('courses_level'); ?></strong></span>
                    <span class='mx-4'>Tryb: <strong><?php echo get_field('chose_course_type'); ?></strong>
                    </span>
                    <span> Czas trwania kursu:
                        <strong><?php echo get_field("courses_time", get_the_ID()) ?>h</strong></span>
                </div>
                <hr>
                <p><?php echo the_content(); ?> </p>
            </div>
            <div class="col-12 col-xl-3 d-flex flex-column justify-content-center teacher-col">
                <h2>Prowadzący</h2>
                <?php foreach ($teachers_query as $teacher) : ?>
                <?php if ($teacher->post_title == get_field("lector_name", $course_ID)) : ?>
                <?php $lector_ID = $teacher->ID ?>
                <img style='margin: 3rem 0' src="<?php echo get_field('teacher_img', $lector_ID) ?>" alt="">
                <div class="text-center">
                    <p> <?php echo get_field('teacher_name', $lector_ID) ?></p>
                    <p> Certyfikaty: <?php echo get_field('teacher_cert', $lector_ID) ?></p>
                    <p> Mail: <?php echo get_field('teacher_email', $lector_ID) ?></p>
                </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>


        <!-- test end -->
        <!-- <div class="row justify-content-center">
            <div class="col-lg-3 shortcut gold-border-right px-5">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="">
            </div>

            <div class="col-lg-7">
                <div class='d-flex justify-content-between align-items-center mx-5' style="height: 100%;">
                    <h1><?php echo get_the_title(); ?></h1>
                    <?php if (is_user_logged_in()) : ?>
                    <?php if (!$added_course) :?>
                    <form method="POST">
                        <input type="hidden" name='save' value='save_course'>
                        <button class='btn-gold-primary save-button' type='submit'><i class="far fa-star"></i> Zapisz
                            kurs</button>
                    </form>
                    <?php else : ?>
                    <div style='overflow: hidden'>
                        <form method="POST" class='form-slider d-flex gap-4'>
                            <input type="hidden" name='delete' value='delete_course'>
                            <div class='btn-gold-secondary d-inline'><i class="fas fa-star"></i> Zapisano!</div>
                            <button type='submit' class='d-inline'>
                                <span>| Usuń</span></button>
                        </form>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 shortcut gold-border-right px-5">
                <p> Poziom: <?php echo get_field("courses_level", get_the_ID()) ?></p>
                <p> Czas trwania kursu: <?php echo get_field("courses_time", get_the_ID()) ?>h</p>
                <p> Tryb: <?php echo $mode ?></p>
                <?php foreach ($teachers_query as $teacher) : ?>
                <?php if ($teacher->post_title == get_field("lector_name", $course_ID)) : ?>
                <?php $lector_ID = $teacher->ID ?>
                <img src="<?php echo get_field('teacher_img', $lector_ID) ?>" alt="">
                <p> Lektor: <?php echo get_field('teacher_name', $lector_ID) ?></p>
                <p> Certyfikaty: <?php echo get_field('teacher_cert', $lector_ID) ?></p>
                <p> Mail: <?php echo get_field('teacher_email', $lector_ID) ?></p>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-7 px-5">
                <p><?php echo the_content(); ?> </p>
            </div>
        </div>
    </div> -->
</section>


<?php get_footer(); ?>