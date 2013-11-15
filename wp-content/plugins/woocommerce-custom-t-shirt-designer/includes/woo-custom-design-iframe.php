<?php require_once('../../../../wp-blog-header.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/popup.css" rel="stylesheet" type="text/css"></link>
</head>
<body>
    <?php 
        function get_custom_design(){
            global $wpdb;
            $sqls="select * from ".$wpdb->prefix ."woo_cd_custom_design where session_id='".$_REQUEST['ids']."'";
            $get_results=$wpdb->get_row($sqls);
            return $get_results;
        }
        $positionName='';
		$pos_top='';
		$pos_left='';
        $getresults=get_custom_design();
        $color=explode(',',$getresults->color);
		$pos_val=explode(',',$getresults->img_drag_pos);
		$pos_top=$pos_val[0];
		$pos_left=$pos_val[1];
        if($getresults->imageposition=='C'){
            $positionName='Center';
        }
        elseif ($getresults->imageposition=='R') {
            $positionName='Right Side';
        }
        elseif ($getresults->imageposition=='L') {
            $positionName='Left Side';
        }
    ?>
    <?php 
	$down_link=$getresults->logoimage_url;
    ?>
	<style type="text/css">
		.img_size img{
			max-width:245px;
			max-height:300px;
		}	
	</style>
    <div style="width:535px; min-height:260px;">
		<?php if(empty($down_link)){?>
        <div style="float:left; margin-left:30px; width:220px; position:relative;">
			<div class="img_size"><img src="<?php echo $getresults->image_url;?>" id="custom_img" name="custom_img"></img></div>
			<?php if($getresults->imageposition=='C'){ ?>
			<div style="position:absolute; top:<?php echo $pos_top;?>px; left:<?php echo $pos_left;?>px;"><img src="<?php echo $getresults->marge_img_url;?>" id="custom_img" name="custom_img" width="90"></img></div>
			<?php } elseif($getresults->imageposition=='R'|| $getresults->imageposition=='L'){?>
			<div style="position:absolute; top:<?php echo $pos_top;?>px; left:<?php echo $pos_left;?>px;"><img src="<?php echo $getresults->marge_img_url;?>" id="custom_img" name="custom_img" width="50"></img></div>
			<?php }?>
		</div>
		<?php } else{?>
		
		<div style="float:left; margin-left:30px; width:220px; position:relative;">
			<div class="img_size"><img src="<?php echo $getresults->image_url;?>" id="custom_img" name="custom_img"></img></div>
			<?php if($getresults->imageposition=='C'){ ?>
			<div style="position:absolute; top:<?php echo $pos_top;?>px; left:<?php echo $pos_left;?>px;"><img src="<?php echo $down_link;?>" id="custom_img" name="custom_img" width="90"></img></div>
			<?php } elseif($getresults->imageposition=='R'|| $getresults->imageposition=='L'){?>
			<div style="position:absolute; top:<?php echo $pos_top;?>px; left:<?php echo $pos_left;?>px;"><img src="<?php echo $down_link;?>" id="custom_img" name="custom_img" width="50"></img></div>
			<?php }?>
		</div>
		<?php }?>
		
        <div style="float:left; width:280px;">
            <div class="popup_top_text">Custom Design Description</div>
            <br></br>
            <?php if($getresults->checkbox_name=='text'){?>
            <div class="popup_text_common">Print Text:<span style="padding-left:66px;"><?php echo $getresults->design_text;?></span></div>
            <div class="popup_text_common">Font Color:<span style="padding-left: 60px;"><?php echo $color[0];?></span></div>
            <div class="popup_text_common">Color Code:<span style="padding-left: 55px;"><?php echo $color[1];?></span></div>
            <div class="popup_text_common">Font Name:<span style="padding-left:56px;"><?php echo $getresults->font_name;?></span></div>
            <div class="popup_text_common">Design Position:<span style="padding-left: 30px;"><?php echo $positionName;?></span></div>
            <?php } elseif($getresults->checkbox_name=='logo'){?>
            <div class="popup_text_common">Design Position:<span style="padding-left: 30px;"><?php echo $positionName;?></span></div>
            <?php }?>
        </div>
        <div style="clear:both;"></div>
        <table style="float:right;">
            <tr>
                <?php if($getresults->checkbox_name=='logo'){?>
                <td> <input type="button" style="cursor:pointer;" class="woo_cd_button_style" value="Print Logo"  onclick="printImg()" /></td>
                <?php }?>
                <td> <input type="button" style="cursor:pointer;" class="woo_cd_button_style" value="Print"  onclick="printDesc()" /></td>
            </tr>
        </table>
        <!--<a id="Img_logo" href='<?php //echo $down_link; ?>'></a>-->
		<a id="Img_logo" href="<?php echo plugins_url('',__FILE__);?>/woo-custom-design-print.php?logo_url=<?php echo $down_link ;?>"></a>
        <a id="desc_design" href="<?php echo plugins_url('',__FILE__);?>/woo-custom-design-print.php?ids=<?php echo $_REQUEST['ids'];?>"></a>
    </div>
    
    <script type="text/javascript">
        function printImg() {
            pwin = window.open(document.getElementById("Img_logo").href,"_blank");
        }
        function printDesc() {
            pwin = window.open(document.getElementById("desc_design").href,"_blank");
        }
    </script>
    
</body>
</html>