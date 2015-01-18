<?php
/**
 * Default widget template For Wp-admin. 
 */
$pick_class="color-picker";
?> 
To Active Widget All options & effects please <a href="http://www.codegrape.com/item/wordpress-images-text-hover-css3-animation-widget/3063?ref=proscriptsell" target="_blank">Buy </a> only at $5 . <br />
<br />
<div id="<?php echo $div_id; ?>" class="<?php esc_attr_e( $this->widget_id ); ?> egw-widget">
	<div class="widget-images-effects egw-row">
			<a id="<?php echo $this->get_field_id( 'img-button' ); ?>" class="select-image button" onClick="egw.selectImage('#<?php echo $div_id; ?>');" <?php if ( $instance['src'] != '') { echo ' style="display: none;"'; } ?>><?php esc_html_e( 'Choose an Image', 'egw' ); ?></a>
			<div id="<?php echo $this->get_field_id( 'img-thumb' ); ?>" class="img-thumb">
			<?php
				if ( $instance['src'] != '') {
					echo '<img src="' . $instance['src'] . '" style="max-width: 100%;">';
				}
			?>
			</div>
            <a id="<?php echo $this->get_field_id( 'img-button' ); ?>" class="remove-image button" onClick="egw.removeImage('#<?php echo $div_id; ?>');" <?php if ( $instance['src'] == '') { echo ' style="display: none;"'; } ?> ><?php esc_html_e( 'Remove image', 'egw' ); ?></a>
			<input class="src"
				id="<?php echo $this->get_field_id( 'src' ); ?>"
				name="<?php echo $this->get_field_name( 'src' ); ?>"
				type="hidden"
				value="<?php esc_attr_e( $instance['src'] ); ?>">
		
	</div>
    
	<div class="egw-row">
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'egw' ); ?></label>
			<input class="widefat title"
				id="<?php echo $this->get_field_id( 'title' ); ?>"
				name="<?php echo $this->get_field_name( 'title' ); ?>"
				type="text"
				value="<?php esc_attr_e( $instance['title'] ); ?>" />
		
	</div>
	<div class="egw-row">
		<label><?php _e( 'Text:', 'egw' ); ?></label>
		<textarea class="widefat" rows="4" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php esc_attr_e( $instance['text'] ); ?></textarea>
	</div>
	
	
	<div class="egw-row">
		<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Link:', 'egw' ); ?></label>
			<input class="widefat"
				id="<?php echo $this->get_field_id( 'url' ); ?>"
				name="<?php echo $this->get_field_name( 'url' ); ?>"
				type="text"
				value="<?php esc_attr_e( $instance['url'] ); ?>" readonly="readonly" />
		
	</div>
    <div class="egw-row">
        <input type="checkbox" name="<?php echo $this->get_field_name( 'new_window' ); ?>" id="<?php echo $this->get_field_id( 'new_window' ); ?>" <?php if($instance['new_window']!=""):?> checked="checked"<?php endif;?>  readonly="readonly"> 
        <?php _e( 'Open in new window?', 'egw' ); ?>
    </div>
<fieldset class="style_wrp"><legend> <?php _e( 'Widget Style and effects', 'egw' ); ?></legend>
<div class="egw-row">
    <label for="<?php echo $this->get_field_id( 'get_bg_effects' ); ?>"><?php _e( 'Images effects:', 'egw' ); ?></label>
    <select class="widefat" 
        id="<?php echo $this->get_field_id( 'get_bg_effects' ); ?>"
        name="<?php echo $this->get_field_name( 'get_bg_effects' ); ?>"
        type="text"
        value="<?php esc_attr_e( $instance['get_bg_effects'] ); ?>"  disabled="disabled">
        <?php
        $targets = $this->get_bg_effects();
        foreach ( $targets as $value => $display ) {
            if ( $instance['get_bg_effects'] == $value ) {
                echo '<option value="' . esc_attr( $value ) . '" selected="selected">' . esc_html( $display ) . '</option>';
            } else {
                echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $display ) . '</option>';
            }
        }
        ?>
    </select>
