<?php 
require_once('../../../../../../../../wp-blog-header.php');
session_start();
$file_name= $_SESSION['front_design'].'.png';
$file_name_mini= $_SESSION['front_design'].'-mini'.'.PNG';

if($_REQUEST['file_delete']=='delete'){
    if(file_exists(WOO_CUSTOM_DESIGN_DIR_URL.'includes/templates/template-red/designit/imgprocess/'.$file_name)){
        unlink(WOO_CUSTOM_DESIGN_DIR_URL.'includes/templates/template-red/designit/imgprocess/'.$file_name);
    }
	 if(file_exists(WOO_CUSTOM_DESIGN_DIR_URL.'includes/templates/template-red/designit/imgprocess/'.$file_name_mini)){
        unlink(WOO_CUSTOM_DESIGN_DIR_URL.'includes/templates/template-red/designit/imgprocess/'.$file_name_mini);
    }
}

if(isset($_SESSION['front_design'])){
    unset($_SESSION['front_design']);
}
?>