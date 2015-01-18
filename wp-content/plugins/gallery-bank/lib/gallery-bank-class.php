<?php
//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING MENUS
//---------------------------------------------------------------------------------------------------------------//

function create_global_menus_for_gallery_bank()
{
	global $wpdb,$current_user;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
	switch ($gb_role) {
		case "administrator":
			add_menu_page("Gallery Bank", __("Gallery Bank", gallery_bank), "read", "gallery_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
			add_submenu_page("gallery_bank", "Dashboard", __("Dashboard", gallery_bank), "read", "gallery_bank", "gallery_bank");
			add_submenu_page("gallery_bank", "Short-Codes", __("Short-Codes", gallery_bank), "read", "gallery_bank_shortcode", "gallery_bank_shortcode");
			add_submenu_page("gallery_bank", "Album Sorting", __("Album Sorting", gallery_bank), "read", "gallery_album_sorting", "gallery_album_sorting");
			add_submenu_page("gallery_bank", "Gallery Bank", __("Global Settings", gallery_bank), "read", "global_settings", "global_settings");
			add_submenu_page("gallery_bank", "System Status", __("System Status", gallery_bank), "read", "gallery_bank_system_status", "gallery_bank_system_status");
			add_submenu_page("gallery_bank", "Recommendations", __("Recommendations", gallery_bank), "read", "gallery_bank_recommended_plugins", "gallery_bank_recommended_plugins");
			add_submenu_page("gallery_bank", "Premium Editions", __("Premium Editions", gallery_bank), "read", "gallery_bank_purchase", "gallery_bank_purchase");
			add_submenu_page("gallery_bank", " Our Other Services ", __("Our Other Services", gallery_bank), "read", "gallery_bank_other_services", "gallery_bank_other_services");
			add_submenu_page("", "", "", "read", "view_album", "view_album");
			add_submenu_page("", "", "", "read", "album_preview", "album_preview");
			add_submenu_page("", "", "", "read", "save_album", "save_album");
			add_submenu_page("", "", "", "read", "images_sorting", "images_sorting");
		break;
		case "editor":
			add_menu_page("Gallery Bank", __("Gallery Bank", gallery_bank), "read", "gallery_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
			add_submenu_page("gallery_bank", "Dashboard", __("Dashboard", gallery_bank), "read", "gallery_bank", "gallery_bank");
			add_submenu_page("gallery_bank", "Short-Codes", __("Short-Codes", gallery_bank), "read", "gallery_bank_shortcode", "gallery_bank_shortcode");
			add_submenu_page("gallery_bank", "Album Sorting", __("Album Sorting", gallery_bank), "read", "gallery_album_sorting", "gallery_album_sorting");
			add_submenu_page("gallery_bank", "Gallery Bank", __("Global Settings", gallery_bank), "read", "global_settings", "global_settings");
			add_submenu_page("gallery_bank", "System Status", __("System Status", gallery_bank), "read", "gallery_bank_system_status", "gallery_bank_system_status");
			add_submenu_page("gallery_bank", "Recommendations", __("Recommendations", gallery_bank), "read", "gallery_bank_recommended_plugins", "gallery_bank_recommended_plugins");
			add_submenu_page("gallery_bank", "Premium Editions", __("Premium Editions", gallery_bank), "read", "gallery_bank_purchase", "gallery_bank_purchase");
			add_submenu_page("gallery_bank", " Our Other Services ", __("Our Other Services", gallery_bank), "read", "gallery_bank_other_services", "gallery_bank_other_services");
			add_submenu_page("", "", "", "read", "view_album", "view_album");
			add_submenu_page("", "", "", "read", "album_preview", "album_preview");
			add_submenu_page("", "", "", "read", "save_album", "save_album");
			add_submenu_page("", "", "", "read", "images_sorting", "images_sorting");
		break;
		case "author":
			add_menu_page("Gallery Bank", __("Gallery Bank", gallery_bank), "read", "gallery_bank", "", plugins_url("/assets/images/icon.png" , dirname(__FILE__)));
			add_submenu_page("gallery_bank", "Dashboard", __("Dashboard", gallery_bank), "read", "gallery_bank", "gallery_bank");
			add_submenu_page("gallery_bank", "Short-Codes", __("Short-Codes", gallery_bank), "read", "gallery_bank_shortcode", "gallery_bank_shortcode");
			add_submenu_page("gallery_bank", "Album Sorting", __("Album Sorting", gallery_bank), "read", "gallery_album_sorting", "gallery_album_sorting");
			add_submenu_page("gallery_bank", "Gallery Bank", __("Global Settings", gallery_bank), "read", "global_settings", "global_settings");
			add_submenu_page("gallery_bank", "System Status", __("System Status", gallery_bank), "read", "gallery_bank_system_status", "gallery_bank_system_status");
			add_submenu_page("gallery_bank", "Recommendations", __("Recommendations", gallery_bank), "read", "gallery_bank_recommended_plugins", "gallery_bank_recommended_plugins");
			add_submenu_page("gallery_bank", "Premium Editions", __("Premium Editions", gallery_bank), "read", "gallery_bank_purchase", "gallery_bank_purchase");
			add_submenu_page("gallery_bank", " Our Other Services ", __("Our Other Services", gallery_bank), "read", "gallery_bank_other_services", "gallery_bank_other_services");
			add_submenu_page("", "", "", "read", "view_album", "view_album");
			add_submenu_page("", "", "", "read", "album_preview", "album_preview");
			add_submenu_page("", "", "", "read", "save_album", "save_album");
			add_submenu_page("", "", "", "read", "images_sorting", "images_sorting");
		break;
	}
}
//--------------------------------------------------------------------------------------------------------------//
// FUNCTIONS FOR REPLACING TABLE NAMES
//--------------------------------------------------------------------------------------------------------------//

function gallery_bank_albums()
{
    global $wpdb;
    return $wpdb->prefix . "gallery_albums";
}

function gallery_bank_pics()
{
    global $wpdb;
    return $wpdb->prefix . "gallery_pics";
}

function gallery_bank_settings()
{
    global $wpdb;
    return $wpdb->prefix . "gallery_settings";
}

//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING PAGES
//---------------------------------------------------------------------------------------------------------------//
function gallery_bank()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
    include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/dashboard.php";
}


function gallery_bank_shortcode()
{
	global $wpdb, $current_user,$wp_version;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
	include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
	include_once GALLERY_BK_PLUGIN_DIR . "/views/shortcode.php";
}
function save_album()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
	$album_count = $wpdb->get_var
	(
		"SELECT count(album_id) FROM ".gallery_bank_albums()
	);
	if($album_count <= 3)
	{
		include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
		include_once GALLERY_BK_PLUGIN_DIR . "/views/edit-album.php";
	}
	else 
	{
        header("Location:admin.php?page=gallery_bank");
	}
}

