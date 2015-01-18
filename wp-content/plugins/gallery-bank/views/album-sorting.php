<?php

switch($gb_role)
{
	case "administrator":
		$user_role_permission = "manage_options";
		break;
	case "editor":
		$user_role_permission = "publish_pages";
		break;
	case "author":
		$user_role_permission = "publish_posts";
		break;
}

if (!current_user_can($user_role_permission))
{
	return;
}
else
{
	if (isset($_REQUEST["row"])) {
	    $album_in_row = intval($_REQUEST["row"]);
	} else {
	    $album_in_row = 3;
	}
	
	if (isset($_REQUEST["order_id"])) {
	    switch (esc_attr($_REQUEST["order_id"])) {
	        case "unsort":
	            $album = $wpdb->get_results
	            (
					"SELECT * FROM " . gallery_bank_albums()
	            );
	            break;
	        case "albumId":
	            $album = $wpdb->get_results
				(
					"SELECT * FROM " . gallery_bank_albums() . " order by album_id asc"
				);
	            break;
	        case "name":
	            $album = $wpdb->get_results
				(
					"SELECT * FROM " . gallery_bank_albums() . " order by album_name asc"
				);
	            break;
	        case "date":
	            $album = $wpdb->get_results
				(
					"SELECT * FROM " . gallery_bank_albums() . " order by album_date asc"
				);
	            break;
	        case "asc":
	            $album = $wpdb->get_results
				(
					"SELECT * FROM " . gallery_bank_albums() . " order by album_id asc"
				);
	            break;
	        case "desc":
	            $album = $wpdb->get_results
				(
					"SELECT * FROM " . gallery_bank_albums() . " order by album_id desc"
				);
	            break;
	    }
	} else {
	    $album = $wpdb->get_results
		(
			"SELECT * FROM " . gallery_bank_albums() . " order by album_order asc "
		);
	}
	
	$album_css = $wpdb->get_results
	(
		"SELECT * FROM " . gallery_bank_settings()
	);
if(isset($album))
{
	if (count($album_css) != 0) 
	{
	    $setting_keys = array();
	    for ($flag = 0; $flag < count($album_css); $flag++) 
	    {
	        array_push($setting_keys, $album_css[$flag]->setting_key);
	    }
	    $index = array_search("cover_thumbnail_width", $setting_keys);
	    $cover_thumbnail_width = $album_css[$index]->setting_value;
	
	    $index = array_search("cover_thumbnail_height", $setting_keys);
	    $cover_thumbnail_height = $album_css[$index]->setting_value;
	
	    $index = array_search("cover_thumbnail_opacity", $setting_keys);
	    $cover_thumbnail_opacity = $album_css[$index]->setting_value;
	
	    $index = array_search("cover_thumbnail_border_size", $setting_keys);
	    $cover_thumbnail_border_size = $album_css[$index]->setting_value;
	    $new_cover_width = $cover_thumbnail_width + ($cover_thumbnail_border_size * 4);
	
	    $index = array_search("cover_thumbnail_border_radius", $setting_keys);
	    $cover_thumbnail_border_radius = $album_css[$index]->setting_value;
	
	    $index = array_search("cover_thumbnail_border_color", $setting_keys);
	    $cover_thumbnail_border_color = $album_css[$index]->setting_value;
	
	    $index = array_search("margin_btw_cover_thumbnails", $setting_keys);
	    $margin_btw_cover_thumbnails = $album_css[$index]->setting_value;
	
	    ?>
	    <!--suppress ALL -->
	    <style type="text/css">
	        .dynamic_cover_css {
	            border: <?php echo $cover_thumbnail_border_size;?>px solid <?php echo $cover_thumbnail_border_color;?>;
	            border-radius: <?php echo $cover_thumbnail_border_radius;?>px;
	            -moz-border-radius: <?php echo $cover_thumbnail_border_radius;?>px;
	            -webkit-border-radius: <?php echo $cover_thumbnail_border_radius;?>px;
	            -khtml-border-radius: <?php echo $cover_thumbnail_border_radius;?>px;
	            -o-border-radius: <?php echo $cover_thumbnail_border_radius;?>px;
	            opacity: <?php echo $cover_thumbnail_opacity;?>;
	            -moz-opacity: <?php echo $cover_thumbnail_opacity;?>;
	            -khtml-opacity: <?php echo $cover_thumbnail_opacity;?>;
	            margin-right: <?php echo $margin_btw_cover_thumbnails; ?>px;
	            margin-bottom: <?php echo $margin_btw_cover_thumbnails; ?>px;
	        }
	
	        .layout-controls > a#<?php echo $_REQUEST["order_id"];?>
	        {
	        	color:#000000;font-weight:bold;
	        }
	        .imgLiquidFill {
	            width: <?php echo $cover_thumbnail_width;?>px;
	            height: <?php echo $cover_thumbnail_height;?>px;
	            cursor: move;
	            display: inline-block;
	        }
	
	        .sort {
	            padding: 6px;
	            clear: both;
	            margin-top: 1%;
	            width: <?php echo ($new_cover_width + $margin_btw_cover_thumbnails *2) * $album_in_row ;?>px;
	        }
	    </style>
	<?php
	}
	?>
	<form id="reodering_albums" class="layout-form">
		<div id="poststuff" style="width: 99% !important;">
			<div id="post-body" class="metabox-holder">
				<div id="postbox-container-2" class="postbox-container">
					<div id="advanced" class="meta-box-sortables">
						<div id="gallery_bank_get_started" class="postbox" >
							<div class="handlediv" data-target="#ux_reorder_album" title="Click to toggle" data-toggle="collapse"><br></div>
							<h3 class="hndle"><span><?php _e("Re-Order Albums", gallery_bank); ?></span></h3>
							<div class="inside">
								<div id="ux_reorder_album" class="gallery_bank_layout">
									<a class="btn btn-inverse"
				                       href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
				                    <a href="#" onclick="show_premium_message();" class="btn btn-info"
				                            style="float:right"><?php _e("Update Order", gallery_bank); ?></a>
				                    <div id="sort_order_message" class="custom-message green" style="display: none;">
										<span>
											<strong><?php _e("Sorting Order has been updated.", gallery_bank); ?></strong>
										</span>
				                    </div>
				                    <div class="separator-doubled"></div>
				                    <div class="fluid-layout">
				                        <div class="layout-span12">
				                            <div class="widget-layout">
				                                <div class="widget-layout-body">
				                                    <div class="layout-control-group">
				                                        <ul class="breadcrumb">
				                                            <li>
				                                                <label class="layout-control-label"><strong>Presort :</strong></label>
				                                                <div class="layout-controls" style="margin-top: 10px;">
				                                                    <a id="unsort" href="admin.php?page=gallery_album_sorting&row=<?php echo $album_in_row; ?>&order_id=unsort">Unsorted</a>
				                                                    |
				                                                    <a id="albumId" href="admin.php?page=gallery_album_sorting&row=<?php echo $album_in_row; ?>&order_id=albumId">Album ID</a>
				                                                    |
				                                                    <a id="name" href="admin.php?page=gallery_album_sorting&row=<?php echo $album_in_row; ?>&order_id=name">File Name</a>
				                                                    |
				                                                    <a id="date" href="admin.php?page=gallery_album_sorting&row=<?php echo $album_in_row; ?>&order_id=date">Date</a>
				                                                    |
				                                                    <a id="asc" href="admin.php?page=gallery_album_sorting&row=<?php echo $album_in_row; ?>&order_id=asc">Ascending</a>
				                                                    |
				                                                    <a id="desc" href="admin.php?page=gallery_album_sorting&row=<?php echo $album_in_row; ?>&order_id=desc">Descending</a>
				                                                </div>
				                                                <label class="layout-control-label" style="margin-top: 10px;">
				                                                    <strong>
				                                                        <?php _e("Albums in Row", gallery_bank); ?> :
				                                                    </strong>
				                                                </label>
				                                                <select id="ux_ddl_albumRow" class="layout-span3"
				                                                        style="margin-left: 16px; margin-top: 10px;" onchange="select_albums_in_row();">
				                                                    <option id="" value=""><?php _e("Please Choose", gallery_bank); ?></option>
				                                                    <?php
				                                                    for ($i = 1; $i <= 10; $i++):
				                                                        ?>
				                                                        <option <?php if ($i == $album_in_row) echo "selected=\"selected\"" ?>
				                                                            value="<?php echo $i ?>"><?php echo $i; ?></option>
				                                                    <?php
				                                                    endfor;
				                                                    ?>
				                                                </select>
				                                            </li>
				                                        </ul>
				                                    </div>
				                                    <div id="sort_album" class="sort">
				                                        <?php
				                                        for ($flag = 0; $flag < count($album); $flag++) {
				
				                                            $albumCover = $wpdb->get_row
				                                                (
				                                                    $wpdb->prepare
				                                                        (
				                                                            "SELECT album_cover,thumbnail_url,video FROM " . gallery_bank_pics() . " WHERE album_cover=1 and album_id = %d",
				                                                            $album[$flag]->album_id
				                                                        )
				                                                );
				                                            ?>
				                                            <div id="sortOrder_<?php echo $album[$flag]->album_id; ?>"
				                                                 class="imgLiquidFill dynamic_cover_css">
				                                                <?php
				                                                if (count($albumCover) != 0) {
				                                                    if ($albumCover->album_cover == 0) {
				                                                        ?>
				                                                        <img id="albumOrder_<?php echo $album[$flag]->album_id; ?>"
				                                                             src="<?php echo stripcslashes(plugins_url("/assets/images/album-cover.png",dirname(__FILE__))); ?>"/>
				                                                    <?php
				                                                    } else {
				                                                        ?>
				                                                        <img id="albumOrder_<?php echo $album[$flag]->album_id; ?>"
				                                                             src="<?php echo stripcslashes(GALLERY_BK_ALBUM_THUMB_URL . $albumCover->thumbnail_url); ?>"/>
				                                                    <?php
				                                                    }
				                                                } else {
				                                                    ?>
				                                                    <img id="sortOrder_<?php echo $album[$flag]->album_id; ?>"
				                                                         src="<?php echo stripcslashes(plugins_url("/assets/images/album-cover.png",dirname(__FILE__))); ?>"/>
				                                                <?php
				                                                }
				                                                ?>
				                                            </div>
				                                        <?php
				                                        }
				                                        ?>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php 
}
?>
	<script type="text/javascript">
	    jQuery(".imgLiquidFill").imgLiquid({fill: true});
	    jQuery(document).ready(function () {
	        jQuery("#sort_album").sortable
	        ({
	            opacity: 0.6,
	            cursor: "move",
	            connectWith: "#sort_album"
	        });
	    });
	    function show_premium_message()
	    {
	    	alert("<?php _e( "This feature is only available in Paid Premium Version!", gallery_bank ); ?>");
	    }
	    function select_albums_in_row() {
	        var row = jQuery("#ux_ddl_albumRow").val();
	        window.location.href = "<?php echo site_url();?>/wp-admin/admin.php?page=gallery_album_sorting&row=" + row;
	    }
	</script>
<?php 
}
?>