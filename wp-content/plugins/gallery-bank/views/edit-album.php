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
		$upload_photos = wp_create_nonce("manage_uploading");
		$album_id = intval($_REQUEST["album_id"]);
		$last_albums_id = $wpdb->get_var
		(
			$wpdb->prepare
			(
				"SELECT album_id FROM " .gallery_bank_albums(). " where album_id= %d",
				$album_id
			)
		);
		$album_count = $wpdb->get_var
		(
			"SELECT count(album_id) FROM ".gallery_bank_albums()
		);
		if($album_count < 3)
		{
			if($last_albums_id == 0)
			{
				$wpdb->query
				(
					$wpdb->prepare
					(
						"INSERT INTO " . gallery_bank_albums() . "(album_id,album_name, description, album_date, author, album_order)
						VALUES(%d, %s, %s, CURDATE(), %s, %d)",
						$album_id,
						"Untitled Album",
						"",
						$current_user->display_name,
						$album_id
					)
				);
				$album = $wpdb->get_row
				(
					$wpdb->prepare
					(
						"SELECT * FROM " . gallery_bank_albums() . " where album_id = %d",
						$album_id
					)
				);
			}
			else
			{
				$album = $wpdb->get_row
				(
					$wpdb->prepare
					(
						"SELECT * FROM " . gallery_bank_albums() . " where album_id = %d",
						$album_id
					)
				);
			}
		}
		else
		{
			$album = $wpdb->get_row
			(
				$wpdb->prepare
				(
					"SELECT * FROM " . gallery_bank_albums() . " where album_id = %d",
					$album_id
				)
			);
		}
		$pics = $wpdb->get_results
		(
		    $wpdb->prepare
		    (
		        "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc ",
		        $album_id
		    )
		);
		
		$album_css = $wpdb->get_results
		(
			"SELECT * FROM " . gallery_bank_settings()
		);
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
		
		    $index = array_search("thumbnails_border_radius", $setting_keys);
		    $thumbnails_border_radius = $album_css[$index]->setting_value;
		
		    $index = array_search("thumbnails_border_color", $setting_keys);
		    $thumbnails_border_color = $album_css[$index]->setting_value;
		
		    $index = array_search("cover_thumbnail_width", $setting_keys);
		    $cover_thumbnail_width = $album_css[$index]->setting_value;
		
		    $index = array_search("cover_thumbnail_height", $setting_keys);
		    $cover_thumbnail_height = $album_css[$index]->setting_value;
		
			$video_url = plugins_url("/assets/images/video.jpg",dirname(__FILE__));
		
		    ?>
		    <!--suppress ALL -->
		    <style type="text/css">
		        .dynamic_css {
		            border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?>;
		            border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -moz-border-radius: <?php echo $thumbnails_border_radius; ?>px;
		            -webkit-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -khtml-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            -o-border-radius: <?php echo $thumbnails_border_radius;?>px;
		            opacity: <?php echo $thumbnails_opacity;?>;
		            -moz-opacity: <?php echo $thumbnails_opacity; ?>;
		            -khtml-opacity: <?php echo $thumbnails_opacity; ?>;
		        }
		    </style>
		<div class="custom-message red" style="display: block;margin-top:30px">
			<span>
				<strong>You will be only allowed to add 3 galleries. Kindly purchase Premium Version for full access.</strong>
			</span>
		</div>
		<form id="edit_album" class="layout-form">
			<div id="poststuff" style="width: 99% !important;">
				<div id="post-body" class="metabox-holder">
					<div id="postbox-container-2" class="postbox-container">
						<div id="advanced" class="meta-box-sortables">
							<div id="gallery_bank_get_started" class="postbox" >
								<div class="handlediv" data-target="#ux_edit_album" title="Click to toggle" data-toggle="collapse"><br></div>
								<h3 class="hndle"><span><?php _e("Album", gallery_bank); ?></span></h3>
								<div class="inside">
									<div id="ux_edit_album" class="gallery_bank_layout">
										<a class="btn btn-inverse" href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
										<button type="submit" class="btn btn-info" style="float:right"><?php _e("Save Album", gallery_bank); ?></button>
										<div class="separator-doubled"></div>
										<div id="update_album_success_message" class="custom-message green" style="display: none;">
											<span>
												<strong><?php _e("Album Saved. Kindly wait for the redirect to happen.", gallery_bank); ?></strong>
											</span>
										</div>
										<div class="fluid-layout">
											<div class="layout-span6">
												<div class="widget-layout">
													<div class="widget-layout-title">
														<h4><?php _e("Album Details", gallery_bank); ?></h4>
													</div>
									                <div class="widget-layout-body">
									                    <div class="layout-control-group">
									                        <label class="layout-control-label"><?php _e("Album Title", gallery_bank); ?> :</label>
									                        <div class="layout-controls">
									                            <input type="text" name="ux_edit_title" class="layout-span12"
								                                   value="<?php echo stripcslashes(htmlspecialchars_decode($album->album_name)); ?>"
								                                   id="ux_edit_title"
								                                   placeholder="<?php _e("Enter your Album Title", gallery_bank); ?>"/>
									                        </div>
									                    </div>
									                    <input type="hidden" id="ux_hidden_album_id" value="<?php echo $album_id; ?>"/>
									                </div>
									                <div class="widget-layout-body">
									                    <div class="layout-control-group">
									                        <label class="layout-control-label"><?php _e("Description", gallery_bank); ?> :</label>
									                    </div>
									                    <div class="layout-control-group">
									                        <?php
									                        $ux_content = stripslashes(htmlspecialchars_decode($album->description));
									                        wp_editor($ux_content, $id = "ux_edit_description", $media_buttons = true, $tab_index = 1);
									                        ?>
									                    </div>
									                </div>
									            </div>
									        </div>
									        <div class="layout-span6">
									            <div class="widget-layout">
									                <div class="widget-layout-title">
									                    <h4><?php _e("Upload Images", gallery_bank); ?></h4>
									                </div>
									                <div class="widget-layout-body" id="edit_image_uploader">
									                    <p><?php _e("Your browser doesn\"t have Flash, Silverlight or HTML5 support.", gallery_bank) ?></p>
									                </div>
									            </div>
									        </div>
									        <div class="layout-span6">
									            <div class="widget-layout">
									                <div class="widget-layout-title">
									                    <h4><?php _e("Upload Videos", gallery_bank); ?>
									                    	<i class="widget_premium_feature"><?php _e(" (Available in Premium Versions)", gallery_bank); ?></i>
									                    </h4>
									                </div>
									                <div class="widget-layout-body" id="edit_video_uploader">
									                    <div class="layout-control-group">
									                        <label class="layout-control-label"><?php _e("Video Url", gallery_bank); ?> :</label>
									                        <div class="layout-controls">
									                            <input type="text" name="ux_edit_txt_video_url" class="layout-span12" value=""
								                                   id="ux_edit_txt_video_url"
								                                   placeholder="<?php _e("Enter your Video Url", gallery_bank); ?>"/>
									                        </div>
									                    </div>
									                    <div class="layout-control-group">
									                        <div class="layout-controls">
									                            <button type="button" onclick="insertVideoToDataTable();" style="float:right"
									                                    class="btn btn-info"><?php _e("Upload Video", gallery_bank); ?></button>
									                        </div>
									                    </div>
									                </div>
									            </div>
									        </div>
										</div>
										<div class="fluid-layout">
											<div class="layout-span12">
												<div class="widget-layout">
													<div class="widget-layout-title">
														<h4><?php _e("Your Gallery Bank Album", gallery_bank); ?></h4>
													</div>
													<div class="widget-layout-body">
														<table class="table table-striped " id="data-table-edit-album">
															<thead>
																<tr>
																	
										                            <th style="width:11%">
										                                <input type="checkbox" id="grp_select_items" name="grp_select_items" style="vertical-align:middle;"/>
										                                <button type="button" onclick="deleteSelectedImages();" style="vertical-align:middle;"
										                                        class="btn btn-inverse"><?php _e("Delete", gallery_bank); ?></button>
										                            </th>
										                            <th style="width:15%">
										                                <?php _e("Thumbnail", gallery_bank); ?>
										                            </th>
										                            <th style="width:25%">
										                                <?php _e("Title & Description", gallery_bank); ?>
										                            </th>
										                            <th style="width:20%">
										                                <?php _e("Tags (comma separated list)", gallery_bank); ?>
										                                <i class="widget_premium_feature"><?php _e(" (Available in Premium Versions)", gallery_bank); ?></i>
										                            </th>
										                            <th style="width:25%">
										                                <?php _e("Url to Redirect on click of an Image", gallery_bank); ?>
										                            </th>
										                            <th style="width:5%"></th>
										                            <th style="visibility: hidden"></th>
										                        </tr>
															</thead>
				                        					<tbody>
																<?php
																for ($flag = 0; $flag < count($pics); $flag++) {
																	?>
																	<tr>
																		<?php
																		if ($pics[$flag]->video == 1) {
																		?>
												
																			<td>
																				<input type="checkbox" id="ux_grp_select_items" name="ux_grp_select_items"
																				value="<?php echo $pics[$flag]->pic_id; ?>" />
																			</td>
																			<td>
																				<a href="javascript:void(0);" title="<?php echo $pics[$flag]->pic_name; ?>">
																					<img imageid="<?php echo $pics[$flag]->pic_id; ?>" type="video"
																					imgpath="<?php echo $pics[$flag]->pic_name; ?>"
																					src="<?php echo stripcslashes($video_url); ?>" id="ux_gb_img"
																					name="ux_gb_img" width="<?php echo $thumbnails_width; ?>px;"
																					class="dynamic_css" picId="<?php echo $pics[$flag]->pic_id; ?>"/>
																				</a><br/>
																				<?php $dateFormat = date("F j, Y", strtotime($pics[$flag]->date)); ?>
																				<label><strong>Video</strong></label><br/><label><?php echo $dateFormat; ?></label>
																			</td>
																			<td>
																				<input placeholder="<?php _e("Enter your Title", gallery_bank) ?>"
																					class="layout-span12 " type="text"
																					name="ux_edit_video_title_<?php echo $pics[$flag]->pic_id; ?>"
																					id="ux_edit_video_title_<?php echo $pics[$flag]->pic_id; ?>"
																					value="<?php echo html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title))); ?>"/>
																				<textarea placeholder=" <?php _e("Enter your Description ", gallery_bank) ?>"
																					style="margin-top:20px" rows="5" class="layout-span12"
																					name="ux_txt_desc_<?php echo $pics[$flag]->pic_id; ?>"
																					id="ux_txt_desc_<?php echo $pics[$flag]->pic_id; ?>"><?php echo html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description))); ?></textarea>
																			</td>
																			<td>
																				<input placeholder="<?php _e("Enter your Tags", gallery_bank) ?>"
																				class="layout-span12"  type="text" readonly="readonly"
																				name="ux_edit_txt_tags_<?php echo $pics[$flag]->pic_id; ?>"
																				id="ux_edit_txt_tags_<?php echo $pics[$flag]->pic_id; ?>" onkeypress="return preventDot(event);"
																				value="" />
																			</td>
																			<td>
																			</td>
																			<td>
																				<a class="btn hovertip " id="ux_btn_delete" style="cursor: pointer;"
																				data-original-title="<?php _e("Delete Video", gallery_bank) ?>"
																				onclick="deleteImage(this);"
																				controlId="<?php echo $pics[$flag]->pic_id; ?>">
																					<i class="icon-trash"></i>
																				</a>
																			</td>
																			
																		<?php
																		} else {
																		?>
																			<td>
																				<input type="checkbox" id="ux_grp_select_items" name="ux_grp_select_items"
																				value="<?php echo $pics[$flag]->pic_id; ?>" />
																			</td>
																			<td>
																				<a href="javascript:void(0);" title="<?php echo $pics[$flag]->pic_name; ?>">
																					<img type="image" imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>"
																						src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL . $pics[$flag]->thumbnail_url); ?>"
																						id="ux_gb_img" imageid="<?php echo $pics[$flag]->pic_id; ?>"
																						name="ux_gb_img" class=" dynamic_css"
																						width="<?php echo $thumbnails_width ?>"/>
																				</a>
																				<br/>
										                                        <?php $dateFormat = date("F j, Y", strtotime($pics[$flag]->date)); ?>
										                                        <label><strong><?php echo $pics[$flag]->pic_name; ?></strong></label><br/><label><?php echo $dateFormat; ?></label><br/>
										                                        <?php
										                                        if ($pics[$flag]->album_cover == 1) {
										                                            ?>
										                                            <input type="radio" style="cursor: pointer;" onclick="select_one_radio(this);" checked="checked"
									                                                   id="ux_edit_rdl_cover_<?php echo $pics[$flag]->pic_id; ?>"
									                                                   name="ux_album_cover"/>
										                                            <label><?php _e(" Set as Album Cover", gallery_bank) ?></label>
										                                        <?php
										                                        } else {
										                                            ?>
										                                            <input type="radio" onclick="select_one_radio(this);" style="cursor: pointer;"
									                                                   id="ux_edit_rdl_cover_<?php echo $pics[$flag]->pic_id; ?>"
									                                                   name="ux_album_cover"/>
										                                            <label><?php _e(" Set as Album Cover", gallery_bank) ?></label>
										                                        <?php
										                                        }
										                                        ?>
										                                    </td>
										                                    <td>
										                                        <input placeholder="<?php _e("Enter your Title", gallery_bank) ?>"
									                                               class="layout-span12 " type="text"
									                                               name="ux_edit_img_title_<?php echo $pics[$flag]->pic_id; ?>"
									                                               id="ux_edit_img_title_<?php echo $pics[$flag]->pic_id; ?>"
									                                               value="<?php echo html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title))); ?>"/>
										                                        <textarea placeholder="<?php _e("Enter your Description ", gallery_bank) ?>"
								                                                   style="margin-top:20px" rows="5" class="layout-span12 "
								                                                   name="ux_edit_txt_desc_<?php echo $pics[$flag]->pic_id; ?>"
								                                                   id="ux_edit_txt_desc_<?php echo $pics[$flag]->pic_id; ?>"><?php echo html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description))); ?></textarea>
										                                    </td>
										                                    <td>
										                                        <input placeholder="<?php _e("Enter your Tags", gallery_bank) ?>"
									                                               class="layout-span12 " type="text" onkeypress="return preventDot(event);"
									                                               name="ux_edit_txt_tags_<?php echo $pics[$flag]->pic_id; ?>"
									                                               id="ux_edit_txt_tags_<?php echo $pics[$flag]->pic_id; ?>" readonly="readonly"
									                                               value=""/>
										                                    </td>
										                                    <td>
										                                        <?php
										                                        if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined") {
										                                            $domain = "http://";
										                                        } else {
										                                            $domain = str_replace("http://http://", "http://", $pics[$flag]->url);
										                                        }
										                                        ?>
										                                        <input value="<?php echo $domain; ?>" type="text"
									                                               id="ux_edit_txt_url_<?php echo $pics[$flag]->pic_id; ?>"
									                                               name="ux_edit_txt_url_<?php echo $pics[$flag]->pic_id; ?>"
									                                               class="layout-span12 "/>
										                                    </td>
										                                    <td>
										                                        <a class="btn hovertip" id="ux_btn_delete" style="cursor: pointer;"
										                                           data-original-title="<?php _e("Delete Image", gallery_bank) ?>"
										                                           onclick="deleteImage(this);"
										                                           controlId="<?php echo $pics[$flag]->pic_id; ?>">
										                                            <i class="icon-trash"></i>
										                                        </a>
										                                    </td>
										                                    <td style="visibility: hidden">
																				<?php echo $pics[$flag]->pic_id; ?>
																			</td>
											                            <?php
											                            }
											                            ?>
											                        </tr>
										                        <?php
										                        }
				                       						 ?>
								                        	</tbody>
									                    </table>
									                </div>
									            </div>
									        </div>
										</div>
				    					<div class="separator-doubled"></div>
										<button type="submit" class="btn btn-info" style="float:right; margin-top: 20px;"><?php _e("Save Album", gallery_bank); ?></button>
										<a class="btn btn-inverse" href="admin.php?page=gallery_bank" style="margin-top: 20px;"><?php _e("Back to Albums", gallery_bank); ?></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<script type="text/javascript">
		
		    jQuery(".hovertip").tooltip();
		    var url = "<?php echo plugins_url("/assets/",dirname(__FILE__)) ?>";
		    var image_width = <?php echo $thumbnails_width; ?>;
		    var image_height = <?php echo $thumbnails_height; ?>;
		    var cover_width = <?php echo $cover_thumbnail_width; ?>;
		    var cover_height = <?php echo $cover_thumbnail_height; ?>;
		    var delete_array = [];
		    var array_album_data = [];
			
		    oTable = jQuery("#data-table-edit-album").dataTable
		    ({
		        "bJQueryUI": false,
		        "bAutoWidth": true,
		        "sPaginationType": "full_numbers",
		        "sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		        "oLanguage": {
		            "sLengthMenu": "<span>Show entries:</span> _MENU_"
		        },
				"aaSorting": [[ 6, "asc" ]],
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [0] },{ "bSortable": false, "aTargets": [0] }]
				
		    });
		    jQuery("#edit_album").validate
		    ({
		        submitHandler: function () {
		            jQuery("#update_album_success_message").css("display", "block");
		            jQuery("body,html").animate({
		                scrollTop: jQuery("body,html").position().top}, "slow");
		            var albumid = jQuery("#ux_hidden_album_id").val();
		            if (delete_array.length > 0)
		            {
		                jQuery.post(ajaxurl,"delete_array=" +  encodeURIComponent(delete_array) + "&albumid=" + albumid + "&param=delete_pic&action=add_new_album_library", function ()
		                {
		                });
		            }
		
		            var uxEditDescription = "";
		
		            <?php
			    	if(class_exists("ckeditor_wordpress"))
					{
						?>
		            var uxEditDescription = encodeURIComponent(CKEDITOR.instances.ux_edit_description.getData());
		            <?php
		        }
		        else
		        {
		            ?>
		            var uxEditDescription = jQuery("#wp-ux_edit_description-wrap").hasClass("tmce-active") ?
		                encodeURIComponent(tinyMCE.get("ux_edit_description").getContent())
		                : encodeURIComponent(jQuery("#ux_edit_description").val());
		            <?php
		        }
		        ?>
		
		            var edit_album_name = encodeURIComponent(jQuery("#ux_edit_title").val());
		            jQuery.post(ajaxurl, "albumid=" + albumid + "&edit_album_name=" + edit_album_name + "&uxEditDescription=" + uxEditDescription + "&param=update_album&action=add_new_album_library", function () {
		                var count = 0;
		                jQuery.each(oTable.fnGetNodes(), function (index, value) {
		                    var controlClass = jQuery(value.cells[1]).find("img").attr("class");
		                    var controlType = "";
		                    var img_gb_path = "";
		                    var isAlbumCoverSet = "";
		                    var title = "";
		                    var description = "";
		                    var tags = "";
		                    var urlRedirect = "";
		                    var picId = "";
		                    var row_data = [];
		
		                    controlType = jQuery(value.cells[1]).find("img").attr("type");
		                    picId = jQuery(value.cells[1]).find("img").attr("imageId");
		                    img_gb_path = (jQuery(value.cells[1]).find("img").attr("imgpath"));
		                    isAlbumCoverSet = jQuery(value.cells[1]).find("input:radio").attr("checked");
		                    title = (jQuery(value.cells[2]).find("input:text").eq(0).val());
		                    description =(jQuery(value.cells[2]).find("textarea").eq(0).val());
		                    tags = jQuery(value.cells[3]).find("input:text").eq(0).val();
		                    urlRedirect = jQuery(value.cells[4]).find("input:text").eq(0).val();
		                    row_data.push(controlType);
		                    row_data.push(picId);
		                    row_data.push(img_gb_path);
		                    row_data.push(isAlbumCoverSet);
		                    row_data.push(title);
		                    row_data.push(description);
		                    row_data.push(tags);
		                    row_data.push(urlRedirect);
		                    row_data.push(cover_width);
		                    row_data.push(cover_height);
		
		                    array_album_data.push(row_data);
		                });
		                jQuery.post(ajaxurl, "album_data="+encodeURIComponent(JSON.stringify(array_album_data))+ "&param=update_pic&action=add_new_album_library", function (data) {
		                    setTimeout(function () {
		                        jQuery("#update_album_success_message").css("display", "none");
		                        window.location.href = "admin.php?page=gallery_bank";
		                    }, 10000);
		                });
		
		            });
		        }
		    });
		    jQuery("#edit_image_uploader").pluploadQueue
		    ({
		        runtimes: "html5,flash,silverlight,html4",
		        url: ajaxurl + "?param=upload_pic&action=upload_library&_nonce=<?php echo $upload_photos;?>",
		        chunk_size: "1mb",
		        filters: {
		            max_file_size: "100mb",
		            mime_types: [
		                {title: "Image files", extensions: "jpg,jpeg,gif,png"}
		            ]
		        },
		        rename: true,
		        sortable: true,
		        dragdrop: true,
		        unique_names: true,
		        max_file_count: 20,
		        views: {
		            list: true,
		            thumbs: true, // Show thumbs
		            active: "thumbs"
		        },
		        flash_swf_url: url + "Moxie.swf",
		        silverlight_xap_url: url + "Moxie.xap",
		        init: {
		            FileUploaded: function (up, file) {
		                
		                var oTable = jQuery("#data-table-edit-album").dataTable();
						var albumid = jQuery("#ux_hidden_album_id").val();
		                var controlType = "image";
		                var image_name = file.name;
		                var img_gb_path = file.target_name;
		                jQuery.post(ajaxurl, "album_id=" + albumid + "&controlType=" + controlType + "&imagename=" + image_name +
		                    "&img_gb_path=" + img_gb_path + "&cover_height=" + cover_height + "&cover_width=" + cover_width +
		                    "&param=add_pic&action=add_new_album_library", function (result) {
		                    	
		                    	jQuery.post(ajaxurl, "img_path=" + file.target_name + "&img_name=" + file.name + "&image_width=" + image_width +
				                "&image_height=" + image_height + "&picid=" + result +
				                "&param=add_new_dynamic_row_for_image&action=add_new_album_library", function (data) {
					                
				                var col1 = jQuery("<td></td>");
				                col1.append(jQuery.parseJSON(data)[0]);
				                var col2 = jQuery("<td></td>");
				                col2.append(jQuery.parseJSON(data)[1]);
				                var col3 = jQuery("<td></td>");
				                col3.append(jQuery.parseJSON(data)[2]);
				                var col4 = jQuery("<td></td>");
				                col4.append(jQuery.parseJSON(data)[3]);
				                var col5 = jQuery("<td></td>");
				                col5.append(jQuery.parseJSON(data)[4]);
				                var col6 = jQuery("<td></td>");
				                col6.append(jQuery.parseJSON(data)[5]);
				                var col7 = jQuery("<td style=\"visibility:hidden;\"></td>");
				                oTable.fnAddData([col1.html(), col2.html(), col3.html(), col4.html(), col5.html(), col6.html(), col7.html()]);
				                
				                select_radio();
				                jQuery(".hovertip").tooltip();
				            });
		                });
		                
		            },
		            UploadComplete: function () {
		                jQuery(".plupload_buttons").css("display", "block");
		                jQuery(".plupload_upload_status").css("display", "none");
		            }
		        }
		    });
		    function deleteImage(control) {
		        var r = confirm("<?php _e("Are you sure you want to delete this Image?", gallery_bank)?>");
		        if (r == true) {
		            var row = jQuery(control).closest("tr");
		            var oTable = jQuery("#data-table-edit-album").dataTable();
		                var controlId = jQuery(control).attr("controlid");
		                delete_array.push(controlId);
		            
		            oTable.fnDeleteRow(row[0]);
		            select_radio();
		        }
		    }
		    function insertVideoToDataTable()
		    {
		       alert("<?php _e( "This feature is only available in Paid Premium Version!", gallery_bank ); ?>");
		    }
		    jQuery("#grp_select_items").click(function () {
		        var oTable = jQuery("#data-table-edit-album").dataTable();
		        var checkProp = jQuery("#grp_select_items").prop("checked");
		        jQuery("input:checkbox", oTable.fnGetNodes()).each(function () {
		            if (checkProp) {
		                jQuery(this).attr("checked", "checked");
		            }
		            else {
		                jQuery(this).removeAttr("checked");
		            }
		        });
		    });
		    function deleteSelectedImages()
		    {
		        alert("<?php _e("This feature is only available in Paid Premium Version!", gallery_bank)?>");
		    }
		
		    function select_one_radio(control)
		    {
		    	var oTable = jQuery("#data-table-edit-album").dataTable();
		    	jQuery("input[type=radio][name=ux_album_cover]:checked", oTable.fnGetNodes()).each(function ()
		    	{
		    		jQuery(this).removeAttr("checked");
		    	});
		    	jQuery(control).attr("checked","checked");
		    }
		    
		    //This function is to select radio button of first image
		    function select_radio() {
		    	var oTable = jQuery("#data-table-edit-album").dataTable();
		        if ((jQuery("input[type=radio][name=ux_album_cover]:checked", oTable.fnGetNodes()).length) < 1){
		        	jQuery("input[type=radio][name=ux_album_cover]:first").attr("checked","checked");
		        }
		    }
		    function preventDot(e)
			{
			    var key = e.charCode ? e.charCode : e.keyCode;
			    if (key == 46)
			    {
			        return false;
			    }    
			}
		    </script>
		<?php
		}
	}
		?>