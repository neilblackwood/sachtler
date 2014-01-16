<?php

// Get / set variables

$meta = get_post_meta( get_the_id());
$feature_author = ($meta['_feature_author'][0] ? sprintf('<h2 class="feature-author">%1$s</h2>',$meta['_feature_author'][0]) : '');
$feature_occupation = ($meta['_feature_occupation'][0] ? sprintf('<h2 class="feature-author-occupation">%1$s</h2>',$meta['_feature_occupation'][0]) : '');
$feature_main_quote_author = ($meta['_feature_main_quote_author'][0] ? sprintf('<span class="feature-quote-author">%1$s</span>',$meta['_feature_main_quote_author'][0]) : '');
$feature_main_quote = ($meta['_feature_main_quote'][0] ? sprintf('<div class="feature-quote sep"><hr>%1$s%2$s<hr></div>',wpautop($meta['_feature_main_quote'][0]),$feature_main_quote_author) : '<hr>');
$feature_equipment = ($meta['_feature_equipment'][0] ? sprintf('<div class="feature-equipment"><h3>Equipment</h3>%1$s</div>',wpautop($meta['_feature_equipment'][0])) : '');
$feature_supporting_copy = ($meta['_feature_supporting_copy'][0] ? sprintf('<div class="feature-supporting-copy">%1$s</div>',wpautop($meta['_feature_supporting_copy'][0])) : '');

get_header(); ?>
<article id="content" class="span12">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="entry-content">
<?php if ( has_post_thumbnail() ) the_post_thumbnail();?>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="sep">
	<div id="feature-author-col" class="span4">
    	<?php echo $feature_author; ?>
        <?php echo $feature_occupation; ?>
    </div><!-- #feature-author-col --><!--
    --><div id="feature-content-col" class="span8">
    	<?php the_content(); ?>
    </div><!-- #feature-content-col -->
</div>
<div class="sep">
	<h2>Get more impressions</h2>
    <!--<?php $query = new WP_Query( array( 'post_type' => array('feature'), 'posts_per_page' => 12,'orderby' => 'date', 'order' => 'ASC', 'post__not_in' => array(get_the_id())));
	$classes = array('span3','new-line','feature-summary');
	while ( $query->have_posts() ) : $query->the_post();?>
		--><div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
		<a href="<?php the_permalink(); ?>" title="<?php printf( __('Read %s', 'blankslate'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
		<div class="entry-summary">
		<?php the_post_thumbnail('full'); ?>
		<div class="summary"><?php the_excerpt( sprintf(__( 'continue reading %s', 'blankslate' ), '<span class="meta-nav">&rarr;</span>' )  ); ?></div>
		</div> 
		</a>
		</div><!-- 
		<?php $classes[1] = '';
	endwhile;
	wp_reset_postdata();?>
--></div>
<?php echo $feature_main_quote; ?>
<div class="sep">
	<div id="feature-equipment-col" class="span4 new-line">
        <?php echo $feature_equipment; ?>
    </div><!-- #feature-author-col --><!--
    --><div id="feature-supporting-copy-col" class="span8">
    	<?php echo $feature_supporting_copy; ?>
    </div><!-- #feature-content-col -->
</div>
</div>
<?php endwhile; endif; ?>
</article>
<?php get_footer(); ?>