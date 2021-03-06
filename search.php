<?php

get_header(); 

?>
<!-- start heading search -->
<section id="search-heading" class="search-heading">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-7">
                <h1 class="search-heading--heading">Wyniki wyszukiwania dla: <span class="search-for"><?php echo get_search_query(); ?></span></h1>
            </div>
        </div>
    </div>
</section>
<!-- end heading search -->

<div class="search">

    <?php if (have_posts()) : ?>
        <?php while(have_posts()) : ?>
                <?php the_post(); ?>

            <section class="search-result">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-8 col-xl-6 col-sm-12 mb-4">
                            <h2><?php echo get_the_title(); ?></h2>
                            <div>
                                <a href="<?php echo get_the_permalink(); ?>">Czytaj więcej</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php endwhile; ?>

        <div class="pagination pagination-lg justify-content-center">       
        <?php
            $big = 99999999;

            echo paginate_links([
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
            ]);
        ?>
        </div>

    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xxl-7">
                    <?php else : ?>
                        <div class="search--heading text-muted">Brak wpisów do wyświetlenia</div>    
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>