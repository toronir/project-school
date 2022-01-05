<?php





$time = get_field('reading_time');
$tags = get_the_tags();
print_r($tags);
$authorId = $post->post_author;

        
// aktualizowanie ostatnio oglądanych
$string_seen_courses_ID = get_field('user', 'user_1');
$array_seen_courses_ID = explode(",", $string_seen_courses_ID);

while ( have_posts() ) : the_post();
$current_post_ID = get_the_ID(); 
endwhile;

array_unshift($array_seen_courses_ID, $current_post_ID);

$new_string_seen_courses_ID = implode(",", $array_seen_courses_ID);
update_field('user', $new_string_seen_courses_ID, 'user_1');
//



get_header();
?>

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
                <h2><?php echo get_the_title(); ?></h2>

                <p>
                    <?php the_content(); ?>
                </p>

                <img src="./images/hero.jpg" alt="" class="img-fluid">


            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>