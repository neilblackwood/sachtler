<?php get_header(); ?>
<article id="content" class="span12">
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sachtler' ) . '&after=</div>') ?>
<?php edit_post_link( __( 'Edit', 'sachtler' ), '<div class="edit-link">', '</div>' ) ?>
</div>
</div>
<?php comments_template( '', true ); ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>