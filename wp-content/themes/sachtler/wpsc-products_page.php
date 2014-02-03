<?php
global $wp_query;
//$wp_query = new WPSC_Query(array('wpsc_product_category' => 'fluid-heads'));
//$wpsc_query = new WPSC_Query(array('category_id' => 21));
//$wpsc_query = new WP_Query('post_type=wpsc-product&posts_per_page=15');

$image_width = get_option('product_image_width');
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */
?>

<?php //wpsc_output_breadcrumbs(); ?>

	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	<?php if(wpsc_display_categories()): ?>
	  <?php if(wpsc_category_grid_view()) :?>
      <?php echo "<!--"; ?>
		<?php wpsc_start_category_query(array('category_group'=> get_option('wpsc_default_category'), 'show_thumbnails'=> 1)); ?>
            --><div class="product-category span4 category-id-<?php wpsc_print_category_id(); ?> <?php wpsc_print_category_classes_section();?>">
                <a href="<?php wpsc_print_category_url();?>" class="wpsc_category_grid_item <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>">
                    <?php wpsc_print_category_image(); ?>
                    <h2><?php wpsc_print_category_name(); ?></h2>
                    <?php wpsc_print_category_description(); ?>
                    <p>FIND OUT MORE</p>
                </a>
            </div><!-- .product-category --><!--
            <?php wpsc_print_subcategory("", ""); ?>
        <?php wpsc_end_category_query(); ?>
        --> 
	  <?php else:?>
			<ul class="wpsc_categories">

				<?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
						<li>
							<?php wpsc_print_category_image(); ?>

							<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?></a>
							<?php if(wpsc_show_category_description()) :?>
								<?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>
							<?php endif;?>

							<?php wpsc_print_subcategory("<ul>", "</ul>"); ?>
						</li>
				<?php wpsc_end_category_query(); ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
