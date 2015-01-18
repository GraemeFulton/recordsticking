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
	?>
<form id="frm_purchase_pro" class="layout-form">
	<div id="poststuff" style="width: 99% !important;">
		<div id="post-body" class="metabox-holder">
			<div id="postbox-container-2" class="postbox-container">
				<div id="advanced" class="meta-box-sortables">
					<div id="gallery_bank_get_started" class="postbox" >
						<div class="handlediv" data-target="ux_purchase_pro" title="Click to toggle" data-toggle="collapse"><br></div>
						<h3 class="hndle"><span><?php _e("Premium Editions", gallery_bank); ?></span></h3>
						<div class="inside">
							<div id="ux_purchase_pro" class="gallery_bank_layout">
								<a class="btn btn-inverse"
								   href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
								<div class="separator-doubled"></div>
								<div class="fluid-layout">
									<div class="layout-span12">
										<h1 style="text-align: center; margin-bottom: 40px">
											<?php _e("WP Gallery Bank is an one time Investment. Its Worth it!", gallery_bank); ?>
										</h1>
										<div id="gallery_bank_pricing"
											class="p_table_responsive p_table_hide_caption_column p_table_1 p_table_1_1 css3_grid_clearfix p_table_hover_disabled" style="margin-bottom:18px;">
											<div class="caption_column column_0_responsive"
												style="width: 20%;">
												<ul>
													<li
														class="css3_grid_row_0 header_row_1 align_center css3_grid_row_0_responsive radius5_topleft"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"></span></span></li>
													<li
														class="css3_grid_row_1 header_row_2 css3_grid_row_1_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h2 class="caption">
																	choose <span>your</span> plan
																</h2></span></span></li>
													<li
														class="css3_grid_row_2 row_style_4 css3_grid_row_2_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Domains per License</span><span
																	class="css3_grid_tooltip"><span>Number of websites that can
																			use the plugin on purchase of a License.</span>Domains
																		per License</span></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_2 css3_grid_row_3_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multisite Compatibility</span><span
																	class="css3_grid_tooltip"><span>Allows you to use this Plugin with network of sites / Multisites WordPress. 
																	But you need to have separate license for each domain. </span>Multisite Compatibility</span></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_4 css3_grid_row_3_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Technical Support</span><span
																	class="css3_grid_tooltip"><span>Technical Support by the
																			Development Team for Installation, Bug Fixing, Plugin
																			Compatibility Issues.</span>Technical Support</span></span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_2 css3_grid_row_4_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Plugin Updates</span><span
																	class="css3_grid_tooltip"><span>Automatic Plugin Update
																			Notification with New Features, Bug Fixing and much more.</span>Plugin
																		Updates</span></span></span></span></li>
													<li
														class="css3_grid_row_5 row_style_4 css3_grid_row_5_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multi-Lingual</span><span
																	class="css3_grid_tooltip"><span>Multi-Lingual Facility
																			allows the plugin to be used in 36 languages.</span>Multi-Lingual</span></span></span></span></li>
													<li
														class="css3_grid_row_6 row_style_2 css3_grid_row_6_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Number of Albums</span><span
																	class="css3_grid_tooltip"><span>Number of Albums allowed to
																			be Published.</span>Number of Albums</span></span></span></span></li>
													<li
														class="css3_grid_row_7 row_style_4 css3_grid_row_7_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Images per Album</span><span
																	class="css3_grid_tooltip"><span>Number of Images per Album
																			allowed to be Published.</span>Images per Album</span></span></span></span></li>
													<li
														class="css3_grid_row_8 row_style_2 css3_grid_row_8_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Responsive Gallery</span><span
																	class="css3_grid_tooltip"><span>Optimal Viewing Experience
																			across a wide range of devices.</span>Responsive Gallery</span></span></span></span></li>
													<li
														class="css3_grid_row_9 row_style_4 css3_grid_row_9_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Shortcode Wizard</span><span
																	class="css3_grid_tooltip"><span>Shortcode Wizard to easily
																			insert albums/images to any Page/Post.</span>Shortcode
																		Wizard</span></span></span></span></li>
													<li
														class="css3_grid_row_10 row_style_2 css3_grid_row_10_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Basic Thumbnail Gallery</span><span
																	class="css3_grid_tooltip"><span>Basic Thumbnail gallery is
																			a grid of images that when clicked on, open in a pop-up
																			full view.</span>Basic Thumbnail Gallery</span></span></span></span></li>
													<li
														class="css3_grid_row_11 row_style_4 css3_grid_row_11_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Grid Album Format</span><span
																	class="css3_grid_tooltip"><span>Displays images inside of
																			the album is in a Grid Format.</span>Grid Album Format</span></span></span></span></li>
													<li
														class="css3_grid_row_12 row_style_2 css3_grid_row_12_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Compact Album</span><span
																	class="css3_grid_tooltip"><span>Each thumbnail in the
																			Compact Album links to the gallery you include in your
																			album, along with the title of the gallery with the
																			amount of images per gallery.</span>Compact Album</span></span></span></span></li>
													<li
														class="css3_grid_row_13 row_style_4 css3_grid_row_13_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Images</span><span
																	class="css3_grid_tooltip"><span>Display Gallery that when
																			clicked on, open in a popup full view.</span>Individual
																		Images</span></span></span></span></li>
													<li
														class="css3_grid_row_14 row_style_2 css3_grid_row_14_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Album</span><span
																	class="css3_grid_tooltip"><span>Thumbnail of Individual
																			Album links to a Gallery you include in your Album</span>Individual
																		Album</span></span></span></span></li>
													<li
														class="css3_grid_row_15 row_style_4 css3_grid_row_15_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Masonry Gallery Format </span><span
																	class="css3_grid_tooltip"><span>Masonry is a JavaScript
																			grid layout library. It works by placing elements in
																			optimal position based on available vertical space.</span>Masonry
																		Gallery Format </span></span></span></span></li>
													<li
														class="css3_grid_row_16 row_style_2 css3_grid_row_16_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">List Album Format</span><span
																	class="css3_grid_tooltip"><span>Vertically stacked album
																			covers with title and description.</span>List Album
																		Format</span></span></span></span></li>
													<li
														class="css3_grid_row_17 row_style_4 css3_grid_row_17_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Lightbox</span><span
																	class="css3_grid_tooltip"><span>Lightbox is a script used
																			to overlay images on the current page. It's a snap to
																			setup and works on all modern browsers.</span>Lightbox</span></span></span></span></li>
													<li
														class="css3_grid_row_18 row_style_2 css3_grid_row_18_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Extended Album</span><span
																	class="css3_grid_tooltip"><span>Extended Album displays as
																			a list, with thumbnails to the left. Alongside the right
																			of the thumbnail is the title and description of the
																			gallery and amount of images within the gallery.</span>Extended
																		Album</span></span></span></span></li>
													<li
														class="css3_grid_row_19 row_style_4 css3_grid_row_19_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Upload of Images</span><span
																	class="css3_grid_tooltip"><span>Bulk Upload of Images in
																			single time.</span>Bulk Upload of Images</span></span></span></span></li>
													<li
														class="css3_grid_row_20 row_style_2 css3_grid_row_20_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filmstrip Gallery Format</span><span
																	class="css3_grid_tooltip"><span>Cool slide-film style
																			galleries – great for displaying non-cropped thumbnails
																			in clean grids.</span>Filmstrip Gallery Format</span></span></span></span></li>
													<li
														class="css3_grid_row_21 row_style_4 css3_grid_row_21_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Blog Style Gallery Format</span><span
																	class="css3_grid_tooltip"><span>Vertically stacked,
																			thumbnails images common to photography blogs.</span>Blog
																		Style Gallery Format</span></span></span></span></li>
													<li
														class="css3_grid_row_22 row_style_2 css3_grid_row_22_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Slideshow Gallery</span><span
																	class="css3_grid_tooltip"><span>Mobile-friendly, non-flash
																			slideshows with nice transitions.</span>Slideshow Gallery</span></span></span></span></li>
													<li
														class="css3_grid_row_23 row_style_4 css3_grid_row_23_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Videos</span><span
																	class="css3_grid_tooltip"><span>You can upload video links
																			from Youtube, Vimeo and other supportive Media Sharing
																			sites.</span>Videos</span></span></span></span></li>
													<li
														class="css3_grid_row_24 row_style_2 css3_grid_row_24_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Global Settings</span><span
																	class="css3_grid_tooltip"><span>Settings for Image
																			Thumbnails, Lightbox, Albums, Layout and much more.</span>Global
																		Settings</span></span></span></span></li>
													<li
														class="css3_grid_row_25 row_style_4 css3_grid_row_25_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Custom Size Thumbnails</span><span
																	class="css3_grid_tooltip"><span>Allowed to customize
																			thumbnails with any size suitable for you. This may
																			howerver disort the image if not used with TimThumb.</span>Custom
																		Size Thumbnails</span></span></span></span></li>
													<li
														class="css3_grid_row_26 row_style_2 css3_grid_row_26_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Pagination for Images</span><span
																	class="css3_grid_tooltip"><span>Pagination allows number of
																			images allowed on a single page and provide navigation
																			for the rest.</span>Pagination for Images</span></span></span></span></li>
													<li
														class="css3_grid_row_27 row_style_4 css3_grid_row_27_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Images</span><span
																	class="css3_grid_tooltip"><span>Sorting of Images allows to
																			re-order images according to different parameters so as
																			per user choice by simply dragging and dropping it.</span>Sorting
																		of Images</span></span></span></span></li>
													<li
														class="css3_grid_row_28 row_style_2 css3_grid_row_28_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Albums</span><span
																	class="css3_grid_tooltip"><span>Sorting of Albums allows to
																			re-order images according to different parameters so as
																			per user choice by simply dragging and dropping it.</span>Sorting
																		of Albums</span></span></span></span></li>
													<li
														class="css3_grid_row_29 row_style_4 css3_grid_row_29_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Animation Effects</span><span
																	class="css3_grid_tooltip"><span>Animation Effects to
																			impliment on Thumbnails.</span>Animation Effects</span></span></span></span></li>
													<li
														class="css3_grid_row_30 row_style_2 css3_grid_row_30_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Special Effects</span><span
																	class="css3_grid_tooltip"><span>Special Effects to
																			impliment on Thumbnails.</span>Special Effects</span></span></span></span></li>
													<li
														class="css3_grid_row_31 row_style_4 css3_grid_row_31_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Restore Factory Settings</span><span
																	class="css3_grid_tooltip"><span>Restore Plugin back to
																			default settings.</span>Restore Factory Settings</span></span></span></span></li>
													<li
														class="css3_grid_row_32 row_style_2 css3_grid_row_32_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filters</span><span
																	class="css3_grid_tooltip"><span>Filters to categorize the
																			images by different names.</span>Filters</span></span></span></span></li>
													<li
														class="css3_grid_row_33 row_style_4 css3_grid_row_33_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Rotation of Thumbnails</span><span
																	class="css3_grid_tooltip"><span>With this feature you can
																			rotate images to different directions.</span>Rotation of
																		Thumbnails</span></span></span></span></li>
													<li
														class="css3_grid_row_34 row_style_2 css3_grid_row_34_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Different Lightboxes</span><span
																	class="css3_grid_tooltip"><span>You can choose Pretty
																			Photo, ColorBox, Photo Swipe, Foo Box, Fancy Box,
																			Lightbox 2, GB Lightbox for display of Images. (You need
																			to Purchase FOO BOX separately).</span>Different
																		Lightboxes</span></span></span></span></li>
													<li
														class="css3_grid_row_35 row_style_4 css3_grid_row_35_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Social Sharing</span><span
																	class="css3_grid_tooltip"><span>Social Sharing makes easy
																			to share your images across social networks with one
																			click.</span>Social Sharing</span></span></span></span></li>
													<li
														class="css3_grid_row_36 row_style_2 css3_grid_row_36_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Commenting on Images</span><span
																	class="css3_grid_tooltip"><span>Commenting on Images allows
																			your users to post comments on images.</span>Commenting
																		on Images</span></span></span></span></li>
													<li
														class="css3_grid_row_37 row_style_4 css3_grid_row_37_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Widgets</span><span
																	class="css3_grid_tooltip"><span>Widgets allows albums and
																			images to be shown in your sidebar, footer, header etc.</span>Widgets</span></span></span></span></li>
													<li
														class="css3_grid_row_38 row_style_2 css3_grid_row_38_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Deletion</span><span
																	class="css3_grid_tooltip"><span>It allows to delete bulk
																			deletion of images and albums on a single click.</span>Bulk
																		Deletion</span></span></span></span></li>
													<li
														class="css3_grid_row_39 row_style_4 css3_grid_row_39_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Purging of Albums</span><span
																	class="css3_grid_tooltip"><span>Purging of albums is used
																			to hard delete the images and thumbnails from the server
																			which are not used anymore.</span>Purging of Albums</span></span></span></span></li>
													<li
														class="css3_grid_row_40 footer_row css3_grid_row_40_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"></span></span></li>
												</ul>
											</div>
											<div class="column_1 column_1_responsive" style="width: 16%;">
												<div class="column_ribbon ribbon_style2_free"></div>
												<ul>
													<li
														class="css3_grid_row_0 header_row_1 align_center css3_grid_row_0_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h2 class="col1">Lite</h2></span></span></li>
													<li
														class="css3_grid_row_1 header_row_2 css3_grid_row_1_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h1 class="col1">FREE</h1></span></span></li>
													<li
														class="css3_grid_row_2 row_style_3 css3_grid_row_2_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Domains per License</span>1</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_1 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multisite Compatibility</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_3 css3_grid_row_3_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Technical Support</span>None</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_1 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Plugin Updates</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_5 row_style_3 css3_grid_row_5_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multi-Lingual</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_6 row_style_1 css3_grid_row_6_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Number of Albums</span>3</span></span></span></li>
													<li
														class="css3_grid_row_7 row_style_3 css3_grid_row_7_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Images per Album</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_8 row_style_1 css3_grid_row_8_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Responsive Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_9 row_style_3 css3_grid_row_9_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Shortcode Wizard</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_10 row_style_1 css3_grid_row_10_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Basic Thumbnail Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_11 row_style_3 css3_grid_row_11_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Grid Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_12 row_style_1 css3_grid_row_12_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Compact Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_13 row_style_3 css3_grid_row_13_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_14 row_style_1 css3_grid_row_14_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_15 row_style_3 css3_grid_row_15_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Masonry Gallery Format </span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_16 row_style_1 css3_grid_row_16_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">List Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_17 row_style_3 css3_grid_row_17_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Lightbox</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_18 row_style_1 css3_grid_row_18_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Extended Album</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_19 row_style_3 css3_grid_row_19_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Upload of Images</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_20 row_style_1 css3_grid_row_20_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filmstrip Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_21 row_style_3 css3_grid_row_21_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Blog Style Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_22 row_style_1 css3_grid_row_22_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Slideshow Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_23 row_style_3 css3_grid_row_23_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Videos</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_24 row_style_1 css3_grid_row_24_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Global Settings</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_25 row_style_3 css3_grid_row_25_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Custom Size Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_26 row_style_1 css3_grid_row_26_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Pagination for Images</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_27 row_style_3 css3_grid_row_27_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Images</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_28 row_style_1 css3_grid_row_28_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_29 row_style_3 css3_grid_row_29_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Animation Effects</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_30 row_style_1 css3_grid_row_30_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Special Effects</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_31 row_style_3 css3_grid_row_31_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Restore Factory Settings</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_32 row_style_1 css3_grid_row_32_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filters</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_33 row_style_3 css3_grid_row_33_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Rotation of Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_34 row_style_1 css3_grid_row_34_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Different Lightboxes</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_35 row_style_3 css3_grid_row_35_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Social Sharing</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_36 row_style_1 css3_grid_row_36_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Commenting on Images</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_37 row_style_3 css3_grid_row_37_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Widgets</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_38 row_style_1 css3_grid_row_38_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Deletion</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_39 row_style_3 css3_grid_row_39_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Purging of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_40 footer_row css3_grid_row_40_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><a target="_blank" 
																href="https://wordpress.org/plugins/gallery-bank/"
																class="sign_up sign_up_orange radius3">Download!</a></span></span></li>
												</ul>
											</div>
											<div class="column_2 column_2_responsive" style="width: 16%;">
												<div class="column_ribbon ribbon_style2_heart"></div>
												<ul>
													<li
														class="css3_grid_row_0 header_row_1 align_center css3_grid_row_0_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h2 class="col1">Eco</h2></span></span></li>
													<li
														class="css3_grid_row_1 header_row_2 css3_grid_row_1_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span
																class="css3_grid_tooltip"><span>You just need to pay for
																		once for life time.</span>
																<h1 class="col1">
																		&euro;<span>15</span>
																	</h1>
																	<h3 class="col1">one time</h3></span></span></span></li>
													<li
														class="css3_grid_row_2 row_style_4 css3_grid_row_2_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Domains per License</span>1</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_2 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multisite Compatibility</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_4 css3_grid_row_3_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Technical Support</span>1 Week</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_2 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Plugin Updates</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_5 row_style_4 css3_grid_row_5_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multi-Lingual</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_6 row_style_2 css3_grid_row_6_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Number of Albums</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_7 row_style_4 css3_grid_row_7_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Images per Album</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_8 row_style_2 css3_grid_row_8_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Responsive Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_9 row_style_4 css3_grid_row_9_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Shortcode Wizard</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_10 row_style_2 css3_grid_row_10_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Basic Thumbnail Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_11 row_style_4 css3_grid_row_11_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Grid Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_12 row_style_2 css3_grid_row_12_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Compact Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_13 row_style_4 css3_grid_row_13_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_14 row_style_2 css3_grid_row_14_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_15 row_style_4 css3_grid_row_15_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Masonry Gallery Format </span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_16 row_style_2 css3_grid_row_16_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">List Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_17 row_style_4 css3_grid_row_17_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Lightbox</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_18 row_style_2 css3_grid_row_18_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Extended Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_19 row_style_4 css3_grid_row_19_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Upload of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_20 row_style_2 css3_grid_row_20_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filmstrip Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_21 row_style_4 css3_grid_row_21_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Blog Style Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_22 row_style_2 css3_grid_row_22_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Slideshow Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_23 row_style_4 css3_grid_row_23_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Videos</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_24 row_style_2 css3_grid_row_24_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Global Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_25 row_style_4 css3_grid_row_25_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Custom Size Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_26 row_style_2 css3_grid_row_26_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Pagination for Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_27 row_style_4 css3_grid_row_27_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_28 row_style_2 css3_grid_row_28_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_29 row_style_4 css3_grid_row_29_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Animation Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_30 row_style_2 css3_grid_row_30_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Special Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_31 row_style_4 css3_grid_row_31_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Restore Factory Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_32 row_style_2 css3_grid_row_32_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filters</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_33 row_style_4 css3_grid_row_33_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Rotation of Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_34 row_style_2 css3_grid_row_34_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Different Lightboxes</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_35 row_style_4 css3_grid_row_35_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Social Sharing</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_36 row_style_2 css3_grid_row_36_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Commenting on Images</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_37 row_style_4 css3_grid_row_37_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Widgets</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_38 row_style_2 css3_grid_row_38_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Deletion</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_39 row_style_4 css3_grid_row_39_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Purging of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/cross_04.png" , dirname(__FILE__)); ?>"
																	alt="no"></span></span></span></li>
													<li
														class="css3_grid_row_40 footer_row css3_grid_row_40_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><a target="_blank" 
																href="http://tech-banker.com/shop/wp-gallery-bank/gallery-bank-eco-edition/"
																class="sign_up sign_up_orange radius3">Order Now!</a></span></span></li>
												</ul>
											</div>
											<div class="column_3 column_3_responsive" style="width: 16%;">
												<div class="column_ribbon ribbon_style2_best"></div>
												<ul>
													<li
														class="css3_grid_row_0 header_row_1 align_center css3_grid_row_0_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h2 class="col2">Pro</h2></span></span></li>
													<li
														class="css3_grid_row_1 header_row_2 css3_grid_row_1_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span
																class="css3_grid_tooltip"><span>You just need to pay for
																		once for life time.</span>
																<h1 class="col1">
																		&euro;<span>25</span>
																	</h1>
																	<h3 class="col1">one time</h3></span></span></span></li>
													<li
														class="css3_grid_row_2 row_style_3 css3_grid_row_2_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Domains per License</span>1</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_1 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multisite Compatibility</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_3 css3_grid_row_3_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Technical Support</span>1 Month</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_1 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Plugin Updates</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_5 row_style_3 css3_grid_row_5_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multi-Lingual</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_6 row_style_1 css3_grid_row_6_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Number of Albums</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_7 row_style_3 css3_grid_row_7_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Images per Album</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_8 row_style_1 css3_grid_row_8_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Responsive Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_9 row_style_3 css3_grid_row_9_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Shortcode Wizard</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_10 row_style_1 css3_grid_row_10_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Basic Thumbnail Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_11 row_style_3 css3_grid_row_11_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Grid Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_12 row_style_1 css3_grid_row_12_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Compact Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_13 row_style_3 css3_grid_row_13_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_14 row_style_1 css3_grid_row_14_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_15 row_style_3 css3_grid_row_15_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Masonry Gallery Format </span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_16 row_style_1 css3_grid_row_16_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">List Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_17 row_style_3 css3_grid_row_17_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Lightbox</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_18 row_style_1 css3_grid_row_18_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Extended Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_19 row_style_3 css3_grid_row_19_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Upload of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_20 row_style_1 css3_grid_row_20_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filmstrip Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_21 row_style_3 css3_grid_row_21_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Blog Style Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_22 row_style_1 css3_grid_row_22_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Slideshow Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_23 row_style_3 css3_grid_row_23_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Videos</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_24 row_style_1 css3_grid_row_24_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Global Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_25 row_style_3 css3_grid_row_25_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Custom Size Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_26 row_style_1 css3_grid_row_26_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Pagination for Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_27 row_style_3 css3_grid_row_27_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_28 row_style_1 css3_grid_row_28_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_29 row_style_3 css3_grid_row_29_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Animation Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_30 row_style_1 css3_grid_row_30_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Special Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_31 row_style_3 css3_grid_row_31_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Restore Factory Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_32 row_style_1 css3_grid_row_32_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filters</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_33 row_style_3 css3_grid_row_33_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Rotation of Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_34 row_style_1 css3_grid_row_34_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Different Lightboxes</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_35 row_style_3 css3_grid_row_35_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Social Sharing</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_36 row_style_1 css3_grid_row_36_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Commenting on Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_37 row_style_3 css3_grid_row_37_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Widgets</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_38 row_style_1 css3_grid_row_38_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Deletion</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_39 row_style_3 css3_grid_row_39_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Purging of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_40 footer_row css3_grid_row_40_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><a target="_blank"
																href="http://tech-banker.com/shop/wp-gallery-bank/gallery-bank-pro-edition/"
																class="sign_up sign_up_orange radius3">Order Now!</a></span></span></li>
												</ul>
											</div>
											<div class="column_4 column_4_responsive" style="width: 16%;">
												<div class="column_ribbon ribbon_style2_hot"></div>
												<ul>
													<li
														class="css3_grid_row_0 header_row_1 align_center css3_grid_row_0_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h2 class="col1">Developer</h2></span></span></li>
													<li
														class="css3_grid_row_1 header_row_2 css3_grid_row_1_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span
																class="css3_grid_tooltip"><span>You just need to pay for
																		once for life time.</span>
																<h1 class="col1">
																		&euro;<span>88</span>
																	</h1>
																	<h3 class="col1">one time</h3></span></span></span></li>
													<li
														class="css3_grid_row_2 row_style_4 css3_grid_row_2_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Domains per License</span>5</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_2 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multisite Compatibility</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_4 css3_grid_row_3_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Technical Support</span>1 Year</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_2 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Plugin Updates</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_5 row_style_4 css3_grid_row_5_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multi-Lingual</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_6 row_style_2 css3_grid_row_6_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Number of Albums</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_7 row_style_4 css3_grid_row_7_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Images per Album</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_8 row_style_2 css3_grid_row_8_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Responsive Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_9 row_style_4 css3_grid_row_9_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Shortcode Wizard</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_10 row_style_2 css3_grid_row_10_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Basic Thumbnail Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_11 row_style_4 css3_grid_row_11_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Grid Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_12 row_style_2 css3_grid_row_12_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Compact Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_13 row_style_4 css3_grid_row_13_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_14 row_style_2 css3_grid_row_14_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_15 row_style_4 css3_grid_row_15_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Masonry Gallery Format </span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_16 row_style_2 css3_grid_row_16_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">List Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_17 row_style_4 css3_grid_row_17_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Lightbox</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_18 row_style_2 css3_grid_row_18_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Extended Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_19 row_style_4 css3_grid_row_19_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Upload of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_20 row_style_2 css3_grid_row_20_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filmstrip Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_21 row_style_4 css3_grid_row_21_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Blog Style Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_22 row_style_2 css3_grid_row_22_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Slideshow Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_23 row_style_4 css3_grid_row_23_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Videos</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_24 row_style_2 css3_grid_row_24_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Global Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_25 row_style_4 css3_grid_row_25_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Custom Size Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_26 row_style_2 css3_grid_row_26_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Pagination for Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_27 row_style_4 css3_grid_row_27_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_28 row_style_2 css3_grid_row_28_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_29 row_style_4 css3_grid_row_29_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Animation Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_30 row_style_2 css3_grid_row_30_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Special Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_31 row_style_4 css3_grid_row_31_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Restore Factory Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_32 row_style_2 css3_grid_row_32_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filters</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_33 row_style_4 css3_grid_row_33_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Rotation of Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_34 row_style_2 css3_grid_row_34_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Different Lightboxes</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_35 row_style_4 css3_grid_row_35_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Social Sharing</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_36 row_style_2 css3_grid_row_36_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Commenting on Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_37 row_style_4 css3_grid_row_37_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Widgets</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_38 row_style_2 css3_grid_row_38_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Deletion</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_39 row_style_4 css3_grid_row_39_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Purging of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_40 footer_row css3_grid_row_40_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><a target="_blank" 
																href="http://tech-banker.com/shop/wp-gallery-bank/gallery-bank-developer-edition/"
																class="sign_up sign_up_orange radius3">Order Now!</a></span></span></li>
												</ul>
											</div>
											<div class="column_1 column_5_responsive" style="width: 16%;">
												<div class="column_ribbon ribbon_style2_save"></div>
												<ul>
													<li
														class="css3_grid_row_0 header_row_1 align_center css3_grid_row_0_responsive radius5_topright"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><h2 class="col1">Extended</h2></span></span></li>
													<li
														class="css3_grid_row_1 header_row_2 css3_grid_row_1_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span
																class="css3_grid_tooltip"><span>You just need to pay for
																		once for life time.</span>
																<h1 class="col1">
																		&euro;<span>769</span>
																	</h1>
																	<h3 class="col1">one time</h3></span></span></span></li>
													<li
														class="css3_grid_row_2 row_style_3 css3_grid_row_2_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Domains per License</span>50</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_1 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multisite Compatibility</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_3 row_style_3 css3_grid_row_3_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Technical Support</span>1 Year</span></span></span></li>
													<li
														class="css3_grid_row_4 row_style_1 css3_grid_row_4_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Plugin Updates</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_5 row_style_3 css3_grid_row_5_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Multi-Lingual</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_6 row_style_1 css3_grid_row_6_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Number of Albums</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_7 row_style_3 css3_grid_row_7_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Images per Album</span>Unlimited</span></span></span></li>
													<li
														class="css3_grid_row_8 row_style_1 css3_grid_row_8_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Responsive Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_9 row_style_3 css3_grid_row_9_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Shortcode Wizard</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_10 row_style_1 css3_grid_row_10_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Basic Thumbnail Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_11 row_style_3 css3_grid_row_11_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Grid Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_12 row_style_1 css3_grid_row_12_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Compact Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_13 row_style_3 css3_grid_row_13_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_14 row_style_1 css3_grid_row_14_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Individual Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_15 row_style_3 css3_grid_row_15_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Masonry Gallery Format </span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_16 row_style_1 css3_grid_row_16_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">List Album Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_17 row_style_3 css3_grid_row_17_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Lightbox</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_18 row_style_1 css3_grid_row_18_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Extended Album</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_19 row_style_3 css3_grid_row_19_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Upload of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_20 row_style_1 css3_grid_row_20_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filmstrip Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_21 row_style_3 css3_grid_row_21_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Blog Style Gallery Format</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_22 row_style_1 css3_grid_row_22_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Slideshow Gallery</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_23 row_style_3 css3_grid_row_23_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Videos</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_24 row_style_1 css3_grid_row_24_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Global Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_25 row_style_3 css3_grid_row_25_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Custom Size Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_26 row_style_1 css3_grid_row_26_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Pagination for Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_27 row_style_3 css3_grid_row_27_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_28 row_style_1 css3_grid_row_28_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Sorting of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_29 row_style_3 css3_grid_row_29_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Animation Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_30 row_style_1 css3_grid_row_30_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Special Effects</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_31 row_style_3 css3_grid_row_31_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Restore Factory Settings</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_32 row_style_1 css3_grid_row_32_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Filters</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_33 row_style_3 css3_grid_row_33_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Rotation of Thumbnails</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_34 row_style_1 css3_grid_row_34_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Different Lightboxes</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_35 row_style_3 css3_grid_row_35_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Social Sharing</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_36 row_style_1 css3_grid_row_36_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Commenting on Images</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_37 row_style_3 css3_grid_row_37_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Widgets</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_38 row_style_1 css3_grid_row_38_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Bulk Deletion</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_39 row_style_3 css3_grid_row_39_responsive align_center"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><span><span
																	class="css3_hidden_caption">Purging of Albums</span><img
																	src="<?php echo plugins_url("/assets/img/tick_10.png" , dirname(__FILE__)); ?>"
																	alt="yes"></span></span></span></li>
													<li
														class="css3_grid_row_40 footer_row css3_grid_row_40_responsive"><span
														class="css3_grid_vertical_align_table"><span
															class="css3_grid_vertical_align"><a target="_blank" 
																href="http://tech-banker.com/shop/wp-gallery-bank/gallery-bank-extended-edition/"
																class="sign_up sign_up_orange radius3">Order Now!</a></span></span></li>
												</ul>
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