function global_settings()
{
	global $wpdb, $current_user,$wp_version;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
    include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/settings.php";
}

function gallery_album_sorting()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
    include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/album-sorting.php";
}

function images_sorting()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
    include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/images-sorting.php";
}

function album_preview()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
    include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/album-preview.php";
}


function gallery_bank_system_status()
{
	global $wpdb,$wp_version,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
    include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/gallery-bank-system-report.php";
}

function gallery_bank_purchase()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
	include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
    include_once GALLERY_BK_PLUGIN_DIR . "/views/purchase_pro_version.php";
}

function gallery_bank_recommended_plugins()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
	include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
	include_once GALLERY_BK_PLUGIN_DIR . "/views/recommended-plugins.php";
}

function gallery_bank_other_services()
{
	global $wpdb,$current_user,$user_role_permission;
	if(is_super_admin())
	{
		$gb_role = "administrator";
	}
	else
	{
		$gb_role = $wpdb->prefix . "capabilities";
		$current_user->role = array_keys($current_user->$gb_role);
		$gb_role = $current_user->role[0];
	}
	include_once GALLERY_BK_PLUGIN_DIR . "/views/header.php";
	include_once GALLERY_BK_PLUGIN_DIR . "/views/other-services.php";
}


//--------------------------------------------------------------------------------------------------------------//
//CODE FOR CALLING JAVASCRIPT FUNCTIONS
//--------------------------------------------------------------------------------------------------------------//
function backend_scripts_calls()
{
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery-ui-draggable");
    wp_enqueue_script("jquery-ui-sortable");
    wp_enqueue_script("jquery-ui-dialog");
    wp_enqueue_script("farbtastic");
    wp_enqueue_script("imgLiquid.js", plugins_url("/assets/js/imgLiquid.js",dirname(__FILE__)));
    wp_enqueue_script("jquery.dataTables.min.js", plugins_url("/assets/js/jquery.dataTables.min.js",dirname(__FILE__)));
    wp_enqueue_script("jquery.validate.min.js", plugins_url("/assets/js/jquery.validate.min.js",dirname(__FILE__)));
    wp_enqueue_script("plupload.full.min.js", plugins_url("/assets/js/plupload.full.min.js",dirname(__FILE__)));
    wp_enqueue_script("jquery.plupload.queue.js", plugins_url("/assets/js/jquery.plupload.queue.js",dirname(__FILE__)));
    wp_enqueue_script("jquery.Tooltip.js", plugins_url("/assets/js/jquery.Tooltip.js",dirname(__FILE__)));
    wp_enqueue_script("bootstrap.js", plugins_url("/assets/js/bootstrap.js",dirname(__FILE__)));
	wp_enqueue_script("jquery.prettyPhoto.js", plugins_url("/assets/js/jquery.prettyPhoto.js",dirname(__FILE__)));
	wp_enqueue_style("google-fonts-roboto", "//fonts.googleapis.com/css?family=Roboto Condensed:300|Roboto Condensed:300|Roboto Condensed:300|Roboto Condensed:regular|Roboto Condensed:300");
}

