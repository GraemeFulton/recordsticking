<?php
    /*
    Plugin Name: Woocommerce custom t-shirt designer
    Plugin URI: http://www.solvercircle.com
    Description:This plugin is used to design or customize t-shirts by users.  
    Version: 1.0.2
    Author: SolverCircle
    Author URI: http://www.solvercircle.com
    */

    if(!defined('ABSPATH')) exit;
    define('WOO_CUSTOM_DESIGN_URL', plugins_url('',__FILE__));
	define('WOO_CUSTOM_DESIGN_DIR_URL', plugin_dir_path( __FILE__ ));
	
    include ('includes/woo-custom-design-settings.php');
    include ('includes/woo-custom-design-setup.php');
    include ('includes/woo-custom-design-sample-logo.php');
	include ('includes/add_logo.php');
	
    add_action( 'admin_init', 'woo_cd_add_custom_design_box' );
    add_action('init', 'woo_cd_dialog_load');

    function woo_cd_dialog_load(){
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script( 'jquery-ui-dialog' );
        wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
    }
    
    //create box
    function woo_cd_add_custom_design_box() {
	add_meta_box( 'woo_custom_design_meta_box','Products Custom Design Option','woo_cd_custom_degin_panel','product', 'normal', 'high');
    }
	
    function woo_cd_custom_degin_panel($product){
    $custom = get_post_custom($product->ID);
    $meta_box_check = $custom["_woo_t_shirt_custom_design_checkbox"][0];

    $custom_price = esc_html( get_post_meta( $product->ID,'_woo_t_shirt_custom_design_price', true ) );
    $custom_color = esc_html( get_post_meta( $product->ID,'_woo_t_shirt_custom_design_font_color', true ) );
	$design_padding = esc_html( get_post_meta( $product->ID,'_woo_t_shirt_custom_design_padding', true ) );
    ?>

    <script type="text/javascript">
        function variation_save(ischecked){
            if(ischecked.checked==true && jQuery('#woo_add_custom_design_price').val()==''){
                alert('For enable popup at frontend, please enter total price with custom design.');
                variation_ajax(<?php echo get_the_ID();?>,"checked");
            }
            if(ischecked.checked==false){
                if(jQuery('#variation_post_id').val()!=''){
                    variation_ajax(jQuery('#variation_post_id').val(),"unchecked");
                }
            }
        }
        function variation_ajax(post_id,status){   
            url="<?php echo plugins_url('',__FILE__);?>/includes/woo-custom-design-ajax.php?prod_ids="+post_id +"&action=add_variation_to_post"+"&status="+status;
            jQuery.ajax({
                type: "POST",
                url:url, 
                success: function(msg){
                    if(msg!=''){
                        jQuery('#variation_post_id').val(msg);
                    }
                }
            }); 
        }
		
		function woo_IntValueCheck(val,id){
			if(isNaN(val)){
				val = val.substring(0, val.length-1);
				document.getElementById(id).value = val;
				return false;
			}
				return true;
		}		
        
    </script>
    <table>
        <tr>
            <td>Design this Product?</td>
            <td><input type="checkbox" name="woo_check_for_design" id="woo_check_for_design"  <?php if( $meta_box_check == true ) { ?>checked="checked"<?php } ?> onclick="variation_save(this);" /></td>
        </tr>
        <tr>
            <td style="width:200px;">Total Price for Custom Design<span id="symbol_star" style="display:none; color:#FF0000;">*</span></td>
            <td><input type="text" name="woo_add_custom_design_price" style="width:80px;" onkeyup="woo_IntValueCheck(this.value,this.id);" id="woo_add_custom_design_price" value="<?php echo $custom_price;?>" /></td>
        </tr>
		<tr>
            <td>Position Padding</td>
            <td><input type="text" name="woo_design_padding" onkeyup="woo_IntValueCheck(this.value,this.id);" style="width:80px;" id="woo_design_padding" value="<?php echo $design_padding;?>" /></td>
        </tr>
        <tr>
            <td>Preview Background Color</td>
            <td><input type="text" class="color" name="woo_design_color" style="width:80px;" id="woo_design_color" value="<?php echo $custom_color;?>" /></td>
        </tr>
    </table>
    <input type="hidden" name="variation_post_id" id="variation_post_id">
    <?php
    }
	
    add_action( 'save_post','woo_cd_custom_design_panel_save', 10, 2 );
	

    function woo_cd_custom_design_panel_save( $post_id,$product) {
        
        if ( $product->post_type == 'product') {
			update_post_meta($post_id, '_woo_t_shirt_custom_design_price', $_POST['woo_add_custom_design_price'] );
					
			update_post_meta( $post_id, '_woo_t_shirt_custom_design_font_color', $_POST['woo_design_color'] );
				
			update_post_meta($post_id, "_woo_t_shirt_custom_design_checkbox", $_POST["woo_check_for_design"]);	
			
			update_post_meta($post_id, "_woo_t_shirt_custom_design_padding", $_POST["woo_design_padding"]);	
        }
    }
    
    function woo_cd_templates_dir() {
	$possible_directories = path_join(dirname(__FILE__), 'includes/templates');
	$dirarr=array();
	if ($handle = opendir($possible_directories)) {
            while (false !== ($entry = readdir($handle))) {
                if($entry != "." && $entry != "..") {
                        $dirarr[]=array('name'=>$entry,
                                        'directory'=>path_join(dirname(__FILE__), 'includes/templates/'.$entry),
                                        'screenshot'=>plugins_url('/includes/templates/'.$entry.'/screenshot.jpg',__FILE__));
                }
            }			
            closedir($handle);
	}
	$dirarr = woo_cd_sort_template($dirarr,'name');
	return $dirarr;
    }
    function woo_cd_sort_template(&$array, $key) {
	$sorter=array();
	$ret=array();
	reset($array);
	foreach ($array as $ii => $va) {
	$sorter[$ii]=$va[$key];
	}
	asort($sorter);
	foreach ($sorter as $ii => $va) {
	$ret[$ii]=$array[$ii];
	}
	$array=$ret;
	return $array;
    }
	
	function woo_cd_get_font_name() {
	$possible_directories = path_join(dirname(__FILE__), 'font');
	$dirarr=array();
	if ($handle = opendir($possible_directories)) {
		while (false !== ($entry = readdir($handle))) {
			if($entry != "." && $entry != "..") {
				$dirarr[]=array('name'=>$entry);
			}
		}			
		closedir($handle);
	}
	$dirarr = woo_cs_sort_font_name($dirarr,'name');
	return $dirarr;
	}
	
	
	function woo_cs_sort_font_name(&$array, $key) {
	$sorter=array();
	$ret=array();
	reset($array);
	foreach ($array as $ii => $va) {
		$sorter[$ii]=$va[$key];
	}
	asort($sorter);
	foreach ($sorter as $ii => $va) {
		$ret[$ii]=$array[$ii];
	}
	$array=$ret;
	return $array;
	}	
      	
    function woo_cd_js_admin(){
        wp_enqueue_script( 'jscolor.js', plugins_url( '/js/colorpicker/jscolor.js', __FILE__ ));
        wp_enqueue_script( 'jquery.popup.js', plugins_url( '/js/jquery.popup.js', __FILE__ ));
    }
    function woo_cd_css(){
		$woo_css = WOO_CUSTOM_DESIGN_URL.'/css/popup.css';
		echo '<link rel="stylesheet" type="text/css" href="'.$woo_css.'" />';
    }
		
    add_action('wp_footer','woo_cd_selected_woo_template');
    add_action('wp_footer','woo_cd_custom_img_in_frontend');
    add_action('admin_footer','woo_cd_custom_img_in_backend');
    add_action('admin_enqueue_scripts','woo_cd_js_admin');
    add_action('admin_head', 'woo_cd_css');
    register_activation_hook(__FILE__, 'woo_cd_install');
    register_deactivation_hook(__FILE__, 'woo_cd_uninstall');
?>