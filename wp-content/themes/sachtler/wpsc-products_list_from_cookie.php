<?php 
$cat = end(get_the_terms(wpsc_the_product_id(),'wpsc_product_category'));

while($cat->parent > 0){
	$cat = get_term($cat->parent,'wpsc_product_category');
}

if(wpsc_show_thumbnails()) :
	if(wpsc_the_product_thumbnail()) :
		echo '<div class="wrapperbox" id="div_' . wpsc_the_product_id(). '">';
		echo '<span class="x-icon" data-id="' . wpsc_the_product_id(). '" data-category="'.$cat->slug.'"></span>';
       	echo '<img id="product_image_' . wpsc_the_product_id(). '" alt="'. wpsc_the_product_title() . '" title="' . wpsc_the_product_title() . '" src="' . wpsc_the_product_thumbnail('150','150') . '" width="150" height="150" />';
       	echo '</div>';
    endif;
endif; 

?>
        
     