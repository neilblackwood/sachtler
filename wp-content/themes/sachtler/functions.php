<?php
add_action('after_setup_theme', 'blankslate_setup');

function blankslate_setup(){
load_theme_textdomain('blankslate', get_template_directory() . '/languages');
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array(
	'primary-menu' => __( 'Primary Menu', 'blankslate' ),
	'secondary-menu' => __( 'Secondary Menu', 'blankslate' ),
	'configurator-menu' => __( 'Configurator Link', 'blankslate' ),
	)
);
}
add_action('comment_form_before', 'blankslate_enqueue_comment_reply_script');
function blankslate_enqueue_comment_reply_script()
{
if(get_option('thread_comments')) { wp_enqueue_script('comment-reply'); }
}
add_filter('the_title', 'blankslate_title');
function blankslate_title($title) {
if ($title == '') {
return 'Untitled';
} else {
return $title;
}
}
add_filter('wp_title', 'blankslate_filter_wp_title');
function blankslate_filter_wp_title($title)
{
return $title . esc_attr(get_bloginfo('name'));
}
add_filter('comment_form_defaults', 'blankslate_comment_form_defaults');
function blankslate_comment_form_defaults( $args )
{
$req = get_option( 'require_name_email' );
$required_text = sprintf( ' ' . __('Required fields are marked %s', 'blankslate'), '<span class="required">*</span>' );
$args['comment_notes_before'] = '<p class="comment-notes">' . __('Your email is kept private.', 'blankslate') . ( $req ? $required_text : '' ) . '</p>';
$args['title_reply'] = __('Post a Comment', 'blankslate');
$args['title_reply_to'] = __('Post a Reply to %s', 'blankslate');
return $args;
}
add_action( 'init', 'blankslate_add_shortcodes' );
function blankslate_add_shortcodes() {
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
add_filter('img_caption_shortcode', 'blankslate_img_caption_shortcode_filter',10,3);
add_filter('widget_text', 'do_shortcode');
}
function blankslate_img_caption_shortcode_filter($val, $attr, $content = null)
{
extract(shortcode_atts(array(
'id'	=> '',
'align'	=> '',
'width'	=> '',
'caption' => ''
), $attr));
if ( 1 > (int) $width || empty($caption) )
return $val;
$capid = '';
if ( $id ) {
$id = esc_attr($id);
$capid = 'id="figcaption_'. $id . '" ';
$id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
}
return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
. (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '<figcaption ' . $capid 
. 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init() {
register_sidebar( array (
'name' => __('Header: Language Area', 'blankslate'),
'id' => 'language-area',
'description' => 'Top-most left-hand area above the logo, used for configuring language selection options.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
'after_widget' => "</div>",
));
register_sidebar( array (
'name' => __('Menu: Fluid Heads Widget', 'blankslate'),
'id' => 'fluid-heads-widget',
'description' => 'Fluid Heads menu widget area.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="inside">',
'after_widget' => "</div></div>",
));
register_sidebar( array (
'name' => __('Menu: Tripods Widget', 'blankslate'),
'id' => 'tripods-widget',
'description' => 'Tripods menu widget area.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="inside">',
'after_widget' => "</div></div>",
));
register_sidebar( array (
'name' => __('Menu: Pedestals Widget', 'blankslate'),
'id' => 'pedestals-widget',
'description' => 'Pedestals menu widget area.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="inside">',
'after_widget' => "</div></div>",
));
register_sidebar( array (
'name' => __('Menu: Camera Stabilizers Widget', 'blankslate'),
'id' => 'camera-stabilizers-widget',
'description' => 'Camera Stabilizers menu widget area.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="inside">',
'after_widget' => "</div></div>",
));
register_sidebar( array (
'name' => __('Menu: Tripod Systems Widget', 'blankslate'),
'id' => 'tripod-systems-widget',
'description' => 'Tripod Systems menu widget area.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="inside">',
'after_widget' => "</div></div>",
));
register_sidebar( array (
'name' => __('Menu: Accessories Widget', 'blankslate'),
'id' => 'accessories-widget',
'description' => 'Accessories menu widget area.',
'before_widget' => '<div id="%1$s" class="widget-container %2$s"><div class="inside">',
'after_widget' => "</div></div>",
));
register_sidebar( array (
'name' => __('Homepage: Primary Widgets', 'blankslate'),
'id' => 'home-primary-widgets',
'description' => 'The first widget area on the Homepage.',
'before_widget' => '',
'after_widget' => '',
));
register_sidebar( array (
'name' => __('Homepage: Secondary Widgets', 'blankslate'),
'id' => 'home-secondary-widgets',
'description' => 'The second widget area on the Homepage.',
'before_widget' => '',
'after_widget' => '',
));
register_sidebar( array (
'name' => __('Homepage: News Ticker Widgets', 'blankslate'),
'id' => 'home-newsticker-widgets',
'description' => 'The News Ticker widget area on the Homepage.',
'before_widget' => '',
'after_widget' => '',
));
register_sidebar( array (
'name' => __('Products: Call to action', 'blankslate'),
'id' => 'products-c2a-widgets',
'description' => 'The call to action area on the product pages.',
'before_widget' => '',
'after_widget' => '',
));
register_sidebar( array (
'name' => __('Footer: Text area', 'blankslate'),
'id' => 'footer-widget',
'description' => 'Free-text area for SEO',
'before_widget' => '',
'after_widget' => '',
));
}
$preset_widgets = array (
'primary-aside'  => array( 'search', 'pages', 'categories', 'archives' ),
);
function blankslate_get_page_number() {
if (get_query_var('paged')) {
print ' | ' . __( 'Page ' , 'blankslate') . get_query_var('paged');
}
}
function blankslate_catz($glue) {
$current_cat = single_cat_title( '', false );
$separator = "\n";
$cats = explode( $separator, get_the_category_list($separator) );
foreach ( $cats as $i => $str ) {
if ( strstr( $str, ">$current_cat<" ) ) {
unset($cats[$i]);
break;
}
}
if ( empty($cats) )
return false;
return trim(join( $glue, $cats ));
}
function blankslate_tag_it($glue) {
$current_tag = single_tag_title( '', '',  false );
$separator = "\n";
$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
foreach ( $tags as $i => $str ) {
if ( strstr( $str, ">$current_tag<" ) ) {
unset($tags[$i]);
break;
}
}
if ( empty($tags) )
return false;
return trim(join( $glue, $tags ));
}
function blankslate_commenter_link() {
$commenter = get_comment_author_link();
if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
$commenter = preg_replace( '/(<a[^>]* class=[\'"]?)/', '\\1url ' , $commenter );
} else {
$commenter = preg_replace( '/(<a )/', '\\1class="url "' , $commenter );
}
$avatar_email = get_comment_author_email();
$avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
}
function blankslate_custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
$GLOBALS['comment_depth'] = $depth;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author vcard"><?php blankslate_commenter_link() ?></div>
<div class="comment-meta"><?php printf(__('Posted %1$s at %2$s', 'blankslate' ), get_comment_date(), get_comment_time() ); ?><span class="meta-sep"> | </span> <a href="#comment-<?php echo get_comment_ID(); ?>" title="<?php _e('Permalink to this comment', 'blankslate' ); ?>"><?php _e('Permalink', 'blankslate' ); ?></a>
<?php edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your comment is awaiting moderation.', 'blankslate'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php
if($args['type'] == 'all' || get_comment_type() == 'comment') :
comment_reply_link(array_merge($args, array(
'reply_text' => __('Reply','blankslate'),
'login_text' => __('Login to reply.', 'blankslate'),
'depth' => $depth,
'before' => '<div class="comment-reply-link">',
'after' => '</div>'
)));
endif;
?>
<?php }
function blankslate_custom_pings($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
?>
<li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
<div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'blankslate'),
get_comment_author_link(),
get_comment_date(),
get_comment_time() );
edit_comment_link(__('Edit', 'blankslate'), ' <span class="meta-sep"> | </span> <span class="edit-link">', '</span>'); ?></div>
<?php if ($comment->comment_approved == '0') { echo '\t\t\t\t\t<span class="unapproved">'; _e('Your trackback is awaiting moderation.', 'blankslate'); echo '</span>\n'; } ?>
<div class="comment-content">
<?php comment_text() ?>
</div>
<?php }

// Custom Functions

if(!function_exists('get_post_top_ancestor_id')){
/**
 * Gets the id of the topmost ancestor of the current page. Returns the current
 * page's id if there is no parent.
 * 
 * @uses object $post
 * @return int 
 */
function get_post_top_ancestor_id(){
    global $post;
    
    if($post->post_parent){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    }
    
    return $post->ID;
}}
function add_parent_class( $css_class, $page, $depth, $args )
{
    if ( ! empty( $args['has_children'] ) )
        $css_class[] = 'parent';
    return $css_class;
}
add_filter( 'page_css_class', 'add_parent_class', 10, 4 );

// Output Gallery for each product

function sb_get_images_for_product($id){
   global $wpdb;
   $post_thumbnail = get_post_thumbnail_id();//read the thumbnail id
   $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = $id AND post_type = 'attachment' AND post_content = '' ORDER BY menu_order ASC",$id));?>
   <ul class="gallery"><!--
   <?php $i=0;
   print_r($attachments);
   foreach ($attachments as $attachment){
   
   	
      if ($attachment->ID <> $post_thumbnail && (strpos($attachment->post_mime_type,'image') !== false )){//if we haven't already got the attachment as the post thumbnail
	  	 //if ($i==0) $i++; continue;
         if ($i==0) {
			 $newline=' new-line';
		 } else {
			 $newline = '';
		 }
		 $image_attributes = wp_get_attachment_image_src($attachment->ID,'medium');?>
	--><li class="span2<?php echo $newline; ?>">
    <a rel="lightbox[<?php echo wpsc_the_product_title(); ?>]" href="<?php echo $attachment->guid; ?>" >
		<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo get_post( $attachment->ID )->post_excerpt; ?>"/>
	</a>
    </li><!--
   <?php $i++; } ?>
   <?php } ?>
   --></ul>
<?php }

// Output first image for each product

function sb_get_first_image_for_product($id){
    global $wpdb;
    $post_thumbnail = get_post_thumbnail_id();//read the thumbnail id
    $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = $id AND post_type = 'attachment' ORDER BY menu_order ASC",$id));
    $i = 1;
    foreach ($attachments as $attachment){
	if ($attachment->ID <> $post_thumbnail && (strpos($attachment->post_mime_type,'image') !== false )){//if we haven't already got the attachment as the post thumbnail  	
		if ($i ==1) {
        	$image_attributes = wp_get_attachment_image_src($attachment->ID,'full');?>
	<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo wpsc_the_product_title(); ?>"/>
    <?php }
		$i ++;
	}
	}
}

// Function to capture the echo command as a variable, used for displaying custom fields

function get_custom_fields($slug = null) {
	ob_start();
	wpsc_the_custom_fields($slug);
	$the_field_value = ob_get_contents();
	ob_end_clean();
	//$the_field_value = '<p>'+str_replace('<br><br>','</p><p>',$the_field_value)+'</p>';
	return $the_field_value;
}

// Function to capture the echo command as a variable, used for displaying more fields

function get_more_fields($slug = null) {
	ob_start();
	meta($slug);
	$the_field_value = ob_get_contents();
	ob_end_clean();
	//$the_field_value = '<p>'+str_replace('<br><br>','</p><p>',$the_field_value)+'</p>';
	return $the_field_value;
}

