<?php $current_application_link = get_term_link( $current_application->slug, 'application');
$current_application_title = '--><div class="wpsc_product_category_header"><h2>%1$s</h2><p>%2$s</p></div><!--';
printf($current_application_title,$current_application->name,$current_application->description); ?>

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