					<div class="product-category product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?> group span4">
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
                            <p><?php print_r($terms); ?></p>
                        </a>
					</div><!--close default_product_display-->