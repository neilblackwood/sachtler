<?php
$i=1;

 get_header(); ?>
<article id="content" class="span12 search">
	<?php if ( have_posts() ) : ?>
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'blankslate' ), '<span>' . get_search_query()  . '</span>' ); ?></h1>
		<?php get_template_part( 'nav', 'above' ); 
		
		//array to hold the sorted posts		
		$resArrList = array();
		?>
		
		<?php while ( have_posts() ) : the_post() ?>
			<?php if (get_post_type() != 'content') $resArrList[get_post_type()][] .= get_the_ID();?>
		<?php endwhile; ?>
		
		<?php	
		echo '<!--';
		//use this array to create alternative text for each content type
		$contentTypes = array(	'page'=>'page',
								'wpsc-product'=>'product',
								);
		
		foreach ($resArrList as $k => $v1) {
		
			echo '--><h1 class="section-title">'.$contentTypes[$k].'</h1><!--';
			$i=1;
		    foreach ($v1 as $v2) {		     
		        $post = get_post($v2);
		       	setup_postdata( $post );
				get_template_part( 'entry' );
				$i++;
				wp_reset_postdata();
		    }
		}
		?>

		<?php get_template_part( 'nav', 'below' ); ?>
	<?php else : ?>
		<div id="post-0" class="post no-results not-found">
			<h2 class="entry-title"><?php _e( 'Nothing Found', 'blankslate' ) ?></h2>
			<div class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>
</article><div class="clear"></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>