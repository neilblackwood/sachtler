<?php 
$weight = (get_query_var('wt') ? get_query_var('wt') : 0);
$application = (get_query_var('a') ? get_query_var('a') : 0);
$camera_brand = (get_query_var('b') ? get_query_var('b') : 0);
$camera_model = (get_query_var('ml') ? get_query_var('ml') : 0);

$wpsc_product_app_list = get_terms('application',array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'DESC'));
if($wpsc_product_app_list){
	$application_options[] = array('name' => 'Select application', 'value' => 0);
	foreach($wpsc_product_app_list as $term) {
		if($term->parent > 0){
			$application_options[] = array('name' => '- '.$term->name, 'value' => $term->term_id);
		} else {
			$application_options[] = array('name' => $term->name, 'value' => $term->term_id);
		}
	}
}
$wpsc_brand_list = get_terms('compatible-product',array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'DESC'));
if($wpsc_brand_list){
	$brand_options[] = array('name' => 'Select camera brand', 'value' => 0);
	$model_options[] = array('name' => 'Select camera model', 'value' => 0, 'class' => 'default');
	foreach($wpsc_brand_list as $term) {
		if($term->parent > 0){
			$model_options[] = array('name' => $term->name, 'value' => $term->term_id, 'class' => $term->parent);
		} else {
			$brand_options[] = array('name' => $term->name, 'value' => $term->term_id);
		}
	}
}

?>
<div id="configurator">
<h2>Find a Fluid head in 3 easy steps.</h2>
<form method="get" id="configuratorform" action="<?php echo esc_url( home_url( '/' ) ); ?>product-configurator">
<div class="span4">
<span class="step-number">1</span>
<p>Choose the weight range<br/>(approx. camera weight plus accesssories).</p>
<select name="wt" id="wt">
	<option value="0"<?php if($weight==0) echo ' selected'; ?>>Select weight</option>
	<option value="1"<?php if($weight==1) echo ' selected'; ?>>1-5 kg</option>
    <option value="2"<?php if($weight==2) echo ' selected'; ?>>6-10 kg</option>
    <option value="3"<?php if($weight==3) echo ' selected'; ?>>11-15 kg</option>
    <option value="4"<?php if($weight==4) echo ' selected'; ?>>16-20 kg</option>
</select>
</div><!--
--><div class="span4">
<span class="step-number">2</span>
<p>What are your projects like?<br/>Select your most common application</p>
<select name="a" id="a">
<?php foreach($application_options as $option) {
	$selected = (($option['value'] == $application) ? 'selected' : '');
	printf('<option value="%1$s" %2$s>%3$s</option>',$option['value'],$selected,$option['name']);
} ?>
</select>
<p>You’re new in this business or your specialist field is low-budget video production. Your documentaries, web videos or corporate films long for professional camera support at an affordable price/performance ratio.</p>
</div><!--
--><div class="span4">
<span class="step-number">3</span>
<p>To further narrow down the list, choose a camera for the most suitable recommendation. – Optional</p>
<select name="b" id="b">
<?php foreach($brand_options as $option) {
	$selected = (($option['value'] == $camera_brand) ? 'selected' : '');
	printf('<option value="%1$s" %2$s>%3$s</option>',$option['value'],$selected,$option['name']);
} ?>
</select>
<select name="ml" id="ml" disabled>
<?php foreach($model_options as $option) {
	$selected = (($option['value'] == $camera_model) ? 'selected' : '');
	printf('<option class="%1$s" value="%2$s" %3$s>%4$s</option>',$option['class'],$option['value'],$selected,$option['name']);
} ?>
</select>
<input type="submit" class="white-button" id="searchsubmit" value="Show recommendation" />
</div>
</form>
</div>