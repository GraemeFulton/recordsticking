<?php
/**
 * WooCommerce Gallery Display Class
 *
 * Class Function into woocommerce plugin
 *
 * Table Of Contents
 *
 * wc_dynamic_gallery_display()
 */
class WC_Gallery_Display_Class
{
	
	public static function wc_dynamic_gallery_display(){
		/**
		 * Single Product Image
		 */
		global $post, $wc_dgallery_fonts_face;
		$current_db_version = get_option( 'woocommerce_db_version', null );
		$lightbox_class = 'lightbox';
		
		// Get all attached images to this product
						
		$featured_img_id = (int)get_post_meta($post->ID, '_thumbnail_id', true);
		$attached_images = (array)get_posts( array(
			'post_type'   => 'attachment',
			'post_mime_type' => 'image',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $post->ID ,
			'orderby'     => 'menu_order',
			'order'       => 'ASC',
			'exclude'	  => array($featured_img_id),
		) );
		
		
		$attached_thumb = array();
		if ($featured_img_id > 0) {
			$feature_image_data = get_post( $featured_img_id );
				
			if ( $feature_image_data && $feature_image_data->post_parent == $post->ID ) {
				if ( get_post_meta( $featured_img_id, '_woocommerce_exclude_image', true ) != 1 ) {
					$attached_thumb[0] = $feature_image_data;
				}
			} else {
				$attached_thumb[0] = $feature_image_data;
			}
		}
		if($attached_images && count($attached_images) > 0 ){
			$i = 0;
			foreach($attached_images as $key=>$object){
				if (get_post_meta( $object->ID, '_woocommerce_exclude_image', true ) == 1) continue;
				
				$i++;
				$attached_thumb[$i] = $object;
			}	
		}
		ksort($attached_thumb);
		$product_id = '_'.rand(100,10000);
		$have_image = false;
		$attached_images = array();
		if(is_array($attached_thumb) && count($attached_thumb) > 0) {
			$attached_images = $attached_thumb;
			$have_image = true;
		}
		?>
        <div class="images gallery_container">
          <div class="product_gallery">
            <?php            
            $g_thumb_width = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_width' );
			if ( $g_thumb_width <= 0 ) $g_thumb_width = 105;
            $g_thumb_height = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'thumb_height' );
			if ( $g_thumb_height <= 0 ) $g_thumb_height = 75;

            $g_auto = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_auto_start' );
            $g_speed = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_speed' );
            $g_effect = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_effect' );
            $g_animation_speed = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_animation_speed' );
			
