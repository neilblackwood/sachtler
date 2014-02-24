<?php 
$weight = (get_query_var('wt') ? get_query_var('wt') : 0);
$application = (get_query_var('a') ? get_query_var('a') : 0);
$camera_brand = (get_query_var('b') ? get_query_var('b') : 0);
$camera_model = (get_query_var('ml') ? get_query_var('ml') : 0);

$weight_text = ($weight ? sprintf(' weighing between %1$s and %2$s kg',$weight*5-4,$weight*5) : '');
$application_text = ($application ? sprintf(' for %1$s projects',get_term($application,'application')->name) : '');
$camera_brand_text = ($camera_brand ? sprintf(', suitable for use with a %1$s',get_term($camera_brand,'compatible-product')->name) : '');
$camera_brand_text = ($camera_model ? sprintf('%1$s %2$s',$camera_brand_text,get_term($camera_model,'compatible-product')->name) : $camera_brand_text);
$camera_brand_text = ($camera_brand_text ? $camera_brand_text . ' camera' : '' );

if($camera_model > 0) $camera_brand = 0;

$args['post_type'] = 'wpsc-product';
$args['tax_query'][] = array(
						'taxonomy'	=>	'wpsc_product_category',
						'field'		=>	'slug',
						'terms'		=>	'fluid-heads',
					);

if($weight) {
	$args['meta_query'] = array(
						'relation' => 'OR',
						array(
							'key'		=>	'_fluid_heads_tech_weight',
							'value'		=>	array($weight*5-4,$weight*5),
							'type' 		=>	'numeric',
							'compare'	=>	'BETWEEN',
						),
						array(
							'key'		=>	'_tripods_tech_weight',
							'value'		=>	array($weight*5-4,$weight*5),
							'type' 		=>	'numeric',
							'compare'	=>	'BETWEEN',
						),
					);
}
	
if($application) {
	$args['tax_query'][] = array(
						'taxonomy'	=>	'application',
						'field'		=>	'id',
						'terms'		=>	$application,
					);
}

if($camera_brand || $camera_model) {
	$args['tax_query'][] = array(
						'taxonomy'	=>	'compatible-product',
						'field'		=>	'id',
						'terms'		=>	array($camera_brand, $camera_model),
					);
}

if($weight + $application + $camera_brand + $camera_model > 0) {
	$query = new WP_Query( $args );
} else {
	$query = new WP_Query( 'posts_per_page=0' );
}

?>
<div class="wpsc_category_details">
	<?php echo '<h1>'.$post->post_title.'</h1>'; ?>
    <?php if($query->have_posts()) : ?>
    <div id="product-category-controls">
        <div id="product-units-switcher">
            <span id="metric-switch">Metric</span><span id="indicator" class="metric"></span><span id="imperial-switch">Imperial</span>
        </div>
    </div>
    <?php endif; ?>
</div><!--close wpsc_category_details--><!--

<?php if($query->have_posts()) : ?>

--><div class="wpsc_product_category_header"><h2>Sachtler recommends</h2><p>Fluid heads<?php echo $weight_text . $application_text . $camera_brand_text; ?>.</p></div><!--

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
        	<a href="#" class="red-button button compare"><?php _e('Show','sachtler'); ?></a>
        </div><!--
    --></div>
<?php else : ?>
--><div class="wpsc_product_category_header"><h2>No products found</h2><p>Try broadening your search with the form above.</p></div>
<?php endif; ?>    
<?php
// The Loop
while ( $query->have_posts() ) {
	$query->the_post();
	get_template_part('wpsc-products_list_fluid-heads');
}

wp_reset_postdata();

?></div>