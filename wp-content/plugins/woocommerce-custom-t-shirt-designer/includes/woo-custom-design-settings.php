<?php
function woo_cd_selected_woo_template(){
    if (class_exists('Woocommerce')) {
        $result = get_option('woo_custom_design_popup_settings'); 
        $temp_name=$result['template_name'];
        $possible_directories = array(STYLESHEETPATH, TEMPLATEPATH, path_join(dirname(__FILE__), 'templates/'.$temp_name));
        if(!empty($possible_directories[2])){
            include ('templates/'.$temp_name.'/woo-custom-design-template.php');
            if(file_exists($possible_directories[2]."/woo-custom-design-template.php")){
                    woo_design_page_in_frontend();
            }
        }
    }
}						
function woo_custom_design_settings_main(){
    $title='';
    $cart_txt='';
    $cart_color='';
	$temp_name='';
	$get_update_result='';
	$selected_template='';
	$get_update_result=woo_cd_retrieve_settings_data();

    $title=$_POST['popup_title'];
	$popup_title_color=$_POST['popup_title_color'];
    $cart_txt=$_POST['cart_text'];
    $cart_color=$_POST['cart_color'];
	$design_text=$_POST['design_text'];
	$design_text_color=$_POST['design_text_color'];
	$design_text_font=$_POST['design_text_font'];
    $user_logo_up=$_POST['user_logo_upload'];
	$temp_name=$_POST['add_select_template'];
	if(!empty($temp_name)){
		$selected_template=$temp_name;
	}
	else{
		$selected_template=$get_update_result['template_name'];
	}
    $update_settings_data = array(
                                'popup_title' =>$title,
								'popup_title_color'=>$popup_title_color,	
                                'cart_text' =>$cart_txt,
                                'cart_color' =>$cart_color,
								'design_text'=>$design_text,
						   		'design_color'=>$design_text_color,
						   		'design_text_font'=>$design_text_font,
                                'user_logo_upload' =>$user_logo_up,
								'template_name' =>$selected_template
    );	 
		 
    if(isset($_GET['post']) && $_GET['post']=='cd_settings' && $_POST['submit']=='Save Changes'){
        update_option('woo_custom_design_popup_settings', $update_settings_data);
        $get_update_result=woo_cd_retrieve_settings_data();
        woo_cd_settings_panel($get_update_result);	
    }
    elseif (isset($_GET['post']) && $_GET['post']=='cd_sample_logo' && $_POST['submit']=='Save') {
        global $wpdb;
        $save_sample_logo=array(
                               'sample_logo_url'=>$_POST['sample_logo_upload_url']
        );
        $wpdb->insert($wpdb->prefix ."woo_cd_sample_logo",$save_sample_logo);
        woo_cd_settings_panel($get_update_result);
    }
    else{
        woo_cd_settings_panel($get_update_result);	
    }
}

function woo_cd_retrieve_settings_data(){
    $result = get_option('woo_custom_design_popup_settings');
    return $result; 
}
	
