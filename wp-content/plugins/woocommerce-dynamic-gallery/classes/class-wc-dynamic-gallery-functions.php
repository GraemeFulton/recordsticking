<?php
/**
 * WC Dynamic Gallery Functions
 *
 * Table Of Contents
 *
 * reset_products_galleries_activate()
 * add_google_fonts()
 * html2rgb()
 * a3_wp_admin()
 * wc_dynamic_gallery_extension()
 * plugin_extra_links()
 * upgrade_1_2_1()
 * upgrade_1_2_5_2()
 */
class WC_Dynamic_Gallery_Functions 
{	
	public function reset_products_galleries_activate() {
		global $wpdb;
		$wpdb->query( "DELETE FROM ".$wpdb->postmeta." WHERE meta_key='_actived_d_gallery' " );
	}
	
	public static function add_google_fonts() {
		global $wc_dgallery_fonts_face;
		
		$caption_font = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'caption_font' );
			
		$navbar_font = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'navbar_font' );
		
		$google_fonts = array( $caption_font['face'], $navbar_font['face'] );
		$wc_dgallery_fonts_face->generate_google_webfonts( $google_fonts );
	}
	
	public static function html2rgb($color,$text = false){
		if ($color[0] == '#')
			$color = substr($color, 1);
	
		if (strlen($color) == 6)
			list($r, $g, $b) = array($color[0].$color[1],
									 $color[2].$color[3],
									 $color[4].$color[5]);
		elseif (strlen($color) == 3)
			list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
		else
			return false;
	
		$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
		if($text){
			return $r.','.$g.','.$b;
		}else{
			return array($r, $g, $b);
		}
	}
	
	public static function a3_wp_admin() {
		wp_enqueue_style( 'a3rev-wp-admin-style', WOO_DYNAMIC_GALLERY_CSS_URL . '/a3_wp_admin.css' );
	}
	
	public static function plugin_extension() {
		$html = '';
		$html .= '<a href="http://a3rev.com/shop/" target="_blank" style="float:right;margin-top:5px; margin-left:10px;" ><div class="a3-plugin-ui-icon a3-plugin-ui-a3-rev-logo"></div></a>';
		$html .= '<h3>'.__('Upgrade to Dynamic Gallery Pro', 'woo_dgallery').'</h3>';
		$html .= '<p>'.__("<strong>NOTE:</strong> All the functions inside the Yellow border on the plugins admin panel are extra functionality that is activated by upgrading to the Pro version", 'woo_dgallery').':</p>';
		
		$html .= '<h3>* '.__('WooCommerce Dynamic Gallery Pro Features', 'woo_dgallery').':</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>1. '.__('Show Multiple Product Variation images in Gallery.', 'woo_dgallery').'</li>';
		$html .= '<li>2. '.__('Assign images to variations and they show when variation is selected.', 'woo_dgallery').'</li>';
		$html .= '<li>3. '.__('Set a single image or set of gallery of images to show for each variation.', 'woo_dgallery').'</li>';
		$html .= '<li>4. '.__('Fully mobile Responsive Gallery option.', 'woo_dgallery').'</li>';
		$html .= '<li>5. '.__('Set gallery wide to % and it becomes fully responsive image product gallery.', 'woo_dgallery').'</li>';
		$html .= '<li>6. '.__('Activate all of the Gallery customization settings.', 'woo_dgallery').'</li>';
		$html .= '<li>7. '.__('Fine tune your product image gallery presentation.', 'woo_dgallery').'</li>';
		$html .= '<li>8. '. sprintf( __('View all Pro features at <a href="%s" target="_blank">a3rev.com</a>.', 'woo_dgallery'), 'http://a3rev.com/shop/woocommerce-dynamic-gallery/' ).'</li>';
		$html .= '</ul>';
		$html .= '</p>';
		$html .= '<h3>'.__('View this plugins', 'woo_dgallery').' <a href="http://docs.a3rev.com/user-guides/woocommerce/woo-dynamic-gallery/" target="_blank">'.__('documentation', 'woo_dgallery').'</a></h3>';
		$html .= '<h3>'.__('Visit this plugins', 'woo_dgallery').' <a href="http://wordpress.org/support/plugin/woocommerce-dynamic-gallery/" target="_blank">'.__('support forum', 'woo_dgallery').'</a></h3>';

		$html .= '<h3>'.__('More a3rev Quality Plugins', 'woo_dgallery').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-product-sort-and-display/" target="_blank">'.__('WooCommerce Product Sort & Display', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-products-quick-view/" target="_blank">'.__('WooCommerce Products Quick View', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-predictive-search/" target="_blank">'.__('WooCommerce Predictive Search', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-compare-products/" target="_blank">'.__('WooCommerce Compare Products', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woo-widget-product-slideshow/" target="_blank">'.__('WooCommerce Widget Product Slideshow', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/woocommerce-email-inquiry-cart-options/" target="_blank">'.__('WooCommerce Email Inquiry & Cart Options', 'woo_dgallery').'</a></li>';
		$html .= '</ul>';
		$html .= '</p>';
		$html .= '<h3>'.__('FREE a3rev WordPress Plugins', 'woo_dgallery').'</h3>';
		$html .= '<p>';
		$html .= '<ul style="padding-left:10px;">';
		$html .= '<li>* <a href="http://wordpress.org/plugins/a3-responsive-slider/" target="_blank">'.__('a3 Responsive Slider', 'woo_dgallery').'</a>&nbsp;&nbsp;&nbsp; '.__('New released!', 'woo_dgallery' ).'</li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/contact-us-page-contact-people/" target="_blank">'.__('Contact Us Page - Contact People', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/wp-email-template/" target="_blank">'.__('WordPress Email Template', 'woo_dgallery').'</a></li>';
		$html .= '<li>* <a href="http://wordpress.org/plugins/page-views-count/" target="_blank">'.__('Page View Count', 'woo_dgallery').'</a></li>';
		$html .= '</ul>';
		$html .= '</p>';
		return $html;
	}
	
	public static function plugin_extra_links($links, $plugin_name) {
		if ( $plugin_name != WOO_DYNAMIC_GALLERY_NAME) {
			return $links;
		}
		$links[] = '<a href="http://docs.a3rev.com/user-guides/woocommerce/woo-dynamic-gallery/" target="_blank">'.__('Documentation', 'woo_dgallery').'</a>';
		$links[] = '<a href="http://wordpress.org/support/plugin/woocommerce-dynamic-gallery/" target="_blank">'.__('Support', 'woo_dgallery').'</a>';
		return $links;
	}
	
	public static function upgrade_1_2_1() {
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'activate', get_option('wc_dgallery_activate') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width', get_option('product_gallery_width') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'width_type', get_option('woo_dg_width_type') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'show_variation', get_option('dynamic_gallery_show_variation') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'stop_scroll_1image', get_option('dynamic_gallery_stop_scroll_1image') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_height', get_option('product_gallery_height') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_width', get_option('thumb_width') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_height', get_option('thumb_height') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_spacing', get_option('thumb_spacing') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_speed', get_option('product_gallery_speed') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_effect', get_option('product_gallery_effect') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_auto_start', get_option('product_gallery_auto_start') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_animation_speed', get_option('product_gallery_animation_speed') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'bg_image_wrapper', get_option('bg_image_wrapper') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'border_image_wrapper_color', get_option('border_image_wrapper_color') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_text_color', get_option('product_gallery_text_color') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_bg_des', get_option('product_gallery_bg_des') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_nav', get_option('product_gallery_nav') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'bg_nav_color', get_option('bg_nav_color') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'bg_nav_text_color', get_option('bg_nav_text_color') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'popup_gallery', get_option('popup_gallery') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'enable_gallery_thumb', get_option('enable_gallery_thumb') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'transition_scroll_bar', get_option('transition_scroll_bar') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'lazy_load_scroll', get_option('lazy_load_scroll') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'caption_font', get_option('caption_font') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'caption_font_size', get_option('caption_font_size') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'caption_font_style', get_option('caption_font_style') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'navbar_font', get_option('navbar_font') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'navbar_font_size', get_option('navbar_font_size') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'navbar_font_style', get_option('navbar_font_style') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'navbar_height', get_option('navbar_height') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'hide_thumb_1image', get_option('dynamic_gallery_hide_thumb_1image') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'clean_on_deletion', get_option('wc_dgallery_lite_clean_on_deletion') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'reset_galleries_activate', get_option('wc_dgallery_reset_galleries_activate') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'reset_variation_activate', get_option('wc_dgallery_reset_variation_activate') );
		
		global $wpdb;
		$wpdb->query( "UPDATE ".$wpdb->postmeta." SET meta_key='_wc_dgallery_show_variation' WHERE meta_key='_show_variation' " );
		$wpdb->query( "UPDATE ".$wpdb->postmeta." SET meta_key='_wc_dgallery_in_variations' WHERE meta_key='_in_variations' " );
	}
	
	public static function upgrade_1_2_5_2() {
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width_responsive', get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width') );
		update_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width_fixed', get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width') );
	}
}
?>
