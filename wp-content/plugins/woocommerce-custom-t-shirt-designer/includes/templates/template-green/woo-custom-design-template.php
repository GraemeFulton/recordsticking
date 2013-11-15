<?php

function woo_cd_getColorById($post_id=0){
    $result=get_post_meta($post_id,'_woo_t_shirt_custom_design_font_color');
    return $result[0];
}
	
function woo_cd_getPriceById($post_id=0){
	$result=get_post_meta($post_id,'_woo_t_shirt_custom_design_price');
	return $result[0];
}
	
function woo_cd_retrieve_product_image($post_id=0){
    $get_attached_images = (array) get_posts( array(
                                                   'post_type'   => 'attachment',
                                                   'post_parent' => $post_id
                                                   )
    );
    if (!empty($get_attached_images)){
        $img_src = $get_attached_images;
    }
    return $img_src;	
}
function woo_cd_get_variation_ids($post_id=0){
     global $wpdb;
    $sqls="select vid from ".$wpdb->prefix ."woo_cd_variation_ids where pid='".$post_id."'";
    $get_results=$wpdb->get_row($sqls);
    return $get_results->vid;
}

function woo_cd_get_popup_settings(){
    $result = get_option('woo_custom_design_popup_settings');
    return $result; 
}
	
function woo_design_page_in_frontend(){
    $setting_result=woo_cd_get_popup_settings();
?>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/le-frog/jquery-ui.css" />
    <?php if(is_shop()){?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
			var get_image_url='';
			var parseStr='';
			var action='<?php echo plugins_url('',__FILE__);?>/woo-custom-design-template-ajax.php?custom_design_enable=yes';
			jQuery.ajax({
				type: "POST",
				url: action,
				dataType: "json",
				success: function(msg){
					if(msg.length!=''){
						jQuery('img.attachment-shop_catalog').each(function(){
							for(var i=0;i<msg.length;i++){
								if(msg[i].id!=''&& msg[i].price!=''){
									var hrefValue=jQuery(this).parent().attr("href");
									var search_string=hrefValue.toString().search("=");
									if(search_string!=-1){
										var parseUrl=hrefValue.toString().split("=");
										parseStr=parseUrl[1];
									}
									else{
										var str_length=msg[i].post_name.length;
										var get_parse_str=hrefValue.toString().substr(-parseInt(str_length+1));
										var get_post_name=get_parse_str.toString().split("/");
										parseStr=get_post_name[0];
									}
									if(parseStr.toLowerCase()==msg[i].post_name.toLowerCase()){
										jQuery(this).attr('id','woo_cd_products_'+msg[i].id);
										if(msg[i].image_url!=''){
											get_image_url=msg[i].image_url;
										}
										if(msg[i].image_url==''){
											var get_url=jQuery(this).attr("src");
											var found = get_url.lastIndexOf('-') + 1;
											var found_ext = get_url.lastIndexOf('.') + 1;
											var get_ext= (parseInt(found_ext) > 0 ? get_url.substr(found_ext) : "");
											get_image_url=get_url.substring(0,found-1)+'.'+get_ext;
										}
										jQuery('img#woo_cd_products_'+msg[i].id).parent().after("<div style='height:25px;' id='woo_products_"+msg[i].id+"'></div>");
									jQuery('#woo_products_'+msg[i].id).append("<a href='javascript:void(0);' onClick=showDesignDialog('"+msg[i].id+"','" +msg[i].color + "','" +get_image_url+ "','" + msg[i].price + "','" + msg[i].variation+ "');><span class='text_style' style='color:<?php echo '#'.$setting_result['design_color'];?>; font-size:<?php echo $setting_result['design_text_font'];?>px;font-weight:bold;'><?php echo ucfirst($setting_result['design_text']);?></span></a>");
									}		
								}
							}
						});
					}
				}
			});
		}); 
    </script>
    <?php }?>
    
    
	<?php if(is_product()){
		global $product;
		$id=$product->post->ID;
		$color=woo_cd_getColorById($id);
		$src=woo_cd_retrieve_product_image($id);
		$price=woo_cd_getPriceById($id);
		$Vids=woo_cd_get_variation_ids($id);
	?>
	<style type="text/css">
		.custom_text{
			text-decoration:none;
		}
		a.custom_text span.text_style{
			padding-top:10px;
		
		}
	</style>
	<script type="text/javascript">
        jQuery(document).ready(function() {
            <?php if(!empty($price)){?>
            jQuery('img.attachment-shop_single').parent().after("<br><div id='woo_cd_single_products_<?php echo $id;?>'></div>");
            jQuery('#woo_cd_single_products_<?php echo $id;?>').append("<a class='custom_text' href='javascript:void(0);' onClick=showDesignDialog(<?php echo $id;?>,'<?php echo $color;?>','<?php echo $src[0]->guid;?>','<?php echo $price;?>',<?php echo $Vids;?>);><span class='text_style' style='color:<?php echo '#'.$setting_result['design_color'];?>; font-size:<?php echo $setting_result['design_text_font'];?>px;font-weight:bold;'><?php echo ucfirst($setting_result['design_text']);?></span></a>");
            <?php }?>
        }); 
	</script>
	<?php }?>
