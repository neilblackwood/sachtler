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
        	<p><?php _e('Payload range','sachtler'); ?></p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/material.png"/>
        	<p><?php _e('Material','sachtler'); ?></p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/height.png"/>
        	<p><?php _e('Height range','sachtler'); ?></p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/head.png"/>
        	<p><?php _e('Head fitting','sachtler'); ?></p>
        </div><!--
        --><div class="center span1">
        	<p><?php _e('Compare up to 4 tripods','sachtler'); ?></p>
        	<a href="/sachtler/product-comparison/?ct=tripods" class="red-button button compare"><?php _e('Show','sachtler'); ?></a>
        </div><!--
    --></div>