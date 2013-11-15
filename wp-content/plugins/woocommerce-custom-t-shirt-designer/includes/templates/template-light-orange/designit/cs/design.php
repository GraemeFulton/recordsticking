<?php require_once('../../../../../../../../wp-blog-header.php');
    session_start();
    $img_src=$_GET['imagelink'];
    $_SESSION['back_design']=$img_src;
	$design_padding_top='';
	
    function woo_cd_get_settings(){
        $result = get_option('woo_custom_design_popup_settings');
        return $result; 
    }
    $setting_result=woo_cd_get_settings();
	
    if($_REQUEST['add_price']=='add_price_postmeta'){
        update_post_meta($_REQUEST['Vids'], '_price',$_REQUEST['custom_price']);
    }
	
	$get_padding=get_post_meta($_REQUEST['product_id'],'_woo_t_shirt_custom_design_padding');
	$get_design_padding_centre=$get_padding[0];
	
	if(empty($get_design_padding_centre)){
		$design_padding_top=0;
	}
	else{
		$design_padding_top=$get_design_padding_centre;
	}
	
	$get_variations=get_post_meta($_REQUEST['product_id'],'_product_attributes');
	$variations_array=array();							 
	$attr_name='';
	$attr_value='';
	foreach($get_variations[0] as $attr) {
		$attr_name=$attr['name'];
		$attr_value=$attr['value'];
		$data = new stdClass();
		$data->names =$attr_name;
		$data->values_attr =$attr_value;
		$variations_array[] = $data;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script type="text/javascript" src="../js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.tipTip.minified.js"></script>
<script type="text/javascript" src="../js/mc_func.js"></script>
<link rel="stylesheet" type="text/css" href="../v5styles.css" />
<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="/iehacks.css" />
    <![endif]-->
<script type="text/javascript" language="javascript" src="js/js_ct_common-min.js"></script>
<script type="text/javascript" language="javascript" src="js/js_ct_design_aposoff.js"></script>
<script type="text/javascript" language="javascript" src="js/js_ct_design3-min.js"></script>
<script type="text/javascript" language="javascript" src="js/js_ct_uploader-min.js"></script>
<script type="text/javascript" language="javascript" src="js/ajaxupload.3.5.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>

<script type="text/javascript">
    var usrStrTextFront = "   Name \n Number";
    var usrBGColour = "<?php echo $_GET['procolor'];?>";
    var usrStrTextFront = decodeURIComponent(usrStrTextFront);
    var usrStrTextFront = usrStrTextFront.replace(/[|]/g,"\n");
    var iFPPos = "2";
    var usrCustomLogoImage = '<?php echo plugins_url('',__FILE__);?>' + '/sampleImage/S0.png?f=zz_default_upload.gif';
    var strFormatted = '';
    var bFL = true;
    //
        window.onload = function() {
        document.frmDesign.front_text.value = usrStrTextFront;
        document.frmDesign.front_text_faux.value = usrStrTextFront;
        bFL = false;
        ajaxUpdateDesignElement();
        jsTogglePos(iFPPos,<?php echo $design_padding_top;?>);
        jsSetColour('White');      
    }
    //Math.floor((Math.random()*100000)+1)
    $(function(){ $(".cbClass").tipTip({defaultPosition: "bottom", delay: 0}); });
</script>
<script type="text/javascript">
    function saveDesign(ids,vids,count_variation){
		var padding_top,padding_left,img_drag_pos;
		
		var pos_top=jQuery('#frontpreviewb').css('top');
		var pos_left=jQuery('#frontpreviewb').css('left');
		var img_pos_top=jQuery('#dShirtpreview').css('padding-left');
		var img_pos_left=jQuery('#dShirtpreview').css('padding-right');
		var img_pos_top=jQuery('#dShirtpreview').css('padding-top');
		var imgpos = jQuery('#imagepos').val();
		
		if(jQuery('#imageposnew').val()==2||imgpos==2 && parseInt(pos_top)==0 && parseInt(pos_left)==0){
			padding_top=parseInt(img_pos_top);
			padding_left=85;
		}
		if(jQuery('#imageposnew').val()==3 && parseInt(pos_top)==0 && parseInt(pos_left)==0){
			padding_top=parseInt(img_pos_top)+5;
			padding_left=45;
		}
		if(jQuery('#imageposnew').val()==1 && parseInt(pos_top)==0 && parseInt(pos_left)==0){
			padding_top=parseInt(img_pos_top)+5;
			padding_left=130;
		}
		if(jQuery('#imageposnew').val()==2||imgpos==2 && parseInt(pos_top)!=0 && parseInt(pos_left)!=0){
			padding_top=parseInt(pos_top)+80;
			padding_left=parseInt(pos_left)+85;
		}
		if(jQuery('#imageposnew').val()==3 && parseInt(pos_top)!=0 && parseInt(pos_left)!=0){
			padding_top=parseInt(img_pos_top)+65;
			padding_left=parseInt(pos_left)+45;
		}
		if(jQuery('#imageposnew').val()==1 && parseInt(pos_top)!=0 && parseInt(pos_left)!=0 ){
			padding_top=parseInt(img_pos_top)+65;
			padding_left=130+parseInt(pos_left);
		}
		
        var isChecked='';
		var attr_name='';
		var attr_value='';
		var parm_attr='';
		for(var i=0;i<count_variation;i++){
			attr_name=jQuery('#attr_name_'+i).html(); 
			attr_value=jQuery('#attr_value_'+i+' option:selected').val();
			if(attr_value!=-1){
				parm_attr+= attr_name+'#'+attr_value+'*';
			}
		}
		
        if(jQuery('#add_names').is(':checked')) {
            isChecked='text';
        }
        else{
            isChecked='logo';
        }
        var font_name=jQuery('#front_text_font option:selected').html();
        var get_text=jQuery('#txtInput').val();
 		
		var drag_pos=jQuery('#img_dragposition').val();
		if(drag_pos==''){
			if(jQuery('#imageposnew').val()==2||imgpos==2){
				img_drag_pos=parseInt(img_pos_top)+','+62;
			}
			if(jQuery('#imageposnew').val()==3){
				img_drag_pos=parseInt(img_pos_top)+','+50;
			}
			if(jQuery('#imageposnew').val()==1){
				img_drag_pos=parseInt(img_pos_top)+','+115;
			}
		}
		else{
			img_drag_pos=drag_pos;
		}
		
		if(jQuery('#qty').val()!=''){
			url="margeImage.php?add_proid="+ids + "&add_qty=" + jQuery('#qty').val()+"&action=add_to_cart"+"&Variationids="+vids+"&imgpos="+imgpos+"&color="+jQuery('#colorpass').val()+"&font="+font_name+"&select_logo_src="+jQuery('#select_logo').val()+"&design_text="+get_text+"&checkbox_name="+isChecked+"&pass_attr="+encodeURIComponent(parm_attr)+"&position_top="+parseInt(padding_top)+"&position_left="+parseInt(padding_left)+"&drag_pos="+img_drag_pos;
			jQuery.ajax({
				type: "POST",
				url:url, 
				success: function(msg){
					if(msg=='save'){
						session_clear();
						alert('Successfully added!');
					}
				}
			});	
			window.parent.jQuery('#dialog-modal').dialog('close');
		}
		else{
			alert('Quantity is required!');
		}
    }
  
	function mergeImage(pid,vids){
		var font_name=jQuery('#front_text_font option:selected').html();
		var imgpos = jQuery('#imagepos').val();
		$.ajax({
		type: "GET",
        url: 'margeImage.php?proId='+pid + '&imgpos=' + imgpos+'&pro_id='+vids +'&color='+jQuery('#colorpass').val()+'&font='+font_name,
        success: function(msg) {
		 //return msg;
        }
    	});
	}
	
	function session_clear(){
		var action='<?php echo plugins_url('',__FILE__)?>/session_clear.php';
		jQuery.ajax({
		type: "POST",
		url: action,
		success: function(msg){
		}
		});
	}
	function showFront(token){
		 if(token=='1'){
		 	jQuery('#s1').hide();
			jQuery('#s2').hide();
		 }
		 else{
		 	jQuery('#s1').show();
			jQuery('#s2').show();
		 }
	}
	
	function setColourCode(color){
	if(color=='White'){
	jQuery('#colorpass').val(color+',FFFFFF');
	}
	else if(color=='Grey'){
	jQuery('#colorpass').val(color+',808080');
	}
	else if(color=='Black'){
	jQuery('#colorpass').val(color+',000000');
	}
	else if(color=='Blue'){
	jQuery('#colorpass').val(color+',0000FF');
	}
	else if(color=='Navy'){
	jQuery('#colorpass').val(color+',000090');
	} 
	else if(color=='Purple'){
	jQuery('#colorpass').val(color+',900090');
	}
	else if(color=='Pink'){
	jQuery('#colorpass').val(color+',F99CF9');
	} 
	else if(color=='DarkGreen'){
	jQuery('#colorpass').val(color+',006300');
	} 
	else if(color=='Green'){
	jQuery('#colorpass').val(color+',009000');
	} 
	else if(color=='Gold'){
	jQuery('#colorpass').val(color+',FFCC00');
	} 
	else if(color=='Orange'){
	jQuery('#colorpass').val(color+',FF6F00');
	}
	else if(color=='Red'){
	jQuery('#colorpass').val(color+',FF0000');
	}  
	}
	function ValueCheck(val){
		if(isNaN(val)){
			val = val.substring(0, val.length-1);
			document.getElementById('qty').value = val;
			return false;
		}
			return true;
	}
	
jQuery( init );
 
function init() {	
  jQuery('#frontpreviewb').draggable({
  	containment: '.ctSubCol2ShirtPreviewImage',
  	cursor: 'move',
	stop: handleDragStop
  });
}

function setting_position(pos){
	jQuery('#imageposnew').val(pos);
}
function handleDragStop( event, ui ) {
  var top=jQuery("#frontpreviewb").offset().top - jQuery(".ctSubCol2ShirtPreviewImage").offset().top;
  var left=jQuery("#frontpreviewb").offset().left - jQuery(".ctSubCol2ShirtPreviewImage").offset().left-7;
  jQuery('#img_dragposition').val(parseInt(top)+','+parseInt(left));
}				
</script>
<script type="text/javascript" language="javascript" src="ajaxpriceupdate.js"></script>
<link rel="stylesheet" type="text/css" href="csd_styles.css" />
</head>
<body>		
    <div class="main">
        <div class="bbox">
<!--            <div class="maincontainer">-->
<!--                <div class="ctContent">
                </div>-->
<!--            </div>    -->
            <form name="frmDesign" id="frmDesignUpload" action="" method="post" enctype="multipart/form-data">
                <div class="ctColumn1">
                    <div class="blackify" style=" height:40px; font-size: 13px; width:670px; margin-top:6px; color:#000000; font-weight:bold;">
                        <div class="ctColumn1Options">
                            <input type="hidden" name="add_front_text" value="false">
                            <label for="add_names" onmouseover="this.style.cursor='pointer'">
                            <input id="add_names" type="checkbox" checked name="add_front_text" value="true" onclick="jsToggleControls(this);showFront(0);">
                            Add custom text </label>
                        </div>
                        <div class="ctColumn1Options_3">
                            <input type="hidden" name="add_front_logo" value="false">
                            <label for="add_logo" onmouseover="this.style.cursor='pointer'">
                            <input id="add_logo" type="checkbox"  name="add_front_logo" value="true" onclick="jsToggleControls(this);showFront(1);">
                            Add your logo</label>
                        </div>
                        <div class="ctColumn1Options" style="width:276px; padding-top:13px;">
                            <label style="text-decoration:blink; color:#CCCCCC; font-weight:bold; font-size:13px; color:#000000;">Total cost for custom design is <?php echo '$'.$_GET['custom_price'];?>. </label>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="ctSubCol1">
                        <div class="blackify ctSubCol1Text" >
                            <div id="controlHolder"> <img src="img/blank.gif" id="controlDisable" style="position: absolute; height: 125px; width: 445px; display: none;">
                            <div id="controlText">
                                <div style="float: left; width: 30px; height: 30px; margin-top: 15px; margin-left:5px; font-size:13px; color:#000000; font-weight:bold;">Text</div>
                                <div class="ctSubCol1Text2">
                                    <textarea id="txtInput" style="display:block; width:100%; height: 82px; color:#fff;" onKeyUp="jsUpdate();" name="front_text_faux" cols="25"></textarea>
                                </div>
                                <div>
                                    <fieldset>
                                        <legend style="color:#000000; font-size:13px; font-weight:bold;">Color</legend>
                                        <div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('White'); setColourCode('White');" title="White"><img border='0' src='img/v5_cb_white.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Grey'); setColourCode('Grey');" title="Grey"><img border='0' src='img/v5_cb_grey.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Black'); setColourCode('Black');" title="Black"><img border='0' src='img/v5_cb_black.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Blue'); setColourCode('Blue');" title="Blue"><img border='0' src='img/v5_cb_blue.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Navy'); setColourCode('Navy');" title="Navy"><img border='0' src='img/v5_cb_navy.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Purple'); setColourCode('Purple');" title="Purple"><img border='0' src='img/v5_cb_purple.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Pink'); setColourCode('Pink');" title="Pink"><img border='0' src='img/v5_cb_pink.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('DarkGreen'); setColourCode('DarkGreen');" title="Dark Green"><img border='0' src='img/v5_cb_darkgreen.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Green'); setColourCode('Green');" title="Green"><img border='0' src='img/v5_cb_green.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Gold'); setColourCode('Gold');" title="Gold"><img border='0' src='img/v5_cb_gold.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Orange'); setColourCode('Orange');" title="Orange"><img border='0' src='img/v5_cb_orange.gif'></a></div>
                                            <div style="float: left; margin-bottom: 5px;"><a onmouseover="this.style.cursor='pointer'" onclick="jsSetColour('Red'); setColourCode('Red');" title="Red"><img border='0' src='img/v5_cb_red.gif'></a></div>
                                        </div>
                                    </fieldset>
                                </div>
                                <br />
                                            <div id="s1" style="float: left; margin-left: 5px; font-size:13px; color:#000000; font-weight:bold;">Font</div>
                                            <div id="s2" style="float: left; margin-left: 5px; width: 165px;">
                                                <select id="front_text_font" name="front_text_font" onChange="jsUpdate();" style="width:170px;" >
                                                <?php
                                                            $font_name=woo_cd_get_font_name();
                                                                    if(isset($font_name)){
                                                                    foreach((array)$font_name as $fonts) { ?>
                                                            <option value="<?php esc_html_e(substr($fonts['name'],0,-4));?>"><?php esc_html_e(substr($fonts['name'],0,-4));?></option>;
                                                <?php } }?>
                                                <script>$('#front_text_font').val('Academic');</script>
                                                </select>
                                            </div>
                            </div>
                            <div id="controlImage" style="display: none;">
                                <div style="width:100%; height:135px;">
                                        <?php if($setting_result['user_logo_upload']=='enable'){?>
                                            <div>
												<div id="upload" style="margin-left: 5px; float:left;"><span>Upload Logo</span></div>
												<div id="status" style=" float:left; padding:3px 0px 0px 5px;"></div>
												<div style="clear:both;"></div>
											</div>
                                        <?php }
                                                global $wpdb;
                                                $get_sample_result = get_option('woo_custom_design_sample_logo_ids');
                                                $get_sample_result_array=explode(',',$get_sample_result['logo_id']);
                                                $i=1;
                                                if($get_sample_result_array[0]!=''){
                                                foreach($get_sample_result_array as $rows){
                                                        if(!empty($rows)){
                                                                $get_sample_logo="select sample_logo_url from ".$wpdb->prefix ."woo_cd_sample_logo where id='".$rows."'";
                                                                $get_Sample_src=$wpdb->get_results($get_sample_logo);
                                                        }
                                        ?>
                                        <div style="float:left; padding-top: 5px;">
                                                <a style="cursor:pointer;" onclick="adminlogoSample(<?php echo $rows;?>);"><img style="width:35px; height:35px; padding-left:28px;" src="<?php echo $get_Sample_src[0]->sample_logo_url;?>"  /></a>
                                        </div>
                                        <?php $i++; }?>
                                        <div style="clear:both;"></div>
                                        <?php }else{?>
                                            <table>
                                                <tr>
                                                    <td valign="top" style="padding-left:100px;"><a style="cursor:pointer;" onclick="logoSample(1);"><img style="width:60px; height:60px;" src="sampleImage/S1.png"  /></a></td>
                                                    <td valign="top" style="padding-left:30px;"><a style="cursor:pointer;" onclick="logoSample(2);"><img style="width:60px; height:60px;" src="sampleImage/S2.png"  /></a></td>
                                                    <td valign="top" style="padding-left:30px;"><a style="cursor:pointer;" onclick="logoSample(3);"><img style="width:60px; height:60px;" src="sampleImage/S3.png"  /></a></td>
                                                </tr>
                                            </table>
                                        <?php }?>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="blackify ctSubCol2Position" style="height: 135px; width:222px; overflow: hidden; float: left; margin-left:6px;">
                            <div id="posHolder"> <img src="img/blank.gif" id="posDisable" style="position: absolute; height: 125px; width: 255px; display: none;">
                            <div style="padding-left:5px; font-size:13px; color:#000000; font-weight:bold;">Position</div>
                            <table width="100%" style="margin:0px; text-align:center;" align="center">
                                <tr>
                                <td><div style="padding-left: 1px; margin-top: 10px;" id="spos3" onmouseover="this.style.cursor='pointer'" onclick="jsTogglePos(3,<?php echo $design_padding_top;?>); setting_position(3);"> <img src="img/shirtposchestright-tshirt.gif">
                                    <div style="margin-left: 17px; margin-top:-12px;"> </div>
                                    <div style="text-align:center; margin-left: 0px; margin-top:18px; font-size: 10px; color:#000000; font-weight:bold;">Top Right </div>
                                    </div></td>
                                <td><div style="margin-left:10px; margin-top: 10px;" id="spos2" onmouseover="this.style.cursor='pointer'" onclick="jsTogglePos(2,<?php echo $design_padding_top;?>);setting_position(2);"> <img src="img/shirtposcentre-tshirt.gif">
                                    <div style="margin-left: 17px; margin-top:-12px;"> </div>
                                    <div style="text-align:center; margin-left: 0px; margin-top:18px; font-size: 10px; color:#000000; font-weight:bold;">Centre</div>
                                    </div></td>
                                <td><div style="margin-left:10px; margin-top: 10px;" id="spos1" onmouseover="this.style.cursor='pointer'" onclick="jsTogglePos(1,<?php echo $design_padding_top;?>); setting_position(1);"> <img src="img/shirtposchestleft-tshirt.gif">
                                    <div style="margin-left: 17px; margin-top:-12px;"> </div>
                                    <div style="text-align:center; margin-left: 0px; margin-top:18px; font-size: 10px; color:#000000; font-weight:bold;">Top Left</div>
                                    </div></td>
                                </tr>
                            </table>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="ctSubCol2">
                        
                        <div class="blackify csPreviewHolder" >
                            <div id="dFrontpreview"><span style="padding-left:5px; font-size:13px; font-weight:bold; color:#000000;">Preview</span>
                            <div class="csPreviewImage" id="prevImageDiv" style="background:<?php echo '#'.$_GET['procolor'];?>; -webkit-border-radius:6px 6px 6px 6px;-moz-border-radius:6px 6px 6px 6px;border-radius:6px 6px 6px 6px; height:221px; margin-left:10px; width:421px;"> <img border="0" id="prevImageBg" src="img/blank.gif" class="img_height" />
                                <div align="center" style="position:relative;padding-top:15px; z-index: 1;"> <img id="frontpreview_" src="img/blank.gif"/> <img id="frontpreview" src="img/blank.gif" width="250" height="180"/> </div>
                            </div>
                            </div>
                        </div>
                        <div class="blackify ctSubCol2ShirtPreview" style="height:268px; width:222px; float:left; margin-left: 6px;">
                            <div> <span style="padding-left:5px; font-size:13px; font-weight:bold; color:#000000;">Design Preview</span>
                                    <?php
                                    $ab_path= ABSPATH; 
                                    $get_link=$_GET['imagelink'];
                                    $getpos1=strpos($get_link,'wp-content');
                                    $getstr1=substr($get_link,$getpos1);
                                    $abs_path= $ab_path.$getstr1;
                                    $img = wp_get_image_editor($abs_path);
                                    if (!is_wp_error( $img ) ) {
                                    $img->resize(210,285, true );
                                    $saved = $img->save();
                                    $getpos2=strpos($saved['path'],'/wp-content');
                                    $getstr2=substr($saved['path'],$getpos2);
                                    $path=$getstr2;
                                    }
                                    ?>
                            <div style="height:243px;width:227px;"> <img  id="frontpreviewb_" src="img/blank.gif">
                                <div class="ctSubCol2ShirtPreviewImage" style="background: url(<?php echo bloginfo('url').$path;?>)7px 0px no-repeat; height:243px;">
                                    <div id="dShirtpreview"  style="text-align:center; background: none; cursor:move;" > <img id="frontpreviewb" src="img/blank.gif"> </div>
                                <div id="dShirtpreviewNos" style="padding-left: 50px; text-align: center; background: none;" > <img id="frontpreviewc" src="img/blank.gif" style="border: none"> </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div align="right">
                        	<div style="float:left; width:65%;height:28px;">
                            	<?php if(!empty($get_variations[0])){?>
                            	<table>
                                	<tr>
										<?php 
                                            $i=0;
											foreach($variations_array as $value){
                                        ?>
                                    	<td id="attr_name_<?php echo $i;?>" style="font-size:13px; font-weight:bold;"><?php echo $value->names;?></td>
                                        <?php 
											$att_values=$value->values_attr;
											$search_char=strpos($att_values,'|');
											if(!empty($search_char)){
												$parse_search=explode('|',$att_values);											
										?>
                                        <td id="attr_value_<?php echo $i;?>">                                         	
                                           <select id="variation_<?php echo $i;?>">
                                           		<option value="-1">--Select--</option>
                                                <?php foreach($parse_search as $rows){?>
                                                    <option value='<?php echo $rows;?>'><?php echo $rows;?></option>
                                                 <?php }?>
                                            </select>                                           
                                        </td>
                                        <?php } else{?>
                                        <td id="attr_value_<?php echo $i;?>">
                                             <select id="variation_<?php echo $i;?>">
                                                <option value="-1">--Select--</option>
                                                <option value='<?php echo $att_values;?>'><?php echo $att_values;?></option>
                                            </select>
                                        
                                        </td>
                                        <?php }?>
                                        <?php 
												if(++$i>1){
									 				break;
												}
											}
										?>
                                       
                                    </tr>
                                </table>
                                <?php }?>
                            </div>
                        	<div style="float:left;">
                                <div style="float: left;"><span style="font-size:13px; font-weight:bold;">Quantity:</span><span style="padding-left:5px;"><input type="text" style="width:40px;" name="qty" id="qty" onkeyup="ValueCheck(this.value);" value="1"></input></span></div>  
                                <div style="float: left; margin-left:18px;"><a class="btnstyle" style="color:<?php echo'#'.$setting_result['cart_color'];?>;" href="javascript:void(0);" onclick="saveDesign(<?php echo $_GET['product_id'];?>,<?php echo $_REQUEST['Vids'];?>,<?php echo count($variations_array);?>)"><span><?php echo ucfirst($setting_result['cart_text']);?></span></a></div>
                                <div style="clear: both;"></div>
                        	</div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>
