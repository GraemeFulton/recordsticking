<?php
/**
 * WooCommerce Gallery Preview Display Class
 *
 * Class Function into woocommerce plugin
 *
 * Table Of Contents
 *
 * wc_dynamic_gallery_preview()
 */
class WC_Gallery_Preview_Display
{
		
	public static function wc_dynamic_gallery_preview($request = ''){
		if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) die();
		
		global $wc_dgallery_fonts_face;
		$request = $_REQUEST;
		/**
		 * Single Product Image
		 */
		$post = new stdClass();
		$current_db_version = get_option( 'woocommerce_db_version', null );
		$woo_a3_gallery_settings = $request;
		$lightbox_class = 'lightbox';
		
		$post->ID = rand(10,10000);
		
		if ( !isset( $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'width_type'] ) || $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'width_type'] == 'px' ) {
			$g_width = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width_fixed'].'px';
			$g_height = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_height'];
		} else {
			$g_width = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_width_responsive'].'%';
			$g_height = false;
			$max_height = 533;
			$width_of_max_height = 400;
			?>
            <script type="text/javascript">
			(function($){
				$(function(){
					a3revWCDynamicGallery_<?php echo $post->ID; ?> = {
		
						setHeightProportional: function () {
							var image_wrapper_width = $( '#gallery_<?php echo $post->ID; ?>' ).find('.ad-image-wrapper').width();
							var width_of_max_height = parseInt(<?php echo $width_of_max_height; ?>);
							var image_wrapper_height = parseInt(<?php echo $max_height; ?>);
							if( width_of_max_height > image_wrapper_width ) {
								var ratio = width_of_max_height / image_wrapper_width;
								image_wrapper_height = parseInt(<?php echo $max_height; ?>) / ratio;
							}
							$( '#gallery_<?php echo $post->ID; ?>' ).find('.ad-image-wrapper').css({ height: image_wrapper_height });
						}
					}
					
					a3revWCDynamicGallery_<?php echo $post->ID; ?>.setHeightProportional();
					
				});
	  		})(jQuery);
			</script>
            <?php
		}
		
		$caption_font = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'caption_font'];
			
		$navbar_font = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'navbar_font'];
		
		$google_fonts = array( $caption_font['face'], $navbar_font['face'] );
		$wc_dgallery_fonts_face->generate_google_webfonts( $google_fonts );
		?>
        <div class="images" style="width:<?php echo $g_width; ?>;margin:30px auto;">
          <div class="product_gallery">
            <?php
            
            $g_thumb_width = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_width' );
			if ($g_thumb_width <= 0) $g_thumb_width = 105;
            $g_thumb_height = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_height' );
			if ($g_thumb_height <= 0) $g_thumb_height = 75;
            $g_thumb_spacing = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_spacing' );
                
			if ( isset( $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_auto_start'] ) ) 
            	$g_auto = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_auto_start'];
			else
				$g_auto = 'false';
            $g_speed = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_speed'];
            $g_effect = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_effect'];
            $g_animation_speed = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_animation_speed'];
			
			$bg_nav_color = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'bg_nav_color'];
			
			$bg_image_wrapper = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'bg_image_wrapper'];
			$border_image_wrapper_color = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'border_image_wrapper_color'];
			
			$product_gallery_bg_des = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_bg_des'];
			
			if ( isset( $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_nav'] ) ) 
				$product_gallery_nav = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_nav'];
			else $product_gallery_nav = 'no';
			$transition_scroll_bar = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'transition_scroll_bar'];
			
			if ( isset( $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'lazy_load_scroll'] ) ) 
				$lazy_load_scroll = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'lazy_load_scroll'];
			else $lazy_load_scroll = 'no';
		
			$navbar_height = $woo_a3_gallery_settings[WOO_DYNAMIC_GALLERY_PREFIX.'navbar_height'];
			
			if($product_gallery_nav == 'yes'){
				$display_ctrl = 'display:block !important;';
				$mg = $navbar_height;
				$ldm = $navbar_height;
				
			}else{
				$display_ctrl = 'display:none !important;';
				$mg = '0';
				$ldm = '0';
			}
			
			$popup_gallery = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'popup_gallery' );
			$zoom_label = __('ZOOM +', 'woo_dgallery');
			if ($popup_gallery == 'deactivate') {
				$lightbox_class = '';
				$zoom_label = '';
			}
			
			$enable_gallery_thumb = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'enable_gallery_thumb' );
			
			$bg_des = WC_Dynamic_Gallery_Functions::html2rgb($product_gallery_bg_des,true);
			$des_background =str_replace('#','',$product_gallery_bg_des);
			
            echo '<style>
			#TB_window{width:auto !important;}
                .ad-gallery {
						position:relative;
                }
				.ad-gallery .ad-image-wrapper {
					background:#'.$bg_image_wrapper.';
                    width: 99.3%;'
					. ( ( $g_height != false ) ? 'height: '.($g_height-2).'px;' : '' ) . 
                    'margin: 0px;
                    position: relative;
                    overflow: hidden !important;
                    padding:0;
                    border:1px solid #'.$border_image_wrapper_color.';
					z-index:8 !important;
                }
				.ad-gallery .ad-image-wrapper .ad-image{width:100% !important;text-align:center;}
                .ad-image img{
                    
                }
                .ad-gallery .ad-thumbs li{
                    padding-right: '.$g_thumb_spacing.'px !important;
                }
                .ad-gallery .ad-thumbs li.last_item{
                    padding-right: '.($g_thumb_spacing+13).'px !important;
                }
                .ad-gallery .ad-thumbs li div{
                    height: '.$g_thumb_height.'px !important;
                    width: '.$g_thumb_width.'px !important;
                }
                .ad-gallery .ad-thumbs li a {
                    width: '.$g_thumb_width.'px !important;
                    height: '.$g_thumb_height.'px !important;	
                }
                * html .ad-gallery .ad-forward, .ad-gallery .ad-back{
                    height:	'.($g_thumb_height).'px !important;
                }
				
				/*Gallery*/
				.ad-image-wrapper{
					overflow:inherit !important;
				}
				
				.ad-gallery .ad-controls {
					background: #'.$bg_nav_color.' !important;
					border:1px solid #'.$bg_nav_color.';
					color: #FFFFFF;
					font-size: 12px;
					height: 22px;
					margin-top: 20px !important;
					padding: 8px 2% !important;
					position: relative;
					width: 95.8%;
					-khtml-border-radius:5px;
					-webkit-border-radius: 5px;
					-moz-border-radius: 5px;
					border-radius: 5px;display:none;
				}
				
				.ad-gallery .ad-info {
					float: right;
					font-size: 14px;
					position: relative;
					right: 8px;
					text-shadow: 1px 1px 1px #000000 !important;
					top: 1px !important;
				}
				.ad-gallery .ad-nav .ad-thumbs{
					margin:7px 4% 0 !important;
				}
				.ad-gallery .ad-thumbs .ad-thumb-list {
					margin-top: 0px !important;
				}
				.ad-thumb-list{
				}
				.ad-thumb-list li{
					background:none !important;
					padding-bottom:0 !important;
					padding-left:0 !important;
					padding-top:0 !important;
				}
				.ad-gallery .ad-image-wrapper .ad-image-description {
					background: rgba('.$bg_des.',0.5);
					filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=1, StartColorStr="#88'.$des_background.'", EndColorStr="#88'.$des_background.'");
					bottom: '.$mg.'px !important;';
					echo $wc_dgallery_fonts_face->generate_font_css( $caption_font );
					echo '
					left: 0;
					line-height: 1.4em;
					margin: 0 !important;
					padding:2% 2% 2% !important;
					position: absolute;
					text-align: left;
					width: 96.1% !important;
					z-index: 10;
					font-weight:normal;
				}
				.product_gallery .ad-gallery .ad-image-wrapper {
					background: none repeat scroll 0 0 '.$bg_image_wrapper.';
					border: 1px solid '.$border_image_wrapper_color.' !important;
					padding-bottom:'.$mg.'px;
				}';
				if($lazy_load_scroll == 'yes'){
					echo '.ad-gallery .lazy-load{
						background:'.$transition_scroll_bar.' !important;'
						 . ( ( $g_height != false ) ? 'top:'.($g_height + 9).'px !important;' : '' ) . 
						'opacity:1 !important;
						margin-top:'.$ldm.'px !important;
					}';
				}else{
					echo '.ad-gallery .lazy-load{display:none!important;}';
				}
				echo'
				.product_gallery .slide-ctrl, .product_gallery .icon_zoom {
					'.$display_ctrl.';
					height: '.($navbar_height-16).'px !important;
					line-height: '.($navbar_height-16).'px !important;';
					
					echo $wc_dgallery_fonts_face->generate_font_css( $navbar_font );
				echo '
				}
				.product_gallery .icon_zoom {
					background: '.$bg_nav_color.';
					border-right: 1px solid '.$bg_nav_color.';
					border-top: 1px solid '.$border_image_wrapper_color.';
				}
				.product_gallery .slide-ctrl {
					background:'.$bg_nav_color.';
					border-left: 1px solid '.$border_image_wrapper_color.';
					border-top: 1px solid '.$border_image_wrapper_color.';
				}
				.product_gallery .slide-ctrl .ad-slideshow-stop-slide,.product_gallery .slide-ctrl .ad-slideshow-start-slide,.product_gallery .icon_zoom{
					line-height: '.($navbar_height-16).'px !important;';
					echo $wc_dgallery_fonts_face->generate_font_css( $navbar_font );
				echo '
				}
				.product_gallery .ad-gallery .ad-thumbs li a {
					border:1px solid '.$border_image_wrapper_color.' !important;
				}
				.ad-gallery .ad-thumbs li a.ad-active {
					border: 1px solid '.$bg_nav_color.' !important;
				}';
			if($enable_gallery_thumb == 'no'){
				echo '.ad-nav{display:none; height:1px;}.woocommerce .images { margin-bottom: 15px;}';
			}	
			
			if($product_gallery_nav == 'no'){
				echo '
				.ad-image-wrapper:hover .slide-ctrl{display: block !important;}
				.product_gallery .slide-ctrl {
					background: none repeat scroll 0 0 transparent;
					border: medium none;
					height: 50px !important;
					left: 41.5% !important;
					top: 38% !important;
					width: 50px !important;
				}';
				echo '.product_gallery .slide-ctrl .ad-slideshow-start-slide {background: url('.WOO_DYNAMIC_GALLERY_JS_URL.'/mygallery/play.png) !important;height: 50px !important;text-indent: -999em !important; width: 50px !important;}';
				echo '.product_gallery .slide-ctrl .ad-slideshow-stop-slide {background: url('.WOO_DYNAMIC_GALLERY_JS_URL.'/mygallery/pause.png) !important;height: 50px !important;text-indent: -999em !important; width: 50px !important;}';
			}
			
			if ($popup_gallery == 'deactivate') echo '.ad-gallery .ad-image-wrapper .ad-image img{cursor: default;} .ad-gallery .icon_zoom{cursor: default;}';
			
			echo '
			</style>';
            
            echo '<script type="text/javascript">
                jQuery(function() {
                    var settings_defaults_'.$post->ID.' = { loader_image: "'.WOO_DYNAMIC_GALLERY_JS_URL.'/mygallery/loader.gif",
                        start_at_index: 0,
                        gallery_ID: "'.$post->ID.'",
						lightbox_class: "'.$lightbox_class.'",
                        description_wrapper: false,
                        thumb_opacity: 0.5,
                        animate_first_image: false,
                        animation_speed: '.$g_animation_speed.'000,
                        width: false,
                        height: false,
                        display_next_and_prev: true,
                        display_back_and_forward: true,
                        scroll_jump: 0,
                        slideshow: {
                            enable: true,
                            autostart: '.$g_auto.',
                            speed: '.$g_speed.'000,
                            start_label: "'.__('START SLIDESHOW', 'woo_dgallery').'",
                            stop_label: "'.__('STOP SLIDESHOW', 'woo_dgallery').'",
							zoom_label: "'.$zoom_label.'",
                            stop_on_scroll: true,
                            countdown_prefix: "(",
                            countdown_sufix: ")",
                            onStart: false,
                            onStop: false
                        },
                        effect: "'.$g_effect.'", 
                        enable_keyboard_move: true,
                        cycle: true,
                        callbacks: {
                        init: false,
                        afterImageVisible: false,
                        beforeImageVisible: false
                    }
                };
                jQuery("#gallery_'.$post->ID.'").adGallery(settings_defaults_'.$post->ID.');
            });
            </script>';
            echo '<div id="gallery_'.$post->ID.'" class="ad-gallery" style="">
                <div class="ad-image-wrapper" style="width: 99.3%; ' . ( ( $g_height != false ) ? 'height: '.($g_height-2).'px;' : '' ) . '"></div>
                <div class="ad-controls"> </div>
                  <div class="ad-nav">
                    <div class="ad-thumbs">
                      <ul class="ad-thumb-list">';
						
						$url_demo_img =  '/assets/js/mygallery/images/';
                        $imgs = array($url_demo_img.'image_1.jpg',$url_demo_img.'image_2.jpg',$url_demo_img.'image_3.jpg',$url_demo_img.'image_4.jpg');
                        
                        $script_colorbox = '';
						$script_fancybox = '';
                        if ( !empty( $imgs ) ){	
                            $i = 0;
                            $display = '';
			
                            if(is_array($imgs) && count($imgs)>0){
                                $script_colorbox .= '<script type="text/javascript">';
								$script_fancybox .= '<script type="text/javascript">';
                                $script_colorbox .= '(function($){';		  
								$script_fancybox .= '(function($){';
                                $script_colorbox .= '$(function(){';
								$script_fancybox .= '$(function(){';
                                $script_colorbox .= '$(document).on("click", ".ad-gallery .lightbox", function(ev) { if( $(this).attr("rel") == "gallery_'.$post->ID.'") {
								var idx = $(".ad-image img").attr("idx");';
								$script_fancybox .= '$(document).on("click", ".ad-gallery .lightbox", function(ev) { if( $(this).attr("rel") == "gallery_'.$post->ID.'") {
								var idx = $(".ad-image img").attr("idx");';
								
                                if(count($imgs) <= 1 ){
                                    $script_colorbox .= '$(".gallery_product_'.$post->ID.'").colorbox({open:true, maxWidth:"100%", title: function() { return "&nbsp;";} });';
									$script_fancybox .= '$.fancybox(';
                                }else{
                                    $script_colorbox .= '$(".gallery_product_'.$post->ID.'").colorbox({rel:"gallery_product_'.$post->ID.'", maxWidth:"100%", title: function() { return "&nbsp;";} }); $(".gallery_product_'.$post->ID.'_"+idx).colorbox({open:true, maxWidth:"100%", title: function() { return "&nbsp;";} });';
									$script_fancybox .= '$.fancybox([';
                                }
								
                                $common = '';
                                $idx = 0;
                                foreach($imgs as $item_thumb){
                                    $li_class = '';
                                    if($i == 0){ $li_class = 'first_item';}elseif($i == count($imgs)-1){$li_class = 'last_item';}
                                    $image_attribute = getimagesize( WOO_DYNAMIC_GALLERY_DIR.$item_thumb);
                                    $image_lager_default_url = WOO_DYNAMIC_GALLERY_URL.$item_thumb;
									
									
                                    $thumb_height = $g_thumb_height;
                                    $thumb_width = $g_thumb_width;
                                    $width_old = $image_attribute[0];
                                    $height_old = $image_attribute[1];
                                     if($width_old > $g_thumb_width || $height_old > $g_thumb_height){
                                        if($height_old > $g_thumb_height && $g_thumb_height > 0) {
                                            $factor = ($height_old / $g_thumb_height);
                                            $thumb_height = $g_thumb_height;
                                            $thumb_width = $width_old / $factor;
                                        }
                                        if($thumb_width > $g_thumb_width && $g_thumb_width > 0){
                                            $factor = ($width_old / $g_thumb_width);
                                            $thumb_height = $height_old / $factor;
                                            $thumb_width = $g_thumb_width;
                                        }elseif($thumb_width == $g_thumb_width && $width_old > $g_thumb_width  && $g_thumb_width > 0){
                                            $factor = ($width_old / $g_thumb_width);
                                            $thumb_height = $height_old / $factor;
                                            $thumb_width = $g_thumb_width;
                                        }						
                                    }else{
                                         $thumb_height = $height_old;
                                        $thumb_width = $width_old;
                                    }
                                    
                                    
                                        
                                    $img_description = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
                                            
                                    echo '<li class="'.$li_class.'"><a class="gallery_product_'.$post->ID.' gallery_product_'.$post->ID.'_'.$idx.'" title="'. esc_attr( $img_description ) .'" rel="gallery_product_'.$post->ID.'" href="'.$image_lager_default_url.'"><div><img idx="'.$idx.'" style="width:'.$thumb_width.'px !important;height:'.$thumb_height.'px !important" src="'.$image_lager_default_url.'" alt="'. esc_attr( $img_description ) .'" class="image'.$i.'" width="'.$thumb_width.'" height="'.$thumb_height.'"></div></a></li>';
                                    $img_description = esc_js( $img_description );
                                    if($img_description != ''){
										$script_fancybox .= $common.'{href:"'.$image_lager_default_url.'",title:"'.$img_description.'"}';
                                    }else{
										$script_fancybox .= $common.'{href:"'.$image_lager_default_url.'",title:""}';
                                    }
                                    $common = ',';
                                    $i++;
									$idx++;
                                 }
								
								 //$.fancybox([ {href : 'img1.jpg', title : 'Title'}, {href : 'img2.jpg', title : 'Title'} ])
                                if(count($imgs) <= 1 ){
									$script_fancybox .= ');';
                                }else{
									$script_fancybox .= '],{
        \'index\': idx
      });';
                                }
                                $script_colorbox .= 'ev.preventDefault();';
                                $script_colorbox .= '} });';
								$script_fancybox .= '} });';
                                $script_colorbox .= '});';
								$script_fancybox .= '});';
                                $script_colorbox .= '})(jQuery);';
								$script_fancybox .= '})(jQuery);';
                                $script_colorbox .= '</script>';
								$script_fancybox .= '</script>';
                            }
                        }else{
                            echo '<li> <a class="lightbox" rel="gallery_product_'.$post->ID.'" href="'.WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/no-image.png"> <img src="'.WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/no-image.png" class="image" alt=""> </a> </li>';
							
							
									
                        }
						
						if ($popup_gallery == 'deactivate') {
							$script_colorbox = '';
							$script_fancybox = '';
						} else if($popup_gallery == 'colorbox'){
                        	echo $script_colorbox;
						} else {
							echo $script_fancybox;
						}
                        echo '</ul>
                        </div>
                      </div>
                    </div>';
                  ?>
          </div>
        </div>
	<?php
	die();
	}
}
?>
