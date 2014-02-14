<?php 
/**
 * Template Name: News/Press Index Page
 */

global $post, $query;
$post_slug=$post->post_name;

if($post_slug=='press-service') {

    $query['post_type'] = 'press';

    //Create an array of press post years available.
    $press_posts = new WP_Query($query);
    $years[] = array('name' => 'Year', 'value' => '');
    while ( $press_posts->have_posts() ) : $press_posts->the_post();
        $year = get_the_date('Y');
        $years[$year] = array('name' => $year, 'value' => $year);
    endwhile;

    //Retrieve the year from the form
    $press_form['year'] = (get_query_var('y') ? get_query_var('y') : '');
    if($press_form['year']) $query['y'] = $press_form['year'];

    //Retrieve the search terms
    $press_form['search'] = (get_query_var('search') ? get_query_var('search') : '');
    if($press_form['search']) $query['s'] = $press_form['search'];

    $args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 0
    );
    $press_categories = get_terms('press_category',$args);
    if($press_categories){
        foreach($press_categories as $category) {
            $press_form[$category->slug] = ($_POST[$category->slug] ? 'checked' : '');
            $checkboxes .= '<input type="checkbox" name="'.$category->slug.'" id="'.$category->slug.'" value="on" '.$press_form[$category->slug].' />';
            $checkboxes .= '<label for="'.$category->slug.'">'.$category->name.'</label>';
            // put only checked categories in here!
            if($_POST[$category->slug]){
                $cat_ids[] = $category->term_id;
            }
        }
        if($cat_ids){
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'press_category',
                    'field' => 'id',
                    'terms' => $cat_ids
                )
            );
        }
    }
}

get_header(); ?>
<article id="content" class="span12">
<h1><?php the_title(); ?></h1>
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="entry-content">
<?php the_content(); ?>
<?php edit_post_link( __( 'Edit', 'blankslate' ), '<div class="edit-link">', '</div>' ) ?>
</div>
</div>
</article>

<?php if($post_slug=='press-service'){ ?>
<section id="press-search" class="span12">
<form method="post" id="press-form" action="">
<div id="press-search-inputs" class="span12">
<input type="text" value="<?php echo $press_form['search'] ?>" name="search" id="search" placeholder="Search press releases">
<!--<input type="submit" id="searchsubmit" value="Search" />-->
</div>
<div class="clear"></div>
<div class="span3">
<select name="y" id="y">
<?php foreach($years as $option) {
	$selected = (($option['value'] == $press_form['year']) ? 'selected' : '');
	printf('<option value="%1$s" %2$s>%3$s</option>',$option['value'],$selected,$option['name']);
} ?>
</select>
</div><!--
--><div class="span6">
<?php echo $checkboxes; ?>
</div>
</form>
</section>
<?php } ?>

<?php if ( is_active_sidebar($post_slug.'-widgets') || $post_slug=='press-service') { ?>
<section id="press-news-sidebar-container" class="span3">
<div id="press-news-sidebar">
<?php if($post_slug=='press-service'){ ?>
    <p class="black">
        Press contact<br>
        For all press inquiries, please contact:
    </p>
    <p class="black">
        Tobias Keuthen<br>
        Global Brand Manager Sachtler
    </p>
     <p>
        T +49 89 321 58 245<br>
        <a href="mailto:tobias.keuthen@vitecgroup.com">tobias.keuthen@vitecgroup.com</a>
    </p>
    <hr>
<?php } ?>
<?php dynamic_sidebar($post_slug.'-widgets'); ?></div>
</section>
<?php } ?>
<section id="news-index">
<?php

    // Limit posts per page
    $query['posts_per_page'] = 10;

    // Get the posts.
    query_posts($query);

    // Set news excerpt length.
    function news_excerpt_length( $length ) {
        return 200;
    }
    add_filter( 'excerpt_length', 'news_excerpt_length', 999 );

    while (have_posts()) : the_post(); ?>
        <div class="entry-content span8">
            <span class="timestamp" title="<?php echo the_time('j F, Y'); ?>"><?php echo the_time('j F, Y'); ?></span>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <div class="storycontent">
                <?php the_excerpt(); ?>
            </div>
            <a class="more-link" href="<?php the_permalink(); ?>">More</a>
        </div>
    <?php endwhile;?>
    <div class="clear"></div>
    <div class="span8 nav_links"><?php posts_nav_link(' ','Older','Newer'); ?></div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>