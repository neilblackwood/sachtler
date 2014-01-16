<?php
$dataArr['fluid-heads'] = Array(
							'weight',
							'payload',
							'counterbalance_steps',
							'drag_grades',
							'tilt_range',
							'slide_range',
							'temp',
							'camera_fitting',
							'head_fitting',
							'pan_bar',
							'level'
							);
$dataArr['tripods'] = Array(
							'weight',
							'payload',
							'material',
							'height',
							'head_fitting',
							'camera_fitting',
							'transport_length',
							'stages'
							);
$dataArr['pedestals'] = Array(
							'weight',
							'payload',
							'height',
							'head_fitting',
							'on_shot_stroke',
							'clearance'
							);
$dataArr['tripod-systems'] = Array(
							'fluid_head',
							'tripod',
							'weight',
							'payload',
							'height',
							'head_fitting',
							'transport_length'
							);

$catName = $_GET['ct'];
?>
<div class="span2 col-display">
			
	<a class="wpsc_product_title span2" href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>">
        		        <h2 class="prodtitle entry-title ">
			<?php echo wpsc_the_product_title(); ?>
        </h2>

       <?php if(wpsc_product_sku()) printf('<span class="%1$s">%2$s</span><span class="%3$s">%4$s</span>', 'product-sku-label','Order code','product-sku',wpsc_product_sku()); ?>

       
        <?php if(wpsc_show_thumbnails()) :?>
        	<?php if(wpsc_the_product_thumbnail()) :
            ?>
                <img class="center wpsc_category_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail('150','150'); ?>"/>
            <?php endif; ?>
        <?php endif; ?>
        
        
    </a>
	<div class="center span2 row2">
		<a href="#" data-id="<?php echo wpsc_the_product_id();?>" data-category="<?php echo $catName;?>" class="grey-button button delete"><span class="x-icon"></span> delete</a>
		<a href="<?php echo esc_url( wpsc_the_product_permalink() ); ?>" class="grey-button button">View</a>
		<div class="payment-detail">Payment detail and Add to cart button will go here</div>
	</div>	
	<?php

	foreach($dataArr[$catName] as $val) {
		echo "<div class='center span2'>" . get_product_specs(wpsc_the_product_id(), $val ,true). '</div>' ;
	}?>
</div><!-- -->