// File attachments and possibly Key Features section?

function my_attachments( $attachments )
{
  $args = array(
 
    // title of the meta box (string)
    'label'         => 'File and Key Feature Attachments',
 
    // all post types to utilize (string|array)
    'post_type'     => array( 'wpsc-product', 'wpsc_product' ),
 
    // allowed file type(s) (array) (image|video|text|audio|application)
    'filetype'      => null,  // no filetype limit
 
    // include a note within the meta box (string)
    'note'          => 'Use this optoin to add product data sheets and pictures for key product features.',
 
    // text for 'Attach' button in meta box (string)
    'button_text'   => __( 'Attach', 'attachments' ),
 
    // text for modal 'Attach' button (string)
    'modal_text'    => __( 'Attach', 'attachments' ),
 
    /**
     * Fields for the instance are stored in an array. Each field consists of
     * an array with three keys: name, type, label.
     *
     * name  - (string) The field name used. No special characters.
     * type  - (string) The registered field type.
     *                  Fields available: text, textarea
     * label - (string) The label displayed for the field.
     */
 
    'fields'        => array(
      array(
        'name'  => 'title',                          // unique field name
        'type'  => 'text',                           // registered field type
        'label' => __( 'Title', 'attachments' ),     // label to display
      ),
      array(
        'name'  => 'caption',                        // unique field name
        'type'  => 'textarea',                       // registered field type
        'label' => __( 'Caption', 'attachments' ),   // label to display
      ),
      array(
        'name'  => 'copyright',                      // unique field name
        'type'  => 'text',                           // registered field type
        'label' => __( 'Copyright', 'attachments' ), // label to display
      ),
    ),
 
  );
 
  $attachments->register( 'my_attachments', $args ); // unique instance name
}
 
add_action( 'attachments_register', 'my_attachments' );

// Add Breadcrumb functionality
// http://dimox.net/wordpress-breadcrumbs-without-a-plugin/

function dimox_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ''; // delimiter between crumbs
	$before         = '<div class="breadcrumb current">'; // tag before the current crumb
	$after          = '</div>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<div class="breadcrumb">';
	$link_after   = '</div>';
	$link_attr    = ' class="crumb"';
	$link         = $link_before . '<a a="--"' . $link_attr . ' href="%1$s" >%2$s</a>' . $link_after;
	$link2         = $link_before . '<a class="crumb single" href="%1$s" >%2$s</a>' . $link_after;
	
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumbs">';
		if ($show_home_link == 1) {
			echo sprintf($link, $home_link, $text['home']);
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				
				if($post_type->labels->singular_name == "Behind the Scenes"){// ==== update Behind the Scenes page url 
					printf($link2, $home_link . 'behind-the-scenes/', $post_type->labels->singular_name);
				}else{
					printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				}
				
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1 && strpos($_SERVER["REQUEST_URI"],'/products/') !== false){
				$crumb = sprintf($link2, get_permalink( get_the_id() ), get_the_title());
			}else if ($show_current == 1) {
				$crumb = sprintf($link2, get_permalink( get_the_id() ), get_the_title());
			}
			wp_reset_postdata();
			$breadcrumb_pages = new WP_Query( array( 'post_type' => 'page', 'post_parent' => 0, 'posts_per_page' => -1) );
			$locations = get_nav_menu_locations();
			$secondary_menu = wp_get_nav_menu_object( $locations[ 'secondary-menu' ] );
			$secondary_menu_pages = wp_get_nav_menu_items($secondary_menu->term_id);
			
			if ( $breadcrumb_pages->have_posts() && isset($secondary_menu_pages)) {
				if (strpos($_SERVER["REQUEST_URI"],'/products/') !== false) {// ==== dont display child pages for pages which are not listed as products
				
					$output .= '<ul class="breadcrumb-menu">';
					foreach( (array) $secondary_menu_pages as $key => $secondary_menu_page ) {
						while ( $breadcrumb_pages->have_posts() ) {
							$breadcrumb_pages->the_post();
							if(get_the_ID() == $secondary_menu_page->object_id) {
								$output .= '<li class="breadcrumb-list-item">';
								$output .= '<a href="'.get_permalink( get_the_ID() ).'">';	
								$output .= get_the_title();
								$output .= '</a>';
								$output .= '</li>';
							}
						}
						wp_reset_postdata();
					}
					$output .= '</ul>';
				}
			}
			if($crumb && $output){
				echo str_replace('</a>','</a>'.$output,$crumb);
			} elseif ($crumb) {
				echo $crumb;
			}			

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} // end dimox_breadcrumbs()

function get_shop_breadcrumbs(){
	ob_start();
	custom_wpsc_output_breadcrumbs();
	$the_field_value = ob_get_contents();
	ob_end_clean();
	return $the_field_value;
}

/**
* Output breadcrumbs if configured
* @return None - outputs breadcrumb HTML
*/
function custom_wpsc_output_breadcrumbs( $options = null ) {

	// Defaults
	$options = apply_filters( 'wpsc_output_breadcrumbs_options', $options );
	$options = wp_parse_args( (array)$options, array(
		'before-breadcrumbs' => '<div class="wpsc-breadcrumbs">',
		'after-breadcrumbs'  => '</div>',
		'before-crumb'       => '<div class="wpsc-breadcrumb">',
		'after-crumb'        => '</div>',
		'crumb-separator'    => '',
		'show_home_page'     => true,
		'show_products_page' => false,
		'echo'               => true,
		'show_product'		 =>	true
	) );

	$output = '';
	$products_page_id = wpsc_get_the_post_id_by_shortcode( '[productspage]' );
	$products_page = get_post( $products_page_id );
	if ( !wpsc_has_breadcrumbs() ) {
		return;
	}
	$filtered_products_page = array(
		'url'  => get_option( 'product_list_url' ),
		'name' => apply_filters ( 'the_title', $products_page->post_title )
	);
	$filtered_products_page = apply_filters( 'wpsc_change_pp_breadcrumb', $filtered_products_page );

	// Home Page Crumb
	// If home if the same as products page only show the products-page link and not the home link
	if ( get_option( 'page_on_front' ) != $products_page_id && $options['show_home_page'] ) {
		$output .= $options['before-crumb'];
		//$output .= '<a class="wpsc-crumb" id="wpsc-crumb-home" href="' . get_option( 'home' ) . '">' . get_option( 'blogname' ) . '</a>';
		$output .= '<a class="wpsc-crumb" id="wpsc-crumb-home" href="' . get_option( 'home' ) . '">Home</a>';
		$output .= $options['after-crumb'];
	}

	// Products Page Crumb
	if ( $options['show_products_page'] ) {
		if ( !empty( $output ) ) {
			$output .= $options['crumb-separator'];
		}
		$output .= $options['before-crumb'];
		$output .= '<a class="wpsc-crumb" id="wpsc-crumb-' . $products_page_id . '" href="' . $filtered_products_page['url'] . '">' . $filtered_products_page['name'] . '</a>';
		$output .= $options['after-crumb'];
	}

	// Remaining Crumbs
	while ( wpsc_have_breadcrumbs() ) {
		wpsc_the_breadcrumb();
		if ( !empty( $output ) ) {
			$output .= $options['crumb-separator'];
		}
		$output .= $options['before-crumb'];
		if ( wpsc_breadcrumb_url() ) {
			$output .= '<a class="wpsc-crumb" id="wpsc-crumb-' . wpsc_breadcrumb_slug() . '" href="' . wpsc_breadcrumb_url() . '">' . wpsc_breadcrumb_name() . '</a>';
			$output .= vamped_breadcrumb(wpsc_breadcrumb_parent(),wpsc_breadcrumb_name());
		} else {
			$output .= '<span class="wpsc-crumb" id="wpsc-crumb-' . wpsc_breadcrumb_slug() . '">' . wpsc_breadcrumb_name() . '</span>';
			$output .= vamped_breadcrumb(wpsc_breadcrumb_parent(),wpsc_breadcrumb_name());
		}
		$output .= $options['after-crumb'];
	}
	
	// Include product name
	if ( $options['show_product'] ) {
		if ( wpsc_is_single_product() ) {
			if ( !empty( $output ) ) {
				$output .= $options['crumb-separator'];
			}
			$output .= $options['before-crumb'];
			$output .= '<a class="wpsc-crumb" id="wpsc-crumb-' . wpsc_the_product_id() . '" href="' . get_permalink( wpsc_the_product_id() ) . '">' . wpsc_the_product_title() . '</a>';
			$categories = wpsc_get_product_terms( wpsc_the_product_id() , 'wpsc_product_category' );
			$output .= vamped_breadcrumb($categories[0]->term_id,wpsc_the_product_title());
			$output .= $options['after-crumb'];
		}
	}
	
	$output = $options['before-breadcrumbs'] . apply_filters( 'wpsc_output_breadcrumbs', $output, $options ) . $options['after-breadcrumbs'];
	if ( $options['echo'] ) {
		echo $output;
	} else {
		return $output;
	}
}

// Get a list of products or categories from ID

function vamped_breadcrumb($uid = 0,$name){
	
	$category_list = get_terms('wpsc_product_category',array('hide_empty' => 0, 'parent' => $uid, 'orderby' => 'name', 'order' => 'DESC'));
	$output = '';
	
	if($category_list){
		$output .= '<ul class="breadcrumb-menu">';
		foreach($category_list as $category) {
			if($name == $category->name) { $current = ' current'; } else { $current = ''; }
			$output .= '<li class="breadcrumb-list-item'.$current.'">';
			$output .= '<a href="'.get_term_link( $category->slug, 'wpsc_product_category').'">';
			$output .= $category->name;
			$output .= '</a>';
			$output .= '</li>';
		}
		$output .= '</ul>';
	} else {
		$category_list = get_terms('wpsc_product_category',array('include' => array($uid), 'hide_empty' => 0, 'orderby' => 'name', 'order' => 'DESC'));
		if($category_list){
			$breadcrumb_products = new WP_Query( array( 'post_type' => 'wpsc-product', 'wpsc_product_category'=>$category_list[0]->slug ) );
			if ( $breadcrumb_products->have_posts() ) {
				$output .= '<ul class="breadcrumb-menu">';
				while ( $breadcrumb_products->have_posts() ) {
					$breadcrumb_products->the_post();
					if($name == get_the_title()) { $current = ' current'; } else { $current = ''; }
					$output .= '<li class="breadcrumb-list-item'.$current.'">';
					$output .= '<a href="'.get_permalink( get_the_ID() ).'">';
					$output .= get_the_title();
					$output .= '</a>';
					$output .= '</li>';
				}
				$output .= '</ul>';
			}
			wp_reset_postdata();
		}
	}
	
	return $output;
	
	if($uid = 0) {
		
	}
	
}

// INJECT PARENT CLASSES TO NAV MENU

add_filter( 'nav_menu_css_class', 'add_parent_url_menu_class', 10, 2 );

function add_parent_url_menu_class( $classes = array(), $item = false ) {
    // Get current URL
    $current_url = current_url();

    // Get homepage URL
    $homepage_url = trailingslashit( get_bloginfo( 'url' ) );

    // Exclude 404 and homepage
    if( is_404() or $item->url == $homepage_url ) return $classes;

    if ( strstr( $current_url, $item->url) ) {
        // Add the 'parent_url' class
        $classes[] = 'parent_url';
    }

    return $classes;
}

function current_url() {
    // Protocol
    $url = ( 'on' == $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
    $url .= $_SERVER['SERVER_NAME'];

    // Port
    $url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];
    $url .= $_SERVER['REQUEST_URI'];
    return trailingslashit( $url );
}


