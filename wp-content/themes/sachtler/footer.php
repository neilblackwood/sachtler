<div class="clear"></div>
</div><!-- .wrapper -->
<?php if(is_front_page()){?>
<div id="intro-text">
    <div class="row">
        <div class="wrapper">
            <div class="span12">
                <?php global $sitepress; ?>
                <?php dynamic_sidebar('footer-widget-'.$sitepress->get_current_language()); ?>
            </div><!-- .span12 -->
        </div><!-- .wrapper -->
    </div><!-- .row -->
</div><!-- #intro-text -->
<div class="clear"></div>
<?php } ?>
</div><!-- #page-content -->
<footer>
<div id="facebook-feed">
	<div class="row">
        <div class="wrapper">
            <div class="span12">
                <?php echo get_facebook_feed('span7'); ?>
                <?php //echo do_shortcode('[recent-facebook-posts number=2 likes=0 comments=0 excerpt_length=300]'); ?>
            </div><!-- .span12 -->
        </div><!-- .wrapper -->
	</div><!-- .row -->
</div><!-- #facebook-feed -->  

<div id="footer-menu">
    <div class="row">
        <div class="wrapper">
            <div class="span12">
                <div id="footer-primary-menu" class="menu span2">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'walker' => new Sachtler_Walker, 'items_wrap' => '<ul id="%1$s" class="%2$s"><li>'.get_the_title(93).'</li><!--%3$s--></ul>', 'container' => false, ) ); ?>
                </div><!-- #primary-menu -->
                <div id="footer-secondary-menu" class="menu span2">
                    <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'walker' => new Sachtler_Walker, 'items_wrap' => '<ul id="%1$s" class="%2$s"><li>'.get_the_title(106).'</li><!--%3$s--></ul>', 'container' => false, ) ); ?>
                </div><!-- #secondary-menu -->
                <div id="footer-language" class="menu span2 right">
                    <?php dynamic_sidebar('footer-language-area'); ?>
                    <?php //wp_nav_menu( array( 'theme_location' => 'footer-widget-menu', 'walker' => new Sachtler_Walker, 'items_wrap' => '<ul id="%1$s" class="%2$s"><li>'.get_the_title(106).'</li><!--%3$s--></ul>', 'container' => false, ) ); ?>
                </div><!-- #footer-language-area -->
            </div><!-- .span12 -->
        </div><!-- .wrapper -->
    </div><!-- .row -->
    <div class="row">
        <div class="wrapper">
            <div class="span12">
                <div id="copyright">
                <p><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'blankslate' ), '&copy;', date('Y'), esc_html(get_bloginfo('name')) ); echo sprintf( __( ' Site by %1$s', 'blankslate' ), '<a href="http://designmotive.co.uk/">Design Motive</a>' ); ?></p>
                </div>
            </div><!-- .span12 -->
        </div><!-- .wrapper -->
    </div><!-- .row -->
</div><!-- #footer-menu -->


</footer>
<?php wp_footer(); ?>
</body>
</html>