<!--                <div class="ctColumn2">
                    <div class="clear"> &nbsp; </div>
                    <div style="margin-top: -80px;"> </div>
                </div>-->
<!--                <div class="clear"></div>-->
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
<!--                <iframe id="upload_target" name="upload_target" src="#" style="width:0px;height:0px;margin:0px;border:0px solid #000;padding:0px;"></iframe>-->
                <input type="hidden" name="front_position" value="chestcentre"/>
                <input type="hidden" name="front_text_colour" value="White"/>
                <input type="hidden" name="front_logo_colour" value="White"/>
                <input type="hidden" name="front_js_offset" id="js_offset"/>
                <input type="hidden" name="front_text"/>
                <input type="hidden" name="redirect" value="4"/>
                <input type="hidden" id="imagepos" value="2"/>
				<input type="hidden" id="imageposnew" value=""/>
				<input type="hidden" id="img_dragposition" value=""/>
                <input type="hidden" id="base_url" value="<?php echo plugins_url('',__FILE__);?>">
                <input type="hidden" id="colorpass" value="White,FFFFFF"/>
                <input type="hidden" name="select_logo" id="select_logo"></input>
            </form>
        </div>                   
    </div>
<style type="text/css">
   .btnstyle{
border:1px solid #ffad41; -webkit-border-radius: 3px; -moz-border-radius: 3px;border-radius: 3px;font-size:12px;font-family:arial, helvetica, sans-serif; padding: 2px 16px 2px 16px; text-decoration:none; display:inline-block;text-shadow: 1px 1px 0 rgba(255,255,255,0.3);font-weight:bold; color: #000000;
 background-color: #ffc579; background-image: -webkit-gradient(linear, left top, left bottom, from(#ffc579), to(#fb9d23));
 background-image: -webkit-linear-gradient(top, #ffc579, #fb9d23);
 background-image: -moz-linear-gradient(top, #ffc579, #fb9d23);
 background-image: -ms-linear-gradient(top, #ffc579, #fb9d23);
 background-image: -o-linear-gradient(top, #ffc579, #fb9d23);
 background-image: linear-gradient(to bottom, #ffc579, #fb9d23);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#ffc579, endColorstr=#fb9d23);
}

.btnstyle:hover{
 border:1px solid #ff9913;
 background-color: #ffaf46; background-image: -webkit-gradient(linear, left top, left bottom, from(#ffaf46), to(#e78404));
 background-image: -webkit-linear-gradient(top, #ffaf46, #e78404);
 background-image: -moz-linear-gradient(top, #ffaf46, #e78404);
 background-image: -ms-linear-gradient(top, #ffaf46, #e78404);
 background-image: -o-linear-gradient(top, #ffaf46, #e78404);
 background-image: linear-gradient(to bottom, #ffaf46, #e78404);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#ffaf46, endColorstr=#e78404);
}
</style>
<script type="text/javascript">
	function uploadAll(){
		startUpload();
		stopUpload(1);
	}
</script>
<script type="text/javascript" >
	function logoSample(logoId){
		jQuery('#select_logo').val(jQuery('#base_url').val()+'/sampleImage/S' + logoId + '.png');
		jQuery('#frontpreview').attr('src',jQuery('#base_url').val() + '/sampleImage/S' + logoId + '.png');
		jQuery('#frontpreviewb').attr('src',jQuery('#base_url').val() + '/sampleImage/S' + logoId + '.png');
	}
        function adminlogoSample(logoId){
                url="../../../../woo-custom-design-ajax.php?get_src=logo_src&ids="+logoId;
		jQuery.ajax({
			type: "POST",
			url:url, 
			success: function(msg){
				if(msg!=''){
                                    jQuery('#frontpreview').attr('src',msg);
                                    jQuery('#frontpreviewb').attr('src',msg);
                                    jQuery('#select_logo').val(msg);
				}
			}
		});
	}
	
	
	jQuery(function(){
		var btnUpload=jQuery('#upload');
		var status=jQuery('#status');
		new AjaxUpload(btnUpload, {
			action: '<?php echo plugins_url('',__FILE__);?>/upload.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(png)$/.test(ext))){ 
                    // extension is not allowed 
					//mestatus.text('Only PNG files are allowed');
                                        alert('Only PNG files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				if(response != 'error'){
					status.text('');
					//jQuery('#frontpreview').attr('src','');
                                        jQuery('#select_logo').val(jQuery('#base_url').val() + '/uploadImage/' + response);
					jQuery('#frontpreview').attr('src',jQuery('#base_url').val() + '/uploadImage/' + response);
					jQuery('#frontpreviewb').attr('src',jQuery('#base_url').val() + '/uploadImage/' + response);
				}
				else{
					status.text('upload error, please try again');
				}	
			}
		});
		
	});
</script>
</body>
</html>
