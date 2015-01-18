<?php

global $wpdb;
$unique_id = rand(100, 10000);
$effect = explode("-", $special_effect);
$album_css = $wpdb->get_results
(
	"SELECT * FROM " . gallery_bank_settings()
);
if (count($album_css) != 0) {
    $setting_keys = array();
    for ($flag = 0; $flag < count($album_css); $flag++) {
        array_push($setting_keys, $album_css[$flag]->setting_key);
    }
}
switch ($album_type) {
    case "images":
        $album = $wpdb->get_var
            (
                $wpdb->prepare
                    (
                        "SELECT album_name FROM " . gallery_bank_albums() . " where album_id = %d",
                        $album_id
                    )
            );
        $pics = $wpdb->get_results
            (
                $wpdb->prepare
                    (
                        "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc",
                        $album_id
                    )
            );
	break;
    case "individual":
        if (isset($widget)) {
            $galleryWidget = $widget;
        } else {
            $galleryWidget = "";
        }
        if ($img_in_row == "") {
            $img_in_row = 0;
        }
        $album = $wpdb->get_row
            (
                $wpdb->prepare
                    (
                        "SELECT * FROM " . gallery_bank_albums() . " WHERE album_id = %d",
                        $album_id
                    )
            );
        $albumCover = $wpdb->get_row
            (
                $wpdb->prepare
                    (
                        "SELECT album_cover,thumbnail_url,video FROM " . gallery_bank_pics() . " WHERE album_cover=1 and album_id = %d",
                        $album_id
                    )
            );
	break;
    case "grid" || "list":
        if (isset($widget)) {
            $galleryWidget = $widget;
        } else {
            $galleryWidget = "";
        }
        if ($img_in_row == "") {
            $img_in_row = 0;
        }
        $album = $wpdb->get_results
		(
			"SELECT * FROM " . gallery_bank_albums() . " order by album_order asc"
		);
	break;
}

/** Switch for global settings **/

