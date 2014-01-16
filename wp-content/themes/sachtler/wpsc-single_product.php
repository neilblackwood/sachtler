<?php
	// Setup globals
	// @todo: Get these out of template
	global $wp_query;

	// Setup image width and height variables
	// @todo: Investigate if these are still needed here
	$image_width  = get_option( 'single_view_image_width' );
	$image_height = get_option( 'single_view_image_height' );
?>

	<?php
		// Breadcrumbs
		//wpsc_output_breadcrumbs();

		// Plugin hook for adding things to the top of the products page, like the live search
		do_action( 'wpsc_top_of_products_page' );
	?>

	<?php
		/**
		 * Start the product loop here.
		 * This is single products view, so there should be only one
		 */

			while ( wpsc_have_products() ) : wpsc_the_product();
			
						// PERFORM STEPS BASED ON CATEGORY ?>
						
						<?php $terms = get_the_terms( $post->ID, 'wpsc_product_category' );
						if ( $terms && ! is_wp_error( $terms ) ) :
							$filename = 'wpsc-single_product';
							$default_filename = $filename.'_default.php';
							$output_complete = false;
							foreach ( $terms as $term ) {
								$cat_filename = $filename.'_'.$term->slug.'.php';
								if(file_exists(TEMPLATEPATH.'/'.$cat_filename)){
									include $cat_filename;
									$output_complete = true;
									break;
								}
							}
							if ($output_complete == false) {
								include $default_filename;
							}
						endif; 
					
			endwhile;

do_action( 'wpsc_theme_footer' ); ?>

