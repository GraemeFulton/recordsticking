<?php require_once('../../../../../../../../wp-blog-header.php');
	
	session_start();
	unset($_SESSION['upload_id']);
	unset($_SESSION['front_design']);
	$filename = $_FILES["uploadfile"]["name"];
	$ext = substr(strrchr($filename, "."), 1);
	//$randName = md5(rand() * time());
	//$randName = uniqid();
	$randName = time().uniqid();
	$filename = $randName . '.' . $ext; 
	$_SESSION['front_design'] = $randName;
	$_SESSION['upload_id'] = $filename;
	if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"],"../cs/uploadImage/" . $filename)){
		echo $filename;
	}
	else{
		echo "error";
	}
?>