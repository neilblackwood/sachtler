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
        	<p><?php _e('Payload range','sachtler'); ?></p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/counterbalance.png"/>
        	<p><?php _e('Counterbalance','sachtler'); ?></p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/drag.png"/>
        	<p><?php _e('Grades of drag','sachtler'); ?><br>
            <?php _e('horizontal / vertical','sachtler'); ?></p>
        </div><!--
        --><div class="center span2">
        	<img src="<?php echo get_bloginfo('template_directory'); ?>/images/ico/head.png"/>
        	<p><?php _e('Head fitting','sachtler'); ?></p>
        </div><!--
        --><div class="center span1">
        	<p><?php _e('Compare up to 4 heads','sachtler'); ?></p>
        	<a href="/sachtler/product-comparison/?ct=fluid-heads" class="red-button button compare"><?php _e('Show','sachtler'); ?></a>
        </div><!--
    --></div>