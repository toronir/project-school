<?php



$time = get_field('reading_time');
$tags = get_the_tags();
$authorId = $post->post_author;
$mode = get_field('chose_course_type');

        
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

get_header();
?>

<section class="news-single">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 shortcut gold-border-right px-5">
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="">
            </div>

            <div class="col-lg-7">
                <div class='d-flex justify-content-between align-items-center mx-5' style="height: 100%;">
                    <h1><?php echo get_the_title(); ?></h1>

                    <?php if (!$added_course) :?>
                    <form method="POST">
                        <input type="hidden" name='save' value='save_course'>
                        <button class='btn-gold-primary' type='submit'><i class="far fa-star"></i> Zapisz kurs</button>
                    </form>
                    <?php else : ?>
                    <form method="POST" class='form-slider d-flex gap-4'>
                        <input type="hidden" name='delete' value='delete_course'>
                        <div class='btn-gold-secondary d-inline'><i class="fas fa-star"></i> Zapisano!</div>
                        <button type='submit' class='d-inline'>
                            <span>| Usuń</span></button>
                    </form>
                    <?php endif; ?>

                </div>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 shortcut gold-border-right px-5">
                <p> Poziom: <?php echo get_field("courses_level", get_the_ID()) ?></p>
                <p> Czas trwania kursu: <?php echo get_field("courses_time", get_the_ID()) ?>h</p>
                <p> Tryb: <?php echo $mode ?></p>
                <p> Lektor: <?php echo get_field("lector_name", get_the_ID()) ?></p>
            </div>
            <div class="col-lg-7 px-5">
                <p><?php echo the_content(); ?> </p>
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>