/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class Sachtler_Walker extends Walker_Nav_Menu
{
	
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
	 
    function start_el(&$output, $item, $depth, $args)
    {
        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
            ' '
        ,   apply_filters(
                'nav_menu_css_class'
            ,   array_filter( $classes ), $item
            )
        );

        ! empty ( $class_names )
            and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "--><li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->attr_title )
            and $attributes .= ' title="'  . esc_attr( $item->attr_title ) .'"';
        ! empty( $item->target )
            and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
        ! empty( $item->xfn )
            and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
        ! empty( $item->url )
            and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

        $title = apply_filters( 'the_title', $item->title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . $title
            . '</a> '
            . $args->link_after
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
        ,   $item_output
        ,   $item
        ,   $depth
        ,   $args
        );
    }
	
	function end_el(&$output, $item, $depth, $args)
    {
		$output .= '</li><!--';
	}
}

/**
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */
class Sachtler_Sub_Menu_Walker extends Walker_Nav_Menu
{
	
    /**
     * Start the element output.
     *
     * @param  string $output Passed by reference. Used to append additional content.
     * @param  object $item   Menu item data object.
     * @param  int $depth     Depth of menu item. May be used for padding.
     * @param  array $args    Additional strings.
     * @return void
     */
	 
    function start_el(&$output, $item, $depth, $args)
    {
        // insert description for top level elements only
        // you may change this
        $description = ( ! empty ( $item->description ) and 0 == $depth )
            ? esc_attr( $item->description ) : '';
			
		if($description != ''){
			$class_names .= ' with-desc';
		} 

		if ( is_active_sidebar($description) ) {
			ob_start();
			dynamic_sidebar($description);
			$submenu .= '<div class="menu-promo-area menu-item-'.$item->ID.'">'.ob_get_contents().'</div>';
  			ob_end_clean();
		}

        $output .= $submenu;
    }
	
	function end_el(&$output, $item, $depth, $args)
    {
		$output .= '';
	}
}

// REGISTER CUSTOM POST & TAXONOMY TYPES

function codex_custom_init() {
  $labels = array(
    'name' => 'Content',
    'singular_name' => 'Content',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Content',
    'edit_item' => 'Edit Content',
    'new_item' => 'New Content',
    'all_items' => 'All Content Areas',
    'view_item' => 'View Content',
    'search_items' => 'Search Content Areas',
    'not_found' =>  'No Content Areas found',
    'not_found_in_trash' => 'No Content Areas found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Content'
  );

  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'content' ),
    'capability_type' => 'post',
	'taxonomies' => array( 'bucket' ),
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 20,
    'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' )
  ); 

  register_post_type( 'content', $args );
  
  $tax_labels = array(
		'name'              => _x( 'Content Buckets', 'taxonomy general name' ),
		'singular_name'     => _x( 'Content Bucket', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Content Buckets' ),
		'all_items'         => __( 'All Content Buckets' ),
		'edit_item'         => __( 'Edit Content Bucket' ),
		'update_item'       => __( 'Update Content Bucket' ),
		'add_new_item'      => __( 'Add New Content Bucket' ),
		'new_item_name'     => __( 'New Content Bucket Name' ),
		'menu_name'         => __( 'Content Buckets' ),
	);

	$tax_args = array(
		'hierarchical'      => true,
		'labels'            => $tax_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'bucket' ),
	);

	register_taxonomy( 'bucket', array( 'content' ), $tax_args );
}
add_action( 'init', 'codex_custom_init' );

add_action( 'init', 'create_post_type' );

//ADD FEATURE TAXONOMY
add_action('init','register_features_taxonomy');

function register_features_taxonomy() {
	register_taxonomy('feature_cat', 'feature', array(
	  'hierarchical'    => true,
	  'label'           => 'Feature Categories',
	  'query_var'       => 'feature_cat',
	  'rewrite'         => array('slug' => 'feature_cat' ),
	));
}

//REGISTER THE CUSTOM POST TYPE => FEATURES
add_action( 'init', 'register_features' );

function register_features() {

//AN ARRAY OF LABELS FOR FEATURES
	$labels = array(
		'name' => 'Behind the Scenes',
		'singular_name' => 'Behind the Scenes',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Feature',
		'edit_item' => 'Edit Feature',
		'new_item' => 'New Feature',
		'all_items' => 'All Features',
		'view_item' => 'View Feature',
		'search_items' => 'Search Features',
		'not_found' =>  'No Features found',
		'not_found_in_trash' => 'No Features found in Trash', 
		'parent_item_colon' => 'Parent Feature:',
		'menu_name' => 'Features'
	);

//AN ARRAY OF ARGUMENTS TO DEFINE FEATURES FUNCTIONALITY
    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __('Feature entries for "Behind the Scenes".', 'posts'),
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats' ),
        'taxonomies' => array( 'feature-cat' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'feature', $args );
}

//ADD ADITIONAL PRODUCT TAXONOMIES
add_action('init','register_product_taxonomies');

function register_product_taxonomies() {
	
	$application_labels = array(
		'name'              => _x( 'Product Applications', 'taxonomy general name' ),
		'singular_name'     => _x( 'Application', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Applications' ),
		'all_items'         => __( 'All Applications' ),
		'edit_item'         => __( 'Edit Application' ),
		'update_item'       => __( 'Update Application' ),
		'add_new_item'      => __( 'Add New Application' ),
		'new_item_name'     => __( 'New Application Name' ),
		'menu_name'         => __( 'Applications' ),
	);

	$application_args = array(
		'hierarchical'      => true,
		'labels'            => $application_labels,
		'show_ui'           => true,
		'show_in_nav_menus'	=> true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'application' ),
	);

	register_taxonomy( 'application', array( 'wpsc-product' ), $application_args );
	
	$material_labels = array(
		'name'              => _x( 'Materials', 'taxonomy general name' ),
		'singular_name'     => _x( 'Material', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Materials' ),
		'all_items'         => __( 'All Materials' ),
		'edit_item'         => __( 'Edit Material' ),
		'update_item'       => __( 'Update Material' ),
		'add_new_item'      => __( 'Add New Material' ),
		'new_item_name'     => __( 'New Material Name' ),
		'menu_name'         => __( 'Materials' ),
	);

	$material_args = array(
		'hierarchical'      => true,
		'labels'            => $material_labels,
		'show_ui'           => true,
		'show_in_nav_menus'	=> true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'material' ),
	);

	register_taxonomy( 'material', array( 'wpsc-product' ), $material_args );
	
	$configurator_labels = array(
		'name'              => _x( 'Compatible Products', 'taxonomy general name' ),
		'singular_name'     => _x( 'Compatible Product', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Products' ),
		'all_items'         => __( 'All Products' ),
		'edit_item'         => __( 'Edit Product' ),
		'update_item'       => __( 'Update Product' ),
		'add_new_item'      => __( 'Add New Product' ),
		'new_item_name'     => __( 'New Product Name' ),
		'menu_name'         => __( 'Compatibility' ),
	);

	$configurator_args = array(
		'hierarchical'      => true,
		'labels'            => $configurator_labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'compatible-product' ),
	);

	register_taxonomy( 'compatible-product', array( 'wpsc-product' ), $configurator_args );
	
	
}


// Set up shortcode for content buckets

function get_content_bucket( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
		'area' => '',
		'span' => '',
		'style' => 'default',
	), $atts ) );

	$output = '';
	$newline = 'new-line';
	if($area == '') return '';

	switch($style){

        default:

            $posts = new WP_Query(
                array(
                    'post_type' => 'content',
                    'bucket' => $area,
                    'order_by' => 'menu_order',
                    'order' => 'ASC'
                    ));

            while ( $posts->have_posts() ) : $posts->the_post();

                switch($style){

                    case 'menu' :

                        $post_link = get_post_meta( get_the_ID(), '_post_link_url', true );
                        $output .= '--><li class="'.$area.' '.$style.'-bucket content-bucket '.$span.' '.$newline.'">'."\n";
                        if($post_link) $output .= '<a class="content-bucket-link" href="'.$post_link.'">';
                        $output .= "\t".'<div class="inside">'.wpautop(get_the_content()).'</div>'."\n";
                        $output .= "\t".get_the_post_thumbnail(get_the_ID(), 'full');
                        if($post_link) $output .= '</a>';
                        if ( is_user_logged_in() ) $output .= "\t".'<a class="post-edit-link" href="'.get_edit_post_link( get_the_ID() ).'">Edit</a>'."\n";
                        $output .= '</li><!--'."\n";
                        $post_link = '';

                    break;

                    default :

                        $post_link = get_post_meta( get_the_ID(), '_post_link_url', true );
                        $output .= '--><li class="'.$area.' '.$style.'-bucket content-bucket '.$span.' '.$newline.'">'."\n";

                        if($area == 'news-ticker-buckets'){
                            if($post_link) $output .= '<a class="content-bucket-link span7" href="'.$post_link.'">';
                            $output .= '<span class="redBox">'. get_post_meta( get_the_ID(), '_content_redbox', true ) .'</span>';
                            $output .= '<b>'.get_the_title().': </b>'.get_the_content();
                            if($post_link) $output .= '</a>';
                        }else{
                            if($post_link) $output .= '<a class="content-bucket-link" href="'.$post_link.'">';
                            $output .= "\t".get_the_post_thumbnail(get_the_ID(), 'full');
                            $output .= "\t".'<div class="inside">'.wpautop(get_the_content()).'</div>'."\n";
                            if($post_link) $output .= '</a>';
                        }

                        if ( is_user_logged_in() ) $output .= "\t".'<a class="post-edit-link" href="'.get_edit_post_link( get_the_ID() ).'">Edit</a>'."\n";

                        $output .= '</li><!--'."\n";
                        $post_link = '';

                    break;

                }

            $newline = '';

            endwhile;

            wp_reset_query();

            if($output == '') return '';

            return '<ul class="slider"><!--'.$output.'--></ul>';

        break;

        case 'feature' :

            $posts = wpba_get_attachments();

            if($posts){

                foreach($posts as $post){

                    $output .= '--><li class="'.$area.' '.$style.'-bucket content-bucket '.$span.' '.$newline.'">'."\n";
                    $output .= '<div class="entry-summary">';
                    $output .= "\t".wp_get_attachment_image($post->ID, 'full' );
                    $output .= "\t".'<div class="summary">'.wpautop($post->post_excerpt).'</div>'."\n";
                    $output .= '</div>';
                    $output .= '</li><!--'."\n";

                    $newline = '';

                }

            }

            if($output == '') return '';

            $htmlWrapOpen = '<h2>Get more impressions</h2><div id="feature-associated-bucket" class="bucket-widget-area"><ul class="slider"><!--';
            $htmlWrapClose = '--></ul></div>';
            return $htmlWrapOpen.$output.$htmlWrapClose;

        break;

    }
}

add_shortcode( 'content', 'get_content_bucket' );

// INITIALISE METABOXES

function be_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'metabox/init.php' );
	}
}

add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );

