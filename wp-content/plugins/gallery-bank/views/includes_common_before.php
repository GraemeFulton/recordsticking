<?php

global $wpdb;
global $current_user;
$unique_id = rand(100, 10000);
if (isset($_REQUEST["row"])) {
    $img_in_row = intval($_REQUEST["row"]);
} else {
    $img_in_row = 3;
}

$album_id = intval($_REQUEST["album_id"]);
$album = $wpdb->get_var
(
    $wpdb->prepare
    (
        "SELECT album_name FROM " . gallery_bank_albums() . " WHERE album_id = %d",
        $album_id
    )
);
$album_css = $wpdb->get_results
(
	"SELECT * FROM " . gallery_bank_settings()
);
/***** Global Queries ******/

$pics = $wpdb->get_results
(
    $wpdb->prepare
    (
        "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc",
        $album_id
    )
);
/***** Global Settings ******/
if (count($album_css) != 0) {
    $setting_keys = array();
    for ($flag = 0; $flag < count($album_css); $flag++) {
        array_push($setting_keys, $album_css[$flag]->setting_key);
    }
    $index = array_search("thumbnails_width", $setting_keys);
    $thumbnails_width = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_height", $setting_keys);
    $thumbnails_height = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_opacity", $setting_keys);
    $thumbnails_opacity = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_border_size", $setting_keys);
    $thumbnails_border_size = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_border_radius", $setting_keys);
    $thumbnails_border_radius = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_border_color", $setting_keys);
    $thumbnails_border_color = $album_css[$index]->setting_value;

    $index = array_search("margin_btw_thumbnails", $setting_keys);
    $margin_btw_thumbnails = $album_css[$index]->setting_value;
    $newMargin = $margin_btw_thumbnails * 3;

    $index = array_search("lightbox_type", $setting_keys);
    $lightbox_type = $album_css[$index]->setting_value;

    $index = array_search("lightbox_overlay_opacity", $setting_keys);
    $lightbox_overlay_opacity = doubleval($album_css[$index]->setting_value);

    $index = array_search("lightbox_overlay_border_size", $setting_keys);
    $lightbox_overlay_border_size = intval($album_css[$index]->setting_value);

    $index = array_search("lightbox_overlay_border_radius", $setting_keys);
    $lightbox_overlay_border_radius = intval($album_css[$index]->setting_value);

    $index = array_search("lightbox_text_color", $setting_keys);
    $lightbox_text_color = $album_css[$index]->setting_value;

    $index = array_search("lightbox_overlay_border_color", $setting_keys);
    $lightbox_overlay_border_color = $album_css[$index]->setting_value;
    $lightbox_border_color_value = $lightbox_overlay_border_size . "px solid " . $lightbox_overlay_border_color;

    $index = array_search("lightbox_inline_bg_color", $setting_keys);
    $lightbox_inline_bg_color = $album_css[$index]->setting_value;

    $index = array_search("lightbox_overlay_bg_color", $setting_keys);
    $lightbox_overlay_bg_color = $album_css[$index]->setting_value;

    $index = array_search("lightbox_fade_in_time", $setting_keys);
    $lightbox_fade_in_time = intval($album_css[$index]->setting_value);

    $index = array_search("lightbox_fade_out_time", $setting_keys);
    $lightbox_fade_out_time = intval($album_css[$index]->setting_value);

    $index = array_search("lightbox_text_align", $setting_keys);
    $lightbox_text_align = $album_css[$index]->setting_value;

    $index = array_search("lightbox_font_family", $setting_keys);
    $lightbox_font_family = $album_css[$index]->setting_value;

    $index = array_search("lightbox_heading_font_size", $setting_keys);
    $lightbox_heading_font_size = intval($album_css[$index]->setting_value);

    $index = array_search("lightbox_text_font_size", $setting_keys);
    $lightbox_text_font_size = intval($album_css[$index]->setting_value);

    $index = array_search("facebook_comments", $setting_keys);
    $facebook_comments = intval($album_css[$index]->setting_value);

    $index = array_search("social_sharing", $setting_keys);
    $social_sharing = intval($album_css[$index]->setting_value);

    $index = array_search("image_title_setting", $setting_keys);
    $image_title_setting = intval($album_css[$index]->setting_value);

    $index = array_search("image_desc_setting", $setting_keys);
    $image_desc_setting = intval($album_css[$index]->setting_value);

    $index = array_search("autoplay_setting", $setting_keys);
    $autoplay_setting = intval($album_css[$index]->setting_value);
    $autoplay = ($autoplay_setting == 1) ? "true" : "false";

    $index = array_search("slide_interval", $setting_keys);
    $slide_interval = intval($album_css[$index]->setting_value);

    $index = array_search("language_direction", $setting_keys);
    $lang_dir_setting = $album_css[$index]->setting_value;

    $video_thumb_url = plugins_url("/assets/images/video.jpg",dirname(__FILE__));
}
?>
    <!-- Global Styling  -->
