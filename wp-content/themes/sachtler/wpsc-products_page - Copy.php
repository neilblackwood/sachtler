<?php
global $wp_query;
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
			<div class="wpsc_category_details span8 new-line">
				<?php if(wpsc_show_category_thumbnails()) : ?>
					<img src="<?php echo wpsc_category_image(); ?>" alt="<?php echo wpsc_category_name(); ?>" />
				<?php endif; ?>
				<?php if(wpsc_show_category_description() &&  wpsc_category_description()) : ?>
					<p><?php echo wpsc_category_description(); ?></p>
				<?php endif; ?>
			</div><!--close wpsc_category_details--><!--
		<?php endif; ?>
		<?php if(wpsc_has_pages_top()) : ?>
			<div class="wpsc_page_numbers_top">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_top-->
		<?php endif; ?>

		<?php /** start the product loop here */?>
		<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
        
        	
			
			<?php $terms = get_the_terms( wpsc_the_product_id(), 'wpsc_product_category' );?>
			
			<?php if ( $terms && ! is_wp_error( $terms ) ) {
				$categoriesstring = '';
				foreach ( $terms as $term ) {
					$categoriesstring .= $term->slug.',';
				}
				if (strpos($categoriesstring,'fluid-heads') !== false || strpos($categoriesstring,'tripods') !== false || strpos($categoriesstring,'lens-camera-accessories') !== false) {
					?>--><div class="product-category product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group span4">
                        <a class="wpsc_product_title payload" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
                        <?php if(wpsc_show_thumbnails()) :?>
                            <?php if(wpsc_the_product_thumbnail()) :
                            ?>
                                <img class="wpsc_category_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail('400','200'); ?>"/>
                            <?php endif; ?>
                        <?php endif; ?>
                            <h2 class="prodtitle entry-title">
                                <?php echo wpsc_the_product_title(); ?>
                            </h2>
                            <p><?php echo wpsc_the_product_additional_description(); ?></p>
                            <p>Find out more</p>
                        </a>
					</div><!--close default_product_display--><!--<?php
				} elseif (strpos($categoriesstring,'support-accessories') !== false || strpos($categoriesstring,'parts') !== false) {
					?>--><div class="product-category grid-view product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group span8 new-line">
                        <a class="wpsc_product_title" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
                        
                        <div class="new-line span2">
							<?php if(wpsc_show_thumbnails()) :?>
                                <?php if(wpsc_the_product_thumbnail()) :
                                ?>
                                    <img class="wpsc_category_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail('200','150'); ?>"/>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div><!--
                        --><div class="span1">
                        	<?php if (wpsc_product_sku()): echo '<span class="product-sku">'.wpsc_product_sku().'</span>'; endif; ?>
                        </div><!--
                        --><div class="span5">
                        	<h2 class="prodtitle entry-title">
                                <?php echo wpsc_the_product_title(); ?>
                            </h2>
                                <?php echo wpsc_the_product_description(); ?>
                        </div><!--
                        -->
                        </a>
					</div><!--close default_product_display--><!--<?php
				} else {
					?>--><div class="product-category product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group span4">
                        <a class="wpsc_product_title" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
                        <?php if(wpsc_show_thumbnails()) :?>
                            <?php if(wpsc_the_product_thumbnail()) :
                            ?>
                                <img class="wpsc_category_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail('400','200'); ?>"/>
                            <?php endif; ?>
                        <?php endif; ?>
                            <h2 class="prodtitle entry-title">
                                <?php echo wpsc_the_product_title(); ?>
                            </h2>
                            <p>Find out more</p>
                        </a>
					</div><!--close default_product_display--><!--<?php
				}
				
			} else {
				echo 'false';
			}?>

		<?php endwhile; 
		echo '-->'; ?>
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
<!--</div><!--close default_products_page_container-->

<div class="clear"></div>
<?php edit_post_link( __( 'Edit', 'sachtler' ), '<div class="edit-link">', '</div>' ) ?>
</article>