			$product_gallery_bg_des = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'product_gallery_bg_des' );
			$des_background             = str_replace('#', '', $product_gallery_bg_des);
			
			$popup_gallery = get_option( WOO_DYNAMIC_GALLERY_PREFIX.'popup_gallery' );
			
			$zoom_label = __('ZOOM +', 'woo_dgallery');
			if ($popup_gallery == 'deactivate') {
				$zoom_label = '';
				$lightbox_class = '';
			}
			
			$_upload_dir = wp_upload_dir();
			if ( file_exists( $_upload_dir['basedir'] . '/sass/woo_dynamic_gallery.min.css' ) ) {
				echo  '<link media="screen" type="text/css" href="' . $_upload_dir['baseurl'] . '/sass/woo_dynamic_gallery.min.css" rel="stylesheet" />' . "\n";
			} else {
				include( WOO_DYNAMIC_GALLERY_DIR . '/templates/customized_style.php' );
			}

            echo '<style>
				.ad-gallery .ad-image-wrapper .ad-image-description {
					filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=1, StartColorStr="#88'.$des_background.'", EndColorStr="#88'.$des_background.'");
				}</style>';

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
			
			echo '<img style="width: 0px ! important; height: 0px ! important; display: none ! important; position: absolute;" src="'.WOO_DYNAMIC_GALLERY_IMAGES_URL . '/blank.gif">';
			
            echo '<div id="gallery_'.$post->ID.'" class="ad-gallery">
                <div class="ad-image-wrapper"></div>
                <div class="ad-controls"> </div>
                  <div class="ad-nav">
                    <div class="ad-thumbs">
                      <ul class="ad-thumb-list">';                        
                        
                        $script_colorbox = '';
						$script_fancybox = '';
                        if ( !empty( $attached_images ) ){	
                            $i = 0;
                            $display = '';
			
                            if(is_array($attached_images) && count($attached_images)>0){
                                $script_colorbox .= '<script type="text/javascript">';
								$script_fancybox .= '<script type="text/javascript">';
                                $script_colorbox .= '(function($){';		  
								$script_fancybox .= '(function($){';	
                                $script_colorbox .= '$(function(){';
								$script_fancybox .= '$(function(){';
								$script_colorbox .= '$(document).on("click", ".ad-gallery .lightbox", function(ev) { if( $(this).attr("rel") == "gallery_'.$post->ID.'") {
									var idx = $("#gallery_'.$post->ID.' .ad-image img").attr("idx");';
								$script_fancybox .= '$(document).on("click", ".ad-gallery .lightbox", function(ev) { if( $(this).attr("rel") == "gallery_'.$post->ID.'") {
									var idx = $("#gallery_'.$post->ID.' .ad-image img").attr("idx");';
								
                                if(count($attached_images) <= 1 ){
                                    $script_colorbox .= '$(".gallery_product_'.$post->ID.'").colorbox({open:true, maxWidth:"100%", title: function() { return "&nbsp;";} });';
									$script_fancybox .= '$.fancybox(';
                                }else{
                                    $script_colorbox .= '$(".gallery_product_'.$post->ID.'").colorbox({rel:"gallery_product_'.$post->ID.'", maxWidth:"100%", title: function() { return "&nbsp;";} }); $(".gallery_product_'.$post->ID.'_"+idx).colorbox({open:true, maxWidth:"100%", title: function() { return "&nbsp;";} });';
									$script_fancybox .= '$.fancybox([';
                                }
								
                                $common = '';
                                
                                
								$idx = 0;
                                foreach($attached_images as $item_thumb){
                                    $li_class = '';
                                    if($i == 0){ $li_class = 'first_item';}elseif($i == count($attached_images)-1){$li_class = 'last_item';}
                                    $image_attribute = wp_get_attachment_image_src( $item_thumb->ID, 'full');
                                    $image_lager_default_url = $image_attribute[0];
									
									$image_thumb_attribute = wp_get_attachment_image_src( $item_thumb->ID, 'wc-dynamic-gallery-thumb');
                                    $image_thumb_default_url = $image_thumb_attribute[0];
									
                                    $thumb_height = $g_thumb_height;
                                    $thumb_width = $g_thumb_width;
                                    $width_old = $image_thumb_attribute[1];
                                    $height_old = $image_thumb_attribute[2];
                                     if($width_old > $g_thumb_width || $height_old > $g_thumb_height){
                                        if($height_old > $g_thumb_height && $g_thumb_height > 0 ) {
                                            $factor = ($height_old / $g_thumb_height);
                                            $thumb_height = $g_thumb_height;
                                            $thumb_width = $width_old / $factor;
                                        }
                                        if($thumb_width > $g_thumb_width && $g_thumb_width > 0 ){
                                            $factor = ($width_old / $g_thumb_width);
                                            $thumb_height = $height_old / $factor;
                                            $thumb_width = $g_thumb_width;
                                        }elseif($thumb_width == $g_thumb_width && $width_old > $g_thumb_width && $g_thumb_width > 0 ){
                                            $factor = ($width_old / $g_thumb_width);
                                            $thumb_height = $height_old / $factor;
                                            $thumb_width = $g_thumb_width;
                                        }						
                                    }else{
                                         $thumb_height = $height_old;
                                        $thumb_width = $width_old;
                                    }
                                    
                                    
                                        
                                   $alt = get_post_meta($item_thumb->ID, '_wp_attachment_image_alt', true);
								   $img_description = $item_thumb->post_excerpt;
                                            
                                    echo '<li class="'.$li_class.'"><a alt="'.$alt.'" class="gallery_product_'.$post->ID.' gallery_product_'.$post->ID.'_'.$idx.'" title="'. esc_attr( $img_description ) .'" rel="gallery_product_'.$post->ID.'" href="'.$image_lager_default_url.'"><div><img idx="'.$idx.'" style="width:'.$thumb_width.'px !important;height:'.$thumb_height.'px !important" src="'.$image_thumb_default_url.'" alt="'. esc_attr( $img_description ) .'" class="image'.$i.'" width="'.$thumb_width.'" height="'.$thumb_height.'"></div></a></li>';
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
																
                                if(count($attached_images) <= 1 ){
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
								
								if (!$have_image) {
									$script_colorbox = '';
									$script_fancybox = '';
									echo '<li style="width:'.$g_thumb_width.'px;height:'.$g_thumb_height.'px;"> <a style="width:'.$g_thumb_width.'px;height:'.$g_thumb_height.'px;" class="" rel="gallery_product_'.$product_id.'" href="'.WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/no-image.png"> <div><img style="width:'.$g_thumb_width.'px;height:'.$g_thumb_height.'px;" src="'.WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/no-image.png" class="image" alt=""> </div></a> </li>';
								}
                            }
                        }else{
                            echo '<li style="width:'.$g_thumb_width.'px;height:'.$g_thumb_height.'px;"> <a style="width:'.$g_thumb_width.'px;height:'.$g_thumb_height.'px;" class="" rel="gallery_product_'.$post->ID.'" href="'.WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/no-image.png"> <div><img style="width:'.$g_thumb_width.'px;height:'.$g_thumb_height.'px;" src="'.WOO_DYNAMIC_GALLERY_JS_URL . '/mygallery/no-image.png" class="image" alt=""> </div></a> </li>';	
								
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
	}
}
?>