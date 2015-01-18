<?php
if (isset($_REQUEST["param"])) {
    global $wpdb;
    if ($_REQUEST["param"] == "show_album_gallery") {
        $album_id = intval($_REQUEST["album_id"]);
        $img_desc = esc_attr($_REQUEST["isImageDesc"]);
        $gallery_type = esc_attr($_REQUEST["gallery_format"]);
        $img_title = esc_attr($_REQUEST["isImageTitle"]);
        $img_in_row = esc_attr($_REQUEST["images_in_row"]);
        $widget = esc_attr($_REQUEST["iswidget"]);
        $special_effect = esc_attr($_REQUEST["special_effects"]);
        $animation_effect = esc_attr($_REQUEST["animation_effects"]);
        $image_width = esc_attr($_REQUEST["filmstrip_width"]);
        $album_title = esc_attr($_REQUEST["show_album_title"]);
		$responsive = esc_attr($_REQUEST["isResponsive"]);
		
        $album_type = "images";
        include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_before.php";
        switch ($gallery_type)
        {
            case "masonry":
                include GALLERY_BK_PLUGIN_DIR . "/front_views/masonry-gallery.php";
                break;
            case "thumbnail":
                include GALLERY_BK_PLUGIN_DIR . "/front_views/thumbnail-gallery.php";
                break;
        }
        include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_after.php";
        die();
    }
}
?>