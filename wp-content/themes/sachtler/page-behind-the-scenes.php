<?php get_header(); ?>
<div id="content">
<div class="span12"><h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-content">
<?php the_content(); ?>
<?php if ( is_user_logged_in() ) echo '<a class="post-edit-link" href="'.get_edit_post_link( get_the_ID() ).'">Edit</a>'; ?>
</div>
<?php $terms = get_terms('feature_cat');
if($terms){ ?>
<ul id="feature-selector"><!--
<?php foreach($terms as $term){ ?>
--><li class="<?php echo $term->slug; ?> active"><?php echo $term->name; ?></li><!--
<?php } ?>
--></ul>
<?php } ?>
</div>
<div class="span12"><!--
<?php $query = new WP_Query( array( 'post_type' => array('feature'), 'posts_per_page' => 12,'orderby' => 'date', 'order' => 'ASC'));
$i = 1;
while ( $query->have_posts() ) : $query->the_post();
get_template_part( 'entry' );
$i++;
endwhile;?>
--></div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>