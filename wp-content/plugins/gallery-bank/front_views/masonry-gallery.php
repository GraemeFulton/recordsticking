<style type="text/css">
	<?php
	if($widget != "true")
	{
	?>
		.width_thumb
		{
			width:<?php echo $thumbnails_width+1;?>px !important;
			border-radius:0px !important;
	        display: block !important;
	        box-sizing: border-box !important;
            max-width: 100% !important;
		}
	<?php
	}
	else
	{
		?>
		.widget_width_thumb<?php echo $unique_id;?>
		{
			width:<?php echo $thumbnails_width+1;?>px !important;
			border-radius:0px !important;
	        display: block !important;
	        box-sizing: border-box !important;
            max-width: 100% !important;
		}
		<?php
	}
	?>
	.gallery-sizer { width:<?php echo $thumbnails_width + 10;?>px !important; }

	@media screen and (min-width: 720px) {
		.gallery-sizer { width:<?php echo $thumbnails_width + 10;?>px !important; } 
	}
</style>
<div  class="<?php echo $class_images_in_row;?>" id="masonry-gallery-thumbnails_<?php echo $unique_id;?>" >
<?php
	$css_class = $widget == "true" ? "widget_width_thumb". $unique_id : "width_thumb ";
	for($flag = 0; $flag< count($pics); $flag++) 
	{
        $image_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))). "</h5>" : "";
        $image_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) ."</p>" : "";
		if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
		{
			if($pics[$flag]->video == 1)
			{
				?>
				<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="element gallery-sizer" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo $image_title.$image_description;?>" id="ux_img_div_<?php echo $unique_id;?>">
				<?php
			}
			else
			{
				?>
				<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="element gallery-sizer" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title.$image_description;?>" id="ux_img_div_<?php echo $unique_id;?>">
				<?php
			}
		}
		else 
		{
			?>
			<a class="element gallery-sizer" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="_blank" data-title="<?php echo $image_title;?>">
			<?php
		}
		if($img_title == "true" || $img_desc == "true")
		{
			?>
			<div class="widget_margin_thumbs<?php echo $unique_id;?> opactiy_thumbs margin_thumbs dynamic_css gb_overlay">
				<div class= "overlay_text">
					<h5><?php echo stripcslashes(htmlspecialchars_decode($pics[$flag]->title));?></h5>
					<?php
					if($img_desc == "true")
					{
						?>
						<p>
							<?php
							$string = stripcslashes(htmlspecialchars_decode($pics[$flag]->description));
							$description = (strlen($string) > $thumbnail_desc_length) ? substr($string,0,$thumbnail_desc_length)."..." : $string;
							echo $description;
							?>
						</p>
						<?php
					}
					?>
				</div>
				<?php
					if($pics[$flag]->video == 1)
					{

						?>
						<img class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>"
						imageid="<?php echo $pics[$flag]->pic_id;?>"
                         id="ux_gb_img_<?php echo $unique_id;?>" type="video"
                             src="<?php echo stripcslashes($video_thumb_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
						<?php
					}
					else
					{
						?>
						<img class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>"
						imageid="<?php echo $pics[$flag]->pic_id;?>"
                           type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
						<?php
					}
				?>
			</div>
		<?php
		}
		else
		{
			?>
			<div class="margin_thumbs dynamic_css opactiy_thumbs widget_margin_thumbs<?php echo $unique_id;?>" >
				<?php
				if($pics[$flag]->video == 1)
				{
					?>
					<img class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>"
					 imageid="<?php echo $pics[$flag]->pic_id;?>"
                      type="video" src="<?php echo stripcslashes($video_thumb_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
					<?php
				}
				else
				{
					?>
					<img class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>"
					imageid="<?php echo $pics[$flag]->pic_id;?>"
                      type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
					<?php
				}
				?>
			</div>
			<?php
		}
		?>
		</a>
	<?php	
	}
?>
</div>