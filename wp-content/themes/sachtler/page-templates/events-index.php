<?php 
/**
 * Template Name: Events Index Page
 */

global $post, $query, $year;

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

<?php if ( is_active_sidebar('events-widgets') ) { ?>
<section id="press-news-sidebar-container" class="span3">
<div id="press-news-sidebar">
<?php dynamic_sidebar('events-widgets'); ?></div>
</section>
<?php } ?>
<section id="news-index">
<?php

    $query['post_type'] = 'event';
    $query['orderby'] = "DATE_FORMAT(STR_TO_DATE(meta_value, '%M %d,%Y'), '%Y-%m-%d')";
    $query['meta_key'] = '_event_start';
    $query['order'] = 'ASC';

    // Get the posts.
    query_posts($query);

    $year=0;

    while (have_posts()) : the_post();
    $postYear = date('Y', strtotime(get_post_meta( get_the_ID(), '_event_start', true )));
    if($year!=0&&$year!=$postYear)
    {
    ?>
        <div class="clear"></div>
    <?php
    }
    $year = $postYear;
    ?>
        <div class="entry-content span4">
            <a href="<?php the_permalink(); ?>">
            <?php
            $eventStart = strtotime(get_post_meta( get_the_ID(), '_event_start', true ));
            $eventEnd = strtotime(get_post_meta( get_the_ID(), '_event_end', true ));

            if($eventStart == $eventEnd){
                $eventDates = $eventStart;
            } else {
                $eventDates = date('Y <\b\r> F <\b\r> j',$eventStart) . '-' . date('j', $eventEnd);
            } ?>
            <span class="event span3"><?php echo $eventDates; ?></span>
            <div class="storycontent">
                <?php the_title(); ?><br>
                <span class="grey"><?php echo get_post_meta( get_the_ID(), '_event_location', true ) ?></span>
            </div>
            </a>
        </div>
    <?php endwhile;?>
    <div class="clear"></div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>