function woo_cd_settings_panel($result){
    global $title;
    $possible_templates=woo_cd_templates_dir();
    if($result['user_logo_upload']=='enable'){ $active='selected="selected"';}else{ $active='';}
    if($result['user_logo_upload']=='disable'){$nactive='selected="selected"';}else{ $nactive='';}
?>

    <script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#get_select_template').val('img_' + '<?php echo $result['template_name'];?>');
		});
		
		function select_templates(templates){
			jQuery('.tempclass').attr("class","opacity_clear");
			jQuery('#'+jQuery('#select_template').val()).removeClass("opacity_ok");
			jQuery('#'+jQuery('#select_template').val()).attr("class","opacity_clear");
			jQuery('#'+templates.id).attr("class","opacity_ok");
			jQuery('#select_template').val(templates.id);
			jQuery('#add_select_template').val(templates.name);
	    }
	 
		function woo_IntValueCheck(val){
			if(isNaN(val)){
				val = val.substring(0, val.length-1);
				document.getElementById('design_text_font').value = val;
				return false;
			}
				return true;
		}	
        function cd_getFileExtension(name){
            var found = name.lastIndexOf('.') + 1;
            return (parseInt(found) > 0 ? name.substr(found) : "");
        }
        jQuery(document).ready(function(){
            jQuery('#sample_logo_upload').click(function() {
                formfield = jQuery('#sample_logo_upload_url').attr('name');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');

                window.send_to_editor = function(html) {      
                url =jQuery(html).attr('href');
                var url_ext=cd_getFileExtension(url);
                if(url_ext=='png'){
                        jQuery('#sample_logo_upload_url').val(url);
                }else{        
                        alert('Only PNG files allowed');        
                }
                tb_remove();
                }
                return false;
            });
	});
        function woo_get_image(){
            var temp=jQuery('#woo_custom_template option:selected').html();
            var screens = new Array();
            <?php foreach((array)$possible_templates as $field_data) { ?>
            screens["<?php echo $field_data['name'];?>"]='<?php echo $field_data['screenshot'];?>';
            <?php } ?>
            jQuery('#divscreen').html('<img src="'+screens[temp]+'" />');	
            }

    </script>
    <style type="text/css">
        .not_active_plugin{
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #FF0000;
        }
		
		<?php foreach((array)$possible_templates as $field_data){ if($result['template_name']==$field_data['name']){ ?>
		img.img_opacity_<?php echo $field_data['name'];?>
		{
			opacity:1.0;
			filter:alpha(opacity=100);
		}
		<?php }else{?>
		img.img_opacity_<?php echo $field_data['name'];?> 
		{
			opacity:0.4;
			filter:alpha(opacity=40); 
		}	
		img.img_opacity_<?php echo $field_data['name'];?>:hover
		{
			opacity:1.0;
			filter:alpha(opacity=100);
		}
		
		<?php }}?>
		
		.opacity_clear{
			opacity:0.4;
			filter:alpha(opacity=40); 
		}
		
		.opacity_ok{
			opacity:1.0;
			filter:alpha(opacity=100);
		}
		.opacity_clear:hover
		{
			opacity:1.0;
			filter:alpha(opacity=100);
		}
    </style>
    <?php if (class_exists('Woocommerce')) {?>
    
        <div class="wrap">
        <div id="icon-options-general" class="icon32"><br></div>
        <h2><?php echo $title;?></h2>
	<div id="poststuff" class="metabox-holder has-right-sidebar">
	<div id="post-body"><div id="post-body-content">
	<div class="_top"></div>
	<div id="namediv" class="stuffbox">
	<h3 class="top_bar">Popup Settings</h3>
	<div class="inside">
            <form method="post" action="admin.php?page=woo_custom_design_settings_slug&post=cd_settings" name="popup_settings" enctype="multipart/form-data">
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                                <th scope="row">
                                        <label for="title">Popup Title</label>
                                </th>
                                <td>
                                        <input id="popup_title" style=" width:200px;" class="regular-text" type="text" value="<?php echo $result['popup_title']; ?>" name="popup_title">
                                </td>
                        </tr>
						<tr valign="top">
                                <th scope="row">
                                        <label for="title">Popup Title Color</label>
                                </th>
                                <td>
                                        <input id="popup_title_color" style=" width:75px;" class="color regular-text" type="text" value="<?php echo $result['popup_title_color']; ?>"  name="popup_title_color">
                                </td>
                        </tr>
                        <tr valign="top">
                                <th scope="row">
                                        <label for="title">Add To Cart Text</label>
                                </th>
                                <td>
                                        <input id="cart_text" style=" width:200px;" class="regular-text" type="text" value="<?php echo $result['cart_text']; ?>" name="cart_text">
                                </td>
                        </tr>
                        <tr valign="top">
                                <th scope="row">
                                        <label for="title">Cart Text Color</label>
                                </th>
                                <td>
                                        <input id="cart_color" style=" width:75px;" class="color regular-text" type="text" value="<?php echo $result['cart_color']; ?>"  name="cart_color">
                                </td>
                        </tr>
						<tr valign="top">
                                <th scope="row">
                                        <label for="title">Design Text Name</label>
                                </th>
                                <td>
                                        <input id="design_text" style=" width:200px;" class="regular-text" type="text" value="<?php echo ucfirst($result['design_text']);?>" name="design_text">
                                </td>
                        </tr>
						<tr valign="top">
                                <th scope="row">
                                        <label for="title">Design Text Color</label>
                                </th>
                                <td>
                                        <input id="design_text_color" style=" width:75px;" class="color regular-text" type="text" value="<?php echo $result['design_color']; ?>"  name="design_text_color">
                                </td>
                        </tr>
						<tr valign="top">
                                <th scope="row">
                                        <label for="title">Design Text Font Size</label>
                                </th>
                                <td>
                                        <input id="design_text_font" style=" width:200px;" onkeyup="woo_IntValueCheck(this.value);" class="regular-text" type="text" value="<?php echo $result['design_text_font']; ?>"  name="design_text_font">
                                </td>
                        </tr>
                        <tr valign="top">
                                <th scope="row">
                                        <label for="title">User Logo Upload </label>
                                </th>
                                <td>
                                    <select id="user_logo_upload" name="user_logo_upload">
                                        <option <?php echo $active;?> value="enable">Enable</option>
                                        <option <?php echo $nactive;?> value="disable">Disable</option>
                                    </select>
                                </td>
                        </tr>                  
		</tbody>
	   </table>	
	   	<br />
	   	<div style="padding-left:10px;">Select Templates</div>
	   	<div style="padding-left:10px;">
            <?php foreach((array)$possible_templates as $field_data){?>
                <div style="float:left;">
                    <img class="img_opacity_<?php echo $field_data['name'];?> tempclass" style="cursor:pointer; padding-right:45px; padding-top:30px;" src="<?php echo $field_data['screenshot'];?>" name="<?php echo $field_data['name'];?>" id="img_<?php echo $field_data['name'];?>" onclick="select_templates(this);"/>                    
                </div>
            <?php }?>			
            <input type="hidden" name="select_template" id="select_template" value="" />
            <input type="hidden" name="get_select_template" id="get_select_template" value="" />
			<input type="hidden" name="add_select_template" id="add_select_template" value="" />
			<div style="clear:both;"></div>
        </div>		
            <p class="submit">
                <input id="submit" class="button-primary" style=" width:100px; float:right;"  type="submit" value="Save Changes" name="submit">
            </p>
			
	</form>	
    </div>
        
    </div>
    </div></div>
    </div>
       
    </div>
<?php	
}
else{
	echo '<div class="not_active_plugin">Please install wp woocommerce plugin first.</div>';
    }	
}

