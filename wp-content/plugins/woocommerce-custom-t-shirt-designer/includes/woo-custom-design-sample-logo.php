<?php
function woo_custom_design_sample_logo_main(){
	woo_cd_sample_logo_list();
}

function woo_cd_retrieve_logo_ids(){
	$result = get_option('woo_custom_design_sample_logo_ids');
	return $result; 
}

function isChecked($ids){
	$get_result = get_option('woo_custom_design_sample_logo_ids');
	if(in_array($ids,explode(',',$get_result['logo_id']))){
		return "check";
	}
}

function woo_cd_sample_logo_list(){
global $wpdb;

$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
$limit =10;
$offset = ( $pagenum - 1 ) * $limit;
$entries = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}woo_cd_sample_logo LIMIT $offset, $limit" );
 
echo '<div class="wrap">';
 
?>
<script type="text/javascript">
	function save_sample_logo_ids(){
		var sample_logo_ids='';
		var uncheck_sample_logo_ids='';
		var checkbox=document.getElementsByName('select_logo[]');
		for(var i=0;i<checkbox.length;i++){
			if(checkbox[i].checked==true){
				sample_logo_ids+=checkbox[i].value+',';
			}
		}
		for(var i=0;i<checkbox.length;i++){
			if(checkbox[i].checked==false){
				uncheck_sample_logo_ids+=checkbox[i].value+',';
			}
		}
                url="<?php echo plugins_url('',__FILE__);?>/woo-custom-design-ajax.php?save_sample_logo_ids=logo_ids&id=" +sample_logo_ids+'&uncheck_ids='+uncheck_sample_logo_ids;
                jQuery.ajax({
                        type: "POST",
                        url:url, 
                        success: function(msg){
                                if(msg=='success'){
                                    window.location.href="<?php echo site_url();?>/wp-admin/admin.php?page=woo_custom_design_sample_logo_slug";
                                }
                                else if(msg=='over'){
                                    alert('you can not select more than 10 sample logos at a time');
                                    window.location.href="<?php echo site_url();?>/wp-admin/admin.php?page=woo_custom_design_sample_logo_slug";
                                }
                                else if(msg=='over2'){
                                    alert('you can not select more than 10 sample logos at a time');
                                    window.location.href="<?php echo site_url();?>/wp-admin/admin.php?page=woo_custom_design_sample_logo_slug";
                                }
                        }
                });
	}
	
	function delete_logo(ids){
		url="<?php echo plugins_url('',__FILE__);?>/woo-custom-design-ajax.php?delete_sample_logo_ids=delete_logo_ids&ids="+ids;
		jQuery.ajax({
			type: "POST",
			url:url, 
			success: function(msg){
				if(msg=='delete'){
					window.location.href="<?php echo site_url();?>/wp-admin/admin.php?page=woo_custom_design_sample_logo_slug";
				}
			}
		});	
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
</style>
 <?php if (class_exists('Woocommerce')) {?>
<form action="admin.php?page=woo_custom_design_sample_logo_slug&post=logo_save" name="logo_save" id="logo_save" method="post" >
<p class="submit">
	<input type="button" name="submit_logo" value="Save" style=" width:100px;" class="button-primary" onclick="save_sample_logo_ids();" id="submit_logo">
        <a href="admin.php?page=woo_custom_design_sample_logo_add_slug"><input type="button" name="add_logo" value="Add Logo" style=" width:100px;" class="button-primary" id="add_logo"></a>
</p>
<table class="widefat">
    <thead>
        <tr>
            <th scope="col" class="manage-column column-name" style="">Select Logo</th>
            <th scope="col" class="manage-column column-name" style="">Logo Image</th>
			<th scope="col" class="manage-column column-name" style=""></th>
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th scope="col" class="manage-column column-name" style="">Select Logo</th>
            <th scope="col" class="manage-column column-name" style="">Logo Image</th>
			<th scope="col" class="manage-column column-name" style=""></th>
        </tr>
    </tfoot>
 
    <tbody>
        <?php if( $entries ) { ?>
 
            <?php
            $count = 1;
            $class = '';
            foreach( $entries as $entry ) {
                $class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
            ?>
 
            <tr<?php echo $class; ?>>
				<?php if(isChecked($entry->id)=='check'){?>
                <td><input type="checkbox" name="select_logo[]" checked="checked" id="select_logo"  value="<?php echo $entry->id;?>" /></td>
				<?php } else{?>
				<td><input type="checkbox" name="select_logo[]" id="select_logo" value="<?php echo $entry->id;?>" /></td>
				<?php }?>
                <td><img src="<?php echo $entry->sample_logo_url;?>" name="logo_img" id="logo_img" alt="logo" width="30" height="30" border="0" /></td>
				<td><img style="padding-top:6px; cursor:pointer;" src="<?php echo plugins_url('',__FILE__);?>/img/delete_icon.png" onclick="delete_logo(<?php echo $entry->id;?>)" name="delete" id="delete" border="0" alt="delete" width="18" height="18" /></td>
            </tr>
 
            <?php
                $count++;
            }
            ?>
 
        <?php } else { ?>
        <tr>
            <td colspan="2">No sample logo yet</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</form>
 <?php	 
$total = $wpdb->get_var( "SELECT COUNT('id') FROM {$wpdb->prefix}woo_cd_sample_logo" );
$num_of_pages = ceil( $total / $limit );
$page_links = paginate_links( array(
    'base' => add_query_arg( 'pagenum', '%#%' ),
    'format' => '',
    'prev_text' => __( '&laquo;', 'aag' ),
    'next_text' => __( '&raquo;', 'aag' ),
    'total' => $num_of_pages,
    'current' => $pagenum
) );
 
if ( $page_links ) {
    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
}
 
echo '</div>';
 }
else{
	echo '<div class="not_active_plugin">Please install wp woocommerce plugin first.</div>';
    }
}
?>