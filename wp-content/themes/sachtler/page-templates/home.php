<?php
/**
 * Template Name: Homepage Template
 */

get_header(); ?>
<article id="content" class="span12">
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<?php the_content(); ?>
<?php edit_post_link( __( 'Edit', 'sachtler' ), '<div class="edit-link">', '</div>' ) ?>
<?php if ( is_active_sidebar('home-primary-widgets') ) { ?>
<div id="home-primary" class="bucket-widget-area"><?php dynamic_sidebar('home-primary-widgets'); ?></div>
<?php } ?>
<?php if ( is_active_sidebar('home-secondary-widgets') ) { ?>
<div id="home-secondary" class="bucket-widget-area"><?php dynamic_sidebar('home-secondary-widgets'); ?></div>
<?php } ?>




<?php if ( is_active_sidebar('home-newsticker-widgets') ) { ?>
<div id="home-newsticker" class="bucket-widget-area newsticker"><?php dynamic_sidebar('home-newsticker-widgets'); ?></div>
<?php } ?>


</div>
</div>
</article>
<?php get_footer(); ?>