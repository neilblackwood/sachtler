<div class="clear"></div>
</div><!-- .wrapper -->
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


  
<div id="intro-text">
    <div class="row">
        <div class="wrapper">
            <div class="span12">
                <?php dynamic_sidebar('footer-widget'); ?>
                <div id="copyright">
                <p><?php echo sprintf( __( '%1$s %2$s %3$s. All Rights Reserved.', 'blankslate' ), '&copy;', date('Y'), esc_html(get_bloginfo('name')) ); echo sprintf( __( ' Site by %1$s', 'blankslate' ), '<a href="http://designmotive.co.uk/">Design Motive</a>' ); ?></p>
            </div><!-- .span12 -->
        </div><!-- .wrapper -->
    </div><!-- .row -->
</div><!-- #intro-text -->    
</footer>
<?php wp_footer(); ?>
</body>
</html>