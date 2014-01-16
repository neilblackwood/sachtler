<?php
$cookieName = $_GET['ct'];
// pedestals, fluid-heads
$json = $_COOKIE[$cookieName.'-compare'];
$dataCookie = str_replace('null,','',$json);
$obj = explode(',',$dataCookie);


if($obj) {
	$args = array(
	   'post_type' => 'wpsc-product',
	   'post__in'      => $obj
	);
	$query = new WP_Query( $args );
}
?>
<div class="wpsc_category_details">
	<?php echo '<h1>'.$post->post_title.'</h1>'; ?>
    <?php if(wpsc_show_category_thumbnails()) : ?>
        <img src="<?php echo wpsc_category_image(); ?>" alt="<?php echo wpsc_category_name(); ?>" />
    <?php endif; ?>
    <?php if(wpsc_show_category_description() &&  wpsc_category_description()) : ?>
        <p><?php echo wpsc_category_description(); ?></p>
    <?php endif; ?>
    <?php if($query->have_posts()) : ?>
    <div id="product-category-controls">
        <div id="product-units-switcher">
            <span id="metric-switch">Metric</span><span id="indicator" class="metric"></span><span id="imperial-switch">Imperial</span>
        </div>
    </div>
    <?php endif; ?>
</div><!--close wpsc_category_details--><!--

<?php if($query->have_posts()) : ?>

--><div class="wpsc_product_category_header"><h2>Showing...</h2><p><?php echo str_replace('-',' ',$cookieName) ?>.</p></div><!--

--><div class="wpsc-product_category_list"><!--
	--><div class="span2 col-display lines">
		<div class="center span2 row1"><p>&nbsp;</p></div><!--
    	--><div class="center span2 row2"><p>&nbsp;</p></div><!-- -->
<?php
        $dataArr['fluid-heads'] = Array(
        							'weight'=>'weight.png',
        							'payload'=>'payload.png',
        							'counterbalance_steps'=>'counterbalance.png',
        							'drag_grades'=>'drag.png',
        							'tilt_range'=>'tilt.png',
        							'slide_range'=>'sliding_range.png',
        							'temp'=>'temp.png',
        							'camera_fitting'=>'camera.png',
        							'head_fitting'=>'head.png',
        							'pan_bar'=>'panbar.png',
        							'level'=>'level.png'
        							);
        $dataArr['tripods'] = Array(
        							'weight'=>'weight.png',
        							'payload'=>'payload.png',
        							'material'=>'material.png',
        							'height'=>'height.png',
        							'head_fitting'=>'head.png',
        							'camera_fitting'=>'camera.png',
        							'transport_length'=>'trans_length.png',
        							'stages'=>'stages.png'
        							);
        $dataArr['pedestals'] = Array(
        							'weight'=>'weight.png',
        							'payload'=>'payload.png',
        							'height'=>'height.png',
        							'head_fitting'=>'head.png',
        							'on_shot_stroke'=>'on_shot_stroke.png',
        							'clearance'=>'clearance.png'
        							);
        $dataArr['tripod-systems'] = Array(
        							'fluid_head'=>'fluid_head.png',
        							'tripod'=>'tripod.png',
        							'weight'=>'weight.png',
        							'payload'=>'payload.png',
        							'height'=>'height.png',
        							'head_fitting'=>'head.png',
        							'transport_length'=>'trans_length.png'
        							);
        
        
        
        
        
        $catName = $_GET['ct'];
        foreach($dataArr[$catName] as $key=>$val) {
        	echo "<div class='center span2'>".
        		 "<p><img src='". get_bloginfo('template_directory') ."/images/ico/". $val ."'/><br/>". $key ."</p>".
        		 "</div>";
       	}
        ?>
   </div><!--
--><?php else : ?><!--
--><div class="wpsc_product_category_header n-margin"><h2>No products found...</h2><?php endif; ?> 
<?php

echo "<div class='list-wrapper'>";
// The Loop
while ( $row = $query->have_posts() ) {
	$query->the_post();

	get_template_part('wpsc-products_list_comparison');
	
}
echo "</div>";
wp_reset_postdata();

?></div><!-- -->