switch ($album_type) {
    case "images":
        $index = array_search("thumbnails_width", $setting_keys);
		if($widget == "true")
		{
			$thumbnails_width = intval($thumb_width);
		}
		else
		{
			$thumbnails_width = intval($album_css[$index]->setting_value);
		}

        $index = array_search("thumbnails_height", $setting_keys);
		if($widget  == "true")
		{
			$thumbnails_height = intval($thumb_height);
		}
		else
		{
			 $thumbnails_height = intval($album_css[$index]->setting_value);
		}
       

        $index = array_search("thumbnails_opacity", $setting_keys);
        $thumbnails_opacity = doubleval($album_css[$index]->setting_value);

        $index = array_search("thumbnails_border_size", $setting_keys);
        $thumbnails_border_size = intval($album_css[$index]->setting_value);

        $index = array_search("thumbnails_border_radius", $setting_keys);
        $thumbnails_border_radius = intval($album_css[$index]->setting_value);

        $index = array_search("thumbnails_border_color", $setting_keys);
        $thumbnails_border_color = $album_css[$index]->setting_value;

        $index = array_search("margin_btw_thumbnails", $setting_keys);
        $margin_btw_thumbnails = intval($album_css[$index]->setting_value);
        $newMargin = $margin_btw_thumbnails * 2;

        $perspective_margin_right = $margin_btw_thumbnails + 20;
        $perspective_margin_bottom = $margin_btw_thumbnails + 50;

        $index = array_search("thumbnail_text_color", $setting_keys);
        $thumbnail_text_color = $album_css[$index]->setting_value;

        $index = array_search("thumbnail_text_align", $setting_keys);
        $thumbnail_text_align = $album_css[$index]->setting_value;

        $index = array_search("thumbnail_font_family", $setting_keys);
        $thumbnail_font_family = $album_css[$index]->setting_value;

        $index = array_search("heading_font_size", $setting_keys);
        $heading_font_size = intval($album_css[$index]->setting_value);

        $index = array_search("text_font_size", $setting_keys);
        $text_font_size = intval($album_css[$index]->setting_value);

        $index = array_search("thumbnail_desc_length", $setting_keys);
        $thumbnail_desc_length = intval($album_css[$index]->setting_value);

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

        $index = array_search("image_title_setting", $setting_keys);
        $image_title_setting = intval($album_css[$index]->setting_value);

        $index = array_search("image_desc_setting", $setting_keys);
        $image_desc_setting = intval($album_css[$index]->setting_value);

        $index = array_search("autoplay_setting", $setting_keys);
        $autoplay_setting = intval($album_css[$index]->setting_value);
        $autoplay = ($autoplay_setting == 1) ? "true" : "false";

        $index = array_search("slide_interval", $setting_keys);
        $slide_interval = intval($album_css[$index]->setting_value);

        $index = array_search("album_seperator", $setting_keys);
        $album_seperator = intval($album_css[$index]->setting_value);

        $index = array_search("language_direction", $setting_keys);
        $lang_dir_setting = $album_css[$index]->setting_value;
		
        $video_thumb_url = plugins_url("/assets/images/video.jpg",dirname(__FILE__));
        

	break;
    case "grid" || "list" || "individual":
        $index = array_search("cover_thumbnail_width", $setting_keys);
        $cover_thumbnail_width = $album_css[$index]->setting_value;

        $index = array_search("cover_thumbnail_height", $setting_keys);
        $cover_thumbnail_height = $album_css[$index]->setting_value;

        $index = array_search("cover_thumbnail_opacity", $setting_keys);
        $cover_thumbnail_opacity = $album_css[$index]->setting_value;

        $index = array_search("cover_thumbnail_border_size", $setting_keys);
        $cover_thumbnail_border_size = $album_css[$index]->setting_value;


        $index = array_search("cover_thumbnail_border_radius", $setting_keys);
        $cover_thumbnail_border_radius = $album_css[$index]->setting_value;

        $index = array_search("cover_thumbnail_border_color", $setting_keys);
        $cover_thumbnail_border_color = $album_css[$index]->setting_value;

        $index = array_search("margin_btw_cover_thumbnails", $setting_keys);
        $margin_btw_cover_thumbnails = $album_css[$index]->setting_value;
        $margin = $margin_btw_cover_thumbnails + 10;

        $index = array_search("album_text_align", $setting_keys);
        $album_text_align = $album_css[$index]->setting_value;

        $index = array_search("album_font_family", $setting_keys);
        $album_font_family = $album_css[$index]->setting_value;

        $index = array_search("album_heading_font_size", $setting_keys);
        $album_heading_font_size = intval($album_css[$index]->setting_value);

        $index = array_search("album_text_font_size", $setting_keys);
        $album_text_font_size = intval($album_css[$index]->setting_value);

        $index = array_search("album_click_text", $setting_keys);
        $album_click_text = $album_css[$index]->setting_value;

        $index = array_search("album_text_color", $setting_keys);
        $album_text_color = $album_css[$index]->setting_value;

        $index = array_search("album_desc_length", $setting_keys);
        $album_desc_length = $album_css[$index]->setting_value;

        $index = array_search("back_button_text", $setting_keys);
        $back_button_text = $album_css[$index]->setting_value;

        $index = array_search("button_color", $setting_keys);
        $button_color = $album_css[$index]->setting_value;

        $index = array_search("button_text_color", $setting_keys);
        $button_text_color = $album_css[$index]->setting_value;

        $index = array_search("album_seperator", $setting_keys);
        $album_seperator = intval($album_css[$index]->setting_value);

        $index = array_search("language_direction", $setting_keys);
        $lang_dir_setting = $album_css[$index]->setting_value;

	break;
}

?>
    <!-- Switch for global css  -->
