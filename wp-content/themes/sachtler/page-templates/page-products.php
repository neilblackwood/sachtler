<?php 
/**
 * Template Name: Products Page Template
 */

get_header(); ?>
<article id="content" class="span12">
<?php the_post(); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_content(); ?>
<?php get_footer(); ?>