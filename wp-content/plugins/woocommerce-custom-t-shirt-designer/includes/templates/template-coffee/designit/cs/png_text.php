<?php
session_start();
header('Content-type: image/png');
$stxt = explode("|",$_GET['str']);
$count = count($stxt);
$str = '';

foreach($stxt as $ztxt){
	if($str !='' && $count != 0){
		$str = $str . chr(0x0A) . $ztxt;
	}
	else if($str !='' && $count = 0){
		$str = $str . $ztxt;
	}
	else{
		$str = $ztxt;
	}
	$count = $count - 1;
}


//create preview

$font = '../../../../../font/'.getFontName($_GET['ft']);
$text_color = getColorCode($_GET['col']);
$back_color = $_GET['bg'];
$fontsize = 50;
$quotes = array($str);
/*Background*/
$r_bg = hexdec("0x".substr($back_color,0,2));
$g_bg = hexdec("0x".substr($back_color,2,2));
$b_bg = hexdec("0x".substr($back_color,4,2));

/*Text Color Change*/
$r_col = hexdec("0x".substr($text_color,0,2));
$g_col = hexdec("0x".substr($text_color,2,2));
$b_col = hexdec("0x".substr($text_color,4,2));
//
$pos = rand(0,count($quotes)-1);
$quote = wordwrap($quotes[$pos],20);
$dims = imagettfbbox($fontsize, 0, $font, $quote);
$width = $dims[4] - $dims[6];
$height = $dims[3] - $dims[5];
$image = imagecreatetruecolor($width,$height);
$bgcolor = imagecolorallocate ($image, $r_bg, $g_bg, $b_bg);
$fontcolor = imagecolorallocate ($image,$r_col,$g_col,$b_col);
imagecolortransparent($image, $bgcolor);
imagefilledrectangle($image, 0, 0, $width, $height, $bgcolor);
$x = 0; 
$y = $fontsize;
imagettftext($image, $fontsize, 0, $x, $y, $fontcolor, $font, $quote);
imagepng($image);

$newIds = ''; 
if(isset($_SESSION['front_design'])){
	$newIds = $_SESSION['front_design'];
}
else{
	$newIds = time().uniqid();
	$_SESSION['front_design'] = $newIds;
}

imagepng($image, '../imgprocess/'.$newIds.'.png');
list($width,$height) = getimagesize('../imgprocess/'.$newId.'.png');
$_SESSION['imgsize'] = $width.'X'.$height;
imagedestroy($image);


//create custom design

$font_custom = '../../../../../font/'.getFontName($_GET['ft']);
$text_color_custom = getColorCode($_GET['col']);
$back_color_custom = $_GET['bg'];
$fontsize_custom =8;
$quotes_custom = array($str);
/*Background*/
$r_bg_custom = hexdec("0x".substr($back_color_custom,0,2));
$g_bg_custom = hexdec("0x".substr($back_color_custom,2,2));
$b_bg_custom = hexdec("0x".substr($back_color_custom,4,2));

/*Text Color Change*/
$r_col_custom = hexdec("0x".substr($text_color_custom,0,2));
$g_col_custom = hexdec("0x".substr($text_color_custom,2,2));
$b_col_custom = hexdec("0x".substr($text_color_custom,4,2));
//
$pos_custom = rand(0,count($quotes_custom)-1);
$quote_custom = wordwrap($quotes_custom[$pos_custom],20);
$dims_custom = imagettfbbox($fontsize_custom, 0, $font_custom, $quote_custom);
$width_custom = $dims_custom[4] - $dims_custom[6];
$height_custom = $dims_custom[3] - $dims_custom[5];
$image_custom = imagecreatetruecolor($width_custom,$height_custom);
$bgcolor_custom = imagecolorallocate ($image_custom, $r_bg_custom, $g_bg_custom, $b_bg_custom);
$fontcolor_custom = imagecolorallocate ($image_custom,$r_col_custom,$g_col_custom,$b_col_custom);
imagecolortransparent($image_custom, $bgcolor_custom);
imagefilledrectangle($image_custom, 0, 0, $width_custom, $height_custom, $bgcolor_custom);
$x_custom = 0; 
$y_custom = $fontsize_custom;
imagettftext($image_custom, $fontsize_custom, 0, $x_custom, $y_custom, $fontcolor_custom, $font_custom, $quote_custom);
imagepng($image_custom);

$newId = ''; 
if(isset($_SESSION['front_design'])){
	$newId = $_SESSION['front_design'];
}
else{
	$newId = time().uniqid();
	$_SESSION['front_design'] = $newId;
}

imagepng($image_custom, '../imgprocess/'.$newId.'-mini'.'.PNG');
list($width_custom,$height_custom) = getimagesize('../imgprocess/'.$newId.'.png');
$_SESSION['imgsize'] = $width_custom.'X'.$height_custom;
imagedestroy($image_custom);




function getFontName($sCode){
	return "$sCode".".ttf";
}
//
function isNewLine(){
	$string = $_GET['str'];
    $pos = strpos($string, "|");
    return $pos;
}

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