function post_link_metaboxes( $meta_boxes ) {
	$prefix = '_post_link_'; // Prefix for all fields
	
	$post_list = array(array('name'=>'-----PAGES-----','value'=>''));
	$query = new WP_Query( array( 'post_type' => array('page'), 'posts_per_page' => -1,'orderby' => 'name', 'order' => 'ASC'));
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_list[] = array('name' => get_the_title(), 'value' => get_permalink( get_the_ID() ));
		}
	}
	wp_reset_postdata();
	$post_list[] = array('name' => '-----FEATURES-----', 'value' => '#');
	$query = new WP_Query( array( 'post_type' => array('feature'), 'posts_per_page' => -1,'orderby' => 'name', 'order' => 'ASC'));
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_list[] = array('name' => get_the_title(), 'value' => get_permalink( get_the_ID() ));
		}
	}
	wp_reset_postdata();
	$post_list[] = array('name' => '-----PRODUCTS-----', 'value' => '#');
	$query = new WP_Query( array( 'post_type' => array('wpsc-product'), 'posts_per_page' => -1,'orderby' => 'name', 'order' => 'ASC'));
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_list[] = array('name' => get_the_title(), 'value' => get_permalink( get_the_ID() ));
		}
	}
	wp_reset_postdata();
	$category_list = get_terms('wpsc_product_category',array('hide_empty' => 0, 'orderby' => 'name', 'order' => 'DESC'));
	if($category_list){
		$post_list[] = array('name' => '-----PRODUCT CATEGORIES-----', 'value' => '#');
		foreach($category_list as $category) {
			if($category->parent > 0){
				$post_list[] = array('name' => '- '.$category->name, 'value' => get_term_link( $category->slug, 'wpsc_product_category'));
			} else {
				$post_list[] = array('name' => $category->name, 'value' => get_term_link( $category->slug, 'wpsc_product_category'));
			}
		}
	}
	
	$meta_boxes[] = array(
		'id' => 'post_link_metabox',
		'title' => 'Linked Post',
		'pages' => array('content'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Linked Page',
				'desc'    => 'Look up the post that this content links to...',
				'id'      => $prefix . 'url',
				'type'    => 'select',
				'options' => $post_list,
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'post_link_metaboxes' );


// PRODUCT TECHNICAL SPECIFICATION METABOXES

function tech_metaboxes( $meta_boxes ) {
	
	$prefix = '_tag_'; // Prefix for all fields
	
	$meta_boxes[] = array(
		'id' => 'tag_line_metabox',
		'title' => 'Product tag line',
		'pages' => array('wpsc-product'), // post type
		'context' => 'side',
		'priority' => 'high',
		'show_names' => false, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Tag line',
				'desc'    => 'Text to display just beneath product title',
				'id'      => $prefix . 'line',
				'type'    => 'text',
			),
		),
	);

    // Product features tab

    $meta_boxes[] = array(
        'id' => 'wpsc-product-features',
        'title' => 'Product features',
        'pages' => array('wpsc-product'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'name'    => 'Product features text',
                'desc'    => 'Text to display in the product features tab',
                'id'      => '_product_features_text',
                'type'    => 'wysiwyg',
                'options' => array('textarea_rows' => 5, ),
            ),
        ),
    );

	$prefix = '_fluid_heads_tech_'; // Prefix for all fields
	
	$meta_boxes[] = array(
		'id' => 'fluid_heads_tech_metabox',
		'title' => 'Tech Specs',
		'pages' => array('wpsc-product'), // post type
		'show_on' => array( 'key' => 'taxonomy', 'value' => array('wpsc_product_category' => 'fluid-heads') ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Weight (kg)',
				'desc'    => 'Enter the weight in kg',
				'id'      => $prefix . 'weight',
				'type'    => 'text',
			),
			array(
				'name'    => 'Weight (lbs)',
				'desc'    => 'Enter the weight in lbs',
				'id'      => $prefix . 'weight_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (kg)',
				'desc'    => 'Enter the payload minimum in kg',
				'id'      => $prefix . 'payload_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (kg)',
				'desc'    => 'Enter the payload maximum in kg',
				'id'      => $prefix . 'payload_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (lbs)',
				'desc'    => 'Enter the payload minimum in lbs',
				'id'      => $prefix . 'payload_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (lbs)',
				'desc'    => 'Enter the payload maximum in lbs',
				'id'      => $prefix . 'payload_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Counterbalance Steps',
				'desc'    => 'Enter the number of counterbalance steps',
				'id'      => $prefix . 'counterbalance_steps',
				'type'    => 'text',
			),
			array(
				'name'    => 'Grades of Drag - Horizontal',
				'desc'    => 'Enter the number of horizontal drag grades (optional)',
				'id'      => $prefix . 'hor_drag_grades',
				'type'    => 'text',
			),
			array(
				'name'    => 'Grades of Drag - Vertical',
				'desc'    => 'Enter the number of vertical drag grades (optional)',
				'id'      => $prefix . 'ver_drag_grades',
				'type'    => 'text',
			),
			array(
				'name'    => 'Grades of Drag - Diagonal',
				'desc'    => 'Enter the number of diagonal drag grades (optional)',
				'id'      => $prefix . 'diag_drag_grades',
				'type'    => 'text',
			),
			array(
				'name'    => 'Tilt Range Max',
				'desc'    => 'Enter the maximum tilt range value in degrees, "90" will be shown as "+90"',
				'id'      => $prefix . 'tilt_range_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Tilt Range Min',
				'desc'    => 'Enter the maximum tilt range value in degrees, "90" will be shown as "-90"',
				'id'      => $prefix . 'tilt_range_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Slide range (mm)',
				'desc'    => 'Enter the slide range in mm',
				'id'      => $prefix . 'slide_range',
				'type'    => 'text',
			),
			array(
				'name'    => 'Slide range (in)',
				'desc'    => 'Enter the slide range in inches',
				'id'      => $prefix . 'slide_range_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Temperature Min (f)',
				'desc'    => 'Enter the minimum temperature in fahrenheit',
				'id'      => $prefix . 'temp_min', // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
				'type'    => 'text',
			),
			array(
				'name'    => 'Temperature Max (f)',
				'desc'    => 'Enter the maximum temperature in fahrenheit',
				'id'      => $prefix . 'temp_max', // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
				'type'    => 'text',
			),
			array(
				'name'    => 'Temperature Min (c)',
				'desc'    => 'Enter the minimum temperature in celcius',
				'id'      => $prefix . 'temp_min_imp', // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
				'type'    => 'text',
			),
			array(
				'name'    => 'Temperature Max (c)',
				'desc'    => 'Enter the maximum temperature in celcius',
				'id'      => $prefix . 'temp_max_imp', // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
				'type'    => 'text',
			),
			array(
				'name'    => 'Camera fitting',
				'desc'    => 'Select from the list of carmera fitting options',
				'id'      => $prefix . 'camera_fitting',
				'type'    => 'multicheck',
				'options' => array(
					'Ace Plate' => 'Ace Plate',
					'Sideload 30 HD' => 'Sideload 30 HD',
					'Sideload S' => 'Sideload S',
					'Sideload M' => 'Sideload M',
					'Touch & Go 35' => 'Touch & Go 35',
					'Touch & Go 16' => 'Touch & Go 16',
					'Touch & Go S' => 'Touch & Go S',
					'V Plate' => 'V Plate',
				),
			),
			array(
				'name'    => 'Head fitting',
				'desc'    => 'Select the compatable fitting options',
				'id'      => $prefix . 'head_fitting',
				'type'    => 'multicheck',
				'options' => array(
					'none (monopods)' => 'none (monopods)',
					'75 mm' => '75 mm',
					'100 mm' => '100 mm',
					'150 mm' => '150 mm',
					'Flat base' => 'Flat base',
					'Touch & Go 35 (Dutch head)' => 'Touch & Go 35 (Dutch head)',
					'Touch & Go 16 (Dutch head)' => 'Touch & Go 16 (Dutch head)'
				),
			),
			array(
				'name'    => 'Integrated flat base',
				'desc'    => 'Check if head fitting includes integrated flat base',
				'id'      => $prefix . 'flat_base',
				'type'    => 'checkbox',
			),
			array(
				'name'    => 'Optional ball adapter',
				'desc'    => 'Check if head fitting includes optional ball adapter',
				'id'      => $prefix . 'ball_adapter',
				'type'    => 'checkbox',
			),
			array(
				'name'    => 'Optional Mitchell adapter',
				'desc'    => 'Check if head fitting includes optional Mitchell adapter',
				'id'      => $prefix . 'mitchell_adapter',
				'type'    => 'checkbox',
			),
			array(
				'name'    => 'Pan bar type / number',
				'desc'    => 'Enter the number of bars and type: eg. "1, Type DV 75"',
				'id'      => $prefix . 'pan_bar',
				'type'    => 'text',
			),
			array(
				'name'    => 'Level',
				'desc'    => 'Select the type of level from the list',
				'id'      => $prefix . 'level',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '--Please select--', 'value' => '', ),
					array( 'name' => 'No', 'value' => 'No', ),
					array( 'name' => 'Yes', 'value' => 'Yes', ),
					array( 'name' => 'Illuminated', 'value' => 'Illuminated', ),
				),
			),
			array(
				'name'    => 'Adapter viewfinder extension',
				'desc'    => 'Indicate whether the head has a viewfinder extension',
				'id'      => $prefix . 'viewfinder',
				'type'    => 'select',
				'options' => array(
					array( 'name' => '--Please select--', 'value' => '', ),
					array( 'name' => 'None', 'value' => 'None', ),
					array( 'name' => 'Standard', 'value' => 'Standard', ),
					array( 'name' => 'Optional', 'value' => 'Optional', ),
				),
			),
		),
	);
	
	$prefix = '_tripods_tech_'; // Prefix for all fields
	
	$meta_boxes[] = array(
		'id' => 'tripods_tech_metabox',
		'title' => 'Tech Specs',
		'pages' => array('wpsc-product'), // post type
		'show_on' => array( 'key' => 'taxonomy', 'value' => array('wpsc_product_category' => 'tripods') ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Weight (kg)',
				'desc'    => 'Enter the weight in kg',
				'id'      => $prefix . 'weight',
				'type'    => 'text',
			),
			array(
				'name'    => 'Weight (lbs)',
				'desc'    => 'Enter the weight in lbs',
				'id'      => $prefix . 'weight_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (kg)',
				'desc'    => 'Enter the payload minimum in kg',
				'id'      => $prefix . 'payload_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (kg)',
				'desc'    => 'Enter the payload maximum in kg',
				'id'      => $prefix . 'payload_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (lbs)',
				'desc'    => 'Enter the payload minimum in lbs',
				'id'      => $prefix . 'payload_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (lbs)',
				'desc'    => 'Enter the payload maximum in lbs',
				'id'      => $prefix . 'payload_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Material',
				'desc'    => 'Select the tripod material',
				'id'      => $prefix . 'material',
				'taxonomy'	=> 'material',
				'type'    => 'taxonomy_multicheck',
			),
			array(
				'name'    => 'Height Min (cm)',
				'desc'    => 'Enter the minimum height in cm',
				'id'      => $prefix . 'height_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Max (cm)',
				'desc'    => 'Enter the maximum height in cm',
				'id'      => $prefix . 'height_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Min (in)',
				'desc'    => 'Enter the minimum height in inches',
				'id'      => $prefix . 'height_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Max (in)',
				'desc'    => 'Enter the maximum height in inches',
				'id'      => $prefix . 'height_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Head fitting',
				'desc'    => 'Select the compatable fitting options',
				'id'      => $prefix . 'head_fitting',
				'type'    => 'multicheck',
				'options' => array(
					'75 mm' => '75 mm',
					'100 mm' => '100 mm',
					'150 mm' => '150 mm',
					'Flat base' => 'Flat base',
				),
			),
			array(
				'name'    => 'Camera fitting',
				'desc'    => 'Select the compatable camera fitting options',
				'id'      => $prefix . 'camera_fitting',
				'type'    => 'multicheck',
				'options' => array(
					'Betacam Quick release' => 'Betacam Quick release',
					'Sandwich Touch & Go' => 'Sandwich Touch & Go',
				),
			),
			array(
				'name'    => 'Transport Length (cm)',
				'desc'    => 'Enter the transport length in cm',
				'id'      => $prefix . 'transport_length',
				'type'    => 'text',
			),
			array(
				'name'    => 'Transport Length (in)',
				'desc'    => 'Enter the transport length in inches',
				'id'      => $prefix . 'transport_length_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Stages',
				'desc'    => 'Select the number of stages',
				'id'      => $prefix . 'stages',
				'type'    => 'radio',
				'options' => array(
					array( 'name' => '0', 'value' => 0, ),
					array( 'name' => '1', 'value' => 1, ),
					array( 'name' => '2', 'value' => 2, ),
					array( 'name' => '3', 'value' => 3, ),
					array( 'name' => '4', 'value' => 4, ),
				),
			),
		),
	);
	
	$prefix = '_pedestals_tech_'; // Prefix for all fields
	
	$meta_boxes[] = array(
		'id' => 'pedestals_tech_metabox',
		'title' => 'Tech Specs',
		'pages' => array('wpsc-product'), // post type
		'show_on' => array( 'key' => 'taxonomy', 'value' => array('wpsc_product_category' => 'pedestals') ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Weight (kg)',
				'desc'    => 'Enter the weight in kg',
				'id'      => $prefix . 'weight',
				'type'    => 'text',
			),
			array(
				'name'    => 'Weight (lbs)',
				'desc'    => 'Enter the weight in lbs',
				'id'      => $prefix . 'weight_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (kg)',
				'desc'    => 'Enter the payload minimum in kg',
				'id'      => $prefix . 'payload_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (kg)',
				'desc'    => 'Enter the payload maximum in kg',
				'id'      => $prefix . 'payload_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (lbs)',
				'desc'    => 'Enter the payload minimum in lbs',
				'id'      => $prefix . 'payload_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (lbs)',
				'desc'    => 'Enter the payload maximum in lbs',
				'id'      => $prefix . 'payload_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Min (cm)',
				'desc'    => 'Enter the minimum height in cm',
				'id'      => $prefix . 'height_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Max (cm)',
				'desc'    => 'Enter the maximum height in cm',
				'id'      => $prefix . 'height_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Min (in)',
				'desc'    => 'Enter the minimum height in inches',
				'id'      => $prefix . 'height_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Max (in)',
				'desc'    => 'Enter the maximum height in inches',
				'id'      => $prefix . 'height_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Head fitting',
				'desc'    => 'Select the compatable fitting options',
				'id'      => $prefix . 'head_fitting',
				'type'    => 'multicheck',
				'options' => array(
					'Flat base' => 'Flat base',
				),
			),
			array(
				'name'    => 'Quick fix',
				'desc'    => 'Check if head fitting includes quick fix',
				'id'      => $prefix . 'quick_fix',
				'type'    => 'checkbox',
			),
			array(
				'name'    => 'On-shot stroke (cm)',
				'desc'    => 'Enter the on-shot stroke in cm',
				'id'      => $prefix . 'on_shot_stroke',
				'type'    => 'text',
			),
			array(
				'name'    => 'On-shot stroke (in)',
				'desc'    => 'Enter the on-shot stroke in inches',
				'id'      => $prefix . 'on_shot_stroke_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Clearance (cm)',
				'desc'    => 'Enter the clearance in cm',
				'id'      => $prefix . 'clearance',
				'type'    => 'text',
			),
			array(
				'name'    => 'Clearance (in)',
				'desc'    => 'Enter the clearance in inches',
				'id'      => $prefix . 'clearance_imp',
				'type'    => 'text',
			),
		),
	);
	
	$prefix = '_tripod_systems_tech_'; // Prefix for all fields
	
	wp_reset_postdata();
	$fluid_heads_list[] = array('name' => 'Select Fluid Head', 'value' => 0);
	$query = new WP_Query( array( 'post_type' => array('wpsc-product'), 'wpsc_product_category' => 'fluid-heads', 'posts_per_page' => -1,'orderby' => 'name', 'order' => 'ASC'));
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$fluid_heads_list[] = array('name' => get_the_title(), 'value' => get_the_ID());
		}
	}
	wp_reset_postdata();
	$tripods_list[] = array('name' => 'Select Tripod', 'value' => 0);
	$query = new WP_Query( array( 'post_type' => array('wpsc-product'), 'wpsc_product_category' => 'tripods', 'posts_per_page' => -1,'orderby' => 'name', 'order' => 'ASC'));
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$tripods_list[] = array('name' => get_the_title(), 'value' => get_the_ID());
		}
	}
	wp_reset_postdata();
	
	$meta_boxes[] = array(
		'id' => 'tripod_systems_tech_metabox',
		'title' => 'Tech Specs',
		'pages' => array('wpsc-product'), // post type
		'show_on' => array( 'key' => 'taxonomy', 'value' => array('wpsc_product_category' => 'tripod-systems') ),
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Fluid head',
				'desc'    => 'Select the fluid head for this system',
				'id'      => $prefix . 'fluid-head',
				'type'    => 'select',
				'options' => $fluid_heads_list,
			),
			array(
				'name'    => 'Tripod',
				'desc'    => 'Select the Tripod for this system',
				'id'      => $prefix . 'tripod',
				'type'    => 'select',
				'options' => $tripods_list,
			),
			array(
				'name'    => 'Spreader',
				'desc'    => 'Select the Spreader for this system',
				'id'      => $prefix . 'spreader',
				'type'    => 'select',
				'options' => array(
					array('name' => 'Select Spreader', 'value' => 0),
					array('name' => 'Ground spreader', 'value' => 'Ground spreader'),
					array('name' => 'Mid-level spreader', 'value' => 'Mid-level spreader'),
				),
			),
			array(
				'name'    => 'Weight (kg)',
				'desc'    => 'Enter the weight in kg',
				'id'      => $prefix . 'weight',
				'type'    => 'text',
			),
			array(
				'name'    => 'Weight (lbs)',
				'desc'    => 'Enter the weight in lbs',
				'id'      => $prefix . 'weight_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (kg)',
				'desc'    => 'Enter the payload minimum in kg',
				'id'      => $prefix . 'payload_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (kg)',
				'desc'    => 'Enter the payload maximum in kg',
				'id'      => $prefix . 'payload_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Min (lbs)',
				'desc'    => 'Enter the payload minimum in lbs',
				'id'      => $prefix . 'payload_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Payload Max (lbs)',
				'desc'    => 'Enter the payload maximum in lbs',
				'id'      => $prefix . 'payload_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Min (cm)',
				'desc'    => 'Enter the minimum height in cm',
				'id'      => $prefix . 'height_min',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Max (cm)',
				'desc'    => 'Enter the maximum height in cm',
				'id'      => $prefix . 'height_max',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Min (in)',
				'desc'    => 'Enter the minimum height in inches',
				'id'      => $prefix . 'height_min_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Height Max (in)',
				'desc'    => 'Enter the maximum height in inches',
				'id'      => $prefix . 'height_max_imp',
				'type'    => 'text',
			),
			array(
				'name'    => 'Head fitting',
				'desc'    => 'Select the compatable fitting options',
				'id'      => $prefix . 'head_fitting',
				'type'    => 'multicheck',
				'options' => array(
					'75 mm' => '75 mm',
					'100 mm' => '100 mm',
					'150 mm' => '150 mm',
				),
			),
			array(
				'name'    => 'Transport Length (cm)',
				'desc'    => 'Enter the transport length in cm',
				'id'      => $prefix . 'transport_length',
				'type'    => 'text',
			),
			array(
				'name'    => 'Transport Length (in)',
				'desc'    => 'Enter the transport length in inches',
				'id'      => $prefix . 'transport_length_imp',
				'type'    => 'text',
			),
		),
	);
	
	$prefix = '_feature_'; // Prefix for all fields
	
	$meta_boxes[] = array(
		'id' => 'feature_metabox',
		'title' => 'Feature page content',
		'pages' => array('feature'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Author name',
				'desc'    => 'Enter the name of the author of this feature',
				'id'      => $prefix . 'author',
				'type'    => 'text',
			),
			array(
				'name'    => 'Author occupation',
				'desc'    => "Enter the author's occupation",
				'id'      => $prefix . 'occupation',
				'type'    => 'text',
			),
			array(
				'name'    => 'Main quote',
				'desc'    => 'Enter text for the main feature quote',
				'id'      => $prefix . 'main_quote',
				'type'    => 'textarea',
			),
			array(
				'name'    => 'Main quote author',
				'desc'    => 'Enter the name of the quote author',
				'id'      => $prefix . 'main_quote_author',
				'type'    => 'text',
			),
			array(
				'name'    => 'Equipment list title',
				'desc'    => 'Enter a title for the equipment list',
				'id'      => $prefix . 'equipment_title',
				'type'    => 'text',
			),
			array(
				'name'    => 'Equipment list description',
				'desc'    => 'Give a brief description for the equipment used in this feature',
				'id'      => $prefix . 'equipment_desc',
				'type'    => 'wysiwyg',
				'options' => array(
					'wpautop' => true, // use wpautop?
					'media_buttons' => false, // show insert/upload button(s)
					'textarea_name' => $prefix . 'equipment_desc', // set the textarea name to something different, square brackets [] can be used here
					'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
					'tabindex' => '',
					'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
					'editor_class' => '', // add extra class(es) to the editor textarea
					'teeny' => false, // output the minimal editor config used in Press This
					'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
					'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
					'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()	
				),
			),
			array(
				'name'    => 'Supporting copy',
				'desc'    => 'Enter any additional supporting copy for this feature, typically an interview with the feature subject',
				'id'      => $prefix . 'supporting_copy',
				'type'    => 'wysiwyg',
				'options' => array(
					'wpautop' => true, // use wpautop?
					'media_buttons' => false, // show insert/upload button(s)
					'textarea_name' => $prefix . 'supporting_copy', // set the textarea name to something different, square brackets [] can be used here
					'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
					'tabindex' => '',
					'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the <style> tags, can use "scoped".
					'editor_class' => '', // add extra class(es) to the editor textarea
					'teeny' => false, // output the minimal editor config used in Press This
					'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
					'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
					'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()	
				),
			),
		),
	);

    $meta_boxes[] = array(
        'id' => 'feature_equipment_title',
        'title' => 'Feature equipment list title',
        'pages' => array('feature'), // post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name'    => 'AFeature equipment list title',
                'desc'    => 'Enter the name of the author of this feature',
                'id'      => $prefix . 'author',
                'type'    => 'text',
            ),
        ),
    );




	$prefix = '_content_'; // Prefix for all fields
	
	$meta_boxes[] = array(
		'id' => 'content_metabox',
		'title' => 'Content page content',
		'pages' => array('content'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name'    => 'Red Box',
				'desc'    => 'Enter the text which appears on the red box',
				'id'      => $prefix . 'redbox',
				'type'    => 'text',
			),
			
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'tech_metaboxes' );

