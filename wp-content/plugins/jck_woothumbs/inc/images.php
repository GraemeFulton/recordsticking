<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $jckWooThumbs;

$defaultVarId = $this->get_default_variation_id();

$initialProdId = ($defaultVarId) ? $defaultVarId : $product->id;
$initialProdId = $this->get_selected_varaiton($initialProdId);

$imgIds = $this->get_all_image_ids($initialProdId);

$images = $this->get_all_image_sizes($imgIds);

$classes = array();

if($jckWooThumbs['navigationType'] == 'thumbnails'){
	$classes[] = 'thumbs'.$jckWooThumbs['thumbnailLayout'];
}

echo '<div id="'.$this->slug.'_img_wrap" class="jckcf '.implode(' ', $classes).'" data-showing="'.$initialProdId.'" data-parentid="'.$product->id.'">';
	
	include('loop-images.php');
	
	echo $return;

echo '</div>';