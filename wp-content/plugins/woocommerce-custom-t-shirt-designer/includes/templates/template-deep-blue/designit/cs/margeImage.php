<?php
require_once('../../../../../../../../wp-blog-header.php');
session_start();
 if($_GET['action']=='add_to_cart'){
        global $woocommerce;
		$arr = array();
		$arr['Design'] = 'Custom_'.$_SESSION['front_design'];
		if(!empty($_REQUEST['pass_attr'])){
			$attr_data=	stripslashes($_REQUEST['pass_attr']);
			$parse_attr=explode('*',trim($attr_data,'*'));
			
			foreach($parse_attr as $data){
				$parse_final=explode('#',$data);
				$arr[$parse_final[0]]=$parse_final[1];
			}
		}
        $woocommerce->cart->add_to_cart($_GET['add_proid'],$_GET['add_qty'],$_REQUEST['Variationids'], $arr, null );      
}
if(isset($_SESSION['front_design'])){
		//image resize
		$img_marge_url='';
		$AB_path= ABSPATH;
		$get_img_link=$_SESSION['back_design'];
		$getpos_in_link=strpos($get_img_link,'wp-content');
		$getstr_in_link=substr($get_img_link,$getpos_in_link);
		$ABS_path= $AB_path.$getstr_in_link;
		$resize_img = wp_get_image_editor($ABS_path);
		if (!is_wp_error( $resize_img ) ) {
			$resize_img->resize(210,285, true );
			$saved = $resize_img->save();
			$getpos_in_link2=strpos($saved['path'],'/wp-content');
			$getstr_in_link2=substr($saved['path'],$getpos_in_link2);
			$resize_path=$getstr_in_link2;
			$img_marge_url=site_url().$resize_path;
		}
		
		$path=upload_directory().'/';
		
        $backdesign = substr($img_marge_url, strrpos($img_marge_url, '.') + 1);
		$dest = '';
        $src = '';
		$save_path='';
        
	if(strtolower($backdesign)==='gif'|| strtolower($backdesign)==='png'){
		if(strtolower($backdesign)==='gif'){
			$srcImg = imagecreatefromgif($img_marge_url);
			$file_name_plain=basename($img_marge_url,".gif");
			$file_name=basename($img_marge_url);			
		}
		else if(strtolower($backdesign)==='png'){
			$srcImg = imagecreatefrompng($img_marge_url);
			$file_name_plain=basename($img_marge_url,".png");
			$file_name=basename($img_marge_url);
		}
			$w = imagesx($srcImg);
			$h = imagesy($srcImg);
			$white = imagecreatetruecolor($w, $h);
			$bg = imagecolorallocate($white, 255, 255, 255);
			imagefill($white, 0, 0, $bg);
			imagecopy($white, $srcImg, 0, 0, 0, 0, $w, $h);
			imagejpeg($white,$path.$file_name_plain.'.jpg',100);
			imagedestroy($srcImg);  
			$dest= imagecreatefromjpeg($path.$file_name_plain.'.jpg');   
	}
	else if(strtolower($backdesign)==='jpeg'|| strtolower($backdesign)==='jpg'){
			if(strtolower($backdesign)==='jpeg'){
				$srcImg = imagecreatefromjpeg($img_marge_url);
				$file_name_plain=basename($img_marge_url,".jpeg");
				$file_name=basename($img_marge_url);
			}
			else if(strtolower($backdesign)==='jpg'){
				$srcImg = imagecreatefromjpeg($img_marge_url);
				$file_name_plain=basename($img_marge_url,".jpg");
				$file_name=basename($img_marge_url);
			}
			
			$w = imagesx($srcImg);
			$h = imagesy($srcImg);
			$white = imagecreatetruecolor($w, $h);
			$bg = imagecolorallocate($white, 255, 255, 255);
			imagefill($white, 0, 0, $bg);
			imagecopy($white, $srcImg, 0, 0, 0, 0, $w, $h);
			imagejpeg($white,$path.$file_name_plain.'.jpg',100);
			imagedestroy($srcImg);  
			$dest= imagecreatefromjpeg($path.$file_name_plain.'.jpg');
	}

        if($_REQUEST['select_logo_src']==''&& empty($_REQUEST['select_logo_src'])){
            $src = imagecreatefrompng(WOO_CUSTOM_DESIGN_DIR_URL.'includes/templates/template-deep-blue/designit/imgprocess/'.$_SESSION['front_design'].'-mini'.'.PNG');
		
            imagecolortransparent($src,imagecolorat($src,0,0));
            $insert_x = imagesx($src);
            $insert_y = imagesy($src); 
			
            imagecopymerge($dest,$src,$_REQUEST['position_left'],$_REQUEST['position_top'],0,0,$insert_x,$insert_y,100);
            imagejpeg($dest,$path.$_SESSION['front_design'].'.jpg',100);
        }
        else{
        
            $image = imagecreatefrompng ($_REQUEST['select_logo_src']);
            $new_image = imagecreatetruecolor (30,30);
            imagealphablending($new_image , false);
            imagesavealpha($new_image , true);
            imagecopyresampled ( $new_image, $image, 0, 0, 0, 0,30,30, imagesx ( $image ), imagesy ( $image ) );
            $image = $new_image;

            imagealphablending($image , false);
            imagesavealpha($image , true);
            imagepng ( $image,$path.$_SESSION['front_design'].'.png');
            
            $src_logo = imagecreatefrompng($path.$_SESSION['front_design'].'.png');

            imagecolortransparent($src_logo,imagecolorat($src_logo,0,0));
            $insert_x = imagesx($src_logo);
            $insert_y = imagesy($src_logo); 

			imagecopymerge($dest,$src_logo,$_REQUEST['position_left'],$_REQUEST['position_top'],0,0,$insert_x,$insert_y,100);   
            imagejpeg($dest,$path.$_SESSION['front_design'].'.jpg',100);
       }
		saveDesignIntoDB($img_marge_url);
}
else{
	echo "0";
}