<style type="text/css">
    .dynamic_css {
        border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?> !important;
        border-radius: <?php echo $thumbnails_border_radius;?>px !important;
        -moz-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
        -webkit-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
        -khtml-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
        -o-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
        opacity: <?php echo $thumbnails_opacity;?> !important;
        -moz-opacity: <?php echo $thumbnails_opacity; ?> !important;
        -khtml-opacity: <?php echo $thumbnails_opacity; ?> !important;
        margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
        margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
    }
     <?php
    if($responsive != "true")
	{
	?>
    	.images-in-row_<?php echo $unique_id;?>
	    {
	        <?php

	        if($gallery_type != "masonry")
	        {
	            if($pagination_setting == 1)
	            {
	                ?>
	            	height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil($images_per_page / $img_in_row) + 20 ;?>px !important;
	                <?php
	            }
	            else
	            {
	                ?>
	                height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil(count($pics) / $img_in_row) + 20 ;?>px !important;
	                <?php
	            }
                    ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)) * $img_in_row ;?>px !important;
                    <?php
            }
            else if($gallery_type == "masonry")
            {
            
                ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2)) * $img_in_row ;?>px !important;
                <?php
            }
		?> clear: both;
	    }
		<?php
	}
	?>
	.images-in-row_<?php echo $unique_id;?> a
    {
        text-decoration:none !important;
    }
    .imgLiquidFill {
        width: <?php echo $thumbnails_width;?>px !important;
        height: <?php echo $thumbnails_height;?>px !important;
        display: inline-block !important;
        box-sizing: border-box !important;
    }

    .gallery_images {
        width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)) * $img_in_row ;?>px !important;
    }
	.pp_pic_holder.pp_default {
	    background-color: #ffffff;
    }
    
    div.pp_overlay {
        background-color: <?php echo $lightbox_overlay_bg_color;?> !important;
        opacity: <?php echo $lightbox_overlay_opacity;?> !important;
    }

    .pp_description p {
        direction: <?php echo $lang_dir_setting; ?> !important;
        color: <?php echo $lightbox_text_color;?> !important;
        text-align: <?php echo $lightbox_text_align;?> !important;
        font-family: <?php echo $lightbox_font_family;?> !important;
        font-size: <?php echo $lightbox_text_font_size;?>px !important;
    }

    .pp_description h5 {
        direction: <?php echo $lang_dir_setting; ?> !important;
        color: <?php echo $lightbox_text_color;?> !important;
        text-align: <?php echo $lightbox_text_align;?> !important;
        font-family: <?php echo $lightbox_font_family;?> !important;
        font-size: <?php echo $lightbox_heading_font_size;?>px !important;
    }

    div.pp_default .pp_top .pp_middle {
        background-color: #ffffff;
    }

    div.pp_default .pp_content_container .pp_left {
        background-color: #ffffff;
        padding-left: 16px;
    }

    div.pp_default .pp_content_container .pp_right {
        background-color: #ffffff;
        padding-right: 13px;
    }

    div.pp_default .pp_bottom .pp_middle {
        background-color: #ffffff;
    }

    div.pp_default .pp_content, div.light_rounded .pp_content {
        background-color: #ffffff;
    }

    .pp_details {
        background-color: #ffffff;
    }

    .ppt {
        display: none !important;
    }

    div.pp_pic_holder {
        border: <?php echo $lightbox_border_color_value;?> !important;
        border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
        -moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
	    -webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
	    -khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
	    -o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
    }
</style>
