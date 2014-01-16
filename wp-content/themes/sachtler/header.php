<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="initial-scale=1.0">
<title><?php wp_title(' | ', true, 'right'); ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/fonts.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>-->
<script src="<?php echo get_bloginfo('template_directory'); ?>/js/plugins.js"></script>
<script src="<?php echo get_bloginfo('template_directory'); ?>/js/main.js"></script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="header">
<div id="GroupEndorsementStripContainer">
	<div class="row">
    <div id="GroupEndorsementStrip" class="wrapper">
        <div class="group-logo">
		<img src="<?php echo get_bloginfo('template_directory'); ?>/images/Endorsement_strip_logo.png" width="33" height="32" alt="" style="float:left; margin-left:0px; margin-top:2px;">
        <p>
        Sachtler &trade;<br>
        A Vitec Group brand
        </p>
		</div><!-- .group-logo -->
        <div id="ESGroupNavMenu">
        <select name="ESoptions" onchange="if(this.value!=''){location.href=this.value;}">        
            <option value="" selected="selected">Vitec Group websites</option> 
            <option value="http://www.vitecgroup.com">The Vitec Group</option>
            <option value="">---------------------</option> 
            <option value="http://www.vitecgroup.com/OurBusinesses/ImagingStagingDivision.aspx">Imaging Division</option>
            <option value="http://www.avenger-grip.com/">Avenger ™</option>
            <option value="http://www.gitzo.com/">Gitzo ™</option>
            <option value="http://www.kata-bags.com/">Kata ™</option>
            <option value="http://www.manfrotto.com/">Manfrotto ™</option>
            <option value="http://www.manfrottodistribution.com/">Manfrotto Distribution </option>
            <option value="http://www.geographicbags.com">National Geographic ™ *</option>
            <option value="http://www.geographicbags.com">* (manufactured &amp; distributed under licence)</option>
            <option value="http://www.lastolite.com">Lastolite</option>
            <option value="http://www.colorama-photo.com">Colorama</option>
            <option value="">---------------------</option> 
            <option value="http://www.vitecgroup.com/OurBusinesses/VideocomDivision.aspx">Videocom Division</option>
            <option value="http://www.antonbauer.com/">Anton/Bauer</option>
            <option value="http://www.autoscript.tv/">Autoscript</option>
            <option value="http://www.cameracorps.co.uk/">Camera Corps</option>
            <option value="http://www.thecamerastore.co.uk/">The Camera Store</option>
            <option value="http://www.haigh-farr.com/">Haigh-Farr</option>
            <option value="http://www.imt-solutions.com/">IMT</option>
            <option value="http://www.litepanels.com/">Litepanels ®</option>
            <option value="http://www.microwaveservice.com/">Microwave Service Company</option>
            <option value="http://www.nucomm.com/">Nucomm</option>
            <option value="http://www.ocon.com/">OConnor</option>
            <option value="http://www.petrolbags.com/">Petrol Bags</option>
            <option value="http://www.rfcentral.com/">RF Central</option>
            <option value="http://www.sachtler.com/">Sachtler ™</option>
            <option value="http://www.vinten.com/">Vinten ™</option>
            <option value="http://www.vintenradamec.com/">Vinten Radamec</option>
            <option value="">---------------------</option> 
            <option value="http://www.vitecgroup.com/OurBusinesses/ServicesDivision.aspx">Services Division</option>
            <option value="http://www.bexel.com/">Bexel</option>
        </select>
        </div><!-- #ESGroupNavMenu -->
    </div><!-- #GroupEndorsementStrip -->
    </div><!-- .row -->
</div><!-- #GroupEndorsementStripContainer -->
<div id="branding-area">
    <div class="row">
        <div class="wrapper">
            <div id="language-menu" class="menu span4">
                <?php if ( is_active_sidebar('language-area') ) : dynamic_sidebar('language-area'); endif; ?>
            </div><!-- #language-menu --><!--
            --><div id="basket-menu" class="menu span8">
                <?php echo wpsc_shopping_cart(); ?> 
            </div><!-- #basket-menu -->    
        </div><!-- .wrapper -->
    </div><!-- .row -->
    <div class="row">
        <div class="wrapper">
            <div id="primary-logo" class="logo span6">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/primary-logo.png" title="<?php bloginfo( 'name' ) ?>" alt="<?php bloginfo( 'name' ) ?>"/></a>        
            </div><!-- #primary-logo --><!--
            --><div id="secondary-logo" class="logo span6">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/images/secondary-logo.png" title="<?php bloginfo( 'name' ) ?>" alt="<?php bloginfo( 'name' ) ?>"/>
            </div><!-- #secondary-logo -->  
        </div><!-- .wrapper -->
    </div><!-- .row -->
</div><!-- #branding-area -->
<div class="menuwrapper">
	<div id="primary-navigation">
	    <div class="row">
	        <div class="wrapper">
	            <div id="primary-menu" class="menu span12">
	            	<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'walker' => new Sachtler_Walker, 'items_wrap' => '<ul id="%1$s" class="%2$s"><!--%3$s--></ul>', 'container' => false, ) ); ?>
	                <?php wp_nav_menu( array( 'theme_location' => 'configurator-menu') ); ?>
	            </div><!-- #primary-menu -->
	        </div><!-- .wrapper -->
	    </div><!-- .row -->
	</div><!-- #primary-navigation -->
	<div id="primary-sub-navigation">
	    <div class="row">
	        <div class="wrapper">
	            <div id="primary-sub-menu" class="span12">
	            	<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'walker' => new Sachtler_Sub_Menu_Walker, 'items_wrap' => '%3$s', 'container' => false, ) ); ?>
	                <div class="menu-promo-area configurator">
	                	<?php get_template_part('configurator','form'); ?>
	                </div>
	            </div><!-- #primary-sub-menu -->
	        </div><!-- .wrapper -->
	    </div><!-- .row -->
	</div><!-- #primary-sub-navigation -->
	<div id="secondary-navigation" >
	    <div class="row">
	        <div class="wrapper">
	            <div id="secondary-menu" class="menu span9">
	                <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu') ); ?>
	            </div><!-- #secondary-menu --><!--
	            --><div id="search-form" class="form span3">
	                <?php get_search_form(); ?>
	            </div><!-- #search-form -->  
	        </div><!-- .wrapper -->
	    </div><!-- .row -->
	</div><!-- #secondary-navigation -->
</div>
</header>

<div id="page-content" class="<?php echo get_post( get_the_ID() )->post_name; ?> row">
<div class="wrapper">

<?php if(!is_front_page()){?>
<div id="breadcrumb" class='breadcrumb span12'>
<?php if (get_shop_breadcrumbs() != null) {
	echo get_shop_breadcrumbs();
} else {
	if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();
}?>
</div>
<?php } ?>