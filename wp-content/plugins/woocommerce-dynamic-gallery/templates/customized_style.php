<style>
<?php
global $wc_dgallery_fonts_face;
$g_width                    = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'product_gallery_width_fixed');
$g_height                   = get_option(WOO_DYNAMIC_GALLERY_PREFIX. 'product_gallery_height');

$g_thumb_width              = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'thumb_width');
if ($g_thumb_width <= 0) $g_thumb_width              = 105;
$g_thumb_height             = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'thumb_height');
if ($g_thumb_height <= 0) $g_thumb_height             = 75;
$g_thumb_spacing            = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'thumb_spacing');

$bg_nav_color               = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'bg_nav_color');

$bg_image_wrapper           = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'bg_image_wrapper');
$border_image_wrapper_color = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'border_image_wrapper_color');

$product_gallery_bg_des     = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'product_gallery_bg_des');

$enable_gallery_thumb       = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'enable_gallery_thumb');

$product_gallery_nav        = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'product_gallery_nav');

$lazy_load_scroll           = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'lazy_load_scroll');

$transition_scroll_bar      = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'transition_scroll_bar' );

$caption_font               = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'caption_font');

$navbar_font                = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'navbar_font');
$navbar_height              = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'navbar_height');

if ('yes' == $product_gallery_nav) {
    $display_ctrl = 'display:block !important;';
    $mg = $navbar_height;
    $ldm = $navbar_height;
} else {
    $display_ctrl = 'display:none !important;';
    $mg = '0';
    $ldm = '0';
}

$bg_des                     = WC_Dynamic_Gallery_Functions::html2rgb($product_gallery_bg_des, true);

$popup_gallery              = get_option(WOO_DYNAMIC_GALLERY_PREFIX . 'popup_gallery');
?>
#TB_window {
    width: auto !important;
}
.ad-gallery {
    width: <?php
echo $g_width; ?>;
    position: relative;
}
.ad-gallery .ad-image-wrapper {
	background: none repeat scroll 0 0 <?php
echo $bg_image_wrapper; ?>;
    border: 1px solid <?php
echo $border_image_wrapper_color; ?> !important;
    width: <?php
echo ($g_width - 2); ?>px;
    height: <?php
echo ($g_height - 2); ?>px;
    margin: 0px;
    position: relative;
    overflow: hidden !important;
    padding: 0 0 <?php
echo $mg; ?>px 0 !important;
    z-index: 8 !important;
}
.ad-gallery .ad-image-wrapper .ad-image {
    width: 100% !important;
    text-align: center;
}
.ad-image img{
    max-width:<?php
echo $g_width; ?>px !important;
}
.ad-gallery .ad-thumbs li {
    padding-right: <?php
echo $g_thumb_spacing; ?>px !important;
}
.ad-gallery .ad-thumbs li.last_item {
    padding-right: <?php
echo ($g_thumb_spacing + 13); ?>px !important;
}
.ad-gallery .ad-thumbs li div {
    height: <?php
echo $g_thumb_height; ?>px !important;
    width: <?php
echo $g_thumb_width; ?>px !important;
}
.ad-gallery .ad-thumbs li a {
    width: <?php
echo $g_thumb_width; ?>px !important;
    height: <?php
echo $g_thumb_height; ?>px !important;
}
* html .ad-gallery .ad-forward, .ad-gallery .ad-back {
    height: <?php
echo $g_thumb_height; ?>px !important;
}
/*Gallery*/

