<div id="my-gallery-content-id" style="display:none;">
	<div class="fluid-layout responsive">
		<div style="padding:0 15px;">
			<h3 class="gallery-shortcode-label"><?php _e("Insert Gallery Bank Shortcode", gallery_bank); ?></h3>
			<span>
				<?php _e("Select an album below to add it to your post or page.", gallery_bank); ?>
			</span>
		</div>
		<div class="layout-span12" style="padding:15px 15px 0 0;">
			<div class="layout-control-group">
			    <label class="custom-layout-label" for="ux_gallery"><?php _e("Gallery Type", gallery_bank); ?> : </label>
			    <input type="radio" name="ux_gallery" value="1" onclick="check_gallery_type();"/>
			    <label><?php _e("Albums with Images", gallery_bank); ?></label>
			    <input type="radio" style="margin-left: 10px;" checked="checked" name="ux_gallery" value="0"
			      onclick="check_gallery_type();"/> <label><?php _e("Only Images", gallery_bank); ?> </label>
			</div>
			<div class="layout-control-group" id="album_format" style="display: none;">
			    <label class="custom-layout-label" for="ux_album_format"><?php _e("Album Format", gallery_bank); ?> : </label>
			    <select id="ux_album_format" class="layout-span9" onclick="check_gallery_type();" onchange="select_album();">
			        <option value=""> <?php _e("Select Album Format", gallery_bank); ?>  </option>
			        <option value="grid">Grid Albums</option>
			        <option value="list">List Albums</option>
			        <option value="individual">Individual Album</option>
			    </select>
			</div>
			<div class="layout-control-group" id="ux_select_album" style="display: block;">
			    <label class="custom-layout-label"><?php _e("Select Album", gallery_bank); ?> : </label>
			    <select id="add_album_id" class="layout-span9">
			        <option value=""> <?php _e("Select an Album", gallery_bank); ?>  </option>
			        <?php
			       global $wpdb,$current_user;
			        
			        $gb_role = $wpdb->prefix . "capabilities";
			        $current_user->role = array_keys($current_user->$gb_role);
			        $gb_role = $current_user->role[0];
			        if($gb_role == "administrator")
			        {
			        	$albums = $wpdb->get_results
			        	(
			        		"SELECT * FROM ".gallery_bank_albums()." order by album_order asc "
			        	);
			        }
			        else 
			        {
			        	$albums = $wpdb->get_results
			        	(
		        			$wpdb->prepare
		        			(
	        					"SELECT * FROM ".gallery_bank_albums()." where author = %s order by album_order asc ",
	        					$current_user->display_name
		        			)
			        	);
			        }
			        for ($flag = 0; $flag < count($albums); $flag++) {
			            ?>
			            <option value="<?php echo intval($albums[$flag]->album_id); ?>"><?php echo esc_html($albums[$flag]->album_name) ?></option>
			        <?php
			        }
			        ?>
			    </select>
			</div>
			<div class="layout-control-group">
			    <label class="custom-layout-label"><?php _e("Gallery Format", gallery_bank); ?> : </label>
			    <select id="ux_gallery_format" class="layout-span9" onchange="select_images_in_row();">
			        <option value=""> <?php _e("Select Gallery Format ", gallery_bank); ?>  </option>
			        <option value="masonry">Masonry Gallery</option>
			        <option value="filmstrip" disabled="disabled" style="color: #FF0000;">Filmstrip Gallery (Available only in Premium Versions)</option>
			        <option value="blog" disabled="disabled" style="color: #FF0000;">Blog Style Gallery (Available only in Premium Versions)</option>
			        <option id="slide_show" disabled="disabled" value="slideshow" style="color: #FF0000;">Slideshow Gallery (Available only in Premium Versions)</option>
			        <option value="thumbnail">Thumbnail Gallery</option>
			    </select>
			</div>
			<div class="layout-control-group" id="div_img_in_row" style="display: none;">
			    <label class="custom-layout-label"><?php _e("Images in Row", gallery_bank); ?> : </label>
			    <input type="text" class="layout-span9" name="ux_img_in_row" id="ux_img_in_row"
			      onkeyup="set_text_value(\"img_in_row\");" onkeypress="return OnlyNumbers(event);" value="3"/>
			</div>
			<div class="layout-control-group" id="div_img_width" style="display: none;">
			    <label class="custom-layout-label"><?php _e("Image Width", gallery_bank); ?> : </label>
			    <input readonly="readonly" type="text" class="layout-span9" name="ux_img_width" id="ux_img_width" onkeypress="return OnlyNumbers(event);"
			           value="600"/>
			           <label class="custom-layout-label"></label>
			    <i class="widget_premium_feature">(Available only in Premium Versions)</i>
			</div>
			<div class="layout-control-group" id="div_albums_in_row" style="display: none;">
			    <label class="custom-layout-label"><?php _e("Albums in Row", gallery_bank); ?> : </label>
			    <input type="text" class="layout-span9" name="ux_album_in_row" id="ux_album_in_row"
			           onkeyup="set_text_value(\"album_in_row\");" onkeypress="return OnlyNumbers(event);" value="3"/>
			</div>
			<div class="layout-control-group" id="gb_gallery_format">
			    <label class="custom-layout-label"><?php _e("Text Format", gallery_bank); ?> : </label>
			    <select id="ux_text_format" class="layout-span9" onchange="show_special_effect();">
			        <option value=""><?php _e("Select Format ", gallery_bank); ?></option>
			        <option value="title_only">With Title only</option>
			        <option value="title_desc">With Title and Description</option>
			        <option value="no_text">Without Title and Description</option>
			    </select>
			</div>
			<div class="layout-control-group" id="div_special_effects" >
			    <label class="custom-layout-label"><?php _e("Special Effects", gallery_bank); ?> : </label>
			    <select id="ux_special_effects" class="layout-span9" onchange="effects_settings();" disabled= "disabled">
			        <option value="blur">Blur</option>
			        <option id="option_cornor_ribbons" value="corner_ribbons">Corner Ribbons</option>
			        <option value="grayscale">Grayscale</option>
			        <option id="option_hover_rotation" value="hover_rotation">Hover Rotation</option>
			        <option id="option_levitation_shadow" value="levitation_shadow">Levitation Shadow</option>
			        <option id="option_lomo_effect" value="lomo_effect">Lomo Effect</option>
			        <option id="option_overlay_fade" value="overlay_fade" selected="selected">Overlay Fade</option>
			        <option id="option_overlay_join" value="overlay_join">Overlay Join</option>
			        <option id="option_overlay_slide" value="overlay_slide">Overlay Slide</option>
			        <option id="option_overlay_split" value="overlay_split">Overlay Split</option>
			        <option id="option_perspective_images" value="perspective_images">Perspective Images</option>
			        <option id="option_pulse" value="pulse">Pulse</option>
			        <option id="option_rounded_images" value="rounded_images">Rounded Images</option>
			        <option value="sepia">Sepia</option>
			        <option value="none">None</option>
			    </select>
			    <label class="custom-layout-label"></label>
			    <i class="widget_premium_feature">(Available only in Premium Versions)</i>
			</div>
			<div class="layout-control-group" id="div_animation_effects">
			    <label class="custom-layout-label"><?php _e("Animation Effects", gallery_bank); ?> : </label>
			    <select id="ux_animation_effects" class="layout-span9" disabled= "disabled">
			        <optgroup label="Attention Seekers">
			            <option value="bounce">Bounce</option>
			            <option value="flash">Flash</option>
			            <option value="pulse">Pulse</option>
			            <option value="shake">Shake</option>
			            <option value="swing">Swing</option>
			            <option value="tada">Tada</option>
			            <option value="wobble">Wobble</option>
			            <option value="lightSpeedIn">Light Speed-In</option>
			            <option value="rollIn">Roll-In</option>
			        </optgroup>
			        <optgroup label="Bouncing Entrances">
			            <option value="bounceIn">Bounce-In</option>
			            <option value="bounceInDown">Bounce-In Down</option>
			            <option value="bounceInLeft">Bounce-In Left</option>
			            <option value="bounceInRight">Bounce-In Right</option>
			            <option value="bounceInUp">Bounce-In Up</option>
			        </optgroup>
			        <optgroup label="Fading Entrances">
			            <option value="fadeIn">Fade-In</option>
			            <option value="fadeInDown">Fade-In Down</option>
			            <option value="fadeInDownBig">Fade-In Down (Big)</option>
			            <option value="fadeInLeft">Fade-In Left</option>
			            <option value="fadeInLeftBig">Fade-In Left (Big)</option>
			            <option value="fadeInRight">Fade-In Right</option>
			            <option value="fadeInRightBig">Fade-In Right (Big)</option>
			            <option value="fadeInUp">Fade-In Up</option>
			            <option value="fadeInUpBig">Fade-In Up (Big)</option>
			        </optgroup>
			        <optgroup label="Flippers">
			            <option value="flip">Flip</option>
			            <option value="flipInX">Flip-In X</option>
			            <option value="flipInY">Flip-In Y</option>
			        </optgroup>
			        <optgroup label="Rotating Entrances">
			            <option value="rotateIn">Rotate-In</option>
			            <option value="rotateInDownLeft">Rotate-In Down Left</option>
			            <option value="rotateInDownRight">Rotate-In Down Right</option>
			            <option value="rotateInUpLeft">Rotate-In Up Left</option>
			            <option value="rotateInUpRight">Rotate-In Up Right</option>
			        </optgroup>
			        <optgroup label="Sliders">
			            <option value="slideInDown">Slide-In Down</option>
			            <option value="slideInLeft">Slide-In Left</option>
			            <option value="slideInRight">Slide-In Right</option>
			        </optgroup>
			    </select>
			    <label class="custom-layout-label"></label>
			    <i class="widget_premium_feature">(Available only in Premium Versions)</i>
			</div>
			<div class="layout-control-group">
			    <label class="custom-layout-label"><?php _e("Show Responsive Gallery", gallery_bank); ?> : </label>
			    <input type="checkbox" checked="checked" onclick="show_images_in_row();" name="ux_responsive_gallery" id="ux_responsive_gallery"/>
			</div>
			<div class="layout-control-group">
			    <label class="custom-layout-label"><?php _e("Show Album Title", gallery_bank); ?> : </label>
			    <input type="checkbox" checked="checked" name="ux_album_title" id="ux_album_title"/>
			</div>
			<div class="layout-control-group">
			    <label class="custom-layout-label"></label>
			    <input type="button" class="button-primary" value="<?php _e("Insert Album", gallery_bank); ?>"
			           onclick="InsertGallery();"/>&nbsp;&nbsp;&nbsp;
			    <a class="button" style="color:#bbb;" href="#"
			       onclick="tb_remove(); return false;"><?php _e("Cancel", gallery_bank); ?></a>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function () {
    check_gallery_type();
    select_images_in_row();
    effects_settings();
    show_special_effect();
    show_images_in_row();
});
function show_images_in_row()
{
	var responsive = jQuery("#ux_responsive_gallery").prop("checked");
	var gallery_format = jQuery("#ux_gallery_format").val();
	if(responsive == true && (gallery_format == "thumbnail" || gallery_format == "masonry" || gallery_format == "slideshow" ))
	{
		jQuery("#div_img_in_row").css("display","none");
	}
	else if(gallery_format != "blog" && gallery_format != "slideshow")
	{
		jQuery("#div_img_in_row").css("display","block");
	}
}
function select_images_in_row() {
    var gallery_format = jQuery("#ux_gallery_format").val();
    switch(gallery_format)
    {
    	case "thumbnail":
	    	jQuery("#div_img_in_row").css("display", "block");
	        jQuery("#gb_gallery_format").css("display", "block");
	        jQuery("#div_img_width").css("display", "none");
	        jQuery("#div_special_effects").css("display", "block");
	        jQuery("#div_animation_effects").css("display", "block");
	        jQuery("#option_cornor_ribbons").css("display", "block");
	        jQuery("#option_hover_rotation").css("display", "block");
	        jQuery("#option_levitation_shadow").css("display", "block");
	        jQuery("#option_lomo_effect").css("display", "block");
	        jQuery("#option_overlay_fade").css("display", "block");
	        jQuery("#option_overlay_join").css("display", "block");
	        jQuery("#option_overlay_slide").css("display", "block");
	        jQuery("#option_overlay_split").css("display", "block");
	        jQuery("#option_perspective_images").css("display", "block");
	        jQuery("#option_rounded_images").css("display", "block");
	        jQuery("#option_pulse").css("display", "block");
	    break;
	    case "filmstrip":
	    	jQuery("#div_img_in_row").css("display", "block");
	        jQuery("#gb_gallery_format").css("display", "block");
	        jQuery("#div_img_width").css("display", "block");
	        jQuery("#div_special_effects").css("display", "none");
	        jQuery("#div_animation_effects").css("display", "block");
	    break;
	    case "masonry":
	    	jQuery("#div_img_in_row").css("display", "block");
	        jQuery("#gb_gallery_format").css("display", "block");
	        jQuery("#div_img_width").css("display", "none");
	        jQuery("#div_special_effects").css("display", "block");
	        jQuery("#div_animation_effects").css("display", "block");
	        jQuery("#ux_special_effects").val("grayscale");
	        jQuery("#option_cornor_ribbons").css("display", "none");
	        jQuery("#option_hover_rotation").css("display", "none");
	        jQuery("#option_levitation_shadow").css("display", "none");
	        jQuery("#option_lomo_effect").css("display", "none");
	        jQuery("#option_overlay_fade").css("display", "none");
	        jQuery("#option_overlay_join").css("display", "none");
	        jQuery("#option_overlay_slide").css("display", "none");
	        jQuery("#option_overlay_split").css("display", "none");
	        jQuery("#option_perspective_images").css("display", "none");
	        jQuery("#option_rounded_images").css("display", "none");
	        jQuery("#option_pulse").css("display", "none");
	    break;
	    case "slideshow":
	    	jQuery("#gb_gallery_format").css("display", "block");
	        jQuery("#div_img_in_row").css("display", "none");
	        jQuery("#div_img_width").css("display", "none");
	        jQuery("#div_special_effects").css("display", "none");
	        jQuery("#div_animation_effects").css("display", "none");
	    break;
	    case "blog":
	    	jQuery("#gb_gallery_format").css("display", "block");
	        jQuery("#div_img_in_row").css("display", "none");
	        jQuery("#div_img_width").css("display", "none");
	        jQuery("#div_special_effects").css("display", "block");
	        jQuery("#div_animation_effects").css("display", "block");
	        jQuery("#ux_special_effects").val("grayscale");
	        jQuery("#option_cornor_ribbons").css("display", "none");
	        jQuery("#option_hover_rotation").css("display", "none");
	        jQuery("#option_levitation_shadow").css("display", "none");
	        jQuery("#option_lomo_effect").css("display", "none");
	        jQuery("#option_overlay_fade").css("display", "none");
	        jQuery("#option_overlay_join").css("display", "none");
	        jQuery("#option_overlay_slide").css("display", "none");
	        jQuery("#option_overlay_split").css("display", "none");
	        jQuery("#option_perspective_images").css("display", "none");
	        jQuery("#option_rounded_images").css("display", "none");
	        jQuery("#option_pulse").css("display", "none");
	    break;
	    default:
	    	jQuery("#gb_gallery_format").css("display", "block");
	        jQuery("#div_img_in_row").css("display", "none");
	        jQuery("#div_img_width").css("display", "none");
	        jQuery("#div_special_effects").css("display", "block");
	        jQuery("#div_animation_effects").css("display", "block");
	        jQuery("#option_cornor_ribbons").css("display", "block");
	        jQuery("#option_hover_rotation").css("display", "block");
	        jQuery("#option_levitation_shadow").css("display", "block");
	        jQuery("#option_lomo_effect").css("display", "block");
	        jQuery("#option_overlay_fade").css("display", "block");
	        jQuery("#option_overlay_join").css("display", "block");
	        jQuery("#option_overlay_slide").css("display", "block");
	        jQuery("#option_overlay_split").css("display", "block");
	        jQuery("#option_perspective_images").css("display", "block");
	        jQuery("#option_rounded_images").css("display", "block");
	        jQuery("#option_pulse").css("display", "block");
	    break;
    }
    show_images_in_row();
}
function effects_settings() {
    var special_effects = jQuery("#ux_special_effects").val();
    switch (special_effects) {
        case "hover_rotation":
            jQuery("#rotation_setting").css("display", "block");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "overlay_fade":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "block");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "overlay_slide":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "block");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "overlay_split":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "block");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "overlay_join":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "block");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "corner_ribbons":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "block");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "levitation_shadow":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "block");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "lomo_effect":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "block");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        case "rounded_images":
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "block");
            break;
        case "perspective_images":
            jQuery("#rotation_setting").css("display", "block");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
        default:
            jQuery("#rotation_setting").css("display", "none");
            jQuery("#overlay_color").css("display", "none");
            jQuery("#overlay_color_with_direction").css("display", "none");
            jQuery("#ribbon_color_with_direction").css("display", "none");
            jQuery("#levitation_shadow_div").css("display", "none");
            jQuery("#lomo_effect_div").css("display", "none");
            jQuery("#rounded_images_div").css("display", "none");
            break;
    }
}
function show_special_effect() {
    var text_format = jQuery("#ux_text_format").val();
    var gallery_format = jQuery("#ux_gallery_format").val();
    if (text_format == "no_text" && (gallery_format != "slideshow" && gallery_format != "filmstrip" )) {
        jQuery("#div_special_effects").css("display", "block");
        effects_settings();
    }
    else if(gallery_format == "blog")
    {
    	jQuery("#div_special_effects").css("display", "block");
    }
    else {
        jQuery("#div_special_effects").css("display", "none");
        jQuery("#rotation_setting").css("display", "none");
        jQuery("#overlay_color").css("display", "none");
        jQuery("#overlay_color_with_direction").css("display", "none");
        jQuery("#ribbon_color_with_direction").css("display", "none");
        jQuery("#levitation_shadow_div").css("display", "none");
        jQuery("#lomo_effect_div").css("display", "none");
        jQuery("#rounded_images_div").css("display", "none");
    }
}
function check_gallery_type() {
    var gallery_type = jQuery("input:radio[name=ux_gallery]:checked").val();
    var album_format = jQuery("#ux_album_format").val();
    if (gallery_type == 0) {
        jQuery("#album_format").css("display", "none");
        jQuery("#div_albums_in_row").css("display", "none");
        jQuery("#ux_select_album").css("display", "block");
        jQuery("#slide_show").css("display", "none");
    }
    else {
        jQuery("#album_format").css("display", "block");
        if (album_format != "individual") {
            jQuery("#ux_select_album").css("display", "none");
            if (album_format == "grid") {
                jQuery("#div_albums_in_row").css("display", "block");
                jQuery("#slide_show").css("display", "block");
            }
            else {
                jQuery("#div_albums_in_row").css("display", "none");
                jQuery("#slide_show").css("display", "block");
            }
        }
        else {
            jQuery("#div_albums_in_row").css("display", "none");
            jQuery("#slide_show").css("display", "block");
        }
    }
}
function select_album() {
    var album_format = jQuery("#ux_album_format").val();
    if (album_format == "individual") {
        jQuery("#ux_select_album").css("display", "block");
    }
    else {
        jQuery("#ux_select_album").css("display", "none");
    }
}
function InsertGallery() {
    var gallery_effect;
    var album_id = jQuery("#add_album_id").val();
    var album_format = jQuery("#ux_album_format").val();
    var gallery_format = jQuery("#ux_gallery_format").val();
    var text_format = jQuery("#ux_text_format").val();
    var images_in_row = jQuery("#ux_img_in_row").val();
    var album_in_row = jQuery("#ux_album_in_row").val();
    var filmstrip_width = jQuery("#ux_img_width").val();
    var gallery_type = jQuery("input:radio[name=ux_gallery]:checked").val();

    var special_effect = jQuery("#ux_special_effects").val();
    var rotation = jQuery("#ux_rotation").val();
    var overlay_color = jQuery("#ux_overlay_color").val();
    var overlay_color_with_dir = jQuery("#ux_overlay_color_with_dir").val();
    var overlay_dir = jQuery("#ux_overlay_dir").val();
    var ribbon_color = jQuery("#ux_ribbon_color").val();
    var ribbon_dir = jQuery("#ux_ribbon_dir").val();
    var shadow = jQuery("#ux_shadow").val();
    var lomo_color = jQuery("#ux_lomo_color").val();
    var lomo_dir = jQuery("#ux_lomo_dir").val();
    var rounded_images = jQuery("#ux_rounded_images").val();
    var animation_effects = jQuery("#ux_animation_effects").val();
    var displayAlbumTitle = jQuery("#ux_album_title").prop("checked");
    var responsiveGallery = jQuery("#ux_responsive_gallery").prop("checked");
    var responsive;

    if (album_id == "" && (album_format == "individual" || gallery_type == 0)) {
        alert("<?php _e("Please select an Album", gallery_bank) ?>");
        return;
    }
    else if (gallery_type == 1 && album_format == "") {
        alert("<?php _e("Please select an Album Format", gallery_bank) ?>");
        return;
    }
    else if (gallery_format == "") {
        alert("<?php _e("Please select a Gallery Images Format", gallery_bank) ?>");
        return;
    }
    else if (text_format == "" && gallery_format != "slideshow") {
        alert("<?php _e("Please select a Text Format for the Gallery", gallery_bank) ?>");
        return;
    }
    else if (gallery_format == "slideshow" || gallery_format == "filmstrip" || gallery_format == "blog") {
        alert("This Feature is only available in Paid Premium Version!");
        return;
    }
	
	if(responsiveGallery == true)
	{
		responsive = "responsive=\""+ responsiveGallery+"\"";
	}
	else
	{
		responsive = "img_in_row=\""+ images_in_row+"\"";
	}
	
    if (gallery_type == 1) {
        if (album_format == "individual") {
            if (gallery_format == "thumbnail" || gallery_format == "masonry") {
                if (text_format == "title_only") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+responsive+" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
                }
                else if (text_format == "title_desc") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+responsive+" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
                }
                else if (text_format == "no_text") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+responsive+" special_effect=\"\" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
                }
            }
        }
        else if (album_format == "grid") {
            if (gallery_format == "thumbnail" || gallery_format == "masonry") {
                if (text_format == "title_only") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+responsive+" albums_in_row=\"" + album_in_row + "\" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\"]");
                }
                else if (text_format == "title_desc") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+responsive+" albums_in_row=\"" + album_in_row + "\" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\"]");
                }
                else if (text_format == "no_text") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+responsive+" albums_in_row=\"" + album_in_row + "\" special_effect=\"\" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\"]");
                }
            }
        }
        else {
            if (gallery_format == "thumbnail" || gallery_format == "masonry") {
                if (text_format == "title_only") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+responsive+" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\"]");
                }
                else if (text_format == "title_desc") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+responsive+" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\"]");
                }
                else if (text_format == "no_text") {
                    window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+responsive+" special_effect=\"\" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\"]");
                }
            }
        }
    }
    else {
        if (gallery_format == "thumbnail" || gallery_format == "masonry") {
            if (text_format == "title_only") {
                window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+responsive+" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
            }
            else if (text_format == "title_desc") {
                window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+responsive+" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
            }
            else if (text_format == "no_text") {
                window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+responsive+" special_effect=\"\" animation_effect=\"\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
            }
        }
    }
}
/**
 * @return {boolean}
 */
function OnlyNumbers(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    return (charCode > 47 && charCode < 58) || charCode == 127 || charCode == 8;
}
function set_text_value(text_type) {
    var val = "";
    switch (text_type) {
        case "img_in_row":
            val = jQuery("#ux_img_in_row").val();
            if (val < 1)
                jQuery("#ux_img_in_row").val(1);


            break;
        case  "album_in_row":
            val = jQuery("#ux_album_in_row").val();
            if (val < 1)
                jQuery("#ux_album_in_row").val(1);
            break;
    }
}
</script>