function saveDesignIntoDB($img_marge_url){
	global $wpdb;
	$base_url=wp_upload_dir();
	$margeimage=$base_url['baseurl'].'/custom_uploads/'.$_SESSION['front_design'].'.jpg';
	
	$file_name=basename($img_marge_url);
	$file_ext = substr($file_name, strrpos($file_name, '.') + 1);
	if(strtolower($file_ext)==='gif'){
		$name=basename($img_marge_url,".gif");
	}
	else if(strtolower($file_ext)==='png'){
		$name=basename($img_marge_url,".png");
	}
	else if(strtolower($file_ext)==='jpeg'){
		$name=basename($img_marge_url,".jpeg");
	}
	else if(strtolower($file_ext)==='jpg'){
		$name=basename($img_marge_url,".jpg");
	}
	$img_marge_url=$base_url['baseurl'].'/custom_uploads/'.$name.'.jpg';
	
if(isset($_GET['imgpos'])){
    $imgpos = $_GET['imgpos'];
    if($imgpos == '3'){
        $imgpos = 'R';
    }
    else if($imgpos == '2'){
        $imgpos = 'C';
    }
    else{
        $imgpos = 'L';
    }
}

$marge_img_url=plugins_url().'/woocommerce-custom-t-shirt-designer/includes/templates/template-deep-blue/designit/imgprocess/'.$_SESSION['front_design'].'.png';

$save_custom_data=array(
                    'pid'=>$_REQUEST['add_proid'],
                    'margeimage_url'=>$margeimage,
					'image_url'=>$img_marge_url,
					'marge_img_url'=>$marge_img_url,
                    'session_id'=>$_SESSION['front_design'],
                    'color'=>$_REQUEST['color'],
                    'font_name'=>$_REQUEST['font'],
                    'design_text'=>$_REQUEST['design_text'],
                    'checkbox_name'=>$_REQUEST['checkbox_name'],    
                    'imageposition'=>$imgpos,
					'logoimage_url'=>$_REQUEST['select_logo_src'],
					'img_drag_pos'=>$_REQUEST['drag_pos']
);

$id=$wpdb->insert($wpdb->prefix ."woo_cd_custom_design",$save_custom_data);
if(!empty($id)){
	echo "save";
}
}
?>
