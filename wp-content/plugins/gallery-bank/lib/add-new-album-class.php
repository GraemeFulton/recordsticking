<?php
$dynamicArray = array();
$dynamicId = mt_rand(10, 10000);
	switch($gb_role)
	{
		case "administrator":
			$user_role_permission = "manage_options";
		break;
		case "editor":
			$user_role_permission = "publish_pages";
		break;
		case "author":
			$user_role_permission = "publish_posts";
		break;
		
	}

if (!current_user_can($user_role_permission))
{
	return;
}
else
{
	if (isset($_REQUEST["param"])) 
	{
		switch($_REQUEST["param"])
		{
			case "add_new_dynamic_row_for_image":
		        $img_path = esc_attr($_REQUEST["img_path"]);
		        $img_name = esc_attr($_REQUEST["img_name"]);
		        $img_width = intval($_REQUEST["image_width"]);
		        $img_height = intval($_REQUEST["image_height"]);
				$picid = intval($_REQUEST["picid"]);
		
		
		        process_image_upload($img_path, $img_width, $img_height);
		
		        $column1 = "<input type=\"checkbox\" id=\"ux_grp_select_items_" . $picid . "\" name=\"ux_grp_select_items_" . $picid . "\" value=\"" . $picid . "\" />";
		        array_push($dynamicArray, $column1);
		
		        $column2 = "<a  href=\"javascript:void(0);\" title=\"" . $img_name . "\" >
						<img type=\"image\" imgPath=\"" . $img_path . "\"  src=\"" . GALLERY_BK_THUMB_SMALL_URL . $img_path . "\" id=\"ux_gb_img\" name=\"ux_gb_img\" class=\"img dynamic_css\" imageid=\"" . $picid . "\" width=\"" . $img_width . "\"/></a><br/>
						<label><strong>" . $img_name . "</strong></label><br/><label>" . date("F j, Y") . "</label><br/>
						<input type=\"radio\" style=\"cursor: pointer;\" onclick=\"select_one_radio(this);\" id=\"ux_rdl_cover\" name=\"ux_album_cover\" /><label>" . __(" Set as Album Cover", gallery_bank) . "</label>";
		        array_push($dynamicArray, $column2);
		
		        $column3 = "<input placeholder=\"" . __("Enter your Title", gallery_bank) . "\" class=\"layout-span12\" type=\"text\" name=\"ux_img_title_" . $picid . "\" id=\"ux_img_title_" . $picid . "\" />
						<textarea placeholder=\"" . __("Enter your Description ", gallery_bank) . "\" style=\"margin-top:20px\" rows=\"5\" class=\"layout-span12\" name=\"ux_txt_desc_" . $picid . "\"  id=\"ux_txt_desc_" . $picid . "\"></textarea>";
		        array_push($dynamicArray, $column3);
		        $column4 = "<input placeholder=\"" . __("Enter your Tags", gallery_bank) . "\" class=\"layout-span12\" readonly=\"readonly\" type=\"text\" onkeypress=\"return preventDot(event);\" name=\"ux_txt_tags_" . $picid . "\" id=\"ux_txt_tags_" . $picid . "\" />";
		        array_push($dynamicArray, $column4);
		        $column5 = "<input value=\"http://\" type=\"text\" id=\"ux_txt_url_" . $picid . "\" name=\"ux_txt_url_" . $picid . "\" class=\"layout-span12\" />";
		        array_push($dynamicArray, $column5);
		        $column6 = "<a class=\"btn hovertip\" id=\"ux_btn_delete\" style=\"cursor: pointer;\" data-original-title=\"" . __("Delete Image", gallery_bank) . "\" onclick=\"deleteImage(this);\" controlId =\"" . $picid . "\" ><i class=\"icon-trash\"></i></a>";
		        array_push($dynamicArray, $column6);
		        echo json_encode($dynamicArray);
		        die();
			break;
			case "add_pic": 
		        $ux_albumid = intval($_REQUEST["album_id"]);
		        $ux_controlType = esc_attr($_REQUEST["controlType"]);
		        $ux_img_name = esc_attr(html_entity_decode($_REQUEST["imagename"]));
		        $img_gb_path = esc_attr($_REQUEST["img_gb_path"]);
		
				if ($ux_controlType == "image") 
				{
	                $wpdb->query
	                    (
	                        $wpdb->prepare
	                            (
	                                "INSERT INTO " . gallery_bank_pics() . " (album_id,thumbnail_url,title,description,url,video,date,tags,pic_name,album_cover)
								VALUES(%d,%s,%s,%s,%s,%d,CURDATE(),%s,%s,%d)",
	                                $ux_albumid,
	                                $img_gb_path,
	                                "",
	                                "",
	                                "http://",
	                                0,
	                                "",
	                                $ux_img_name,
	                                0
	                            )
	                    );
		            echo $pic_id = $wpdb->insert_id;
		            $wpdb->query
		                (
		                    $wpdb->prepare
		                        (
		                            "UPDATE " . gallery_bank_pics() . " SET sorting_order = %d WHERE pic_id = %d",
		                            $pic_id,
		                            $pic_id
		                        )
		                );
				}
	       		 die();
			break;
			case "update_album":
		        $albumId = intval($_REQUEST["albumid"]);
		        $ux_edit_album_name1 = htmlspecialchars(esc_attr($_REQUEST["edit_album_name"]));
		        $ux_edit_album_name = ($ux_edit_album_name1 == "") ? "Untitled Album" : $ux_edit_album_name1;
		        $ux_edit_description = htmlspecialchars($_REQUEST["uxEditDescription"]);
		        $wpdb->query
		            (
		                $wpdb->prepare
		                    (
		                        "UPDATE " . gallery_bank_albums() . " SET album_name = %s, description = %s WHERE album_id = %d",
		                        $ux_edit_album_name,
		                        $ux_edit_description,
		                        $albumId
		                    )
		            );
		        die();
			break;
			case "update_pic":
	            $album_data = json_decode(stripcslashes($_REQUEST["album_data"]),true);
	            foreach($album_data as $field)
	            {
	                if ($field[0] == "image")
	                {
	                    if ($field[3] == "checked")
	                    {
	                        $wpdb->query
	                            (
	                                $wpdb->prepare
	                                    (
	                                        "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, url = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
	                                        htmlspecialchars($field[4]),
	                                        htmlspecialchars($field[5]),
	                                        $field[7],
	                                        htmlspecialchars($field[6]),
	                                        1,
	                                        $field[1]
	                                    )
	                            );
	                        process_album_upload($field[2], $field[8], $field[9]);
	                    }
	                    else
	                    {
	                        $wpdb->query
	                            (
	                                $wpdb->prepare
	                                    (
	                                        "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, url = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
	                                        htmlspecialchars($field[4]),
	                                        htmlspecialchars($field[5]),
	                                        $field[7],
	                                        htmlspecialchars($field[6]),
	                                        0,
	                                        $field[1]
	                                    )
	                            );
	                    }
	                }
	                else
	                {
	                    $wpdb->query
	                        (
	                            $wpdb->prepare
	                                (
	                                    "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
	                                    htmlspecialchars($field[4]),
	                                    htmlspecialchars($field[5]),
	                                    htmlspecialchars($field[6]),
	                                    0,
	                                    $field[1]
	                                )
	                        );
	                }
	            }
	            die();
       		break;
			case "delete_pic":
		        $delete_array = (html_entity_decode($_REQUEST["delete_array"]));
		        $albumId = intval($_REQUEST["albumid"]);
		
		        $wpdb->query
		        (
					"DELETE FROM " . gallery_bank_pics() . " WHERE pic_id in ($delete_array)"
		        );
		        die();
	        break;
			case "Delete_album":
		        $album_id = intval($_REQUEST["album_id"]);
		        $wpdb->query
		        (
		            $wpdb->prepare
		                (
		                    "DELETE FROM " . gallery_bank_pics() . " WHERE album_id = %d",
		                    $album_id
		                )
		        );
		        $wpdb->query
		        (
		            $wpdb->prepare
		                (
		                    "DELETE FROM " . gallery_bank_albums() . " WHERE album_id = %d",
		                    $album_id
		                )
		        );
		        die();
			break;
		}
	}
}
function process_image_upload($image, $width, $height)
{
    $temp_image_path = GALLERY_MAIN_UPLOAD_DIR . $image;
    $temp_image_name = $image;
    list(, , $temp_image_type) = getimagesize($temp_image_path);
    if ($temp_image_type === NULL) {
        return false;
    }
    $uploaded_image_path = GALLERY_MAIN_UPLOAD_DIR . $temp_image_name;
    move_uploaded_file($temp_image_path, $uploaded_image_path);
    $type = explode(".", $image);
    $thumbnail_image_path = GALLERY_MAIN_THUMB_DIR . preg_replace("{\\.[^\\.]+$}", ".".$type[1], $temp_image_name);
   
    $result = generate_thumbnail($uploaded_image_path, $thumbnail_image_path, $width, $height);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

/******************************************Code for Album cover thumbs Creation**********************/
function process_album_upload($album_image, $width, $height)
{
    $temp_image_path = GALLERY_MAIN_UPLOAD_DIR . $album_image;
    $temp_image_name = $album_image;
    list(, , $temp_image_type) = getimagesize($temp_image_path);
    if ($temp_image_type === NULL) {
        return false;
    }
	$uploaded_image_path = GALLERY_MAIN_UPLOAD_DIR . $temp_image_name;
    move_uploaded_file($temp_image_path, $uploaded_image_path);
	$type = explode(".", $album_image);
	$thumbnail_image_path = GALLERY_MAIN_ALB_THUMB_DIR . preg_replace("{\\.[^\\.]+$}", ".".$type[1], $temp_image_name);
    
    $result = generate_thumbnail($uploaded_image_path, $thumbnail_image_path, $width, $height);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

function generate_thumbnail($source_image_path, $thumbnail_image_path, $imageWidth, $imageHeight)
{
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    $source_gd_image = false;
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    if ($source_image_width > $source_image_height) {
        $real_height = $imageHeight;
        $real_width = $imageHeight * $source_aspect_ratio;
    } else if ($source_image_height > $source_image_width) {
        $real_height = $imageWidth / $source_aspect_ratio;
        $real_width = $imageWidth;

    } else {

        $real_height = $imageHeight > $imageWidth ? $imageHeight : $imageWidth;
        $real_width = $imageWidth > $imageHeight ? $imageWidth : $imageHeight;
    }

    $thumbnail_gd_image = imagecreatetruecolor($real_width, $real_height);
    
	if(($source_image_type == 1) || ($source_image_type==3)){
		imagealphablending($thumbnail_gd_image, false);
		imagesavealpha($thumbnail_gd_image, true);
		$transparent = imagecolorallocatealpha($thumbnail_gd_image, 255, 255, 255, 127);
		imagecolortransparent($thumbnail_gd_image, $transparent);
		imagefilledrectangle($thumbnail_gd_image, 0, 0, $real_width, $real_height, $transparent);
 	}
	else
	{
		$bg_color = imagecolorallocate($thumbnail_gd_image, 255, 255, 255);
		imagefilledrectangle($thumbnail_gd_image, 0, 0, $real_width, $real_height, $bg_color);
	}
	imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $real_width, $real_height, $source_image_width, $source_image_height);
	switch ($source_image_type)
	{
		case IMAGETYPE_GIF:
			imagepng($thumbnail_gd_image, $thumbnail_image_path, 9 );
		break;
		case IMAGETYPE_JPEG:
			imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 100);
		break;
		case IMAGETYPE_PNG:
			imagepng($thumbnail_gd_image, $thumbnail_image_path, 9 );
		break;
	}
	imagedestroy($source_gd_image);
	imagedestroy($thumbnail_gd_image);
	return true;
}

?>
