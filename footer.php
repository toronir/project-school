<?php
$linkI = get_theme_mod('linkI');
$linkF = get_theme_mod('linkF');
$linkL = get_theme_mod('linkL');
?>



<!-- Start footer -->
<footer class="footer">
    <div class="container">

        <div class="row">
            <div class="col">
                <hr class="footer--line">
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <nav class="footer--menu">
                <?php echo wp_nav_menu([
                            'theme_location' => 'footer_nav_1'
                        ]); ?>
                </nav>
            </div>
            
            <div class="col-md-4">
                <div class="footer--social">
                <?php if($linkF) : ?>
                    <a href="<?php echo $linkF?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if($linkI) : ?>
                        <a href="<?php echo $linkI?>" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if($linkL) : ?>
                        <a href="<?php echo $linkL?>" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row footer--bottom">
            <div class="col-sm-6">
                &copy; <?php echo get_bloginfo('title') . ' ' . date('Y'); ?>
            </div>
            <div class="col-sm-6">
                wykonanie: work-on 6
            </div>
        </div>
    </div>
</footer>
<!-- End footer -->



<?php wp_footer(); ?>

</body>

</html>