function frontend_plugin_js_scripts_gallery_bank()
{
    wp_enqueue_script("jquery");
    wp_enqueue_script("jquery.masonry.min.js", plugins_url("/assets/js/jquery.masonry.min.js",dirname(__FILE__)));
    wp_enqueue_script("isotope.pkgd.js", plugins_url("/assets/js/isotope.pkgd.js",dirname(__FILE__)));
    wp_enqueue_script("imgLiquid.js", plugins_url("/assets/js/imgLiquid.js",dirname(__FILE__)));
	wp_enqueue_script("jquery.prettyPhoto.js", plugins_url("/assets/js/jquery.prettyPhoto.js",dirname(__FILE__)));
}

//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CALLING STYLE SHEETS
function backend_css_calls()
{
    wp_enqueue_style("farbtastic");
	wp_enqueue_style("wp-jquery-ui-dialog");
    wp_enqueue_style("jquery.plupload.queue.css", plugins_url("/assets/css/jquery.plupload.queue.css",dirname(__FILE__)));
    wp_enqueue_style("stylesheet.css", plugins_url("/assets/css/stylesheet.css",dirname(__FILE__)));
    wp_enqueue_style("font-awesome.css", plugins_url("/assets/css/font-awesome/css/font-awesome.css",dirname(__FILE__)));
    wp_enqueue_style("system-message.css", plugins_url("/assets/css/system-message.css",dirname(__FILE__)));
    wp_enqueue_style("gallery-bank.css", plugins_url("/assets/css/gallery-bank.css",dirname(__FILE__)));
	wp_enqueue_style("prettyPhoto.css", plugins_url("/assets/css/prettyPhoto.css",dirname(__FILE__)));
	wp_enqueue_style("premium-edition.css", plugins_url("/assets/css/premium-edition.css",dirname(__FILE__)));
	wp_enqueue_style("responsive.css", plugins_url("/assets/css/responsive.css",dirname(__FILE__)));
}

function frontend_plugin_css_scripts_gallery_bank()
{
    wp_enqueue_style("gallery-bank.css", plugins_url("/assets/css/gallery-bank.css",dirname(__FILE__)));
	wp_enqueue_style("prettyPhoto.css", plugins_url("/assets/css/prettyPhoto.css",dirname(__FILE__)));
}

