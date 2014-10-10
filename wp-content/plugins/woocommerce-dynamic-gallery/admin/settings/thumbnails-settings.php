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

class WC_Dynamic_Gallery_Thumbnails_Settings extends WC_Dynamic_Gallery_Admin_UI
{
	
	/**
	 * @var string
	 */
	private $parent_tab = 'thumbnails-settings';
	
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
	public $form_key = 'wc_dgallery_thumbnails_settings';
	
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
				'success_message'	=> __( 'Thumbnails Settings successfully saved.', 'woo_dgallery' ),
				'error_message'		=> __( 'Error: Thumbnails Settings can not save.', 'woo_dgallery' ),
				'reset_message'		=> __( 'Thumbnails Settings successfully reseted.', 'woo_dgallery' ),
			);
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_end', array( $this, 'include_script' ) );
			
		add_action( $this->plugin_name . '_set_default_settings' , array( $this, 'set_default_settings' ) );
		
		add_action( $this->plugin_name . '-' . $this->form_key . '_settings_init' , array( $this, 'reset_default_settings' ) );
		
		//add_action( $this->plugin_name . '_get_all_settings' , array( $this, 'get_settings' ) );
		
		// Add yellow border for pro fields
		add_action( $this->plugin_name . '_settings_pro_enable_gallery_thumb_before', array( $this, 'pro_fields_before' ) );
		add_action( $this->plugin_name . '_settings_pro_hide_thumb_1image_after', array( $this, 'pro_fields_after' ) );
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
			'name'				=> 'thumbnails-settings',
			'label'				=> __( 'Image Thumbnails', 'woo_dgallery' ),
			'callback_function'	=> 'wc_dgallery_thumbnails_settings_form',
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
	
	/*-----------------------------------------------------------------------------------*/
	/* init_form_fields() */
	/* Init all fields of this form */
	/*-----------------------------------------------------------------------------------*/
	public function init_form_fields() {
				
  		// Define settings			
     	$this->form_fields = apply_filters( $this->option_name . '_settings_fields', array(
		
			array(
            	'name' 		=> __('Image Thumbnails', 'woothemes'),
                'type' 		=> 'heading',
				'id'		=> 'pro_enable_gallery_thumb',
           	),
			array(  
				'name' 		=> __( 'Show thumbnails', 'woo_dgallery' ),
				'desc' 		=> __( 'YES to enable thumbnail gallery', 'woo_dgallery' ),
				'class'		=> 'enable_gallery_thumb',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'enable_gallery_thumb',
				'default'			=> 'yes',
				'type' 				=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'YES', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'NO', 'woo_dgallery' ),
			),
			
			array(
                'type' 		=> 'heading',
				'class'		=> 'gallery_thumb_container',
				'id'		=> 'pro_hide_thumb_1image',
           	),
			array(  
				'name' 		=> __( 'Single Image Thumbnail', 'woo_dgallery' ),
				'desc' 		=> __( "YES to hide thumbnail when only 1 image is loaded to gallery.", 'woo_dgallery' ),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'hide_thumb_1image',
				'default'			=> 'no',
				'type' 				=> 'onoff_checkbox',
				'checked_value'		=> 'yes',
				'unchecked_value'	=> 'no',
				'checked_label'		=> __( 'YES', 'woo_dgallery' ),
				'unchecked_label' 	=> __( 'NO', 'woo_dgallery' ),
			),
			
			array(
                'type' 		=> 'heading',
				'class'		=> 'gallery_thumb_container',
           	),
			array(  
				'name' 		=> __( 'Thumbnail width', 'woo_dgallery' ),
				'desc' 		=> 'px. '.__("Setting 0px will show at default 105px. Please use the disable thumbnails feature if you want to hide them.", 'woo_dgallery'),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'thumb_width',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '105',
				'free_version'		=> true,
			),
			array(  
				'name' 		=> __( 'Thumbnail height', 'woo_dgallery' ),
				'desc' 		=> 'px. '.__("Setting 0px will show at default 75px. Please use the disable thumbnails feature if you want to hide them.", 'woo_dgallery'),
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'thumb_height',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '75',
				'free_version'		=> true,
			),
			array(  
				'name' 		=> __( 'Thumbnail spacing', 'woo_dgallery' ),
				'desc' 		=> 'px',
				'id' 		=> WOO_DYNAMIC_GALLERY_PREFIX.'thumb_spacing',
				'type' 		=> 'text',
				'css' 		=> 'width:40px;',
				'default'	=> '2',
				'free_version'		=> true,
			),
		
        ));
	}
	
	public function include_script() {
	?>
<script>
(function($) {
$(document).ready(function() {
	
	if ( $("input.enable_gallery_thumb:checked").val() == 'yes') {
		$(".gallery_thumb_container").css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} );
	} else {
		$(".gallery_thumb_container").css( {'visibility': 'hidden', 'height' : '0px', 'overflow' : 'hidden'} );
	}
	
	$(document).on( "a3rev-ui-onoff_checkbox-switch", '.enable_gallery_thumb', function( event, value, status ) {
		if ( status == 'true' ) {
			$(".gallery_thumb_container").hide().css( {'visibility': 'visible', 'height' : 'auto', 'overflow' : 'inherit'} ).slideDown();
		} else {
			$(".gallery_thumb_container").slideUp();
		}
	});
	
});
})(jQuery);
</script>
    <?php	
	}
}

global $wc_dgallery_thumbnails_settings;
$wc_dgallery_thumbnails_settings = new WC_Dynamic_Gallery_Thumbnails_Settings();

/** 
 * wc_dgallery_thumbnails_settings_form()
 * Define the callback function to show subtab content
 */
function wc_dgallery_thumbnails_settings_form() {
	global $wc_dgallery_thumbnails_settings;
	$wc_dgallery_thumbnails_settings->settings_form();
}

?>