<?php $current_category_link = get_term_link( $current_category->slug, 'wpsc_product_category');
$current_category_title = '--><div class="wpsc_product_category_header"><h2><a href="%1$s">%2$s</a></h2><p>%3$s</p></div><!--';
printf($current_category_title,$current_category_link,$current_category->name,$current_category->description); ?>

--><div class="wpsc-product_category_list">
	<div class="table-header-row">
    	<div class="span3 new-line">
        	<p>&nbsp;</p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/payload.png"/>
        	<p>Payload range</p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/height.png"/>
        	<p>Height range</p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/on_shot_stroke.png"/>
        	<p>On-shot stroke</p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/clearance.png"/>
        	<p>Clearance</p>
        </div><!--
        --><div class="center span1">
        	<p>Compare up to 4 pedestals</p>
        	<a href="/sachtler/product-comparison/?ct=pedestals" class="red-button button compare">Show</a>
        </div><!--
    --></div>