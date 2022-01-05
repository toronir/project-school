<?php



$time = get_field('reading_time');
$tags = get_the_tags();
print_r($tags);
$authorId = $post->post_author;

        
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

if ($_POST['save'] == 'save_course') {
    $string_saved_courses_ID = get_field('user_saved_courses', $logged_in_user_data->ID);
    $array_saved_courses_ID = explode(",", $string_saved_courses_ID);
    
    array_unshift($array_saved_courses_ID, $current_post_ID);
    
    $new_string_saved_courses_ID = implode(",", $array_saved_courses_ID);

    update_field('user_saved_courses', '', $logged_in_user_data->ID);
    update_field('user_saved_courses', $new_string_saved_courses_ID, $logged_in_user_data->ID);
   
}


get_header();
?>

<section class="news-single--start start__subpage">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="start--heading"><?php the_title(); ?></h1>
                <div class="start--breadcrumbs">
                    <a href="<?php echo get_home_url(); ?>">Start</a>
                    <i class="fas fa-chevron-right"></i>
                    <span><?php the_title(); ?></span>
                    <form method="POST">
                        <input type="hidden" name='save' value='save_course'>
                        <button type='submit'>Zapisz kurs</button>
                        <!-- <p>zapisane: <?php echo get_field('user_saved_courses', $logged_in_user_data->ID);?></p>
                        <p>odwiedzone: <?php echo get_field('user_visited_courses', $logged_in_user_data->ID);?></p> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="news-single">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-muted">
                <span><i class="fas fa-user"></i> Autor: <a href="<?php echo get_author_posts_url($authorId); ?>">
                        <?php $authorName = the_author_meta($field = 'user_nickname', $user_id = $authorId);?>
                    </a></span>
                <span><i class="ms-2 fas fa-clock"></i> Reading time:<?php echo $time?></span>
                <span><i class="ms-2 fas fa-tags"></i> Tagi:
                    <?php if ($tags) :?>
                    <?php foreach ($tags as $tag) : ?>

                    <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>

                    <?php endforeach; ?>
                </span>
                <?php endif ;?>
                <hr>
            </div>
            <div class="col-lg-8">
                <div class='news-single--img'>
                    <h2><?php echo get_the_title(); ?></h2>
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="">
                </div>

                <p>
                    <?php the_content(); ?>
                </p>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>