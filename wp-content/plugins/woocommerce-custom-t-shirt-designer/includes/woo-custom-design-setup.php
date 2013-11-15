<?php
if(!defined('ABSPATH')) exit;
function woo_cd_popup_settings(){
    $popup_settings = array(
                           'popup_title' => 'Custom T-Shirt Designer',
						   'popup_title_color' => 'FFFFFF',
                           'cart_text' => 'Add to cart',
                           'cart_color' => 'FF0000',
                           'design_text'=>'Custom design',
                           'design_color'=>'FF0000',
                           'design_text_font'=>'14',
                           'user_logo_upload' => 'enable',
						   'template_name' => 'template-white',
    );
    if (get_option( 'woo_custom_design_popup_settings' ) === false ) {
    add_option( 'woo_custom_design_popup_settings', $popup_settings );
    }
}

function woo_cd_sample_logo_ids(){
    $logo_save = array(
                      'logo_id' => '',
    );
    if (get_option( 'woo_custom_design_sample_logo_ids' ) === false ) {
    add_option( 'woo_custom_design_sample_logo_ids', $logo_save);
    }
}

function woo_cd_create_tables(){
    global $wpdb;
    $table_variation_ids = $wpdb->prefix ."woo_cd_variation_ids";
    $table_custom_design = $wpdb->prefix ."woo_cd_custom_design";
    $table_sample_logo = $wpdb->prefix ."woo_cd_sample_logo";
    $sql_variation_ids = "CREATE TABLE IF NOT EXISTS $table_variation_ids(
                                                                        id int(11) NOT NULL auto_increment,
                                                                        pid int(11) NOT NULL,
                                                                        vid int(11) NOT NULL,
                                                                        PRIMARY KEY  (id)
    );";
    $wpdb->query($sql_variation_ids);
         
    $sql_custom_design = "CREATE TABLE IF NOT EXISTS $table_custom_design(
                                                                        id int(11) NOT NULL auto_increment,
                                                                        pid int(11) NOT NULL,
                                                                        margeimage_url VARCHAR(260),
																		image_url VARCHAR(260),
																		marge_img_url VARCHAR(260),
                                                                        session_id VARCHAR(250),
                                                                        color VARCHAR(250),
                                                                        font_name VARCHAR(250),
                                                                        design_text VARCHAR(250),
                                                                        checkbox_name VARCHAR(250),    
                                                                        imageposition VARCHAR(50),
																		logoimage_url VARCHAR(260),
																		img_drag_pos VARCHAR(260),
                                                                        PRIMARY KEY  (id)
    );";
   $wpdb->query($sql_custom_design);
   $sql_sample_logo = "CREATE TABLE IF NOT EXISTS $table_sample_logo(
                                                                        id int(11) NOT NULL auto_increment,                                                                       
                                                                        sample_logo_url VARCHAR(260),                                                                   
                                                                        PRIMARY KEY  (id)
   );";
   $wpdb->query($sql_sample_logo);	 
}

function upload_directory(){
	$upload_dir = wp_upload_dir();
	return $upload_dir['basedir'].'/custom_uploads';
}

function woo_dir_create(){
	if (!file_exists(upload_directory())) {
    	mkdir(upload_directory(), 0777, true);
	}
}

function woo_cd_install(){
    woo_cd_create_tables();    
    woo_cd_popup_settings();
    woo_cd_sample_logo_ids();
	woo_dir_create();
}
function woo_cd_uninstall(){
    delete_option('woo_custom_design_popup_settings');
}

function woo_cd_admin_page(){
    add_object_page('General Settings', 'T-Shirt Designer Settings', 'edit_themes','woo_custom_design_settings_slug', 'woo_custom_design_settings_main','');
    add_submenu_page('woo_custom_design_settings_slug', 'Logo List','Sample Logo List', 'edit_themes','woo_custom_design_sample_logo_slug','woo_custom_design_sample_logo_main');
	 add_submenu_page('woo_custom_design_settings_slug', '','', 'edit_themes','woo_custom_design_sample_logo_add_slug','woo_custom_design_sample_logo_add_main');
}
    add_action('admin_menu', 'woo_cd_admin_page');
?>