<script type="text/javascript">	   
function showDesignDialog(product_id,color_code,img_src,custom_price,variation_id){

    var url = '<?php echo plugins_url('',__FILE__);?>/designit/cs/design.php?product_id='+product_id+'&procolor='+color_code+'&imagelink='+img_src+'&custom_price='+custom_price+'&Vids='+variation_id+'&add_price=add_price_postmeta';
    jQuery( "#dialog-modal").dialog({
        closeOnEscape: false,
        resizable: false,
        width:680,
        height:580,
		modal: true
    });
    
		jQuery("#dialog-modal").html("<iframe style='margin-left:1px;' width='677' height='499' scrolling='no' src='"+url+"' ></iframe>");
        jQuery(".ui-widget-overlay").css({background: "#000 transparent", opacity: 0.9});
		jQuery('.ui-dialog-title').css({color:"#<?php echo $setting_result['popup_title_color'];?>"});
        jQuery('.ui-widget-overlay').css({'z-index':'10000'});
 		jQuery('.ui-dialog').css({'z-index':'1000000'});
		jQuery('.ui-dialog .ui-dialog-content').css({'padding':'.1em 0em 0em 0em','height':'506'});
        jQuery('a.ui-dialog-titlebar-close', jQuery('#dialog-modal').parent()).replaceWith("<a style='position:absolute; right:10px;' role='button' onclick='parent.showconfirm();' href='javascript:void(0);'><span class='ui-icon ui-icon-closethick' unselectable='on' style='-moz-user-select: none;'>close</span></a>");
	
	
	var action='<?php echo plugins_url('',__FILE__);?>/woo-custom-design-template-ajax.php?delete_create_png_mini=yes';
	jQuery.ajax({
		type: "POST",
		url: action,
		success: function(msg){
		}
	}); 
 }
	
function showconfirm(){
    jQuery("#designClose").dialog({
	resizable: false,
	modal: true,
        width:320,
        height:220,
        buttons: {
        'Stay Page': function() {
            jQuery(this).dialog('close');
        },
        'Leave Page': function() {
            jQuery(this).dialog('close');                             
            jQuery("#dialog-modal").dialog('close');
                var action='<?php echo plugins_url('',__FILE__)?>/designit/cs/session_clear.php?file_delete=delete';
                jQuery.ajax({
                type: "POST",
                url: action,
                success: function(msg){
                }
            });    	
        }
	}
    });
						
	jQuery('.ui-widget-overlay').css({'z-index':'10000'});
 	jQuery('.ui-dialog').css({'z-index':'1000000'});
	jQuery('.ui-dialog .ui-dialog-content').css({'padding':'.1em 0em 0em 0em'});
	jQuery('.ui-dialog-title').css({color:"#<?php echo $setting_result['popup_title_color'];?>"});
	jQuery('.ui-button-text-only .ui-button-text').attr('style', 'font-size:12px');						
	jQuery("#designClose").html("<div style='color:red;font-size:12px; padding-left:5px;'><div>If you leave this page, design will not be saved anywhere.</div> <div>Are you sure  to leave the current page?</div></div>");
	jQuery('a.ui-dialog-titlebar-close', jQuery('#designClose').parent()).remove();
}				
</script>
	<?php
	?>
	<div id="dialog-modal" title="<?php echo ucfirst($setting_result['popup_title']);?>" style="display: none;"></div>
	<div id="designClose" title="Close Confirmation" style="display:none;"></div>
	<?php 
	}
	
?>		