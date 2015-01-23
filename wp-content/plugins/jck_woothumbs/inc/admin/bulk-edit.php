<?php
   	
echo '<div class="wrap">';
	
	echo '<h2 style="margin-bottom: 20px;">'.__('Bulk Edit Variation Images', $this->slug).'</h2>';
	
	echo '<p>'.sprintf( __( 'From this page you can edit all variation images from one place. Simply enter a comma separated list (no spaces) of image IDs for each variation and click Update. You can find your image IDs in the <a href="%s" target="_blank">Media Library</a>.', $this->slug ), admin_url('upload.php') ).'</p>';
	
	$args = array(
		'post_type' => 'product_variation',
		'posts_per_page' => -1
	);
	
	$variations = new WP_Query( $args );
	
	if ( $variations->have_posts() ) {
	
		echo '<table class="widefat wp-list-table">';
			
			echo '<thead>';
			    echo '<tr>';
			        echo '<th>Variation Name</th>';
			        echo '<th>Parent Product</th>';
			        echo '<th>Images</th>';     
			        echo '<th>&nbsp;</th>';
			    echo '</tr>';
			echo '</thead>';
			
			echo '<tbody>';
		
				$i = 0; while ( $variations->have_posts() ) {
					$variations->the_post();
					
					$variation = new WC_Product_Variation( get_the_id() );
					$variationAtts = $variation->get_variation_attributes();
					
					$images = get_post_meta(get_the_id(), 'variation_image_gallery', true);
					$parents = get_post_ancestors(get_the_id()); 
					$parentId = $parents[0];
					$parentEditUrl = admin_url('post.php?post='.$parentId.'&action=edit');
					$parentName = get_the_title($parentId);
					
					// List Variation Attributes
					
					if(is_array($variationAtts) && !empty($variationAtts))
					{
						
						$atts = '<ul class="variationAtts">';
											
						foreach($variationAtts as $attName => $variationAtt)
						{
							if($variationAtt != "")
							{
								$atts .= '<li><em>'.$attName.'</em>: '.$variationAtt.'</li>';
							}
						}
						
						$atts .= '</ul>';
					
					}
					
					// Echo Variation row
					
					echo '<tr class="'.($i % 2 == 0 ? 'alternate' : '').'">';
						echo '<td>'.get_the_title().$atts.'</td>';
						echo '<td><a href="'.$parentEditUrl.'" target="_blank">'.$parentName.' ('.$parentId.')</a></td>';
						echo '<td><input id="images-'.$i.'" value="'.$images.'"></td>';
						echo '<td><input class="button-primary saveVariationImages" type="submit" value="'.__('Update', $this->slug).'" data-updating="'.__('Updating...', $this->slug).'" data-updated="'.__('Updated', $this->slug).'" data-update="'.__('Update', $this->slug).'" data-varid="'.get_the_id().'" data-input="#images-'.$i.'" data-error="'.__('Error', $this->slug).'"> <p class="updateMsg"></p></td>';
					echo '</tr>';
					
					$i++;
				}
			
			echo '</tbody>';
		
		echo '</table>';
		
	} else {
		// no posts found
	}
	
	wp_reset_postdata();
	
echo '</div>';