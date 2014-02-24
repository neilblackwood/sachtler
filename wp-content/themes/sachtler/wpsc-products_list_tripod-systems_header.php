<?php 
$cat = get_term(wpsc_category_id(),'wpsc_product_category');
$title = ($cat->parent ? get_term($cat->parent,'wpsc_product_category')->name.' &gt; '.wpsc_category_name() : wpsc_category_name());
?>
			<div class="wpsc_category_details">
            	<?php echo '<h1>'.$title.'</h1>'; ?>
				<?php if(wpsc_show_category_thumbnails()) : ?>
					<img src="<?php echo wpsc_category_image(); ?>" alt="<?php echo wpsc_category_name(); ?>" />
				<?php endif; ?>
				<?php if(wpsc_show_category_description() &&  wpsc_category_description()) : ?>
					<p><?php echo wpsc_category_description(); ?></p>
				<?php endif; ?>
                <div id="product-category-controls">
                    <ul id="product-category-switch" class="tabify"><!--
                        --><li class="active"><a href="#head-fixing"><?php _e('by head fixing',''); ?></a></li><!--
                        --><li><a href="#application"><?php _e('by application',''); ?></a></li><!--
                    --></ul><!-- #product-tabs-menu -->
                    <div id="product-units-switcher">
                        <span id="metric-switch">Metric</span><span id="indicator" class="metric"></span><span id="imperial-switch">Imperial</span>
                    </div>
                </div>
			</div><!--close wpsc_category_details--><!--<?php ?>