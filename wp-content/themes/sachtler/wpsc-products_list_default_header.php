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
			</div><!--close wpsc_category_details--><!--<?php ?>