// ADD HIERACHICAL FILTER TO METABOXES

function taxonomy_show_on_filter( $display, $meta_box ) {

	if ( 'taxonomy' !== $meta_box['show_on']['key'] )
		return $display;

	if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	if( !isset( $post_id ) )
		return $display;
	
	foreach( $meta_box['show_on']['value'] as $taxonomy => $slugs ) {
		if( !is_array( $slugs ) )
			$slugs = array( $slugs );
		
		$display = false;			
		$terms = wp_get_object_terms( $post_id, $taxonomy );
			foreach( $terms as $term ) {
				while($term->parent != 0) {
					$term = get_term($term->parent,$taxonomy);
				}
				if( in_array( $term->slug, $slugs ) )
					$display = true;
			}
	}
	
	return $display;
	
}
add_filter( 'cmb_show_on', 'taxonomy_show_on_filter', 10, 2 );


// CUSTOM EXCERPT LENGTH

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// CUSTOM MORE LINK

function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_facebook_feed($span) {
	global $RFB;
	$options = $RFB->get_options();
	
	$doc = new DOMDocument();
	$doc->loadHTML(do_shortcode('[recent-facebook-posts number=1 likes=0 comments=0 excerpt_length=300]'));

	$finder = new DOMXPath($doc);
	$posts = $finder->query("//*[contains(@class, 'rfb-post')]");
	$images = $finder->query("//*[contains(@class, 'rfb_image')]");
	$links = $finder->query("//*[contains(@class, 'rfb_link')]");
	
	
	
	$div = $doc->createElement('div');
	$div->setAttribute('class','rfb_main_link'.' span12');

	

	$socialBt = $doc->createElement('div');
	$socialBt->setAttribute('class','socialButtons span6 right');

	$Twitter = $doc->createElement('a');
	$Twitter->setAttribute('title', 'Twitter');
	$Twitter->setAttribute('href','http://twitter.com/'.$options['tw_id']);
	$Twitter->setAttribute('target','_blank');
	$Twitter->setAttribute('class','twitter-link');
	$socialBt->appendChild($Twitter);

    $Pinterest = $doc->createElement('a');
    $Pinterest->setAttribute('title', 'Pinterest');
    $Pinterest->setAttribute('href','http://www.pinterest.com/'.$options['pi_id']);
    $Pinterest->setAttribute('target','_blank');
    $Pinterest->setAttribute('class','pinterest-link');
    $socialBt->appendChild($Pinterest);

    $GooglePlus = $doc->createElement('a');
    $GooglePlus->setAttribute('title', 'Google+');
    $GooglePlus->setAttribute('href','https://plus.google.com/'.$options['pi_id']);
    $GooglePlus->setAttribute('target','_blank');
    $GooglePlus->setAttribute('class','google-link');
    $socialBt->appendChild($GooglePlus);


	$Facebook = $doc->createElement('a','facebook.com/'.$options['fb_id']);
	$Facebook->setAttribute('href','http://facebook.com/'.$options['fb_id']);
	$Facebook->setAttribute('target','_blank');
	$Facebook->setAttribute('class','facebook-link');
	$socialBt->appendChild($Facebook);

	/*
	$Youtube = $doc->createElement('a','Youtube'.$options['tw_id']);
	$Youtube->setAttribute('href','http://youtube.com/'.$options['tw_id']);
	$Youtube->setAttribute('target','_blank');
	$Youtube->setAttribute('class','Youtube-link');
	$socialBt->appendChild($Youtube);
	

	$Instagram = $doc->createElement('a','Instagram'.$options['tw_id']);
	$Instagram->setAttribute('href','http://instagram.com/'.$options['tw_id']);
	$Instagram->setAttribute('target','_blank');
	$Instagram->setAttribute('class','Instagram-link');
	$socialBt->appendChild($Instagram);

    */
	
	$div->appendChild($socialBt);
	
	$posts->item(0)->parentNode->insertBefore($div,$posts->item(0));
	$posts->item(0)->setAttribute('class',$posts->item(0)->getAttribute('class').' new-line');
	
	foreach($posts as $post){
		$post->setAttribute('class',$post->getAttribute('class').' span11');
	}
	
	foreach($images as $image){
		$firstElement = $image->parentNode->getElementsByTagName( 'p' )->item( 0 );
		$image->parentNode->insertBefore($image,$firstElement);
	}
	
	foreach($links as $link){
		//$url = $link->getAttribute('href');
		//$like = $doc->createElement('a','Like');
		//$like->setAttribute('href','http://facebook.com/plugins/like.php?href='.urlencode($url));
		//$link->parentNode->appendChild($like);
	}
	
	//$output = str_replace('rfb-post','rfb-post '.$span,$doc->saveHTML());
	
	$output =  $doc->saveHTML() ;

	return 	'<div class="center span12"><div class="span8 center">' .$output . '</div></div>';
}






