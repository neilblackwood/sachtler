	<div class="table table-product-row product-category product_view_<?php echo wpsc_the_product_id(); ?> <?php echo wpsc_category_class(); ?>">
    	<div class="span3 new-line">
        	<a class="wpsc_product_title" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
                <?php if(wpsc_show_thumbnails()) :?>
					<?php if(wpsc_the_product_thumbnail()) :
                    ?>
                        <img class="wpsc_category_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail('150','150'); ?>"/>
                    <?php endif; ?>
                <?php endif; ?>
                <h2 class="prodtitle entry-title">
					<?php echo wpsc_the_product_title(); ?>
                </h2>
                <?php if(wpsc_product_sku()) printf('<span class="%1$s">%2$s</span><span class="%3$s">%4$s</span>', 'product-sku-label','Code','product-sku',wpsc_product_sku()); ?>
            </a>
        </div><!--
        --><div class="center span2">
        	<?php echo get_product_specs(wpsc_the_product_id(),'payload',true); ?>
        </div><!--
        --><div class="center span2">
        	<?php echo get_product_specs(wpsc_the_product_id(),'material',true); ?>
        </div><!--
        --><div class="center span2">
        	<?php echo get_product_specs(wpsc_the_product_id(),'height',true); ?>
        </div><!--
        --><div class="center span2">
        	<?php echo get_product_specs(wpsc_the_product_id(),'head_fitting',true); ?>
        </div><!--
        --><div class="center span1">
        	<input type='checkbox' class="compareInput" category='tripods' value='<?php echo wpsc_the_product_id(); ?>'  onchange='setCompareProductCookie("tripods-compare", this);'></input>
        </div><!--
    --></div>
    
    
    