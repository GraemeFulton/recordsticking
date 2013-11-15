<?php 
header("Content-type: image/png");
session_start();
$imgname = '';
if(isset($_GET['f'])){
	$imgname = $_GET['f'];	
}
else{
	$imgname = $_SESSION['upload_id'];
	//front = explode('.',$imgname);
	//$_SESSION['front_design'] = $front[0];
}
//
$textcolor = getColorCode($_GET['cs']);
$background = $_GET['ceh'];

$sPath = "../imgprocess/" . $imgname;
$image = imagecreatefrompng ($sPath);
$r_bg = hexdec("0x".substr($background,0,2));
$g_bg = hexdec("0x".substr($background,2,2));
$b_bg = hexdec("0x".substr($background,4,2));


$r_col = hexdec("0x".substr($textcolor,0,2));
$g_col = hexdec("0x".substr($textcolor,2,2));
$b_col = hexdec("0x".substr($textcolor,4,2));
 
$white = imagecolorallocate ($image, $r_bg, $g_bg, $b_bg);
$black = imagecolorallocate ($image,$r_col,$g_col,$b_col);
imagefill($image,0,0,$white);
imagestring ($image,$font,0,0,$string,$black);
imagepng ($image);
imagedestroy($image);

echo file_get_contents($image);

function getColorCode($colortext){
	if($colortext=='White'){
		return 'ffffff';
	}
	else if($colortext=='Grey'){
		return '808080';
	}
	else if($colortext=='Black'){
		return '000000';
	}
	else if($colortext=='Blue'){
		return '0000FF';
	}
	else if($colortext=='Navy'){
		return '000080';
	}
	else if($colortext=='Purple'){
		return '800080';
	}
	else if($colortext=='Pink'){
		return 'FAAFBE';
	}
	else if($colortext=='DarkGreen'){
		return '254117';
	}
	else if($colortext=='Green'){
		return '008000';
	}
	else if($colortext=='Gold'){
		return 'C6C600';
	}
	else if($colortext=='Orange'){
		return 'CE8500';
	}
	else if($colortext=='Red'){
		return 'C30000';
	}
	
}

?>