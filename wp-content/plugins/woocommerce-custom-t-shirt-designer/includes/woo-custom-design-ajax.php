<?php
    require_once('../../../../wp-blog-header.php');
    if($_REQUEST['action']=='add_variation_to_post'){
        global $wpdb;
        if($_REQUEST['status']=='checked'){
            $post_datas=array(
                        'post_author'=>1,
                        'post_status'=>'draft',
                        'post_name'=>'product-'.$_REQUEST['prod_ids'].'-variation',
                        'post_parent'=>$_REQUEST['prod_ids'],
                        'post_type'=>'product_variation'
            );
            $post_id=wp_insert_post($post_datas);
            
            $sqls="select id from ".$wpdb->prefix ."woo_cd_variation_ids where pid='".$_REQUEST['prod_ids']."'";
            $get_results=$wpdb->get_row($sqls);
            if(empty($get_results)){
                $save_data=array(
                                'pid'=>$_REQUEST['prod_ids'],
                                'vid'=>$post_id,
                );
                $wpdb->insert($wpdb->prefix ."woo_cd_variation_ids",$save_data);
            }
            elseif (!empty($get_results)) {
                $update_data=array(
                                'pid'=>$_REQUEST['prod_ids'],
                                'vid'=>$post_id

                );
                $where = array('pid' =>$_REQUEST['prod_ids']);
                
                $wpdb->update($wpdb->prefix ."woo_cd_variation_ids",$update_data,$where);  
            }
            echo $post_id;
        }
        elseif ($_REQUEST['status']=='unchecked') {
            wp_delete_post($_REQUEST['prod_ids']);
        }
    }
    
    if($_REQUEST['get_custom_img_url']=='custom_img'){
        $sqls="select margeimage_url from ".$wpdb->prefix ."woo_cd_custom_design where session_id='".$_REQUEST['session_id']."'";
        $get_results=$wpdb->get_row($sqls);
		echo $get_results->margeimage_url;
    }
	
    if($_REQUEST['get_custom_img_url_admin']=='custom_img_admin'){
        $custom_data=array();    
        $sqls_admin="select * from ".$wpdb->prefix ."woo_cd_custom_design where session_id='".$_REQUEST['session_id']."'";
        $get_results=$wpdb->get_results($sqls_admin);
        foreach($get_results as $rows){
            $data = new stdClass();
            $data->p_id =$rows->pid;
            $data->margeimage_url =$rows->margeimage_url;
            $data->color=$rows->color;
            $data->fontName=$rows->font_name;
            $data->position=$rows->imageposition;
            $custom_data[]= $data;
        }
        echo json_encode($custom_data);
    }
	
	if($_REQUEST['save_sample_logo_ids']=='logo_ids'){
		global $wpdb;
                $sample_ids_empty_option='';
                $get_sample_ids='';
                $get_uncheck_ids='';
                $get_check_ids='';
                $array_check_ids='';
                $array_save_ids='';
                $store_check_ids_1='';
                $store_check_ids_2='';
                $total_sample_ids='';
                $get_ids='';
                $check_array='';
		$result = get_option('woo_custom_design_sample_logo_ids');
                $get_sample_logos_ids="select id from ".$wpdb->prefix ."woo_cd_sample_logo";
                $get_Sample_ids=$wpdb->get_results($get_sample_logos_ids);
                foreach($get_Sample_ids as $rows){
                    $get_ids.=$rows->id.',';
                }
                $check_array=explode(',',trim($get_ids,','));
                $get_request_ids=trim($_REQUEST['id'],',');
                $get_request_sample_ids=explode(',',$get_request_ids);
                
                if(count($get_request_sample_ids)>10){
                    echo "over";
                
                }else{
                        if(!empty($result['logo_id'])){
                            $get_sample_ids=$result['logo_id'];
                            $get_check_ids=trim($_REQUEST['id'],',');
                            $array_save_ids=explode(',',$get_sample_ids);
                            $array_check_ids=explode(',',$get_check_ids);
                            foreach($array_check_ids as $ids){
                                if(!in_array($ids,$array_save_ids)){
                                    $store_check_ids_1.=$ids.',';
                                }
                            }
                            $total_sample_ids=$get_sample_ids.','.trim($store_check_ids_1,',');
                            $get_uncheck_ids=trim($_REQUEST['uncheck_ids'],',');
                            $array3=explode(',',$total_sample_ids);
                            $array4=explode(',',$get_uncheck_ids);
                            $new_array=array_diff($array3,$array4);
                            foreach($new_array as $rows){
                                if(in_array($rows,$check_array)){
                                    $store_check_ids_2.=$rows.',';
                                }
                            }
                            $values=trim($store_check_ids_2,',');
                            $msg_check=explode(',',$values);
                            if(count($msg_check)>10){
                               echo "over2";  
                            }else{
                                $logo_ids = array(
                                            'logo_id' =>$values
                                );	
                                update_option('woo_custom_design_sample_logo_ids', $logo_ids);
                                echo "success";
                            }
                        }
                        else{
                            $array1=explode(',',trim($_REQUEST['id'],','));
                            foreach($array1 as $rows){
                                if(in_array($rows,$check_array)){
                                    $sample_ids_empty_option.=$rows.',';
                                }
                            }

                            $values=trim($sample_ids_empty_option,',');
                            $logo_ids = array(
                                            'logo_id' =>$values
                            );	
                            update_option('woo_custom_design_sample_logo_ids', $logo_ids);
                            echo "success";
                        }
                }
	}
	
	if($_REQUEST['delete_sample_logo_ids']=='delete_logo_ids'){
		global $wpdb;
		$sqls="DELETE FROM ".$wpdb->prefix."woo_cd_sample_logo where id='".$_REQUEST['ids']."'";
		$wpdb->query($sqls);
		echo 'delete';
	}
        
	if($_REQUEST['get_src']=='logo_src'){  
		$get_sample_logo="select sample_logo_url from ".$wpdb->prefix ."woo_cd_sample_logo where id='".$_REQUEST['ids']."'";
		$get_Sample_src=$wpdb->get_row($get_sample_logo);
		echo $get_Sample_src->sample_logo_url;
	}
	
	if($_REQUEST['save_templates']=='save_selected_templates'){
		$update_templates_name = array(
                                    
                                'template_name' =>$_REQUEST['temp_name']
    	);	 
		update_option('woo_custom_design_popup_templates', $update_templates_name);
		$result = get_option('woo_custom_design_popup_templates');
		echo $result['template_name'];
	}
?>