<?php // */ ?>

	<?php if(wpsc_display_products()): ?>
    
    	<?php if(wpsc_is_in_category()) : ?>
        
        	<?php // Output the correct category header file ?>
			
            <?php
			$term = get_term_by('slug',get_query_var( 'wpsc_product_category' ),'wpsc_product_category');
			$parent_term = get_term($term->parent,'wpsc_product_category');
			
			$cat_header_filename = sprintf('wpsc-products_list_%1$s_header.php',$term->slug);
			$cat_parent_header_filename = sprintf('wpsc-products_list_%1$s_header.php',$parent_term->slug);
			$default_header_filename = sprintf('wpsc-products_list_%1$s_header.php','default');
			$cat_header_output_complete = false;
			if(file_exists(TEMPLATEPATH.'/'.$cat_header_filename)){
				include $cat_header_filename;
				$cat_header_output_complete = true;
			}
			if(file_exists(TEMPLATEPATH.'/'.$cat_parent_header_filename)){
				include $cat_parent_header_filename;
				$cat_header_output_complete = true;
			}
			if ($cat_header_output_complete == false) {
				include $default_header_filename;
			} ?>
            
		<?php endif; ?>
        
        <?php global $product_output, $sorted_cats, $sorted_apps; $cat_parent_slug;  ?>

		<?php /** start the product loop here */?>
        <?php wpsc_rewind_products()?>
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
        
        	<?php // Collate the products into an associative array. Like a boss. ?>
        
            <?php $terms = get_the_terms( wpsc_the_product_id(), 'wpsc_product_category' );
            $app_terms = get_the_terms( wpsc_the_product_id(), 'application' );
            $material_terms = get_the_terms( wpsc_the_product_id(), 'material' );

			if ( $terms && ! is_wp_error( $terms ) ) :
				$filename = 'wpsc-products_list';
				$default_filename = $filename.'_default.php';
				$output_complete = false;
				foreach ( $terms as $term ) {
					$cat_filename = $filename.'_'.$term->slug.'.php';

					if(file_exists(TEMPLATEPATH.'/'.$cat_filename)){
						$product_output[$term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($cat_filename);
						$output_complete = true;
						break;
					}
					$cat_parent_name = get_term($term->parent,'wpsc_product_category');
					if($cat_parent_name && ! is_wp_error( $cat_parent_name ) ) {
					    $cat_parent_slug = $cat_parent_name->slug;
						$cat_parent_filename = $filename.'_'.$cat_parent_name->slug.'.php';
						if(file_exists(TEMPLATEPATH.'/'.$cat_parent_filename)){
							$product_output[$term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($cat_parent_filename);
							$output_complete = true;
							break;
						}
					}
					if ($output_complete == false) {
						$product_output[$term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($default_filename);
					}
				}
			endif;

            if ( $app_terms && ! is_wp_error( $app_terms ) ) :
                $filename = 'wpsc-products_list';
                $default_filename = $filename.'_default.php';
                $output_complete = false;
                foreach ( $app_terms as $app_term ) {
                    if($cat_parent_slug){
                        $app_filename = $filename.'_'.$cat_parent_slug.'_'.$app_term->taxonomy.'.php';
                    } else {
                        $app_filename = $filename.'_'.$app_term->taxonomy.'.php';
                    }
                    if(file_exists(TEMPLATEPATH.'/'.$app_filename)){
                        $product_app_output[$app_term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($app_filename);
                        $output_complete = true;
                        break;
                    }
                    if ($output_complete == false) {
                        $product_app_output[$app_term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($default_filename);
                    }
                }
            endif; ?>

            <?php

            if ( $material_terms && ! is_wp_error( $material_terms ) ) :
                $filename = 'wpsc-products_list';
                $default_filename = $filename.'_default.php';
                $output_complete = false;
                foreach ( $material_terms as $material_term ) {
                    $material_filename = $filename.'_'.$material_term->taxonomy.'.php';
                    if(file_exists(TEMPLATEPATH.'/'.$material_filename)){
                        $material_app_output[$material_term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($material_filename);
                        $output_complete = true;
                        break;
                    }
                    if ($output_complete == false) {
                        $material_app_output[$material_term->term_id][get_post(wpsc_the_product_id())->menu_order] = includeToString($default_filename);
                    }
                }
            endif; ?>

		<?php endwhile;
		
		foreach($product_output as $category_id => $products_array) {
			$sorted_cats[] = get_term($category_id,'wpsc_product_category');
		}

        if($product_app_output){
            foreach($product_app_output as $term_id => $products_array) {
                $sorted_apps[] = get_term($term_id,'application');
            }
        }

        if($material_app_output){
            foreach($material_app_output as $term_id => $products_array) {
                $sorted_materials[] = get_term($term_id,'material');
            }
        }

		// Order by database values (set by drag and drop)
		
		$sorted_cats = wpsc_get_terms_category_sort_filter($sorted_cats);
        ?>
        --><div id="head-fixing" class="tab"><!--
        <?php
		
		foreach($sorted_cats as $cat) {
			
			// Output the various template parts
			
			$current_category = get_term($cat->term_id,'wpsc_product_category');
			$parent_category = get_term($current_category->parent,'wpsc_product_category');
			$cat_parent_slug = $parent_category->slug;
		
			$base_filename = 'wpsc-products_list_';
			$filename = $base_filename.$current_category->slug.'_table_header.php';
			$parent_filename = $base_filename.$parent_category->slug.'_table_header.php';
			$default_filename = $base_filename.'default_table_header.php';
			
			if(file_exists(TEMPLATEPATH.'/'.$filename)){
				include $filename;
			} elseif(file_exists(TEMPLATEPATH.'/'.$parent_filename)){
				include $parent_filename;
			} elseif(file_exists(TEMPLATEPATH.'/'.$default_filename)){
				include $default_filename;
			}
			
			ksort($product_output[$cat->term_id]);
			foreach($product_output[$cat->term_id] as $product_string){
				echo $product_string;
			}
			
			$filename = $base_filename.$current_category->slug.'_table_footer.php';
			$parent_filename = $base_filename.$parent_category->slug.'_table_footer.php';
			$default_filename = $base_filename.'default_table_footer.php';
			
			if(file_exists(TEMPLATEPATH.'/'.$filename)){
				include $filename;
			} elseif(file_exists(TEMPLATEPATH.'/'.$parent_filename)){
				include $parent_filename;
			} elseif(file_exists(TEMPLATEPATH.'/'.$default_filename)){
				include $default_filename;
			}
			
		}

        ?>
        --></div>
        <?php if($sorted_apps) { ?>
        <div id="application" class="tab"><!--
        <?php

        foreach($sorted_apps as $app) {

            // Output the various template parts
            $current_application = get_term($app->term_id,'application');
            $base_filename = 'wpsc-products_list_';
            $taxonomy = $current_application->taxonomy;

            if($cat_parent_slug){
                $filename = $base_filename.$cat_parent_slug.'_'.$taxonomy.'_table_header.php';
            } else {
                $filename = $base_filename.$taxonomy.'_table_header.php';
            }
            $default_filename = $base_filename.'default_table_header.php';

            if(file_exists(TEMPLATEPATH.'/'.$filename)){
                include $filename;
            } elseif(file_exists(TEMPLATEPATH.'/'.$default_filename)){
                include $default_filename;
            }

            ksort($product_app_output[$app->term_id]);
            foreach($product_app_output[$app->term_id] as $product_string){
                echo $product_string;
            }

            $filename = $base_filename.$current_application->taxonomy.'_table_footer.php';
            $default_filename = $base_filename.'default_table_footer.php';

            if(file_exists(TEMPLATEPATH.'/'.$filename)){
                include $filename;
            } elseif(file_exists(TEMPLATEPATH.'/'.$default_filename)){
                include $default_filename;
            }

        }

        ?>
        --></div>
        <?php } /** end application if statement here */ ?>
        <?php if($sorted_materials) { ?>
        <div id="material" class="tab"><!--
        <?php

        foreach($sorted_materials as $material) {

            // Output the various template parts
            $current_material = get_term($material->term_id,'material');
            $base_filename = 'wpsc-products_list_';
            $filename = $base_filename.$current_material->taxonomy.'_table_header.php';
            $default_filename = $base_filename.'default_table_header.php';

            if(file_exists(TEMPLATEPATH.'/'.$filename)){
                include $filename;
            } elseif(file_exists(TEMPLATEPATH.'/'.$default_filename)){
                include $default_filename;
            }

            ksort($material_app_output[$material->term_id]);
            foreach($material_app_output[$material->term_id] as $product_string){
                echo $product_string;
            }

            $filename = $base_filename.$current_material->taxonomy.'_table_footer.php';
            $default_filename = $base_filename.'default_table_footer.php';

            if(file_exists(TEMPLATEPATH.'/'.$filename)){
                include $filename;
            } elseif(file_exists(TEMPLATEPATH.'/'.$default_filename)){
                include $default_filename;
            }

        }

        ?>
        --></div>
        <?php } /** end material if statement here */ ?>

		<?php /** end the product loop here */?>

		<?php if(wpsc_product_count() == 0):?>
			<h3><?php  _e('There are no products in this group.', 'wpsc'); ?></h3>
		<?php endif ; ?>
	    <?php do_action( 'wpsc_theme_footer' ); ?>

		<?php if(wpsc_has_pages_bottom()) : ?>
			<div class="wpsc_page_numbers_bottom">
				<?php wpsc_pagination(); ?>
			<!--</div><!--close wpsc_page_numbers_bottom-->
		<?php endif; ?>
	<?php endif; ?>
</div><!--close default_products_page_container-->

<div class="clear"></div>
<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
</article>
