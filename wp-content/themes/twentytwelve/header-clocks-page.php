<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
            
            <!--top (secondary) menu-->
            <nav id="site-navigation-top" class="main-navigation cart-navigation" role="navigation">
                <?php wp_nav_menu( array('menu_class' => 'nav-menu','theme_location' => 'secondary') ); ?>
            </nav>
            <div class="clear_both"></div>
            <!------------->
            <hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                       
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img class="main-logo" src="<?php echo bloginfo('template_url'); ?>/images/logo.png"/>
                        </a>    
                    
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

<?php if(!MobileDTS::is('mobile')){?>     
                <!--#search clocks-->
                <div id="main-search">
                    <div id="search-clocks"><p>SEARCH CLOCKS; </p></div>
                    <div id="main-search-form">
                      <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
                        <div>
                            <input type="text" value="<?php echo esc_html($s); ?>" name="s" id="s" />
                            <input type="submit" id="submitbtn" value="&nbsp;" class="btn" />
                        </div>
                       </form>              
                        </div>
                 </div>
                <!--#search clocks-->

		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
<?php }
else{?>
<style>
#mob-search{width:100%; margin-top:20px;}
</style>
<center>
<form id="mob-search" method="get" action="<?php bloginfo('home'); ?>">
<div>
<input style="width:70%" placeholder="SEARCH CLOCKS" type="text" name="s" id="s" size="15" />
<input type="submit" value="<?php echo attribute_escape(__('Search')); ?>" />
</div>
</form>
</center>

<?php } ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">
