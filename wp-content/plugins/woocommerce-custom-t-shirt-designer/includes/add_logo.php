<?php
			
function woo_custom_design_sample_logo_add_main(){

    if(isset($_GET['post']) && $_GET['post']=='cd_sample_logo' && $_POST['submit']=='Save') {
        global $wpdb;
        $save_sample_logo=array(
                               'sample_logo_url'=>$_POST['sample_logo_upload_url']
        );
		if(!empty($_POST['sample_logo_upload_url'])){
        	$wpdb->insert($wpdb->prefix ."woo_cd_sample_logo",$save_sample_logo);
		}
		woo_cd_sample_logo_list();
    }
	else{
		woo_cd_logo_add_panel();
	}
}


	
function woo_cd_logo_add_panel(){
    global $title;
?>

    <script type="text/javascript">			
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
    </script>
    <style type="text/css">
        .not_active_plugin{
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #FF0000;
        }
				
    </style>
    <?php if (class_exists('Woocommerce')) {?>
    
    <div class="wrap">
    <div id="poststuff" class="metabox-holder has-right-sidebar">
	<div id="post-body"><div id="post-body-content">
	<div class="_top"></div>
	<div id="namediv" class="stuffbox">
	<h3 class="top_bar">Sample Logo Upload</h3>
	<div class="inside">
            <form method="post" action="admin.php?page=woo_custom_design_sample_logo_add_slug&post=cd_sample_logo" name="sample_logo" enctype="multipart/form-data">
                <table class="form-table">
                    <tbody>
                        <tr valign="top">
                                <th scope="row">
                                        <label for="title">logo upload </label>
                                </th>
                                <td>
                                    <input type="text" readonly="true" name="sample_logo_upload_url" id="sample_logo_upload_url"  style="width:200px;" value="" />  
                                    <span><input id="sample_logo_upload" name="sample_logo_upload" class="woo_cd_button_style" style="width:80px; cursor:pointer;" type="button" value="Browse" /></span>
                                </td>
                        </tr>    
		</tbody>
	   </table>
            <p class="submit">
                <input id="submit" class="button-primary" style=" width:100px; float:right;"  type="submit" value="Save" name="submit">
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

?>