<?php
require_once('../../../../../../wp-blog-header.php');

if($_REQUEST['custom_design_enable']=='yes'){
    global $wpdb;
	$sql_post="SELECT post_id FROM ".$wpdb->prefix ."postmeta where meta_key='_woo_t_shirt_custom_design_checkbox' and meta_value='on' order by post_id desc";
    $result_post=$wpdb->get_results($sql_post);
	
	foreach($result_post as $rows){
		if(!empty($rows)){
			$getImage='';
			//get color
			$result_color=get_post_meta($rows->post_id,'_woo_t_shirt_custom_design_font_color');
    		$getcolor=$result_color[0];
			
			//get thumbnail_id
			$result_thumbnail=get_post_meta($rows->post_id,'_thumbnail_id');
    		$getthumid=$result_thumbnail[0];
			
			//get image
			$get_attached_images = (array) get_posts( array(
                                                'post_type'   => 'attachment',
                                                'post_parent' =>$rows->post_id
                                                )
			);
			if (!empty($get_attached_images)){
				$img_src = $get_attached_images;
				$getImage=$img_src[0]->guid;
			}	
			//get price
			$result_price=get_post_meta($rows->post_id,'_woo_t_shirt_custom_design_price'); 
    		$getprice=$result_price[0];
			
			//get variation
			$sqls_variation="select vid from ".$wpdb->prefix ."woo_cd_variation_ids where pid='".$rows->post_id."'";
    		$get_results_variation=$wpdb->get_row($sqls_variation);
    		$getVids=$get_results_variation->vid;
			
			//get post name
			
			$sql="select post_name from ".$wpdb->prefix ."posts where ID='".$rows->post_id."'";
    		$result=$wpdb->get_row($sql);
			
			$data = new stdClass();
			$data->id =$rows->post_id;
			$data->post_name =$result->post_name;
			$data->color =$getcolor;
			$data->image_url =$getImage;
			$data->price =$getprice;
			$data->variation =$getVids;
			
			$frontview_array[] = $data;
		}
	}
    echo json_encode($frontview_array);
}

if($_REQUEST['delete_create_png_mini']=='yes'){
	$files=glob(WOO_CUSTOM_DESIGN_DIR_URL.'includes/templates/template-coffee/designit/imgprocess/*.PNG');
	foreach($files as $file){
		if(is_file($file)){
			unlink($file);
		}
	}
}
?>