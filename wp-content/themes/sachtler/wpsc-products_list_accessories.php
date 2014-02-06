                    <?php global $wpsc_cart; ?>
					<div class="product-category product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group span4">
                        <h2 class="prodtitle entry-title">
                            <?php echo wpsc_the_product_title(); ?>
                        </h2>
                        <?php if(wpsc_product_sku()) printf('<span class="%1$s">%2$s</span><span class="%3$s">%4$s</span>', 'product-sku-label','Code','product-sku',wpsc_product_sku()); ?>
                        <?php if(wpsc_show_thumbnails()) :?>
                            <?php if(wpsc_the_product_thumbnail()) :
                            ?>
                                <img class="wpsc_category_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail('316','267'); ?>"/>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="product_description">
                            <?php echo wpsc_the_product_description(); ?>
                        </div><!--close product_description -->
                        <div class="product_c2a_col valign_bottom">
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
						</div>
					</div><!--close default_product_display-->