//--------------------------------------------------------------------------------------------------------------//
// REGISTER AJAX BASED FUNCTIONS TO BE CALLED ON ACTION TYPE AS PER WORDPRESS GUIDELINES
//--------------------------------------------------------------------------------------------------------------//
if (isset($_REQUEST["action"])) {
    switch ($_REQUEST["action"]) {
        case "add_new_album_library":
            add_action("admin_init", "album_gallery_library");
            function album_gallery_library()
            {
            	global $wpdb,$current_user,$user_role_permission;
            	if(is_super_admin())
            	{
            		$gb_role = "administrator";
            	}
            	else
            	{
            		$gb_role = $wpdb->prefix . "capabilities";
	            	$current_user->role = array_keys($current_user->$gb_role);
	            	$gb_role = $current_user->role[0];
            	}
                include_once GALLERY_BK_PLUGIN_DIR . "/lib/add-new-album-class.php";
            }
            break;
        case "front_view_all_albums_library":
            add_action("admin_init", "front_view_all_albums_library");
            function front_view_all_albums_library()
            {
                include_once GALLERY_BK_PLUGIN_DIR . "/lib/front-view-all-albums-class.php";
            }
            break;
		case "upload_library":
            add_action("admin_init", "upload_library");
            function upload_library()
            {
            	global $wpdb,$current_user,$user_role_permission;
            	if(is_super_admin())
            	{
            		$gb_role = "administrator";
            	}
            	else
            	{
            		$gb_role = $wpdb->prefix . "capabilities";
	            	$current_user->role = array_keys($current_user->$gb_role);
	            	$gb_role = $current_user->role[0];
            	}
				include_once GALLERY_BK_PLUGIN_DIR . "/lib/upload.php";
            }
            break;
    }
}

/**************************************************************************************************/
add_action("media_buttons_context", "add_gallery_shortcode_button", 1);
function add_gallery_shortcode_button($context)
{
    add_thickbox();
    $context .= "<a href=\"#TB_inline?width=500&height=600&inlineId=my-gallery-content-id\"  class=\"button thickbox\"
     title=\"" . __("Add Gallery using Gallery Bank", gallery_bank) . "\"><span class=\"gallery_icon\"></span> Gallery Bank</a>";
    return $context;
}

add_action("admin_footer", "add_gallery_bank_popup");

function add_gallery_bank_popup()
{
    add_thickbox();
    require_once GALLERY_BK_PLUGIN_DIR . "/front_views/gallery-bank-shortcode.php";
}

function gallery_bank_short_code($atts)
{
    extract(shortcode_atts(array(
        "album_id" => "",
        "type" => "",
        "format" => "",
        "title" => "",
        "desc" => "",
        "img_in_row" => "",
        "responsive" => "",
        "albums_in_row" => "",
        "special_effect" => "",
        "animation_effect" => "",
        "image_width" => "",
        "album_title" => "",
        "thumb_width" => "",
        "thumb_height" => "",
        "widget" => "",
    ), $atts));
    return extract_short_code_for_gallery_images($album_id, $type, $format, $title, $desc, $img_in_row, $responsive, $albums_in_row, $special_effect, $animation_effect, $image_width, $album_title, $thumb_width, $thumb_height, $widget);
}
function extract_short_code_for_gallery_images($album_id, $album_type, $gallery_type, $img_title, $img_desc, $img_in_row, $responsive, $albums_in_row, $special_effect, $animation_effect, $image_width, $album_title, $thumb_width, $thumb_height, $widget)
{
    ob_start();
    global $wpdb;
    include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_before.php";

    switch ($album_type) {
        case "images":
            switch ($gallery_type) {
                case "masonry":
                    include GALLERY_BK_PLUGIN_DIR . "/front_views/masonry-gallery.php";
                    break;
                case "thumbnail":
                    include GALLERY_BK_PLUGIN_DIR . "/front_views/thumbnail-gallery.php";
                    break;
            }
            break;
        case "grid":
            include GALLERY_BK_PLUGIN_DIR . "/front_views/grid-albums.php";
            break;
        case "list":
            include GALLERY_BK_PLUGIN_DIR . "/front_views/listed-album.php";
            break;
        case "individual":
            include GALLERY_BK_PLUGIN_DIR . "/front_views/single-album.php";
            break;
    }
    include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_after.php";
    $gallery_bank_output_album = ob_get_clean();
    wp_reset_query();
    return $gallery_bank_output_album;
}

/*****************************************************************************************************************/
add_shortcode("gallery_bank", "gallery_bank_short_code");
add_action("admin_init", "backend_scripts_calls");
add_action("admin_init", "backend_css_calls");
add_action("init", "frontend_plugin_js_scripts_gallery_bank");
add_action("init", "frontend_plugin_css_scripts_gallery_bank");
add_action("admin_menu", "create_global_menus_for_gallery_bank");
add_action( "network_admin_menu", "create_global_menus_for_gallery_bank" );