</div>
<div class="egw-row">
    <input type="checkbox" disabled="disabled" name="<?php echo $this->get_field_name( 'disable_captions' ); ?>" id="<?php echo $this->get_field_id( 'disable_captions' ); ?>" <?php if($instance['disable_captions']!=""):?> checked="checked"<?php endif;?> readonly="readonly">
    <?php _e( 'Disable Captions ?', 'egw' ); ?>
</div>
<div class="egw-row">
    <input type="checkbox" disabled="disabled" name="<?php echo $this->get_field_name( 'disable_opacity' ); ?>" id="<?php echo $this->get_field_id( 'disable_opacity' ); ?>" <?php if($instance['disable_opacity']!=""):?> checked="checked"<?php endif;?> readonly="readonly">
    <?php _e( 'Disable captions opacity?', 'egw' ); ?>
</div>
<div class="egw-row">
    <label for="<?php echo $this->get_field_id( 'get_captions_effects' ); ?>"><?php _e( 'Captions effects:', 'egw' ); ?></label>
    <select class="widefat" 
        id="<?php echo $this->get_field_id( 'captions_effects' ); ?>"
        name="<?php echo $this->get_field_name( 'captions_effects' ); ?>"
        type="text"
        value="<?php esc_attr_e( $instance['captions_effects'] ); ?>" disabled="disabled">
        <?php
        $targets = $this->get_captions_effects();
        foreach ( $targets as $value => $display ) {
            if ( $instance['captions_effects'] == $value ) {
                echo '<option value="' . esc_attr( $value ) . '" selected="selected">' . esc_html( $display ) . '</option>';
            } else {
                echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $display ) . '</option>';
            }
        }
        ?>
    </select>
</div>
<div class="egw-row">
    <label><?php _e( 'Captions padding:', 'egw' ); ?></label>
    <input class="min"
    id="<?php echo $this->get_field_id( 'padding' ); ?>"
    name="<?php echo $this->get_field_name( 'padding' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['padding'] ); ?>" 
     readonly="readonly"/>
     px
</div>   
<div class="egw-row">
<label for="<?php echo $this->get_field_id( 'captions_bg_color' ); ?>"><?php _e( 'Captions background color:', 'egw' ); ?></label>
   	#<input class="<?php echo $pick_class;?>"
    id="<?php echo $this->get_field_id( 'captions_bg_color' ); ?>"
    name="<?php echo $this->get_field_name( 'captions_bg_color' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['captions_bg_color'] ); ?>" 
    style="background:#<?php esc_attr_e( $instance['captions_bg_color'] ); ?>"
   readonly="readonly" />
</div>
<div class="egw-row">
	<label for="<?php echo $this->get_field_id( 'title_color' ); ?>"><?php _e( 'Captions  title color:', 'egw' ); ?></label>
  	#<input class="<?php echo $pick_class;?>"
    id="<?php echo $this->get_field_id( 'title_color' ); ?>"
    name="<?php echo $this->get_field_name( 'title_color' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['title_color'] ); ?>"  
    style="background:#<?php esc_attr_e( $instance['title_color'] ); ?>" readonly="readonly"/>
</div>
<div class="egw-row">
	<label for="<?php echo $this->get_field_id( 'text_color' ); ?>"><?php _e( 'Captions text color:', 'egw' ); ?></label>
   	#<input class="<?php echo $pick_class;?>"
    id="<?php echo $this->get_field_id( 'text_color' ); ?>"
    name="<?php echo $this->get_field_name( 'text_color' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['text_color'] ); ?>"  
    style="background:#<?php esc_attr_e( $instance['text_color'] ); ?>" readonly="readonly"/>
</div>
<div class="egw-row">
    <label for="<?php echo $this->get_field_id( 'fonts_family' ); ?>"><?php _e( 'Fonts family:', 'egw' ); ?></label>
    <select class="widefat"
        id="<?php echo $this->get_field_id( 'fonts_family' ); ?>"
        name="<?php echo $this->get_field_name( 'fonts_family' ); ?>"
        type="text"
        value="<?php esc_attr_e( $instance['fonts_family'] ); ?>" readonly="readonly">
        <?php
        $targets = $this->get_fonts_family();
        foreach ( $targets as $value => $display ) {
            if ( $instance['fonts_family'] == $value ) {
                echo '<option value="' . esc_attr( $value ) . '" selected="selected">' . esc_html( $display ) . '</option>';
            } else {
                echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $display ) . '</option>';
            }
        }
        ?>
    </select>
