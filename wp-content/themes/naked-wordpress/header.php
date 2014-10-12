<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to begin 
	/* rendering the page and display the header/nav
	/*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
	<?php bloginfo('name'); // show the blog name, from settings ?> | 
	<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // We are loading our theme directory style.css by queuing scripts in our functions.php file, 
	// so if you want to load other stylesheets,
	// I would load them with an @import call in your style.css
//        wp_enqueue_script("jquery");

?>
    <?php $template_dir= get_template_directory_uri();?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="<?php echo $template_dir; ?>/css/bootstrap-theme.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="<?php echo $template_dir; ?>/css/bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="<?php echo $template_dir; ?>/js/bootstrap.min.js"></script>
        <script>
$(document).ready(function(){

$(".product-box").each(function(){
    // Uncomment the following if you need to make this dynamic
    //var refH = $(this).height();
    //var refW = $(this).width();
    //var refRatio = refW/refH;

    // Hard coded value...
    var refRatio = 240/300;

    var imgH = $(this).children("img").height();
    var imgW = $(this).children("img").width();

    if ( (imgW/imgH) < refRatio ) { 
        $(this).addClass("portrait");
    } else {
        $(this).addClass("landscape");
    }
})

})
</script>
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); 
// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
// (right here) into the head of your website. 
// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
// Move it if you like, but I would keep it around.
?>
</head>

<body 
	<?php body_class(); 
	// This will display a class specific to whatever is being loaded by Wordpress
	// i.e. on a home page, it will return [class="home"]
	// on a single post, it will return [class="single postid-{ID}"]
	// and the list goes on. Look it up if you want more.
	?>
>

<header id="masthead" class="site-header" role="banner">
	<div class="container center">
	
<?php //BOOTSTRAP NAV-WALKER
         do_action('bp_after_header');
 ?>
	</div>
	<div class="center">

		<div id="brand">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); // Link to the home page ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); // Title it with the blog name ?>" rel="home"><?php bloginfo( 'name' ); // Display the blog name ?></a>
			</h1>
			<h4 class="site-description">
				<?php bloginfo( 'description' ); // Display the blog description, found in General Settings ?>
			</h4>
		</div><!-- /brand -->
		
		<div class="clear"></div>
	</div><!--/container -->
		
</header><!-- #masthead .site-header -->

<div class="main-fluid"><!-- start the page containter -->