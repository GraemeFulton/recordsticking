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
	<form id="shortcode" class="layout-form">
		<div id="poststuff" style="width: 99% !important;">
			<div id="post-body" class="metabox-holder">
				<div id="postbox-container-2" class="postbox-container">
					<div id="advanced" class="meta-box-sortables">
						<div id="gallery_bank_get_started" class="postbox" >
							<div class="handlediv" data-target="#ux_shortcode" title="Click to toggle" data-toggle="collapse"><br></div>
							<h3 class="hndle"><span><?php _e("Gallery Bank Short-Codes", gallery_bank); ?></span></h3>
							<div class="inside">
								<div id="ux_shortcode" class="gallery_bank_layout">
									<a class="btn btn-inverse"
									   href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
									<div class="separator-doubled"></div>
									<div class="fluid-layout">
										<div class="layout-span12">
										    <div class="widget-layout">
										        <div class="widget-layout-body">
										        	<img src="<?php echo plugins_url("/assets/images/how-to-setup-short-code.png",dirname(__FILE__));?>" />
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