// PRODUCTS PAGE FUNCTIONS


function get_images_for_product($id,$lightbox=false){
   global $wpdb;
   $post_thumbnail = get_post_thumbnail_id();//read the thumbnail id
   $attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_parent = $id AND post_type = 'attachment' AND post_content = '' ORDER BY menu_order ASC",$id));?>
   <ul class="gallery"><!--
   <?php foreach ($attachments as $attachment){
      if (strpos($attachment->post_mime_type,'image') !== false ){//if we haven't already got the attachment as the post thumbnail
		 $image_attributes = wp_get_attachment_image_src($attachment->ID,'full');?>
	--><li>
    <?php if($lightbox) echo '<a rel="lightbox['.wpsc_the_product_title().']" href="'.$attachment->guid.'" >';?>
		<img src="<?php echo $image_attributes[0]; ?>" alt="<?php echo get_post( $attachment->ID )->post_excerpt; ?>"/>
	<?php if($lightbox) echo '</a>';?>
    </li><!--
   <?php } ?>
   <?php } ?>
   --></ul>
<?php }



function get_product_specs($id,$single,$short = false) {
	
	// Set the ID if it is not specified and set other variables
	if(!$id) $id = get_the_id();
	$taxonomy = 'wpsc_product_category';
	$cat_hierachy = array();
	$output = array();
	$return_string;
	$spec_format = '<p class="tech-%1$s %2$s">%3$s</p>'."\n";
	
	// Get the product category hierachical list
	$terms = wp_get_object_terms( $id, $taxonomy );
	foreach( $terms as $term ) {
		$cat_hierachy[] = $term->slug;
		while($term->parent != 0) {
			$term = get_term($term->parent,$taxonomy);
			$cat_hierachy[] = $term->slug;
		}
	}
	if (in_array($output['cat']='fluid-heads',$cat_hierachy)) {
		
		// Fluid Heads Tech Spec output here...
		
		// Set all variables
		
		$prefix = '_fluid_heads_tech_';
		$weight = get_post_meta( $id, $prefix.'weight' , true );
		$weight_imp = get_post_meta( $id, $prefix.'weight_imp' , true );
		$payload_min = get_post_meta( $id, $prefix.'payload_min' , true );
		$payload_max = get_post_meta( $id, $prefix.'payload_max' , true );
		$payload_min_imp = get_post_meta( $id, $prefix.'payload_min_imp' , true );
		$payload_max_imp = get_post_meta( $id, $prefix.'payload_max_imp' , true );
		$counterbalance_steps = get_post_meta( $id, $prefix.'counterbalance_steps' , true );
		$hor_drag_grades = get_post_meta( $id, $prefix.'hor_drag_grades' , true );
		$ver_drag_grades = get_post_meta( $id, $prefix.'ver_drag_grades' , true );
		$diag_drag_grades = get_post_meta( $id, $prefix.'diag_drag_grades' , true );
		$tilt_range_max = get_post_meta( $id, $prefix.'tilt_range_max' , true );
		$tilt_range_min = get_post_meta( $id, $prefix.'tilt_range_min' , true );
		$slide_range = get_post_meta( $id, $prefix.'slide_range' , true );
		$slide_range_imp = get_post_meta( $id, $prefix.'slide_range_imp' , true );
		$temp_min = get_post_meta( $id, $prefix.'temp_min_imp' , true ); // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
		$temp_min_imp = get_post_meta( $id, $prefix.'temp_min' , true ); // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
		$temp_max = get_post_meta( $id, $prefix.'temp_max_imp' , true ); // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
		$temp_max_imp = get_post_meta( $id, $prefix.'temp_max' , true ); // GOT THIS WRONG WAY ROUND BUT MUST STAY DUE TO INPUT DATA
		$camera_fitting = get_post_meta( $id, $prefix.'camera_fitting');
		$head_fitting = get_post_meta( $id, $prefix.'head_fitting');
		$flat_base = get_post_meta( $id, $prefix.'flat_base');
		$ball_adapter = get_post_meta( $id, $prefix.'ball_adapter');
		$mitchell_adapter = get_post_meta( $id, $prefix.'mitchell_adapter');
		$pan_bar = get_post_meta( $id, $prefix.'pan_bar' , true );
		$level = get_post_meta( $id, $prefix.'level' , true );
		$viewfinder = get_post_meta( $id, $prefix.'viewfinder' , true );
		
		// Long & Short formats
		
		$str_weight = ($short ? '<span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>' : 'Weight: <span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>');
		$str_payload_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>' : 'Payload: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>');
		$str_payload_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Payload: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_counterbalance_steps = ($short ? '%1$s steps +0' : '%1$s counterbalance steps +0');
		$str_drag_grades_same = ($short ? '%1$s / %1$s + 0' : '%1$s horizontal and vertical grades of drag, +0');
		$str_drag_grades_dif = ($short ? '%1$s / %2$s + 0' : '%1$s horizontal and %2$s vertical grades of drag, +0');
		$str_drag_grades_hor = ($short ? '%1$s hor + 0' : '%1$s horizontal grades of drag, +0');
		$str_drag_grades_ver = ($short ? '%1$s ver + 0' : '%1$s vertical grades of drag, +0');
		$str_drag_grades_diag = ($short ? '%1$s diag + 0' : '%1$s diagonal grades of drag, +0');
		$str_tilt_range = ($short ? '+%1$s&ordm ;&ndash; -%2$s&ordm;' : 'Tilt range: +%1$s&ordm; to -%2$s&ordm;');
		$str_slide_range = ($short ? '<span class="metric">%1$s mm</span><span class="imperial">%2$s in</span>' : 'Slide range: <span class="metric">%1$s mm</span><span class="imperial">%2$s in</span>');
		$str_temp = ($short ? '<span class="metric">%1$s&ordm;</span><span class="imperial">%2$s&ordm;</span>&ndash;<span class="metric">%3$s&ordm;c</span><span class="imperial">%4$s&ordm;f</span>' : 'Temperature range: <span class="metric">%1$s&ordm;</span><span class="imperial">%2$s&ordm;</span>&ndash;<span class="metric">%3$s&ordm;c</span><span class="imperial">%4$s&ordm;f</span>');
		$str_temp_single = ($short ? '<span class="metric">%1$s%3$s&ordm;f</span><span class="imperial">%2$s%4$s&ordm;c</span>' : 'Temperature range: <span class="metric">%1$s%2$s&ordm;f</span><span class="imperial">%3$s%4$s&ordm;c</span>');
		$str_camera_fitting = ($short ? '%1$s' : 'Camera fitting: %1$s');
		$str_head_fitting = ($short ? '%1$s' : 'Head fitting: %1$s');
		$str_flat_base = ($short ? 'Flat base' : 'Integrated flat base');
		$str_ball_adapter = ($short ? 'Opt. ball Adapter' : 'Optional ball adapter');
		$str_mitchell_adapter = ($short ? 'Opt. Mitchell adapter' : 'Optional Mitchell adapter');
		$str_pan_bar = ($short ? '%1$s' : 'Pan bar type / number: %1$s');
		$str_level = ($short ? '%1$s' : 'Level: %1$s');
		$str_viewfinder = ($short ? '%1$s' : 'Adapter viewfinder extension: %1$s');
		
		
		// Build strings
		
		if ($weight !== '' && $weight_imp !== '') {
			$output['weight'] = sprintf($str_weight,$weight,$weight_imp);
		}
		
		if ($payload_min !== '' && $payload_max !== '' && $payload_min_imp !== '' && $payload_max_imp !== '') {
			$output['payload'] = sprintf($str_payload_range,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		} elseif ($payload_min !== '' && $payload_min_imp !== '' || $payload_max !== '' && $payload_max_imp !== '' ) {
			$output['payload'] = sprintf($str_payload_single,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		}
		
		if ($counterbalance_steps !== '') $output['counterbalance_steps'] = sprintf($str_counterbalance_steps,$counterbalance_steps);
		
		if ($hor_drag_grades !== '' && $ver_drag_grades !== '') {
			if ($hor_drag_grades == $ver_drag_grades) {
				$output['drag_grades'] = sprintf($str_drag_grades_same,$hor_drag_grades);
			} else {
				$output['drag_grades'] = sprintf($str_drag_grades_dif,$hor_drag_grades,$ver_drag_grades);
			}
		} elseif ($hor_drag_grades !== '') {
			$output['drag_grades'] = sprintf($str_drag_grades_hor,$hor_drag_grades);
		} elseif ($ver_drag_grades !== '') {
			$output['drag_grades'] = sprintf($str_drag_grades_ver,$ver_drag_grades);
		} elseif ($diag_drag_grades !== '') {
			$output['drag_grades'] = sprintf($str_drag_grades_diag,$diag_drag_grades);
		}
		
		if ($tilt_range_max !== '' && $tilt_range_min !== '') {
			$output['tilt_range'] = sprintf($str_tilt_range,$tilt_range_max,$tilt_range_min);
		}
		
		if ($slide_range !== '' && $slide_range_imp !== '') {
			$output['slide_range'] = sprintf($str_slide_range,$slide_range,$slide_range_imp);
		}
		
		if ($temp_min !== '' && $temp_max !== '' && $temp_min_imp !== '' && $temp_max_imp !== '') {
			$output['temp'] = sprintf($str_temp,$temp_min,$temp_min_imp,$temp_max,$temp_max_imp);
		} elseif ($temp_min !== '' && $temp_min_imp !== '' || $temp_max !== '' && $temp_max_imp !== '' ) {
			$output['temp'] = sprintf($str_temp_single,$temp_min,$temp_min_imp,$temp_max,$temp_max_imp);
		}
		
		if ($camera_fitting !== '') $output['camera_fitting'] = sprintf($str_camera_fitting,implode(', ',$camera_fitting));
		
		if ($head_fitting !== '') $output['head_fitting'] = sprintf($str_head_fitting,implode(', ',$head_fitting));
		
		if ($flat_base) $output['flat_base'] = $str_flat_base;
		
		if ($ball_adapter) $output['ball_adapter'] = $str_ball_adapter;
		
		if ($mitchell_adapter) $output['mitchell_adapter'] = $str_mitchell_adapter;
		
		if ($pan_bar !== '') $output['pan_bar'] = sprintf($str_pan_bar,$pan_bar);
		
		if ($level !== '') $output['level'] = sprintf($str_level,$level);
		
		if ($viewfinder !== '') $output['viewfinder'] = sprintf($str_viewfinder,$viewfinder);
		
	} elseif (in_array($output['cat']='tripods',$cat_hierachy)) {
		
		// Tripods Tech Spec output here...
		
		// Set all variables
		
		$prefix = '_tripods_tech_';
		$weight = get_post_meta( $id, $prefix.'weight' , true );
		$weight_imp = get_post_meta( $id, $prefix.'weight_imp' , true );
		$payload_min = get_post_meta( $id, $prefix.'payload_min' , true );
		$payload_max = get_post_meta( $id, $prefix.'payload_max' , true );
		$payload_min_imp = get_post_meta( $id, $prefix.'payload_min_imp' , true );
		$payload_max_imp = get_post_meta( $id, $prefix.'payload_max_imp' , true );
		$material = get_the_terms($post->ID,'material');
		$height_min = get_post_meta( $id, $prefix.'height_min' , true );
		$height_min_imp = get_post_meta( $id, $prefix.'height_min_imp' , true );
		$height_max = get_post_meta( $id, $prefix.'height_max' , true );
		$height_max_imp = get_post_meta( $id, $prefix.'height_max_imp' , true );
		$head_fitting = get_post_meta( $id, $prefix.'head_fitting');
		$camera_fitting = get_post_meta( $id, $prefix.'camera_fitting');
		$transport_length = get_post_meta( $id, $prefix.'transport_length' , true );
		$transport_length_imp = get_post_meta( $id, $prefix.'transport_length_imp' , true );
		$stages = get_post_meta( $id, $prefix.'stages');
		
		// Long and short formats
		
		$str_weight = ($short ? '<span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>' : 'Weight: <span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>');
		$str_payload_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>' : 'Payload: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>');
		$str_payload_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Payload: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_material = ($short ? '<span class="material %1$s">%1$s</span><div class="material-desc %1$s">%2$s</div>' : 'Material: <span class="material %1$s">%1$s</span><div class="material-desc %1$s">%2$s</div>');
		$str_height_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s cm</span><span class="imperial">%4$s in</span>' : 'Height range: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s cm</span><span class="imperial">%4$s in</span>');
		$str_height_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Height: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_head_fitting = ($short ? '%1$s' : 'Head fitting: %1$s');
		$str_camera_fitting = ($short ? '%1$s' : 'Camera fitting: %1$s');
		$str_transport_length = ($short ? '<span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>' : 'Transport length: <span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>');
		$str_stages = ($short ? '%1$s' : '%1$s stages');
		
		// Build strings
		
		if ($weight !== '' && $weight_imp !== '') {
			$output['weight'] = sprintf($str_weight,$weight,$weight_imp);
		}
		
		if ($payload_min !== '' && $payload_max !== '' && $payload_min_imp !== '' && $payload_max_imp !== '') {
			$output['payload'] = sprintf($str_payload_range,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		} elseif ($payload_min !== '' && $payload_min_imp !== '' || $payload_max !== '' && $payload_max_imp !== '' ) {
			$output['payload'] = sprintf($str_payload_single,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		}
		
		if (!empty($material)) $output['material'] = sprintf($str_material,end($material)->name,end($material)->description);
		
		if ($height_min !== '' && $height_max !== '' && $height_min_imp !== '' && $height_max_imp !== '') {
			$output['height'] = sprintf($str_height_range,$height_min,$height_min_imp,$height_max,$height_max_imp);
		} elseif ($height_min !== '' && $height_min_imp !== '' || $height_max !== '' && $height_max_imp !== '' ) {
			$output['height'] = sprintf($str_height_single,$height_min,$height_min_imp,$height_max,$height_max_imp);
		}
		
		if (!empty($head_fitting)) $output['head_fitting'] = sprintf($str_head_fitting,implode(', ',$head_fitting));
		
		if (!empty($camera_fitting)) $output['camera_fitting'] = sprintf($str_camera_fitting,implode(', ',$camera_fitting));
		
		if ($transport_length !== '' && $transport_length_imp !== '') {
			$output['transport_length'] = sprintf($str_transport_length,$transport_length,$transport_length_imp);
		}
		
		if (end($stages)) $output['stages'] = sprintf($str_stages, end($stages));
		
	} elseif (in_array($output['cat']='pedestals',$cat_hierachy)) {
		
		// Pedestals Tech Spec output here...
		
		// Set all variables
		
		$prefix = '_pedestals_tech_';
		$weight = get_post_meta( $id, $prefix.'weight' , true );
		$weight_imp = get_post_meta( $id, $prefix.'weight_imp' , true );
		$payload_min = get_post_meta( $id, $prefix.'payload_min' , true );
		$payload_max = get_post_meta( $id, $prefix.'payload_max' , true );
		$payload_min_imp = get_post_meta( $id, $prefix.'payload_min_imp' , true );
		$payload_max_imp = get_post_meta( $id, $prefix.'payload_max_imp' , true );
		$height_min = get_post_meta( $id, $prefix.'height_min' , true );
		$height_min_imp = get_post_meta( $id, $prefix.'height_min_imp' , true );
		$height_max = get_post_meta( $id, $prefix.'height_max' , true );
		$height_max_imp = get_post_meta( $id, $prefix.'height_max_imp' , true );
		$head_fitting = get_post_meta( $id, $prefix.'head_fitting');
		$quick_fix = get_post_meta( $id, $prefix.'quick_fix');
		$on_shot_stroke = get_post_meta( $id, $prefix.'on_shot_stroke' , true );
		$on_shot_stroke_imp = get_post_meta( $id, $prefix.'on_shot_stroke_imp' , true );
		$clearance = get_post_meta( $id, $prefix.'clearance' , true );
		$clearance_imp = get_post_meta( $id, $prefix.'clearance_imp' , true );
		
		// Long and short formats
		
		$str_weight = ($short ? '<span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>' : 'Weight: <span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>');
		$str_payload_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>' : 'Payload: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>');
		$str_payload_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Payload: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_height_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s cm</span><span class="imperial">%4$s in</span>' : 'Height range: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s cm</span><span class="imperial">%4$s in</span>');
		$str_height_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Height: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_head_fitting = ($short ? '%1$s' : 'Head fitting: %1$s');
		$str_quick_fix = ($short ? ' + quick fix' : ' with quick fix');
		$str_on_shot_stroke = ($short ? '<span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>' : 'On-shot stroke: <span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>');
		$str_clearance = ($short ? '<span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>' : 'Clearance: <span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>');
		
		// Build strings
		
		if ($weight !== '' && $weight_imp !== '') {
			$output['weight'] = sprintf($str_weight,$weight,$weight_imp);
		}
		
		if ($payload_min !== '' && $payload_max !== '' && $payload_min_imp !== '' && $payload_max_imp !== '') {
			$output['payload'] = sprintf($str_payload_range,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		} elseif ($payload_min !== '' && $payload_min_imp !== '' || $payload_max !== '' && $payload_max_imp !== '' ) {
			$output['payload'] = sprintf($str_payload_single,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		}
		
		if ($height_min !== '' && $height_max !== '' && $height_min_imp !== '' && $height_max_imp !== '') {
			$output['height'] = sprintf($str_height_range,$height_min,$height_min_imp,$height_max,$height_max_imp);
		} elseif ($height_min !== '' && $height_min_imp !== '' || $height_max !== '' && $height_max_imp !== '' ) {
			$output['height'] = sprintf($str_height_single,$height_min,$height_min_imp,$height_max,$height_max_imp);
		}
		
		if (!empty($head_fitting)) $output['head_fitting'] = sprintf($str_head_fitting,implode(', ',$head_fitting));
		
		if ($quick_fix && !empty($head_fitting)) $output['head_fitting'] .= $str_quick_fix;
		
		if ($on_shot_stroke !== '' && $on_shot_stroke_imp !== '') {
			$output['on_shot_stroke'] = sprintf($str_on_shot_stroke,$on_shot_stroke,$on_shot_stroke_imp);
		}
		
		if ($clearance !== '' && $clearance_imp !== '') {
			$output['clearance'] = sprintf($str_clearance,$clearance,$clearance_imp);
		}
		
	} elseif (in_array($output['cat']='tripod-systems',$cat_hierachy)) {
		
		// Tripod Systems Tech Spec output here...
		
		// Set all variables
		
		$prefix = '_tripod_systems_tech_';
		$fluid_head = get_post(get_post_meta( $id, $prefix.'fluid-head', true));
		$tripod = get_post(get_post_meta( $id, $prefix.'tripod', true));
		$spreader = get_post_meta( $id, $prefix.'spreader', true );
		$weight = get_post_meta( $id, $prefix.'weight' , true );
		$weight_imp = get_post_meta( $id, $prefix.'weight_imp' , true );
		$payload_min = get_post_meta( $id, $prefix.'payload_min' , true );
		$payload_max = get_post_meta( $id, $prefix.'payload_max' , true );
		$payload_min_imp = get_post_meta( $id, $prefix.'payload_min_imp' , true );
		$payload_max_imp = get_post_meta( $id, $prefix.'payload_max_imp' , true );
		$height_min = get_post_meta( $id, $prefix.'height_min' , true );
		$height_min_imp = get_post_meta( $id, $prefix.'height_min_imp' , true );
		$height_max = get_post_meta( $id, $prefix.'height_max' , true );
		$height_max_imp = get_post_meta( $id, $prefix.'height_max_imp' , true );
		$head_fitting = get_post_meta( $id, $prefix.'head_fitting');
		$transport_length = get_post_meta( $id, $prefix.'transport_length' , true );
		$transport_length_imp = get_post_meta( $id, $prefix.'transport_length_imp' , true );
		
		// Long and short formats
		
		$str_fluid_head = ($short ? '<a href="%1$s" title="%2$s">%2$s</a>' : 'Fluid head: <a href="%1$s" title="%2$s">%2$s</a>');
		$str_tripod = ($short ? '<a href="%1$s" title="%2$s">%2$s</a>' : 'Tripod: <a href="%1$s" title="%2$s">%2$s</a>');
		$str_spreader = ($short ? '%1$s' : 'Spreader: %1$s');
		$str_weight = ($short ? '<span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>' : 'Weight: <span class="metric">%1$s kg</span><span class="imperial">%2$s lbs</span>');
		$str_payload_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>' : 'Payload: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s kg</span><span class="imperial">%4$s lbs</span>');
		$str_payload_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Payload: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_height_range = ($short ? '<span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s cm</span><span class="imperial">%4$s in</span>' : 'Height range: <span class="metric">%1$s</span><span class="imperial">%2$s</span>&ndash;<span class="metric">%3$s cm</span><span class="imperial">%4$s in</span>');
		$str_height_single = ($short ? '<span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>' : 'Height: <span class="metric">%1$s%3$s kg</span><span class="imperial">%2$s%4$s lbs</span>');
		$str_head_fitting = ($short ? '%1$s' : 'Head fitting: %1$s');
		$str_transport_length = ($short ? '<span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>' : 'Transport length: <span class="metric">%1$s cm</span><span class="imperial">%2$s in</span>');
		$str_extension = ($short ? '%1$s' : 'Extension: %1$s');
		
		// Build strings
		
		if (!empty($fluid_head)) {
			$output['fluid_head'] = sprintf($str_fluid_head,get_permalink( $fluid_head->ID ),$fluid_head->post_title);
		}
		
		if (!empty($tripod)) {
			$output['tripod'] = sprintf($str_tripod,get_permalink( $tripod->ID ),$tripod->post_title);
		}
		
		if ($spreader) {
			$output['spreader'] = sprintf($str_spreader,$spreader);
		}
		
		if ($weight !== '' && $weight_imp !== '') {
			$output['weight'] = sprintf($str_weight,$weight,$weight_imp);
		}
		
		if ($payload_min !== '' && $payload_max !== '' && $payload_min_imp !== '' && $payload_max_imp !== '') {
			$output['payload'] = sprintf($str_payload_range,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		} elseif ($payload_min !== '' && $payload_min_imp !== '' || $payload_max !== '' && $payload_max_imp !== '' ) {
			$output['payload'] = sprintf($str_payload_single,$payload_min,$payload_min_imp,$payload_max,$payload_max_imp);
		}
		
		if ($height_min !== '' && $height_max !== '' && $height_min_imp !== '' && $height_max_imp !== '') {
			$output['height'] = sprintf($str_height_range,$height_min,$height_min_imp,$height_max,$height_max_imp);
		} elseif ($height_min !== '' && $height_min_imp !== '' || $height_max !== '' && $height_max_imp !== '' ) {
			$output['height'] = sprintf($str_height_single,$height_min,$height_min_imp,$height_max,$height_max_imp);
		}
		
		if ($head_fitting !== '') $output['head_fitting'] = sprintf($str_head_fitting,implode(', ',$head_fitting));
		
		if ($transport_length !== '' && $transport_length_imp !== '') {
			$output['transport_length'] = sprintf($str_transport_length,$transport_length,$transport_length_imp);
		}
		
	}
	
	// Build output
		
	foreach ( $output as $label => $spec ) {
		if ($label != 'cat') $return_string .= sprintf($spec_format,$output['cat'],$label,$spec);
	}
	
	if($single) {
		$return_string = sprintf($spec_format,$output['cat'],$single,$output[$single]);
	}
	
	return $return_string;
}


// Output Related Features


function get_related_features($id) {
                        
	$my_related_posts = MRP_get_related_posts( $id, true, true, 'feature' );
	$i=0;
	if($my_related_posts) {
		echo '<h2>Behind the Scenes <span class="count">('.count($my_related_posts).')</span></h2>';
		echo '<div class="product-features product-row">';
	} else { 
		return; 
	}
	foreach ($my_related_posts as $my_related_post) {
		
		if ($i==0) {
			$newline=' new-line';
		} else {
			$newline='';
		}

		echo '<div class="product-feature">';
			echo '<div class="span6">';
				echo '<div class="feature-image">';
					echo get_the_post_thumbnail( $my_related_post->ID, 'full');
				echo '</div>';
			echo '</div>';
			echo '<div class="span6">';
				echo '<div class="feature-excerpt">';
					echo sprintf('<h3>%1$s</h3>',$my_related_post->post_title);
					echo wpautop(implode(' ', array_slice(explode(' ', $my_related_post->post_content), 0, 150)));
					echo sprintf('<a class="read-more" href="%1$s" title="Read more about %2$s">Read the full feature</a>',$my_related_post->guid,$my_related_post->post_title);
				echo '</div>';		
			echo '</div>';		
		echo '</div>';
		
		$i++;
	}
	echo '</div>';
}
						



// Output Product Related Posts


function get_related_products($id) {
                        
	$my_related_posts = MRP_get_related_posts( $id, true, true, 'wpsc-product' );
	$i=0;
	foreach ($my_related_posts as $my_related_post) {
		//echo $my_related_post->ID;
		//$categories = get_the_category($my_related_post->ID);
		$categories = wp_get_object_terms( $my_related_post->ID , 'wpsc_product_category' );
		if($categories) foreach($categories as $cat) {
			while($cat -> parent != 0) {
				$cat = get_term($cat->parent,'wpsc_product_category');
			}
			$parent_cats[] = $cat;
		}
		if($parent_cats){
			//$my_related_post['category'] = end($categories)->name;
			$my_related_posts[$i]->product_category = end($parent_cats)->name;
			$categorized[end($parent_cats)->name][] = $my_related_post;
			//echo '<h2>Recommended '.end($categories)->name.'</h2>';
			//echo print_r($my_related_post);
		}
		$i++;
	}
	//echo print_r($categorized);
	$i=0;
	foreach ($categorized as $recommended_category => $recommended_products) {
		echo '<div class="product-recommended-products product-row">';
		//echo '<h2>'.wpsc_the_product_title().' '.$recommended_category.'</h2>';
		echo '<h2>Recommended '.$recommended_category.' <span class="count">('.count($recommended_products).')</span></h2>';
		echo '<ul class="recommended-products gallery"><!--';
		foreach ($recommended_products as $recommended_product) {
			$material = wp_get_object_terms( $recommended_product->ID , 'material' );
			if(empty($material)) {
				$material = '';
			} else {
				$material = sprintf('<span class="material %1$s">%1$s</span><div class="material-desc %1$s">%2$s</div>',end($material)->name,end($material)->description);
			}
			if ($i==0) {
				$newline=' new-line';
			} else {
				$newline='';
			}
			$code = wpsc_product_sku( $recommended_product->ID );
			if($code) $code = sprintf('<p><span class="product-sku-label">Code</span><span class="product-sku">%1$s</span></p>',$code);

            // if accessories category output category URL rather than product url
            $currentCat = get_the_product_category($recommended_product->ID);
            $accessoriesID = 23;
            if($currentCat[0]->cat_ID==$accessoriesID){
                $link = wpsc_category_url(intval($currentCat[0]->cat_ID));
            } else {
                $link = get_permalink( $recommended_product->ID );
            }

			echo '--><li class="span2'.$newline.'"><a href="'.$link.'"><img src="'.wpsc_the_product_thumbnail(200,200,$recommended_product->ID,'single').'"/>'.$material.'<p>'.$recommended_product->post_title.'</p>'.$code.'</a></li><!--';
			$i++;
		}
		echo '--></ul>';
		echo '</div>';
		$i=0;
	}

}

function get_equipment_list() {

    $related_products = MRP_get_related_posts( get_the_id(), true, true, 'wpsc-product');
    $output .= "";

    if($related_products){
        $output .= "<div class=\"feature-equipment\">\n";
        $meta = get_post_meta( get_the_id());

        if($meta['_feature_equipment_title'][0]){
            $output .= ($meta['_feature_equipment_title'][0] ? sprintf('<h3>%1$s</h3>',wpautop($meta['_feature_equipment_title'][0])) : '');
        } else {
            $output .= "<h3>Equipment</h3>\n";
        }
        if($meta['_feature_equipment_desc'][0]){
            $output .= ($meta['_feature_equipment_desc'][0] ? sprintf('<p>%1$s</p>',wpautop($meta['_feature_equipment_desc'][0])) : '');
        }

        $category = 0;

        foreach($related_products as $product) {
            $associatedCats = get_the_product_category($product->ID);
            if($associatedCats['0']->cat_ID!=$category){
                if($category!=0){
                    $output .= "</p>\n";
                }
                $output .= "<p><strong>".$associatedCats['0']->cat_name."</strong><br>\n";
                // set the category value to prevent duplicate category names being displayed.
                $category = $associatedCats['0']->cat_ID;
            }
            $output .= "";

            // if accessories category output category URL rather than product url
            $accessoriesID = 23;
            if($associatedCats['0']->cat_ID==$accessoriesID){
                $link = wpsc_category_url(intval($associatedCats['0']->cat_ID));
            } else {
                $link = get_permalink( $product->ID );
            }

            $output .= "<a href=\"".$link."\">".$product->post_title."</a><br>\n";
        }

        $output .= "</div>\n";
    }
    return $output;
}

add_shortcode( 'feature_equipment', 'get_equipment_list' );

	
function includeToString($filename) {
	ob_start();
    include $filename;
    return ob_get_clean();
}

function my_remove_meta_boxes() {
  remove_meta_box('materialdiv', 'wpsc-product', 'side');
}
add_action( 'admin_menu', 'my_remove_meta_boxes' );
 
function add_query_vars_filter( $vars ){
  $vars[] = "wt";
  $vars[] = "a";
  $vars[] = "b";
  $vars[] = "ml";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );