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
		$unique_id = rand(100, 10000);
		$album_id = intval($_REQUEST["album_id"]);
		$img_in_row = intval($_REQUEST["row"]);
		if (isset($_REQUEST["order_id"])) {
		    switch (esc_attr($_REQUEST["order_id"])) {
		        case "unsort":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d",
		                            $album_id
		                        )
		                );
		            break;
		        case "picId":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_id",
		                            $album_id
		                        )
		                );
		            break;
		        case "name":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_name asc",
		                            $album_id
		                        )
		                );
		            break;
		        case "title":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by title asc",
		                            $album_id
		                        )
		                );
		            break;
		        case "date":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by date asc",
		                            $album_id
		                        )
		                );
		            break;
		        case "asc":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_id asc",
		                            $album_id
		                        )
		                );
		            break;
		        case "desc":
		            $pics_order = $wpdb->get_results
		                (
		                    $wpdb->prepare
		                        (
		                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_id desc",
		                            $album_id
		                        )
		                );
		            break;
		    }
		} else {
		    $pics_order = $wpdb->get_results
		        (
		            $wpdb->prepare
		                (
		                    "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc",
		                    $album_id
		                )
		        );
		}
		
		$album = $wpdb->get_row
		(
		    $wpdb->prepare
		        (
		            "SELECT * FROM " . gallery_bank_albums() . " where album_id = %d",
		            $album_id
		        )
		);
		$album_css = $wpdb->get_results
		(
			"SELECT * FROM " . gallery_bank_settings()
		);
	if(isset($pics_order))
	{
		if (count($album_css) != 0) 
		{
		    $setting_keys = array();
		    for ($flag = 0; $flag < count($album_css); $flag++) 
		    {
		        array_push($setting_keys, $album_css[$flag]->setting_key);
		    }
		    $index = array_search("thumbnails_width", $setting_keys);
		    $thumbnails_width = $album_css[$index]->setting_value;
		
		    $index = array_search("thumbnails_height", $setting_keys);
		    $thumbnails_height = $album_css[$index]->setting_value;
		
		    $index = array_search("thumbnails_opacity", $setting_keys);
		    $thumbnails_opacity = $album_css[$index]->setting_value;
		
		    $index = array_search("thumbnails_border_size", $setting_keys);
		    $thumbnails_border_size = $album_css[$index]->setting_value;
		    $new_thumb_width = $thumbnails_width + ($thumbnails_border_size * 4);
		
		    $index = array_search("thumbnails_border_radius", $setting_keys);
		    $thumbnails_border_radius = $album_css[$index]->setting_value;
		
		    $index = array_search("thumbnails_border_color", $setting_keys);
		    $thumbnails_border_color = $album_css[$index]->setting_value;
		
		    $index = array_search("margin_btw_thumbnails", $setting_keys);
		    $margin_btw_thumbnails = $album_css[$index]->setting_value;
		
		    $video_thumb_url = plugins_url("/assets/images/video.jpg",dirname(__FILE__));
		    ?>
		    <!--suppress ALL -->
		    <style type="text/css">
		        .dynamic_css {
		            border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?>;
		            border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -moz-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -webkit-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -khtml-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -o-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            opacity: <?php echo $thumbnails_opacity;?>;
		            -moz-opacity: <?php echo $thumbnails_opacity; ?>;
		            -khtml-opacity: <?php echo $thumbnails_opacity; ?>;
		            margin-right: <?php echo $margin_btw_thumbnails;?>px;
		            margin-bottom: <?php echo $margin_btw_thumbnails;?>px;
		        }
		        .layout-controls > a#<?php echo $_REQUEST["order_id"];?>
		        {
		            color: #000000 !important;
		            font-weight: bold !important;
		        }
		
		        .imgLiquidFill {
		            width: <?php echo $thumbnails_width;?>px;
		            height: <?php echo $thumbnails_height;?>px;
		            cursor: move;
		            display: inline-block;
		        }
		
		        .sort {
		            padding: 6px;
		            clear: both;
		            margin-top: 1%;
		            width: <?php echo ($new_thumb_width + $margin_btw_thumbnails * 2) * $img_in_row ;?>px;
		        }
		    </style>
		<?php
		}
		?>
		<form id="reodering_images" class="layout-form" method="post">
			<div id="poststuff" style="width: 99% !important;">
				<div id="post-body" class="metabox-holder">
					<div id="postbox-container-2" class="postbox-container">
						<div id="advanced" class="meta-box-sortables">
							<div id="gallery_bank_get_started" class="postbox" >
								<div class="handlediv" data-target="#ux_image_sorting" title="Click to toggle" data-toggle="collapse"><br></div>
								<h3 class="hndle"><span><?php _e("Re-Order Images", gallery_bank); ?></span></h3>
								<div class="inside">
									<div id="ux_image_sorting" class="gallery_bank_layout">
										<a class="btn btn-inverse"
					                       href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
					                    <a href="#" class="btn btn-info" onclick="show_premium_message();"
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
					                                <div class="widget-layout-title">
					                                    <h4><?php echo stripcslashes(htmlspecialchars_decode($album->album_name)); ?></h4>
					                                </div>
					                                <div class="widget-layout-body">
					                                    <div class="layout-control-group">
					                                        <ul class="breadcrumb">
					                                            <li>
					                                                <label class="layout-control-label"><strong>Presort :</strong></label>
					                                                <div class="layout-controls" style="margin-top: 8px;">
					                                                    <a id="unsort" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=unsort">Unsorted</a>
					                                                    |
					                                                    <a id="picId" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=picId">Image ID</a>
					                                                    |
					                                                    <a id="name" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=name">File Name</a>
					                                                    |
					                                                    <a id="title" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=title">Title Text</a>
					                                                    |
					                                                    <a id="date" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=date">Date</a>
					                                                    |
					                                                    <a id="asc" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=asc">Ascending</a>
					                                                    |
					                                                    <a id="desc" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=desc">Descending</a>
					                                                </div>
					                                                <br>
					                                                <label class="layout-control-label">
					                                                    <strong>
					                                                        <?php _e("Images in Row", gallery_bank); ?> :
					                                                    </strong>
					                                                </label>
					                                                <select id="ux_ddl_img_in_Row" name="ux_ddl_img_in_Row" class="layout-span2" style="margin-left: 16px;" onchange="img_in_row();">
					                                                    <option id="" value=""><?php _e("Please Choose", gallery_bank); ?></option>
					                                                    <?php
					                                                    for ($i = 1; $i <= 10; $i++):
					                                                        ?>
					                                                        <option <?php if ($i == $img_in_row) echo "selected=\"selected\"" ?>
					                                                            value="<?php echo $i ?>"><?php echo $i; ?></option>
					                                                    <?php
					                                                    endfor;
					                                                    ?>
					                                                </select>
					                                            </li>
					                                        </ul>
					                                    </div>
					                                    <div id="images_sort" class="sort">
					                                        <?php
					                                        for ($flag = 0; $flag < count($pics_order); $flag++) {
					                                            ?>
					                                            <div id="sortOrder_<?php echo $pics_order[$flag]->pic_id; ?>"
					                                                 class="imgLiquidFill dynamic_css">
					                                                <?php
					                                                if ($pics_order[$flag]->video == 1) {
					                                                    ?>
					                                                    <img id="imgOrder_<?php echo $pics_order[$flag]->pic_id; ?>"
					                                                         src="<?php echo $video_thumb_url; ?>"/>
					                                                <?php
					                                                } else {
					                                                    ?>
					                                                    <img id="imgOrder_<?php echo $pics_order[$flag]->pic_id; ?>"
					                                                         src="<?php echo GALLERY_BK_THUMB_SMALL_URL . $pics_order[$flag]->thumbnail_url; ?>"/>
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
		    jQuery(document).ready(function () {
		        jQuery(".sort").sortable
		        ({
		            opacity: 0.6,
		            cursor: "move",
		            connectWith: ".sort"
		        });
		    });
		    jQuery(".imgLiquidFill").imgLiquid({fill: true});
		    function show_premium_message()
		    {
		    	alert("<?php _e( "This feature is only available in Paid Premium Version!", gallery_bank ); ?>");
		    }
		    function img_in_row() {
		        var row = jQuery("#ux_ddl_img_in_Row").val();
		        window.location.href = "<?php echo site_url();?>/wp-admin/admin.php?page=images_sorting&album_id=<?php echo $album_id;?>&row=" + row;
		    }
		</script>
	<?php 
	}
	?>