<?php
/* "Copyright 2012 A3 Revolution Web Design" This software is distributed under the terms of GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007 */
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<?php
/*-----------------------------------------------------------------------------------
WC Dynamic Gallery Style Settings

TABLE OF CONTENTS

- var parent_tab
- var subtab_data
- var option_name
- var form_key
- var position
- var form_fields
- var form_messages

- __construct()
- subtab_init()
- set_default_settings()
- get_settings()
- subtab_data()
- add_subtab()
- settings_form()
- init_form_fields()

-----------------------------------------------------------------------------------*/

class WC_Dynamic_Gallery_Style_Settings extends WC_Dynamic_Gallery_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'gallery-style';
	
	/**
	 * @var array
	 */
	private $subtab_data;
	
	/**
	 * @var string
	 * You must change to correct option name that you are working
	 */
	public $option_name = '';
	
	/**
	 * @var string
	 * You must change to correct form key that you are working
	 */
	public $form_key = 'wc_dgallery_style_settings';
	
	/**
	 * @var string
	 * You can change the order show of this sub tab in list sub tabs
	 */
	private $position = 1;
	
	/**
	 * @var array
	 */
	public $form_fields = array();
	
	/**
	 * @var array
	 */
	public $form_messages = array();
	
	/*-----------------------------------------------------------------------------------*/
	/* __construct() */
	/* Settings Constructor */
	/*-----------------------------------------------------------------------------------*/
	public function __construct() {
		$this->init_form_fields();
		$this->subtab_init();
		
		$this->form_messages = array(
				'success_message'	=> __( 'Dynamic Gallery Style successfully saved.', 'woo_dgallery' ),
				'error_message'		=> __( 'Error: Dynamic Gallery Style can not save.', 'woo_dgallery' ),
				'reset_message'		=> __( 'Dynamic Gallery Style successfully reseted.', 'woo_dgallery' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_after_settings_save' , array( $this, 'reset_default_settings' ) );
		
		//add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
		add_action('wp_ajax_woo_dynamic_gallery', array('WC_Gallery_Preview_Display','wc_dynamic_gallery_preview'));
		add_action('wp_ajax_nopriv_woo_dynamic_gallery', array('WC_Gallery_Preview_Display','wc_dynamic_gallery_preview'));
		
		// Add yellow border for pro fields
		add_action( $this->plugin_name . '_settings_pro_gallery_width_type_before', array( $this, 'pro_fields_before' ) );
		add_action( $this->plugin_name . '_settings_pro_product_gallery_width_responsive_after', array( $this, 'pro_fields_after' ) );
		
		// Add yellow border for pro fields
		add_action( $this->plugin_name . '_settings_pro_gallery_special_effects_before', array( $this, 'pro_fields_before' ) );
		add_action( $this->plugin_name . '_settings_pro_variation_load_effect_timing_after', array( $this, 'pro_fields_after' ) );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* subtab_init() */
	/* Sub Tab Init */
	/*-----------------------------------------------------------------------------------*/
	public function subtab_init() {
		
		add_filter( $this->plugin_name . '-' . $this->parent_tab . '_settings_subtabs_array', array( $this, 'add_subtab' ), $this->position );
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* set_default_settings()
	/* Set default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function set_default_settings() {
		global $wc_dgallery_admin_interface;
		
		$wc_dgallery_admin_interface->reset_settings( $this->form_fields, $this->option_name, false );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* reset_default_settings()
	/* Reset default settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function reset_default_settings() {
		global $wc_dgallery_admin_interface;
		
		$wc_dgallery_admin_interface->reset_settings( $this->form_fields, $this->option_name, true, true );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* get_settings()
	/* Get settings with function called from Admin Interface */
	/*-----------------------------------------------------------------------------------*/
	public function get_settings() {
		global $wc_dgallery_admin_interface;
		
		$wc_dgallery_admin_interface->get_settings( $this->form_fields, $this->option_name );
	}
	
	/**
	 * subtab_data()
	 * Get SubTab Data
	 * =============================================
	 * array ( 
	 *		'name'				=> 'my_subtab_name'				: (required) Enter your subtab name that you want to set for this subtab
	 *		'label'				=> 'My SubTab Name'				: (required) Enter the subtab label
	 * 		'callback_function'	=> 'my_callback_function'		: (required) The callback function is called to show content of this subtab
	 * )
	 *
	 */
	public function subtab_data() {
		
		$subtab_data = array( 
			'name'				=> 'gallery-style',
			'label'				=> __( 'Gallery Style', 'woo_dgallery' ),
			'callback_function'	=> 'wc_dgallery_style_settings_form',
		);
		
		if ( $this->subtab_data ) return $this->subtab_data;
		return $this->subtab_data = $subtab_data;
		
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* add_subtab() */
	/* Add Subtab to Admin Init
	/*-----------------------------------------------------------------------------------*/
	public function add_subtab( $subtabs_array ) {
	
		if ( ! is_array( $subtabs_array ) ) $subtabs_array = array();
		$subtabs_array[] = $this->subtab_data();
		
		return $subtabs_array;
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* settings_form() */
	/* Call the form from Admin Interface
	/*-----------------------------------------------------------------------------------*/
	public function settings_form() {
		global $wc_dgallery_admin_interface;
		
		$output = '';
		$output .= $wc_dgallery_admin_interface->admin_forms( $this->form_fields, $this->form_key, $this->option_name, $this->form_messages );
		
		return $output;
	}
	
	// fix conflict with mandrill plugin
	public function remove_mandrill_notice() {
		remove_action( 'admin_notices', array( 'wpMandrill', 'adminNotices' ) );
	}
	
	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
		
  		// Define settings			
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(
		
			array(
            	'name' 		=> __( 'Preview', 'woo_dgallery' ),
				'desc'		=> '<a href="'.  admin_url( 'admin-ajax.php', 'relative') .'?act=preview-dgallery" class="preview_gallery">' . __( 'Click here to preview gallery', 'woo_dgallery' ) . '</a>',
                'type' 		=> 'heading',
           	),
			
			array(	
				'name' 		=> __('Gallery Dimensions', 'woo_dgallery'), 
				'type' 		=> 'heading', 
			),
			
			array(	
				'type' 		=> 'heading', 
				'id' 		=> 'pro_gallery_width_type', 
			),
			array(  
				'name' 		=> __( 'Gallery type', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX . 'width_type',
				'class'		=> 'gallery_width_type',
				'type' 		=> 'switcher_checkbox',
				'default'	=> 'px',
				'checked_value'		=> '%',
				'unchecked_value' 	=> 'px',
				'checked_label'		=> __( 'Responsive', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'Fixed Wide', 'woo_dgallery' ),
			),
			
			array(
            	'class' 	=> 'gallery_width_type_percent',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Gallery width', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX . 'product_gallery_width_responsive',
				'desc'		=> '%',
				'type' 		=> 'slider',
				'default'	=> 100,
				'min'		=> 20,
				'max'		=> 100,
				'increment'	=> 1,
			),
			
			array(
            	'class' 	=> 'gallery_width_type_percent',
                'type' 		=> 'heading',
				'id'		=> 'pro_product_gallery_width_responsive',
				'desc'		=> '<table class="form-table"><tbody><tr valign="top"><th class="titledesc" scope="row"><label>' . __( 'Gallery height', 'woo_dgallery' ) . '</label></th><td class="forminp">' . __( "Show tall in proportion to wide", 'woo_dgallery' ) . '</td></tr></tbody></table>',
           	),
			
			array(
            	'class' 	=> 'gallery_width_type_fixed',
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Gallery width', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX . 'product_gallery_width_fixed',
				'desc'		=> 'px',
				'type' 		=> 'text',
				'default'	=> 320,
				'free_version'		=> true,
				'css' 		=> 'width:40px;',
			),			
			array(  
				'name' 		=> __( 'Gallery height', 'woo_dgallery' ),
				'desc'		=> 'px',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_height',
				'type' 		=> 'text',
				'default'	=> 215,
				'free_version'		=> true,
				'css' 		=> 'width:40px;',
			),
			
			array(	
				'name' => __('Gallery Special Effects', 'woo_dgallery'), 
				'type' => 'heading', 
				'id' => 'pro_gallery_special_effects' 
			),
			array(  
				'name' => __( 'Auto start', 'woo_dgallery' ),
				'desc' 		=> '',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_auto_start',
				'default'	=> 'true',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'true',
				'unchecked_value'	=> 'false',
				'checked_label'		=> __( 'YES', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'NO', 'woo_dgallery' ),
			),
			array(  
				'name' => __( 'Slide transition effect', 'woo_dgallery' ),
				'desc' 		=> '',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_effect',
				'css' 		=> 'width:120px;',
				'default'	=> 'slide-vert',
				'type' 		=> 'select',
				'options' => array( 
					'none'  			=> __( 'None', 'woo_dgallery' ),
					'fade'				=> __( 'Fade', 'woo_dgallery' ),
					'slide-hori'		=> __( 'Slide Hori', 'woo_dgallery' ),
					'slide-vert'		=> __( 'Slide Vert', 'woo_dgallery' ),
					'resize'			=> __( 'Resize', 'woo_dgallery' ),
				),
			),
			array(  
				'name' => __( 'Time between transitions', 'woo_dgallery' ),
				'desc' 		=> 'seconds',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_speed',
				'type' 		=> 'slider',
				'default'	=> 4,
				'min'		=> 1,
				'max'		=> 10,
				'increment'	=> 1,
			),
			array(  
				'name' => __( 'Transition effect speed', 'woo_dgallery' ),
				'desc' 		=> 'seconds',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_animation_speed',
				'type' 		=> 'slider',
				'default'	=> 2,
				'min'		=> 1,
				'max'		=> 10,
				'increment'	=> 1,
			),
			
			array(  
				'name' 		=> __( 'Single Image Transition', 'woo_dgallery' ),
				'desc' 		=> __( 'YES to auto deactivate image transition effect when only 1 image is loaded to gallery.', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'stop_scroll_1image',
				'default'	=> 'no',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'YES', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'NO', 'woo_dgallery' ),
			),
			
			array(	'name' => __('Gallery Style', 'woo_dgallery'), 'type' => 'heading'),
			array(  
				'name' => __( 'Image background colour', 'woo_dgallery' ),
				'desc' 		=> __( 'Gallery image background colour. Default <code>#FFFFFF</code>.', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'bg_image_wrapper',
				'type' 		=> 'color',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' => __( 'Border colour', 'woo_dgallery' ),
				'desc' 		=> __( 'Gallery border colour. Default <code>#CCCCCC</code>.', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'border_image_wrapper_color',
				'type' 		=> 'color',
				'default'	=> '#CCCCCC'
			),
			
			array(	'name' => __('Caption text', 'woo_dgallery'), 'type' => 'heading'),
			array(  
				'name' 		=> __( 'Font', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'caption_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#FFFFFF' )
			),
			array(  
				'name' => __( 'Background', 'woo_dgallery' ),
				'desc' 		=> __( 'Caption text background colour. Default [default_value]', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_bg_des',
				'type' 		=> 'color',
				'default'	=> '#000000'
			),
			
			array(	'name' => __('Nav Bar', 'woo_dgallery'), 'type' => 'heading'),
			array(  
				'name' 		=> __( 'Control', 'woo_dgallery' ),
				'desc' 		=> __( 'YES to enable Nav bar Control', 'woo_dgallery' ),
				'class'		=> 'gallery_nav_control',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_nav',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'YES', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'NO', 'woo_dgallery' ),
			),
			
			array(
				'type' 		=> 'heading',
				'class'		=> 'nav_bar_container',
			),
			array(  
				'name' 		=> __( 'Font', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'navbar_font',
				'type' 		=> 'typography',
				'default'	=> array( 'size' => '12px', 'face' => 'Arial, sans-serif', 'style' => 'normal', 'color' => '#000000' )
			),
			array(  
				'name' => __( 'Background', 'woo_dgallery' ),
				'desc' 		=> __( 'Nav bar background colour. Default [default_value].', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'bg_nav_color',
				'type' 		=> 'color',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' 		=> __( 'Container height', 'woo_dgallery' ),
				'desc'		=> 'px',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'navbar_height',
				'type' 		=> 'text',
				'default'	=> 25,
				'css' 		=> 'width:40px;',
			),
			
			array(
            	'name' 		=> __('Lazy-load scroll', 'woo_dgallery'),
                'type' 		=> 'heading',
           	),
			array(  
				'name' 		=> __( 'Control', 'woo_dgallery' ),
				'desc' 		=> __( 'YES to enable lazy-load scroll', 'woo_dgallery' ),
				'class'		=> 'lazy_load_control',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'lazy_load_scroll',
				'default'	=> 'yes',
				'type' 		=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'YES', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'NO', 'woo_dgallery' ),
			),
			
			array(
				'type' 		=> 'heading',
				'class'		=> 'lazy_load_container',
				'id'		=> 'pro_lazy_bar_colour',
			),
			array(  
				'name' => __( 'Colour', 'woo_dgallery' ),
				'desc' 		=> __( 'Scroll bar colour. Default [default_value].', 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'transition_scroll_bar',
				'type' 		=> 'color',
				'default'	=> '#000000'
			),
			
			array(	'name' => __('Variations Galleries', 'woo_dgallery'), 'type' => 'heading'),
			array(  
				'name' => __( 'Gallery load effect', 'woo_dgallery' ),
				'desc' 		=> '',
				'class'		=> 'variation_gallery_effect',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'variation_gallery_effect',
				'default'	=> 'none',
				'type' 		=> 'switcher_checkbox',
				'checked_value'		=> 'fade',
				'unchecked_value'	=> 'none',
				'checked_label'		=> __( 'FADE', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'DEFAULT', 'woo_dgallery' ),
			),
			array(	
				'type' 		=> 'heading',
				'class'		=> 'variation_load_effect_timing',
				'id'		=> 'pro_variation_load_effect_timing',
			),
			array(  
				'name' 		=> __( 'Load effect timing', 'woo_dgallery' ),
				'desc' 		=> 'seconds',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'variation_gallery_effect_speed',
				'type' 		=> 'slider',
				'default'	=> 2,
				'min'		=> 1,
				'max'		=> 10,
				'increment'	=> 1,
			),
		
        ));
	}
	
	public function include_script() {
		add_action('admin_footer', array($this, 'wc_dynamic_gallery_add_script'), 10);
	?>
<script>
(function($) {
$(document).ready(function() {
	if ( $("input.gallery_width_type:checked").val() == '%') {
		$(".gallery_width_type_percent").show();
		$(".gallery_width_type_fixed").hide();
	} else {
		$(".gallery_width_type_percent").hide();
		$(".gallery_width_type_fixed").show();
	}
	if ( $("input.gallery_nav_control:checked").val() == 'yes') {
		$('.nav_bar_container').css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
	} else {
		$('.nav_bar_container').css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden'} );
	}
	if ( $("input.lazy_load_control:checked").val() == 'yes') {
		$(".lazy_load_container").show();
	} else {
		$(".lazy_load_container").hide();
	}
	if ( $("input.variation_gallery_effect:checked").val() == 'fade') {
		$(".variation_load_effect_timing").show();
	} else {
		$(".variation_load_effect_timing").hide();
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.gallery_width_type', function( event, value, status ) {
		if ( status == 'true' ) {
			$(".gallery_width_type_percent").slideDown();
			$(".gallery_width_type_fixed").slideUp();
		} else {
			$(".gallery_width_type_percent").slideUp();
			$(".gallery_width_type_fixed").slideDown();
		}
	});
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.gallery_nav_control', function( event, value, status ) {
		$('.nav_bar_container').hide().css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
		if ( status == 'true' ) {
			$(".nav_bar_container").slideDown();
		} else {
			$(".nav_bar_container").slideUp();
		}
	});
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.lazy_load_control', function( event, value, status ) {
		if ( status == 'true' ) {
			$(".lazy_load_container").slideDown();
		} else {
			$(".lazy_load_container").slideUp();
		}
	});
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.variation_gallery_effect', function( event, value, status ) {
		if ( status == 'true' ) {
			$(".variation_load_effect_timing").slideDown();
		} else {
			$(".variation_load_effect_timing").slideUp();
		}
	});
});
})(jQuery);
</script>
    <?php	
	}
	
	public function wc_dynamic_gallery_add_script(){
		global $woocommerce;
		$current_db_version = get_option( 'woocommerce_db_version', null );
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		wp_register_script( 'dynamic-gallery-script', WOO_DYNAMIC_GALLERY_JS_URL.'/galleries.js' );
		wp_enqueue_script( 'dynamic-gallery-script' );
		
		wp_enqueue_style( 'ad-gallery-style', WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/jquery.ad-gallery.css' );
		wp_enqueue_script( 'ad-gallery-script', WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/jquery.ad-gallery.js', array(), false, true );
		
		wp_enqueue_style( 'a3_colorbox_style', WOO_DYNAMIC_GALLERY_JS_URL . '/colorbox/colorbox.css' );
		wp_enqueue_script( 'colorbox_script', WOO_DYNAMIC_GALLERY_JS_URL . '/colorbox/jquery.colorbox'.$suffix.'.js', array(), false, true );
			
		wp_enqueue_style( 'woocommerce_fancybox_styles', WOO_DYNAMIC_GALLERY_JS_URL . '/fancybox/fancybox.css' );
		wp_enqueue_script( 'fancybox', WOO_DYNAMIC_GALLERY_JS_URL . '/fancybox/fancybox'.$suffix.'.js', array(), false, true );
		
	}
}

global $wc_dgallery_style_settings;
$wc_dgallery_style_settings = new WC_Dynamic_Gallery_Style_Settings();

/** 
 * wc_dgallery_style_settings_form()
 * Define the callback function to show subtab content
 */
function wc_dgallery_style_settings_form() {
	global $wc_dgallery_style_settings;
	$wc_dgallery_style_settings->settings_form();
}

?>
