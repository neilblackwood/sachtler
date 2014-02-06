<?php $current_category_link = get_term_link( $current_category->slug, 'wpsc_product_category');
$current_category_title = '--><div class="wpsc_product_category_header"><h2>%1$s</h2><p>%2$s</p></div><!--';
printf($current_category_title,$current_category->name,$current_category->description); ?>

--><hr><div class="wpsc-product_category_list">
	<div class="table-header-row">