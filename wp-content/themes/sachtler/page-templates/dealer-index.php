<?php 
/**
 * Template Name: Dealer Index Page
 */
 
$dealer_form['continent'] = (get_query_var('continent') ? get_query_var('continent') : '');
$dealer_form['country'] = (get_query_var('country') ? get_query_var('country') : '');
$dealer_form['shop'] = ($_POST['shop'] ? 'checked' : '');

$dealer_query['post_type'] = 'dealer';
if($dealer_form['continent']) $dealer_query['tax_query'][] = array(
									'taxonomy'	=>	'continent',
									'field'		=>	'id',
									'terms'		=>	$dealer_form['continent'],
								);
if($dealer_form['country']) $dealer_query['tax_query'][] = array(
									'taxonomy'	=>	'country',
									'field'		=>	'id',
									'terms'		=>	$dealer_form['country'],
								);
if($dealer_form['shop']) $dealer_query['meta_query'] = array(
						array(
							'key'		=>	'_dealer_shop',
							'value'		=>	array('on'),
						),
					);

$dealer_continents = get_terms('continent',array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'DESC'));
if($dealer_continents){
	$continents[] = array('name' => 'Select continent', 'value' => '');
	foreach($dealer_continents as $term) {
		if($term->parent > 0){
			$continents[] = array('name' => '- '.$term->name, 'value' => $term->term_id);
		} else {
			$continents[] = array('name' => $term->name, 'value' => $term->term_id);
		}
	}
}
$dealer_countries = get_terms('country',array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'DESC'));
if($dealer_countries){
	$countries[] = array('name' => 'Select country', 'value' => '');
	foreach($dealer_countries as $term) {
		if($term->parent > 0){
			$countries[] = array('name' => '- '.$term->name, 'value' => $term->term_id);
		} else {
			$countries[] = array('name' => $term->name, 'value' => $term->term_id);
		}
	}
}

get_header(); ?>
<article id="content" class="span12">
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<?php the_content(); ?>
<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
</div>
</div>
</article>
<section id="dealer-search">
<div id="dealer-search">
<form method="post" id="dealer-form" action="">
<div class="span3">
<h3>Continent</h3>
<select name="continent" id="continent">
<?php foreach($continents as $option) {
	$selected = (($option['value'] == $dealer_form['continent']) ? 'selected' : '');
	printf('<option value="%1$s" %2$s>%3$s</option>',$option['value'],$selected,$option['name']);
} ?>
</select>
</div><!--
--><div class="span3">
<h3>Country</h3>
<select name="country" id="country">
<?php foreach($countries as $option) {
	$selected = (($option['value'] == $dealer_form['country']) ? 'selected' : '');
	printf('<option value="%1$s" %2$s>%3$s</option>',$option['value'],$selected,$option['name']);
} ?>
</select>
</div><!--
--><div class="span6">
<h3>Online Shop</h3>
<input type="checkbox" name="shop" id="shop" value="on" <?php echo $dealer_form['shop'] ?>/>
<label for="shop">Only show dealers with Online Stores</label>
<input type="submit" class="grey-button" id="searchsubmit" value="Update" />
</div>
</form>
</div>
</section>
<section id="dealer-index"><!--
<?php $dealers = new WP_Query($dealer_query);
while ( $dealers->have_posts() ) : $dealers->the_post();
	get_template_part( 'dealer' );
endwhile; ?>
--></section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>