<?php

switch ($album_type) {
	case "images":
        if ($album_seperator == 1) {
            ?>
            <div class="separator-doubled"></div>
        <?php
        }
        ?>
		<script type="text/javascript">

	        <?php
	        switch($gallery_type)
	        {
	            case "masonry":
					?>
					var $container1_<?php echo $unique_id;?> = jQuery("#masonry-gallery-thumbnails_<?php echo $unique_id;?>");
			        $container1_<?php echo $unique_id;?>.imagesLoaded( function() {
			            $container1_<?php echo $unique_id;?>.isotope({
			                itemSelector: ".element",
			                layoutMode : "masonry",
			                itemPositionDataEnabled: true,
			                resizable: false,
			                resizesContainer: true,
			                isAnimated: true,
			                animationOptions: {
			                    duration: 750,
			                    easing: "linear",
			                    queue: false
			                },
			                masonry : {
			                	columnWidth: ".gallery-sizer"
			                }
			            });
			        });
			        jQuery(window).smartresize(function(){
					  $container1_<?php echo $unique_id;?>.isotope({
					    // update columnWidth to a percentage of container width
					    masonry: { columnWidth: ".gallery-sizer" }
					  });
					});
					<?php
				break;
				case "thumbnail":
				    ?>
				        jQuery(function () {
				            jQuery(".imgLiquidFill").imgLiquid({fill: true});
				        });
				        <?php
				break;
			}
			?>
		</script>
        <?php
	break;
    case "grid" || "list" || "individual":
        ?>
		<script type="text/javascript">
	        jQuery(function () {
	            jQuery(".imgLiquid").imgLiquid({fill: true});
	        });
        	var ajaxurl = "<?php echo admin_url("admin-ajax.php"); ?>";
	        <?php
	        if($album_type == "grid")
	        {
                ?>
		        if (typeof(view_album_images<?php echo $unique_id;?>) != "function") {
		            function view_album_images<?php echo $unique_id;?>(album_id, unique_id) {
		                var isImageDesc = "<?php echo $img_desc ;?>";
		                var isImageTitle = "<?php echo $img_title; ?>";
		                var gallery_format = "<?php echo $gallery_type; ?>";
		                var images_in_row = "<?php echo $img_in_row; ?>";
		                var iswidget = "<?php echo $galleryWidget; ?>";
		                var special_effects = "<?php echo $special_effect; ?>";
		                var animation_effects = "<?php echo $animation_effect; ?>";
		                var show_album_title = "<?php echo $album_title; ?>";
		                var filmstrip_width = "<?php echo $image_width; ?>";
		                var isResponsive = "<?php echo $responsive;?>";
		
		                jQuery(".albums-in-row_" + unique_id).css("display", "none");
		                jQuery("#back_button" + unique_id).css("display", "none");
		                jQuery("#seperator" + unique_id).css("display", "none");
		                jQuery("#bank_album_images_div" + unique_id).css("display", "block");
		                jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
		                    "&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
		                    "&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
		                    "&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
		                    "&filmstrip_width=" + filmstrip_width + "&show_album_title=" + show_album_title +
		                    "&isResponsive="+isResponsive+
		                    "&param=show_album_gallery&action=front_view_all_albums_library", function (data) {
		                    jQuery("#back_button" + unique_id).css("display", "block");
		                    jQuery("#seperator" + unique_id).css("display", "block");
		                    jQuery("#seperator1" + unique_id).css("display", "none");
		                    jQuery("#show_bank_album_images" + unique_id).html(data);
		                });
		            }
		        }
		        if (typeof(view_albums<?php echo $unique_id;?>) != "function") {
		            function view_albums<?php echo $unique_id;?>(unique_id) {
		                jQuery(".albums-in-row_" + unique_id).css("display", "block");
		                jQuery("#bank_album_images_div" + unique_id).css("display", "none");
		                jQuery("#back_button" + unique_id).css("display", "none");
		                jQuery("#seperator" + unique_id).css("display", "none");
		                jQuery("#show_bank_album_images" + unique_id).html("");
		                <?php
		                if($album_seperator == 1)
		                {
		                    ?>
		                jQuery("#seperator1" + unique_id).css("display", "block");
		                <?php
		            }
		            ?>
		            }
		        }
		        <?php
			}
			elseif($album_type == "list")
			{
				?>
		        if (typeof(view_listed_album_images<?php echo $unique_id;?>) != "function") {
		            function view_listed_album_images<?php echo $unique_id;?>(album_id, unique_id) {
		                var isImageDesc = "<?php echo $img_desc ;?>";
		                var isImageTitle = "<?php echo $img_title; ?>";
		                var gallery_format = "<?php echo $gallery_type; ?>";
		                var images_in_row = "<?php echo $img_in_row; ?>";
		                var iswidget = "<?php echo $galleryWidget; ?>";
		                var special_effects = "<?php echo $special_effect; ?>";
		                var animation_effects = "<?php echo $animation_effect; ?>";
		                var show_album_title = "<?php echo $album_title; ?>";
		                var filmstrip_width = "<?php echo $image_width; ?>";
		                var isResponsive = "<?php echo $responsive;?>";
		
		                jQuery("#view_gallery_bank_albums_" + unique_id).css("display", "none");
		                jQuery("#back_button" + unique_id).css("display", "none");
		                jQuery("#seperator" + unique_id).css("display", "none");
		                jQuery("#bank_album_images_div" + unique_id).css("display", "block");
		                jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
		                    "&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
		                    "&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
		                    "&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
		                    "&filmstrip_width=" + filmstrip_width + "&show_album_title=" + show_album_title +
		                    "&isResponsive="+isResponsive+
		                    "&param=show_album_gallery&action=front_view_all_albums_library", function (data) {
		                    jQuery("#back_button" + unique_id).css("display", "block");
		                    jQuery("#seperator" + unique_id).css("display", "block");
		                    jQuery("#seperator1" + unique_id).css("display", "none");
		                    jQuery("#show_bank_album_images" + unique_id).html(data);
		                });
		            }
		        }
		        if (typeof(view_list_albums<?php echo $unique_id;?>) != "function") {
		            function view_list_albums<?php echo $unique_id;?>(unique_id) {
		                jQuery("#view_gallery_bank_albums_" + unique_id).css("display", "block");
		                jQuery("#bank_album_images_div" + unique_id).css("display", "none");
		                jQuery("#back_button" + unique_id).css("display", "none");
		                jQuery("#seperator" + unique_id).css("display", "none");
		                jQuery("#show_bank_album_images" + unique_id).html("");
		                <?php
		                if($album_seperator == 1)
		                {
		                    ?>
			                jQuery("#seperator1" + unique_id).css("display", "block");
			                <?php
			            }
		            ?>
		            }
		        }
				<?php
			}
			else
			{
		        ?>
		        if (typeof(view_individual_album_images<?php echo $unique_id;?>) != "function") {
		            function view_individual_album_images<?php echo $unique_id;?>(album_id, unique_id) {
		                var isImageDesc = "<?php echo $img_desc ;?>";
		                var isImageTitle = "<?php echo $img_title; ?>";
		                var gallery_format = "<?php echo $gallery_type; ?>";
		                var images_in_row = "<?php echo $img_in_row; ?>";
		                var iswidget = "<?php echo $galleryWidget; ?>";
		                var special_effects = "<?php echo $special_effect; ?>";
		                var animation_effects = "<?php echo $animation_effect; ?>";
		                var show_album_title = "<?php echo $album_title; ?>";
		                var filmstrip_width = "<?php echo $image_width; ?>";
		                var isResponsive = "<?php echo $responsive;?>";
		
		                jQuery("#ux_individual_main_div" + unique_id).css("display", "none");
		                jQuery("#back_button" + unique_id).css("display", "none");
		                jQuery("#seperator" + unique_id).css("display", "none");
		                jQuery("#bank_album_images_div" + unique_id).css("display", "block");
		                jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
		                    "&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
		                    "&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
		                    "&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
		                    "&filmstrip_width=" + filmstrip_width + "&show_album_title=" + show_album_title +
		                    "&isResponsive="+isResponsive+
		                    "&param=show_album_gallery&action=front_view_all_albums_library", function (data) {
		                    jQuery("#back_button" + unique_id).css("display", "block");
		                    jQuery("#seperator" + unique_id).css("display", "block");
		                    jQuery("#seperator1" + unique_id).css("display", "none");
		                    jQuery("#show_bank_album_images" + unique_id).html(data);
		                });
		            }
		        }
		        if (typeof(view_individual_albums<?php echo $unique_id;?>) != "function") {
		            function view_individual_albums<?php echo $unique_id;?>(unique_id) {
		                jQuery("#ux_individual_main_div" + unique_id).css("display", "inline-block");
		                jQuery("#bank_album_images_div" + unique_id).css("display", "none");
		                jQuery("#back_button" + unique_id).css("display", "none");
		                jQuery("#seperator" + unique_id).css("display", "none");
		                jQuery("#show_bank_album_images" + unique_id).html("");
		                <?php
		                if($album_seperator == 1)
		                {
		                    ?>
		                jQuery("#seperator1" + unique_id).css("display", "block");
		                <?php
		            }
		            ?>
		            }
		        }
			   <?php
			}
			?>
		</script>
        <?php
	break;
}
if($album_type == "images")
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function () {
		    jQuery("a[rel^=\"<?php echo $unique_id;?>prettyPhoto\"]").prettyPhoto
		    ({
		        animation_speed: <?php echo $lightbox_fade_in_time;?>, 
		        slideshow: <?php echo $slide_interval * 1000; ?>,
		        autoplay_slideshow: <?php echo $autoplay;?>,
		        opacity: 0.80,
		        show_title: false,
		        allow_resize: true,
		        changepicturecallback: onPictureChanged
		    });
		});
		
		function onPictureChanged() 
		{

			jQuery('.pp_social').append('<div style="margin-left:5px; display:inline-block;"><g:plusone data-action="share" href="'+ encodeURIComponent(location.href.replace(location.hash,"")) +'" width="160px" ></g:plusone></div>');

			jQuery('.pp_social').append("<script type='text/javascript'> \
			(function() { \
			var po = document.createElement('script'); \
			po.type = 'text/javascript'; \
			po.async = true; \
			po.src = 'https://apis.google.com/js/plusone.js'; \
			var s = document.getElementsByTagName('script')[0]; \
			s.parentNode.insertBefore(po, s); \
			})(); <" + "/" +  "script>");

		}
	</script>
	<?php
}
?>