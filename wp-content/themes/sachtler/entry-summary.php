<?php $terms = get_the_terms(the_ID(),array('feature_cat','category'));
global $i;

foreach($terms as $term){
	$classes[] = $term->slug;
}
$classes[] = 'span3';
$classes[] = 'visible';
if(($i - 1) %4 == 0) { $classes[] = 'new-line'; }?>
--><div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
<div class="entry-summary">
<a href="<?php the_permalink(); ?>" title="<?php printf( __('Read %s', 'blankslate'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
<?php the_post_thumbnail(); ?>
</a>
<h2 class="prodtitle entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Read %s', 'blankslate'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
<?php printf( __('Read %s', 'blankslate'), the_title_attribute('echo=0') ); ?></a></h2>
<?php the_excerpt( sprintf(__( 'continue reading %s', 'blankslate' ), '<span class="meta-nav">&rarr;</span>' )  ); ?>
<?php if ( is_user_logged_in() ) echo '<a class="post-edit-link" href="'.get_edit_post_link( get_the_ID() ).'">Edit</a>'; ?>
</div> 

</div><!-- 