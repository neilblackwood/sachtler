<?php 
$GLOBALS['comparison'];
?>
<?php get_header(); ?>
<article id="content" class="span12">
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
	<?php get_template_part('comparison','results'); ?>
</div>
</div>
<?php comments_template( '', true ); ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>