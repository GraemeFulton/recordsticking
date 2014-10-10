<?php
function wc_dynamic_gallery_show() {
	WC_Gallery_Display_Class::wc_dynamic_gallery_display();
}

function wc_dynamic_gallery_install(){
	update_option('a3rev_woo_dgallery_lite_version', '1.3.0');
	// Set Settings Default from Admin Init
	global $wc_dgallery_admin_init;
	$wc_dgallery_admin_init->set_default_settings();

	// Build sass
	global $wc_wc_dynamic_gallery_less;
	$wc_wc_dynamic_gallery_less->plugin_build_sass();

	update_option('a3rev_woo_dgallery_just_installed', true);
}

/**
 * Load languages file
 */
function wc_dynamic_gallery_init() {
	if ( get_option('a3rev_woo_dgallery_just_installed') ) {
		delete_option('a3rev_woo_dgallery_just_installed');
		wp_redirect( admin_url( 'admin.php?page=woo-dynamic-gallery', 'relative' ) );
		exit;
	}
	load_plugin_textdomain( 'woo_dgallery', false, WOO_DYNAMIC_GALLERY_FOLDER.'/languages' );
	$thumb_width = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_width' );
	if ( $thumb_width <= 0 ) $thumb_width = 105;
	$thumb_height = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_height' );
	if ( $thumb_height <= 0 ) $thumb_height = 75;
	add_image_size( 'wc-dynamic-gallery-thumb', $thumb_width, $thumb_height, false  );
}
// Add language
add_action('init', 'wc_dynamic_gallery_init');

// Add custom style to dashboard
add_action( 'admin_enqueue_scripts', array( 'WC_Dynamic_Gallery_Functions', 'a3_wp_admin' ) );

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array('WC_Dynamic_Gallery_Functions', 'plugin_extra_links'), 10, 2 );

// Need to call Admin Init to show Admin UI
global $wc_dgallery_admin_init;
$wc_dgallery_admin_init->init();

$woocommerce_db_version = get_option( 'woocommerce_db_version', null );

// Add upgrade notice to Dashboard pages
add_filter( $wc_dgallery_admin_init->plugin_name . '_plugin_extension', array( 'WC_Dynamic_Gallery_Functions', 'plugin_extension' ) );

add_filter( 'attachment_fields_to_edit', array('WC_Dynamic_Gallery_Variations', 'media_fields'), 10, 2 );
add_filter( 'attachment_fields_to_save', array('WC_Dynamic_Gallery_Variations', 'save_media_fields'), 10, 2 );

add_action( 'wp', 'setup_dynamic_gallery', 20);
function setup_dynamic_gallery() {
	global $woocommerce, $post;
	$current_db_version = get_option( 'woocommerce_db_version', null );
	$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	if (is_singular( array( 'product' ) )) {
		$global_wc_dgallery_activate = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'activate' );
		$actived_d_gallery = get_post_meta($post->ID, '_actived_d_gallery',true);

		if ($actived_d_gallery == '' && $global_wc_dgallery_activate != 'no') {
			$actived_d_gallery = 1;
		}

		if($actived_d_gallery == 1){
			// Include google fonts into header
			add_action( 'wp_head', array( 'WC_Dynamic_Gallery_Functions', 'add_google_fonts'), 10 );

			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
			remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

			add_action( 'woocommerce_before_single_product_summary', 'wc_dynamic_gallery_show', 30);

			wp_enqueue_style( 'ad-gallery-style', WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/jquery.ad-gallery.css' );
			wp_enqueue_script( 'ad-gallery-script', WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/jquery.ad-gallery.js', array(), false, true );

			$popup_gallery = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'popup_gallery' );
			//wp_enqueue_script('jquery');
			if ($popup_gallery == 'fb') {
				wp_enqueue_style( 'woocommerce_fancybox_styles', WOO_DYNAMIC_GALLERY_JS_URL . '/fancybox/fancybox.css' );
				wp_enqueue_script( 'fancybox', WOO_DYNAMIC_GALLERY_JS_URL . '/fancybox/fancybox'.$suffix.'.js', array(), false, true );
			} elseif ($popup_gallery == 'colorbox') {
				wp_enqueue_style( 'a3_colorbox_style', WOO_DYNAMIC_GALLERY_JS_URL . '/colorbox/colorbox.css' );
				wp_enqueue_script( 'colorbox_script', WOO_DYNAMIC_GALLERY_JS_URL . '/colorbox/jquery.colorbox'.$suffix.'.js', array(), false, true );
			}

			if ( in_array( 'woocommerce-professor-cloud/woocommerce-professor-cloud.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && get_option('woocommerce_cloud_enableCloud') == 'true' ) :
				remove_action( 'woocommerce_before_single_product_summary', 'wc_dynamic_gallery_show', 30);
			endif;
		}
	}
}

// Check upgrade functions
add_action('plugins_loaded', 'woo_dgallery_lite_upgrade_plugin');
function woo_dgallery_lite_upgrade_plugin () {

	// Upgrade to 1.3.0
	if( version_compare(get_option('a3rev_woo_dgallery_lite_version'), '1.3.0') === -1 ){
		// Build sass
		global $wc_wc_dynamic_gallery_less;
		$wc_wc_dynamic_gallery_less->plugin_build_sass();
		update_option('a3rev_woo_dgallery_lite_version', '1.3.0');
	}

	update_option('a3rev_woo_dgallery_lite_version', '1.3.0');
}

?>