.ad-image-wrapper {
    overflow: inherit !important;
}
.ad-gallery .ad-controls {
    display: none;
}
.ad-gallery .ad-info {
    float: right;
    font-size: 14px;
    position: relative;
    right: 8px;
    text-shadow: 1px 1px 1px #000000 !important;
    top: 1px !important;
}
.ad-gallery .ad-nav .ad-thumbs {
    margin: 7px 4% 0 !important;
}
.ad-gallery .ad-thumbs .ad-thumb-list {
    margin-top: 0px !important;
}
.ad-thumb-list li {
    background: none !important;
    padding-bottom: 0 !important;
    padding-left: 0 !important;
    padding-top: 0 !important;
}
.ad-image-wrapper .ad-image-description {
    background: rgba(<?php
echo $bg_des; ?>, 0.5) !important;
    margin: 0 0 <?php
echo $mg; ?>px !important;
    left: 0;
    line-height: 1.4em;
    padding: 2% 2% 2% !important;
    position: absolute;
    text-align: left;
    width: 96.1% !important;
    z-index: 10;
    font-weight: normal;
    <?php
echo $wc_dgallery_fonts_face->generate_font_css($caption_font); ?>;
}
.product_gallery .slide-ctrl, .product_gallery .icon_zoom {
    <?php echo $display_ctrl; ?>;
    height: <?php
echo ($navbar_height - 16); ?>px !important;
    line-height: <?php
echo ($navbar_height - 16); ?>px !important;
    <?php
echo $wc_dgallery_fonts_face->generate_font_css($navbar_font); ?>
}
<?php if ('yes' == $lazy_load_scroll) { ?>
 .ad-gallery .lazy-load{
    background: <?php echo $transition_scroll_bar; ?> !important;
    top:<?php echo ($g_height + 9); ?>px !important;
    opacity:1 !important;
    margin-top:<?php echo $ldm; ?>px !important;
}
<?php } else { ?>
.ad-gallery .lazy-load {
    display:none!important;
}
<?php } ?>
.product_gallery .icon_zoom {
    background: <?php
echo $bg_nav_color; ?>;
    border-right: 1px solid <?php
echo $bg_nav_color; ?>;
    border-top: 1px solid <?php
echo $border_image_wrapper_color; ?>;
}
.product_gallery .slide-ctrl {
    background: <?php
echo $bg_nav_color; ?>;
    border-left: 1px solid <?php
echo $border_image_wrapper_color; ?>;
    border-top: 1px solid <?php
echo $border_image_wrapper_color; ?>;
}
.product_gallery .slide-ctrl .ad-slideshow-stop-slide, .product_gallery .slide-ctrl .ad-slideshow-start-slide, .product_gallery .icon_zoom {
    line-height: <?php
echo ($navbar_height - 16); ?>px !important;
    <?php
echo $wc_dgallery_fonts_face->generate_font_css($navbar_font); ?>
}
.product_gallery .ad-gallery .ad-thumbs li a {
    border: 1px solid <?php
echo $border_image_wrapper_color; ?> !important;
}
.ad-gallery .ad-thumbs li a.ad-active {
    border: 1px solid <?php
echo $bg_nav_color; ?> !important;
}
<?php
if ('no' == $enable_gallery_thumb) { ?>
.ad-nav{display:none; height:1px;}
.woocommerce .images { margin-bottom: 15px;}
<?php
} ?>
<?php
if ('no' == $product_gallery_nav) { ?>
.ad-image-wrapper:hover .slide-ctrl {
        display: block !important;
 }
 .product_gallery .slide-ctrl {
       background: none repeat scroll 0 0 transparent;
       border: medium none;
       height: 50px !important;
       left: 41.5% !important;
       top: 38% !important;
       width: 50px !important;
}
.product_gallery .slide-ctrl .ad-slideshow-start-slide {background: url(<?php
    echo WOO_DYNAMIC_GALLERY_JS_URL; ?>/mygallery/play.png) !important;height: 50px !important;text-indent: -999em !important; width: 50px !important;}
.product_gallery .slide-ctrl .ad-slideshow-stop-slide {background: url(<?php
    echo WOO_DYNAMIC_GALLERY_JS_URL; ?>/mygallery/pause.png) !important;height: 50px !important;text-indent: -999em !important; width: 50px !important;}
<?php
} ?>
<?php
if ('deactivate' == $popup_gallery) { ?>
.ad-image-wrapper .ad-image img{cursor: default !important;}
.icon_zoom{cursor: default !important;}
<?php
} ?>
</style>