                    <?php global $wpsc_cart; ?>
					
					<?php // GET THE TITLE AND TAGLINE ?>
                    
                    <div id="product_title_col" class="span3 new-line">
                    	<h1 class="entry-title"><?php the_title(); ?></h1>
                    	<span class="entry-tagline"><?php echo get_post_meta( get_the_id(), '_tag_line', true );?></span>
                    </div><!--close #product_title_col--><!--
                    
                    <?php // GET THE SLIDESHOW ?>
                    
                    --><div id="product_gallery_col" class="span6">
                    	<?php echo get_images_for_product(get_the_id()); ?>
                    </div><!--close #product_gallery_col--><!--
                    
                    <?php // CALL TO ACTIONS ?>
                    
                    --><div class="product_c2a_col span3 valign_bottom">
                    
                    	<?php if(wpsc_product_sku( wpsc_the_product_id() )) printf('<span class="%1$s">%2$s</span><span class="%3$s">%4$s</span>', 'product-sku-label','Order code','product-sku',wpsc_product_sku( wpsc_the_product_id() )); ?>
                        
                    	<form class="product_form" enctype="multipart/form-data" action="<?php echo esc_url( wpsc_this_page_url() ); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
							<?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
                            
                            
							<div class="wpsc_product_price">
								<?php wpsc_the_product_price_display(array('price_text'=>__( '%s', 'wpsc' ))); ?>
                                 <!-- multi currency code -->
                                <?php if(wpsc_product_has_multicurrency()) : ?>
                                    <?php echo wpsc_display_product_multicurrency(); ?>
                                <?php endif; ?>
                                <?php $wpsc_cart->get_tax_rate(); ?>
                                <?php printf('<span>inc VAT: %1$s%2$s</span>',$wpsc_cart->tax_percentage,'%'); ?>
							</div><!--close wpsc_product_price-->

							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id" />
							<?php if( wpsc_product_is_customisable() ) : ?>
								<input type="hidden" value="true" name="is_customisable"/>
							<?php endif; ?>

							<?php
							/**
							 * Cart Options
							 */
							?>
							
							<?php if ( is_active_sidebar('products-c2a-widgets') ) dynamic_sidebar('products-c2a-widgets'); ?>

							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
                                <div class="wpsc_buy_button_container">
                                    <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
                                        <?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
                                        <input class="red-button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?>" onclick="return gotoexternallink('<?php echo esc_url( $action ); ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
                                    <?php else: ?>
                                    	<input class="red-button" type="submit" value="<?php _e('Add To Cart', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
                                    <?php endif; ?>
                                </div><!--close wpsc_buy_button_container-->
							<?php endif ; ?>
							<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
						</form><!--close product_form-->
                    
                    </div><!--close #product_c2a_col-->
                </article>

				<div class="span12 grad">
                
                	<?php // PRODUCT DESCRIPTION ?>
                
					<div class="product-row">
						<div id="product-compare-row" class="span12">
						
							<ul id="product-tabs-menu" class="tabify"><!--
								--><li><a class="button grey-button add-to-compare"  data-id="<?php echo wpsc_the_product_id(); ?>" data-category="<?php echo wpsc_the_product_id(); ?>" href="#">Add to comparison list </a></li><!--
								--><li><a class="button grey-button spare-prts" href="#">Spare parts</a></li><!--
								--><li><a class="button grey-button manuals" href="#">Manuals</a></li><!--
							--></ul><!-- #product-tabs-menu -->
							<div id="compare-list-overview">
								<p>You have reached your limit of 2 items per compare. Please delete a product before you add this item to the compare list.</p>
								<div id="product-overview-list">
									<?php 
									$cookieName = 'fluid-heads';//$_GET['ct'];
									// pedestals, fluid-heads
									$json = $_COOKIE[$cookieName.'-compare'];
									$dataCookie = str_replace('null,','',$json);
									$obj = explode(',',$dataCookie);
					
									if($obj) {
										$args = array(
										   'post_type' => 'wpsc-product',
										   'post__in'      => $obj
										);
										$query = new WP_Query( $args );
									}
									// The Loop
									while ( $row = $query->have_posts() ) {
										$query->the_post();
										get_template_part('wpsc-products_list_from_cookie');
									}
									?>								
								</div>
							</div>
							
							<p>
								You've selected 
								<span>
									<span class="total-comp-items active"></span>
									<span> fluid heads.<br/>
										<a href="#" class="show-comparison-list-bt" data-id="<?php echo wpsc_the_product_id(); ?>" data-category="<?php echo wpsc_the_product_id(); ?>" >Show comparison </a>
									</span>
								</span>
							</p>
							
						</div><!-- 
				--><div id="product_desc_col" class="span4 new-line">
                    	<?php do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post); ?>
                        <div class="product_description">
                            <?php echo wpsc_the_product_description(); ?>
                        </div><!--close product_description -->
                        <?php do_action( 'wpsc_product_addons', wpsc_the_product_id() ); ?>
                        <?php if ( wpsc_the_product_additional_description() ) : ?>
                            <!--<div class="single_additional_description">
                                <p><?php echo wpsc_the_product_additional_description(); ?></p>
                            </div>--><!--close single_additional_description-->
                        <?php endif; ?>
                        <?php do_action( 'wpsc_product_addon_after_descr', wpsc_the_product_id() ); ?>
                    </div><!--close #product_c2a_col--><!--
                    
                    <?php // PRODUCT TABS (TECH SPEC & FEATURES) - USING TABIFY ?>
                
					--><div id="product_tabs_col" class="span8">
                    
                    	<ul id="product-tabs-menu" class="tabify"><!--
                            --><li class="active"><a href="#product-tech-spec">Tech Specs</a></li><!--
                            --><li><a href="#product-features">Features</a></li><!--
                        --></ul><!-- #product-tabs-menu -->
                        
                        <div id="product-units-switcher">
                        	<span id="metric-switch">Metric</span><span id="indicator" class="metric"></span><span id="imperial-switch">Imperial</span>
                        </div>
                        
                        <div id="product-tech-spec" class="tab">
                        	<?php echo get_product_specs(wpsc_the_product_id()); ?>                        
                        </div><!-- close #product-tech-spec -->
                        
                        <div id="product-features" class="tab">
                        	<p><?php echo(get_post_meta( wpsc_the_product_id(), '_product_features_text' , true )); ?></p>
                        </div><!-- close #product-features -->
                    
                    </div><!--close #product_tabs_col-->
                    </div><!--close .product-row-->
                    
                    <div id="product_related_content" class="product-row">
                    	<?php get_related_features(wpsc_the_product_id()); ?>
                        <?php get_related_products(wpsc_the_product_id()); ?>
                    	<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
                    </div><!--close #product_related_content-->
                    
                </div><!-- close span12 -->