function woo_cd_custom_img_in_frontend(){
?>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            if(jQuery('table tr').hasClass('cart_table_item')){
                jQuery('.cart_table_item dd').each(function() {
                    var session_id=jQuery(this).html();
					var design_type=jQuery(this).prev('dt').html();
					var getids= session_id.toString().split('_');
					var design_name= design_type.toString().split(':');
					if(getids[0]=='Custom'&& design_name[0]=='Design'){
						jQuery(this).parent(".variation").parent(".product-name").prev('td.product-thumbnail').addClass('img_'+session_id);
						url="<?php echo plugins_url('',__FILE__);?>/woo-custom-design-ajax.php?get_custom_img_url=custom_img"+"&session_id="+getids[1]; 
						jQuery.ajax({
							type: "POST",
							url:url, 
							success: function(msg){
								if(msg!=''){
									jQuery('.img_'+session_id).find('img.attachment-shop_thumbnail').attr("src",msg);
								}
							}
						});
					}	
 				});   
          	}
        });
    </script>
<?php
}
function woo_cd_custom_img_in_backend(){
   global $theorder;
   $order = $theorder;
   $customids='';
   
   if(isset($order)){
        foreach($order->get_items() as $rows){
            if(array_key_exists('Design', $rows['item_meta'])){ 
                $getcustomids=$rows['item_meta']['Design'][0];
                $ids=explode('_',$getcustomids);
                $customids.=$ids[1].',';
            }	
        }
   }
?>
    
    
    <script type="text/javascript">
        jQuery(document).ready(function(){
		var getValName='';	
        if(jQuery('div').hasClass('woocommerce_order_items_wrapper')){ 
        if(jQuery('table').hasClass('woocommerce_order_items')){     
            <?php 
                if(!empty($customids)){
                    $getids=explode(',',  trim($customids,','));
                }
                if(!empty($getids)){
                foreach ($getids as $rows){
             ?>  
                   jQuery('.thumb').each(function() {
                       if(jQuery(this).next('.name').find('table tbody.meta_items tr').length){
					   		
                            jQuery(this).next('.name').find('table tbody.meta_items tr').each(function(){
								jQuery(this).find('td').each(function(){
									if(jQuery(this).find('input[type="text"]').val()=='Design'){
										getValName=jQuery(this).next().find('input[type="text"]').val();
									}
								});
							});
							
                            if(getValName!=''){
                                var getsessionsid=getValName.toString().split('_');
                                if(getsessionsid[1]=="<?php echo $rows; ?>"){
                                    jQuery(this).attr('id','<?php echo $rows; ?>');
                                    url="<?php echo plugins_url('',__FILE__);?>/woo-custom-design-ajax.php?get_custom_img_url_admin=custom_img_admin"+"&session_id="+'<?php echo $rows; ?>'; 
                                    jQuery.ajax({
                                            type: "POST",
                                            url:url, 
                                            dataType: "json",
                                            success: function(msg){
                                                if(msg!=''){
                                                    jQuery('#'+'<?php echo $rows;?>').find('img').attr("src",msg[0]['margeimage_url']);
                                                                                   
                                                    jQuery('#'+'<?php echo $rows;?>').find('a').after('<div><a id="<?php echo $rows;?>" style="color:#FF0000;" href="javascript:void(0);" data-reveal-id="myModal" data-animation="none" onclick=popupCustomDetails("<?php echo $rows;?>");>Design</a></div>'); 
                                                }
                                            }
                                    });
                                }
                            }
                       }     
                    }); 
                  //
            <?php 
                }
                }
            ?>
     }    
     }               
     });

     function popupCustomDetails(ids){
        var url = '<?php echo plugins_url('',__FILE__);?>/woo-custom-design-iframe.php?design=custom'+'&ids='+ids;
		jQuery( "#dialog-modal").dialog({
			closeOnEscape: false,
			resizable: false,
			width:590,
			height:400,
			modal: true
    	});
		jQuery(".ui-widget-overlay").css({background: "url('images/ui-bg_flat_0_aaaaaa_40x100.png') repeat-x scroll 50% 50% #AAAAAA", opacity: 0.9});
		jQuery('.ui-widget-header').css({background:"none",border:"none"});
		jQuery("#dialog-modal").html("<iframe id='custom_desc' width='550' height='330' scrolling='no' src='"+url+"' ></iframe>");
     }
    </script>
	<div id="dialog-modal" title="" style="display: none;"></div>            
<?php
}
?>