</div>
<div class="egw-row">
    <label><?php _e( 'Title font size:', 'egw' ); ?></label>
    <input class="min"
    id="<?php echo $this->get_field_id( 'title_size' ); ?>"
    name="<?php echo $this->get_field_name( 'title_size' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['title_size'] ); ?>" 
    readonly="readonly"/>
     px
</div>
<div class="egw-row">
    <label><?php _e( 'Text font size:', 'egw' ); ?></label>
    <input class="min"
    id="<?php echo $this->get_field_id( 'text_size' ); ?>"
    name="<?php echo $this->get_field_name( 'text_size' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['text_size'] ); ?>" 
    readonly="readonly"/>
     px
</div>
<div class="egw-row">
    <label for="<?php echo $this->get_field_id( 'widge_style' ); ?>"><?php _e( 'Widgets style:', 'egw' ); ?></label>
    <select class="widefat"
        id="<?php echo $this->get_field_id( 'widge_style' ); ?>"
        name="<?php echo $this->get_field_name( 'widge_style' ); ?>"
        type="text"
        value="<?php esc_attr_e( $instance['widge_style'] ); ?>">
        <?php
        $targets = $this->get_widget_style();
        foreach ( $targets as $value => $display ) {
            if ( $instance['widge_style'] == $value ) {
                echo '<option value="' . esc_attr( $value ) . '" selected="selected">' . esc_html( $display ) . '</option>';
            } else {
                echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $display ) . '</option>';
            }
        }
        ?>
    </select>
</div>
<div class="egw-row">
    <label><?php _e( 'Widgets border width:', 'egw' ); ?></label>
    <input class="min"
    id="<?php echo $this->get_field_id( 'border_width' ); ?>"
    name="<?php echo $this->get_field_name( 'border_width' ); ?>"
    type="text"
    readonly="readonly" value="<?php esc_attr_e( $instance['border_width'] ); ?>" 
    />
     px
</div>
<div class="egw-row">
	<label for="<?php echo $this->get_field_id( 'border_color' ); ?>"><?php _e( 'Widgets border color:', 'egw' ); ?></label>
   	#<input class="<?php echo $pick_class;?>"
    id="<?php echo $this->get_field_id( 'border_color' ); ?>"
    name="<?php echo $this->get_field_name( 'border_color' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['border_color'] ); ?>"  
    style="background:#<?php esc_attr_e( $instance['border_color'] ); ?>" readonly="readonly"/>
</div>
<div class="egw-row">
    <label><?php _e( 'Css Class:', 'egw' ); ?></label>
    <input 
    id="<?php echo $this->get_field_id( 'custom_css' ); ?>"
    name="<?php echo $this->get_field_name( 'custom_css' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['custom_css'] ); ?>" 
    readonly="readonly" />
</div>
<div class="egw-row">
    <label><?php _e( 'display width :', 'egw' ); ?></label>
    <input class="min"
    id="<?php echo $this->get_field_id( 'width' ); ?>"
    name="<?php echo $this->get_field_name( 'width' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['width'] ); ?>" 
      /> px
</div>
<div class="egw-row">
    <label><?php _e( 'display height :', 'egw' ); ?></label>
    <input  class="min"
    id="<?php echo $this->get_field_id( 'height' ); ?>"
    name="<?php echo $this->get_field_name( 'height' ); ?>"
    type="text"
    value="<?php esc_attr_e( $instance['height'] ); ?>" 
   /> px
</div>
To Active Widget All options please <a href="http://www.codegrape.com/item/wordpress-images-text-hover-css3-animation-widget/3063?ref=proscriptsell" target="_blank">buy now</a> . <br />
<br />
    </fieldset>
</div>


<script type="text/javascript">
jQuery(document).ready(function($) {   
	jQuery('.color-picker').colpick({
	layout:'hex',
	onSubmit:function(hsb,hex,rgb,el) {
		jQuery(el).css('background-color', '#'+hex);
		jQuery(el).colpickHide();
	},
	onChange:function(hsb,hex,rgb,el,bySetColor) {
		jQuery(el).css('background-color','#'+hex);
		if(!bySetColor) $(el).val(hex);
	}
	});
});             
</script>



