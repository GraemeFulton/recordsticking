<style>
.<?php echo $class_images_in_row ?> > a
{
 text-decoration:none !important;
}
</style>
<div class="<?php echo $class_images_in_row;?>" id="gallery-bank-thumbnails_<?php echo $unique_id;?>">
<?php
	for($flag = 0; $flag< count($pics); $flag++) 
	{
        $image_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))). "</h5>" : "";
        $image_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) ."</p>" : "";
        if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
		{
			if($pics[$flag]->video == 1)
			{
				?>
				<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]"  href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo $image_title.$image_description;?>" id="ux_img_div_<?php echo $unique_id; ?>">
				<?php
			}
			else
			{
				?>
				<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]"  href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title.$image_description;?>" id="ux_img_div_<?php echo $unique_id;?>">
				<?php
			}
		}
		else 
		{
			?>
			<a href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="_blank" data-title="<?php echo $image_title;?>">
			<?php
		}
		if($img_title == "true" || $img_desc == "true")
		{
			?>
			<div class="dynamic_css margin_thumbs thumbnail_width<?php echo $unique_id;?> widget_margin_thumbs<?php echo $unique_id;?> gb_overlay">
				<div class="widgetImgLiquidFill<?php echo $unique_id;?> imgLiquidFill opactiy_thumbs">
					<div class="overlay_text">
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
							<img imageid="<?php echo $pics[$flag]->pic_id;?>"
                                 id="ux_gb_img_<?php echo $pics[$flag]->pic_id;?>" type="video"
                                 src="<?php echo stripcslashes($video_thumb_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
							<?php
						}
						else
						{
							?>
							<img imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>"
                                 type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
							<?php
						}
					?>
				</div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="imgLiquidFill widgetImgLiquidFill<?php echo $unique_id;?> shutter-gb-img-wrap opactiy_thumbs dynamic_css margin_thumbs thumbnail_width<?php echo $unique_id;?> widget_margin_thumbs<?php echo $unique_id;?>" >
				<?php
				if($pics[$flag]->video == 1)
				{
					?>
					<img imageid="<?php echo $pics[$flag]->pic_id;?>"
                         id="ux_gb_img_<?php echo $pics[$flag]->pic_id;?>" type="video"
                         src="<?php echo stripcslashes($video_thumb_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
					<?php
				}
				else
				{
					?>
					<img imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>"
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