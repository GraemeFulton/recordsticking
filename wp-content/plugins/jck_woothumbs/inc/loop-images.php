<?php

global $jckWooThumbs;

$return = '';

if(!empty($images)):
	
	$return .= '<div class="'.$this->slug.' rsMinW jckcf">';

	$i = 0; foreach($images as $image):
		
		$return .= '<div>';
		
			$return .= '<img class="rsImg '.$this->slug.'_zoom" src="'.$image['single'][0].'" data-rsTmb="'.$image['thumb'][0].'" data-jckLargeImg="'.$image['large'][0].'" title="'.$image['title'].'" alt="'.$image['alt'].'">';
			
			if($jckWooThumbs['enableLightbox']){ 
				$return .= '<a href="'.$image['large'][0].'" rel="prettyPhoto[wt_gal]" class="viewFull"><span>Fullscreen</span></a>'; 
			} else {
				if($jckWooThumbs['enableArrows']) $return .= '<div class="viewFull">&nbsp;</div>';
			}
		
		$return .= '</div>';
		
	$i++; endforeach;
	
	$return .= '</div>';
	
	$return .= '<div class="jckLoading"><img src="'.$this->plugin_url.'assets/frontend/img/loading.gif"></div>';

endif;