<style type="text/css">
    <?php
    switch($album_type)
    {
        case "images":
                ?>
			    /*noinspection ALL*/

			    .dynamic_css {
			        border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?> !important;
			        border-radius: <?php echo $thumbnails_border_radius;?>px !important;
			        -moz-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
			        -webkit-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
			        -khtml-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
			        -o-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
			    }

			    .dynamic_css img {
			        margin: 0 !important;
			        padding: 0 !important;
			        border: 0 !important;
			    }
				.thumbnail_width<?php echo $unique_id;?>
				{
                    width: <?php echo $thumbnails_width;?>px !important;
                    height: <?php echo $thumbnails_height;?>px !important;
                    box-sizing: border-box !important;
				}
			    /*noinspection ALL*/
			    .images-in-row_<?php echo $unique_id;?> a, 
				.widget-images-in-row_<?php echo $unique_id;?> a
			    {
			    	border-bottom: none !important;
			    }
			   <?php
			    if($widget != "true")
				{
			   ?>
				    .imgLiquidFill {
					    <?php
					    if($effect[0] == "")
					    {
					        ?> 
					        width: <?php echo $thumbnails_width + ($thumbnails_border_size * 2) ;?>px !important;
	                        box-sizing: border-box !important;
					   		<?php
					    }
					    else
					    {
					        ?> width: <?php echo $thumbnails_width;?>px !important;
	                            box-sizing: border-box !important;
					        <?php
					    }
					    ?>
					    height: <?php echo $thumbnails_height;?>px !important;
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
				                ?>
				                height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil(count($pics) / $img_in_row) + 20 ;?>px !important;
				                <?php
					             if($effect[0] != "")
	                             {
	                               ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + 10) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                             else
	                             {
	                                ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                        }
	                        else if($gallery_type == "masonry")
	                        {
	                        	if($effect[0] != "")
	                             {
	                               ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2) + 10) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                             else
	                             {
	                                ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2)) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                        }
	            		?> clear: both;
					    }
						<?php
					}
					?>
					.images-in-row_<?php echo $unique_id;?> a:hover
                    {
                        text-decoration:none !important;
                    }
					.margin_thumbs {
				        margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
				        margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
				    }
					<?php
				}
				else
				{
					?>
					.widgetImgLiquidFill<?php echo $unique_id;?> {
						<?php
					    if($effect[0] == "")
					    {
					        ?> 
					        width: <?php echo $thumbnails_width + ($thumbnails_border_size * 2) ;?>px !important;
	                        box-sizing: border-box !important;
					   		<?php
					    }
					    else
					    {
					        ?> width: <?php echo $thumbnails_width;?>px !important;
	                            box-sizing: border-box !important;
					        <?php
					    }
					    ?>
					    height: <?php echo $thumbnails_height;?>px !important;
				    }
				    .widget-images-in-row_<?php echo $unique_id;?> a:hover
					{
						text-decoration: none !important;
					}
				    <?php
				    if($responsive != "true")
					{
				    	?>
					    .widget-images-in-row_<?php echo $unique_id;?>
					    {
					        <?php
	
					        if($gallery_type != "masonry")
					        {
					        	?>
					                height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil(count($pics) / $img_in_row) + 20 ;?>px !important;
					                <?php
					             if($effect[0] != "")
	                             {
	                               ?> 
	                               width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + 10) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                             else
	                             {
	                                ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                        }
	                        else if($gallery_type == "masonry")
	                        {
	                        	if($effect[0] != "")
	                             {
	                               ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2) + 10) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                             else
	                             {
	                                ?> width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2)) * $img_in_row ;?>px !important;
	                                <?php
	                             }
	                        }
	            			?> clear: both;
					    }
					<?php
					}
					?>
				    .widget_margin_thumbs<?php echo $unique_id;?> {
				        margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
				        margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
				    }
					<?php
				}
			    ?>
			    /*noinspection ALL*/
			    .opactiy_thumbs {
			        opacity: <?php echo $thumbnails_opacity;?> !important;
			        -moz-opacity: <?php echo $thumbnails_opacity; ?> !important;
			        -khtml-opacity: <?php echo $thumbnails_opacity; ?> !important;
			    }

			    /*noinspection ALL*/

			    .shutter-gb-img-wrap {
			        margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
			        margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
			    }

			    
			    .overlay_text > h5 {
			    	margin-top:10px !important;
			        padding: 0 10px 0 10px !important;
			        line-height: 1.5em !important;
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $thumbnail_text_align;?> !important;
			        font-family: <?php echo $thumbnail_font_family;?> !important;
			        color: <?php echo $thumbnail_text_color?> !important;
			        font-size: <?php echo $heading_font_size;?>px !important;
			    }

			    .overlay_text > p {
			        padding: 10px 10px 0 10px !important;
			        line-height: 1.5em !important;
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $thumbnail_text_align;?> !important;
			        font-family: <?php echo $thumbnail_font_family;?> !important;
			        color: <?php echo $thumbnail_text_color?> !important;
			        font-size: <?php echo $text_font_size?>px !important;
			    }
			<?php
		break;
		case "grid" || "list" || "individual":
			?>
		    .dynamic_cover_css {
		        border: <?php echo $cover_thumbnail_border_size;?>px solid <?php echo $cover_thumbnail_border_color;?> !important;
		        -moz-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
		        -webkit-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
		        -khtml-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
		        -o-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
		        border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
		        opacity: <?php echo $cover_thumbnail_opacity;?> !important;
		        -moz-opacity: <?php echo $cover_thumbnail_opacity;?> !important;
		        -khtml-opacity: <?php echo $cover_thumbnail_opacity;?> !important;
		    }
		
		    .dynamic_cover_css img {
		        margin: 0 !important;
		        padding: 0 !important;
		        border: 0 !important;
		    }
		
		    .imgLiquid {
		        width: <?php echo $cover_thumbnail_width;?>px !important;
		        height: <?php echo $cover_thumbnail_height;?>px !important;
		        display: inline-block;
                box-sizing: border-box !important;
		    }
		
		    .album_back_btn {
		        margin-top: 10px !important;
		        border-radius: 8px !important;
		        padding: 10px 10px !important;
		        border: none !important;
		        clear: both;
		        cursor: pointer !important;
		        background: <?php echo $button_color;?> linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -webkit-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -moz-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -o-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -ms-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -webkit-gradient(linear, left bottom, left top, color-stop(0%, rgba(0, 0, 0, 0.1)), color-stop(100%, rgba(255, 255, 255, 0))) !important;
		    }
		
		    .album_back_btn:hover {
		        cursor: pointer !important;
		        background: <?php echo $button_color;?> linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -webkit-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -moz-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -o-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -ms-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
		        background: <?php echo $button_color;?> -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0.1)), color-stop(100%, rgba(255, 255, 255, 0))) !important;
		    }

		    #view_gallery_bank_albums_<?php echo $unique_id;?> {
			    <?php
			    if($album_seperator == 1)
			    {
			        ?> clear: both;
			    	<?php
				}
				else
				{
				    ?> margin-bottom: 20px !important;
				    <?php
				}
				?>
		    }
			<?php
		    if($album_type == "grid")
		    {
		    ?>
			    /*********** For Grid Albums ********/
			    .albums-in-row_<?php echo $unique_id;?> {
			        width: <?php echo ($cover_thumbnail_width + ($margin_btw_cover_thumbnails * 2)) * $albums_in_row ;?>px !important;
				    <?php
				    if($album_seperator == 1)
				    {
						?> clear: both;
						<?php
					}
					else
					{
					    ?> margin-bottom: 20px !important;
					    <?php
					}
					?>
				}

			    .albums_margin {
			        margin-right: <?php echo $margin_btw_cover_thumbnails; ?>px !important;
			        margin-bottom: <?php echo $margin_btw_cover_thumbnails; ?>px !important;
			        display: inline-block !important;
			        width: <?php echo $cover_thumbnail_width;?>px !important;
			        vertical-align: text-top !important;
			        cursor: pointer;
			    }
				
			    .album_holder {
			        display: inline-block !important;
			        width: <?php echo $cover_thumbnail_width;?>px !important;
			    }
			
			    .album_holder h5 {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        font-family: <?php echo $album_font_family;?> !important;
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_heading_font_size;?>px !important;
			        cursor: pointer;
			        margin: 10px 0 0 0 !important;
			        padding: 0 !important;
			        line-height: 1.5em !important;
			    }
			
			    .album_holder p {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        font-family: <?php echo $album_font_family;?> !important;
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_text_font_size?>px !important;
			        cursor: pointer;
			        margin: 10px 0 0 0 !important;
			        padding: 0 !important;
			        line-height: 1.5em !important;
			    }
			
			    .album_holder > div.album_link {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        margin: 10px 0 0 0 !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        cursor: pointer;
			    }

			    div.album_link a {
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_text_font_size?>px !important;
			        font-family: <?php echo $album_font_family;?> !important;
			    }
    			<?php
			}
		    if($album_type == "individual")
		    {
			    ?>
			    /*********** For Single Albums ********/
			    .album_content_holder {
			        display: inline-block !important;
			        width: 300px !important;
			        vertical-align: top !important;
			    }
			
			    .album_content_div<?php echo $unique_id;?> {
			        cursor: pointer;
			        width: 100% !important;
					<?php
				    if($album_seperator == 1)
				    {
				        ?> clear: both;
					    <?php
					}
					else
					{
					    ?> margin-bottom: 20px !important;
					    <?php
					}
					?> display: inline-block;
				}

			    .album_content_holder h5 {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        font-family: <?php echo $album_font_family;?> !important;
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_heading_font_size;?>px !important;
			        cursor: pointer;
			        line-height: 1.5em !important;
			        margin: 0 0 10px 10px !important;
			        padding: 0 !important;
			    }
			
			    .album_content_holder p {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        font-family: <?php echo $album_font_family;?> !important;
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_text_font_size?>px !important;
			        cursor: pointer;
			        margin: 0 0 0 10px !important;
			        padding: 0 !important;
			        line-height: 1.5em !important;
			    }

			    .album_content_holder div.album_view_link {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        margin: 10px 0 0 10px !important;
			        padding: 0 !important;
			        cursor: pointer;
			    }
			
			    div.album_view_link a {
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_text_font_size?>px !important;
			        font-family: <?php echo $album_font_family;?> !important;
			    }

    		<?php
    		}
		    if($album_type == "list")
		    {
				 ?>
			    /*********** For Listed Albums ********/
			     .content_holder {
			        display: inline-block !important;
			        width: 300px !important;
			        vertical-align: top !important;
			    }
		
			    .list_album_content_div<?php echo $unique_id;?> {
			        margin-bottom: <?php echo $margin_btw_cover_thumbnails; ?>px !important;
			        cursor: pointer;
			        width: 100% !important;
			        display: inline-block;
			    }
			
			    .content_holder h5 {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        font-family: <?php echo $album_font_family;?> !important;
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_heading_font_size;?>px !important;
			        cursor: pointer;
			        margin: 0 0 10px 10px !important;
			        padding: 0 !important;
			        line-height: 1.5em !important;
			    }
		
			    .content_holder p {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        font-family: <?php echo $album_font_family;?> !important;
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_text_font_size?>px !important;
			        cursor: pointer;
			        margin: 0 0 0 10px !important;
			        padding: 0 !important;
			        line-height: 1.5em !important;
			    }
			
			    .content_holder div.view_link {
			        direction: <?php echo $lang_dir_setting; ?> !important;
			        text-align: <?php echo $album_text_align;?> !important;
			        margin: 10px 0 0 10px !important;
			        padding: 0 !important;
			        cursor: pointer;
			    }
			
			    div.view_link a {
			        color: <?php echo $album_text_color?> !important;
			        font-size: <?php echo $album_text_font_size?>px !important;
			        font-family: <?php echo $album_font_family;?> !important;
			    }
		
		    	<?php
		    }
		break;
	}
    if($album_type == "images")
    {
        ?>
        .pp_pic_holder.pp_default {
            background-color: #ffffff;
        }

        div.pp_overlay {
            background-color: <?php echo $lightbox_overlay_bg_color;?> !important;
            opacity: <?php echo $lightbox_overlay_opacity;?> !important;
            -moz-opacity: <?php echo $lightbox_overlay_opacity; ?> !important;
		    filter: alpha(opacity=<?php echo $lightbox_overlay_opacity; ?>);
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
        <?php
    }
     $class_images_in_row = $widget == "true" ? "widget-images-in-row_".$unique_id : "images-in-row_".$unique_id;
	?>
</style>

    <!-- Global Styling  -->
<?php
switch ($album_type) {
    case "images":
        if ($album_title == "true")
        {
            ?>
            <h3><?php echo stripcslashes(htmlspecialchars_decode($album)); ?></h3>
            <?php
        }
	break;
}
?>