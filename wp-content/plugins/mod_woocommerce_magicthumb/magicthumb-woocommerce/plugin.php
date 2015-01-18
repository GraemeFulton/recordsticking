<?php
/*

Copyright 2014 MagicToolbox (email : support@magictoolbox.com)

*/

$error_message = false;

function WooCommerce_MagicThumb_activate () {

    if(!function_exists('file_put_contents')) {
        function file_put_contents($filename, $data) {
            $fp = fopen($filename, 'w+');
            if ($fp) {
                fwrite($fp, $data);
                fclose($fp);
            }
        }
    }

    /* try to rename template files */
    $themePath = get_template_directory();
    if (file_exists($themePath.'/woocommerce/single-product/product-image.php')) {
        chmod($themePath.'/woocommerce/single-product/product-image.php', 0777);
        rename($themePath.'/woocommerce/single-product/product-image.php',$themePath.'/woocommerce/single-product/product-image.php~magictoolbox-backup');
    }
    if (file_exists($themePath.'/woocommerce/single-product/product-thumbnails.php')) {
        chmod($themePath.'/woocommerce/single-product/product-thumbnails.php', 0777);
        rename($themePath.'/woocommerce/single-product/product-thumbnails.php',$themePath.'/woocommerce/single-product/product-thumbnails.php~magictoolbox-backup');
    }

    //fix url's in css files
    $fileContents = file_get_contents(dirname(__FILE__) . '/core/magicthumb.css');
    $cssPath = preg_replace('/https?:\/\/[^\/]*/is', '', get_option("siteurl"));

    $cssPath .= '/wp-content/'.preg_replace('/^.*?\/(plugins\/.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__))).'/core';

    $pattern = '/url\(\s*(?:\'|")?(?!'.preg_quote($cssPath, '/').')\/?([^\)\s]+?)(?:\'|")?\s*\)/is';
    $replace = 'url(' . $cssPath . '/$1)';
    $fixedFileContents = preg_replace($pattern, $replace, $fileContents);
    if($fixedFileContents != $fileContents) {
        file_put_contents(dirname(__FILE__) . '/core/magicthumb.css', $fixedFileContents);
    }
    add_option("WooCommerceMagicThumbJustActivated", true); 
    magictoolbox_WooCommerce_MagicThumb_init() ;

    WooCommerce_MagicThumb_send_stat('install');

}

function WooCommerce_MagicThumb_deactivate () {

    /* restore from backups */
    $themePath = get_template_directory();
    if (file_exists($themePath.'/woocommerce/single-product/product-image.php~magictoolbox-backup')) {
        chmod($themePath.'/woocommerce/single-product/product-image.php~magictoolbox-backup', 0777);
        rename($themePath.'/woocommerce/single-product/product-image.php~magictoolbox-backup',$themePath.'/woocommerce/single-product/product-image.php');
    }
    if (file_exists($themePath.'/woocommerce/single-product/product-thumbnails.php~magictoolbox-backup')) {
        chmod($themePath.'/woocommerce/single-product/product-thumbnails.php~magictoolbox-backup', 0777);
        rename($themePath.'/woocommerce/single-product/product-thumbnails.php~magictoolbox-backup',$themePath.'/woocommerce/single-product/product-thumbnails.php');
    }
    //delete_option("WooCommerceMagicThumbCoreSettings");
    WooCommerce_MagicThumb_send_stat('uninstall');
}

function WooCommerce_MagicThumb_send_stat($action = '') {

    //NOTE: don't send from working copy
    if('working' == 'v5.12.17' || 'working' == 'v2.0.69') {
        return;
    }

    $hostname = 'www.magictoolbox.com';

    $url = preg_replace('/^https?:\/\//is', '', get_option("siteurl"));
    $url = urlencode(urldecode($url));

    $platformVersion = defined('WOOCOMMERCE_VERSION') ? WOOCOMMERCE_VERSION : '';
    
    

    $path = "api/stat/?action={$action}&tool_name=magicthumb&license=trial&tool_version=v2.0.69&module_version=v5.12.17&platform_name=woocommerce&platform_version={$platformVersion}&url={$url}";
    $handle = @fsockopen($hostname, 80, $errno, $errstr, 30);
    if($handle) {
        $headers  = "GET /{$path} HTTP/1.1\r\n";
        $headers .= "Host: {$hostname}\r\n";
        $headers .= "Connection: Close\r\n\r\n";
        fwrite($handle, $headers);
        fclose($handle);
    }

}

function showMessage_WooCommerce_MagicThumb($message, $errormsg = false) {
    if ($errormsg) {
        echo '<div id="message" class="error">';
    } else {
        echo '<div id="message" class="updated fade">';
    }
    echo "<p><strong>$message</strong></p></div>";
}    


function showAdminMessages_WooCommerce_MagicThumb(){
    global $error_message;
    if (current_user_can('manage_options')) {
       showMessage_WooCommerce_MagicThumb($error_message,true);
    }
}

function WooCommerce_MagicThumb_LoadScroll($tool) {

    if($tool->params->checkValue('magicscroll', 'yes') && $tool->type == 'standard') {
        require_once(dirname(__FILE__) . '/core/magicscroll.module.core.class.php');
        $scroll = new MagicScrollModuleCoreClass();
        $scroll->params->appendArray($tool->params->getArray());
        $GLOBALS["magictoolbox"]["scroll"] = & $tool;
        if($tool->params->checkValue('template', 'classic')) {
            $scroll->params->set('direction', 'right');
        }
        if($tool->params->checkValue('template', 'selectors-left')) {
            $scroll->params->set('direction', 'bottom');
        }
        return $scroll;
    }

    return false;


}

function plugin_get_version_WooCommerce_MagicThumb() {
    $plugin_data = get_plugin_data(str_replace('/plugin.php','.php',__FILE__));
    $plugin_version = $plugin_data['Version'];
    return $plugin_version;
}

function update_plugin_message_WooCommerce_MagicThumb() {
    $ver = json_decode(@file_get_contents('http://www.magictoolbox.com/api/platform/wordpress/version/'));
    if (empty($ver)) return false;
    $ver = str_replace('v','',$ver->version);
    $oldVer = plugin_get_version_WooCommerce_MagicThumb();
    if (version_compare($oldVer, $ver, '<')) {
        echo '<div id="message" class="updated fade">
                  <p>New version available! We recommend that you download the latest version of the plugin <a href="http://magictoolbox.com/magicthumb/modules/woocommerce/">here</a>. </p>
              </div>';
    }
}


function  magictoolbox_WooCommerce_MagicThumb_init() {

    global $error_message;
    
    $tool_lower = 'magicthumb';
    switch ($tool_lower) {
	case 'magiczoom': 	$priority = '90'; break;
	case 'magiczoomplus': 	$priority = '100'; break;
	case 'magicthumb': 	$priority = '110'; break;
	case 'magicscroll': 	$priority = '120'; break;
	case 'magicslideshow':	$priority = '130'; break;
	case 'magic360': 	$priority = '140'; break;
	case 'magictouch': 	$priority = '150'; break;
	default :		$priority = '90'; break;
    }
    
    /* add filters and actions into WordPress */
    add_action("admin_menu", "magictoolbox_WooCommerce_MagicThumb_config_page_menu");

    



    add_action("woocommerce_before_single_product", "magictoolbox_WooCommerce_MagicThumb_styles",$priority);
    add_action("woocommerce_before_main_content", "magictoolbox_WooCommerce_MagicThumb_styles",$priority);
    add_action ("woocommerce_before_main_content","start_parsing",10);
    add_action ("woocommerce_after_main_content","end_parsing",10);
    add_action ("woocommerce_before_single_product","start_alternative_parsing",11);
    add_action ("woocommerce_after_single_product","end_alternative_parsing",11);
    add_action( 'wp_print_footer_scripts', 'denided_prettyPhoto_inline' );
    add_filter ("the_content","contentClean",13);
    add_filter( 'plugin_action_links', 'magictoolbox_WooCommerce_MagicThumb_links', 10, 2 );

    if (!file_exists(dirname(__FILE__) . '/core/magicthumb.js')) {
        $jsContents = file_get_contents('http://www.magictoolbox.com/static/magicthumb/trial/magicthumb.js');
        if (!empty($jsContents) && preg_match('/\/\*.*?\\\*/is',$jsContents)){
            if ( !is_writable(dirname(__FILE__) . '/core/')) {
                $error_message = 'The '.substr(dirname(__FILE__),strpos(dirname(__FILE__),'wp-content')).'/core/magicthumb.js file is missing. Please re-uplaod it.';
            }
            file_put_contents(dirname(__FILE__) . '/core/magicthumb.js', $jsContents);
            chmod(dirname(__FILE__) . '/core/magicthumb.js', 0777);
        } else {
            $error_message = 'The '.substr(dirname(__FILE__),strpos(dirname(__FILE__),'wp-content')).'/core/magicthumb.js file is missing. Please re-uplaod it.';
        }
    }
    if ($error_message) add_action('admin_notices', 'showAdminMessages_WooCommerce_MagicThumb');

    //add_filter("shopp_catalog", "magictoolbox_create", 1); //filter content for SHOPP plugin

    if(!isset($GLOBALS['magictoolbox']['WooCommerceMagicThumb'])) {
        require_once(dirname(__FILE__) . '/core/magicthumb.module.core.class.php');
        $coreClassName = "MagicThumbModuleCoreClass";
        $GLOBALS['magictoolbox']['WooCommerceMagicThumb'] = new $coreClassName;
        $coreClass = &$GLOBALS['magictoolbox']['WooCommerceMagicThumb'];
    }
    $coreClass = &$GLOBALS['magictoolbox']['WooCommerceMagicThumb'];
    /* get current settings */
    $settings = get_option("WooCommerceMagicThumbCoreSettings");
    if($settings !== false && is_array($settings) && !isset($_GET['reset_settings'])) {
        $coreClass->params->appendArray($settings);
    } else {
        update_option("WooCommerceMagicThumbCoreSettings", $coreClass->params->getArray());
    }
    if (!get_option('WooCommerceMagicThumbJustActivated',false)) {
        update_option("WooCommerceMagicThumbCoreSettings", $coreClass->params->getArray());
        delete_option('WooCommerceMagicThumbJustActivated');
    }
}

function denided_prettyPhoto_inline(){
  if( wp_script_is( 'jquery', $list = 'enqueued' ) && (wp_script_is( 'avia-prettyPhoto', $list = 'enqueued' ) || wp_script_is( 'avia-default', $list = 'enqueued' )) ) {
    ?>
    <script type="text/javascript">
    if (typeof(jQuery)=="function" && typeof(jQuery.fn)=="object" && (typeof(jQuery.fn.prettyPhoto)=="function") || (typeof(jQuery.fn.avia_activate_lightbox)=="function")) {
      jQuery.fn.prettyPhoto = function(){};
      jQuery.fn.avia_activate_lightbox = function(){};
      
    function cart_improvement_functions_new()
      {
          //single products are added via ajax //doesnt work currently
          //jQuery('.summary .cart .button[type=submit]').addClass('add_to_cart_button product_type_simple');

          //downloadable products are now added via ajax as well
          jQuery('.product_type_downloadable, .product_type_virtual').addClass('product_type_simple');

          //clicking tabs dont activate smoothscrooling
          jQuery('.woocommerce-tabs .tabs a').addClass('no-scroll');
      }
      
      window.cart_improvement_functions = cart_improvement_functions_new;
    
    }
    </script>
    <?php
  }
}

function WooCommerceMagicThumb_config_page() {
     magictoolbox_WooCommerce_MagicThumb_config_page('WooCommerceMagicThumb');
}

function magictoolbox_WooCommerce_MagicThumb_links( $links, $file ) {
    if ( $file == plugin_basename( dirname(__FILE__).'.php' ) ) {
        $settings_link = '<a href="plugins.php?page=WooCommerceMagicThumb-config-page">'.__('Settings').'</a>';
        array_unshift( $links, $settings_link );
    }
    return $links;
}

function magictoolbox_WooCommerce_MagicThumb_config_page_menu() {
    if(function_exists("add_menu_page")) {
        //$page = add_submenu_page("plugins.php", __("Magic Thumb for WooCommerce Plugin Configuration"), __("Magic Thumb for WooCommerce Configuration"), "manage_options", "WooCommerceMagicThumb-config-page", "WooCommerceMagicThumb_config_page");
        $page = add_menu_page(__("Magic Thumb for WooCommerce"), __("Magic Thumb for WooCommerce"), "manage_options", "WooCommerceMagicThumb-config-page", "WooCommerceMagicThumb_config_page", plugin_dir_url( __FILE__ )."/core/admin_graphics/icon.png");
    }
}

function  magictoolbox_WooCommerce_MagicThumb_config_page($id) {
    update_plugin_message_WooCommerce_MagicThumb();
    $settings = $GLOBALS['magictoolbox'][$id]->params->getArray();
    if(isset($_POST["submit"])) {
        /* save settings */
        foreach($settings as $name => $s) {
            if(isset($_POST["magicthumbsettings".ucwords(strtolower($name))])) {
                $v = $_POST["magicthumbsettings".ucwords(strtolower($name))];
                switch($s["type"]) {
                    case "num": $v = intval($v); break;
                    case "array": 
                        $v = trim($v);
                        if(!in_array($v,$s["values"])) $v = $s["default"];
                        break;
                    case "text":
                    default: $v = trim($v);
                }
                $s["value"] = $v;
                $settings[$name] = $s;                
            }
        }
        update_option($id . "CoreSettings", $settings);
        $GLOBALS['magictoolbox'][$id]->params->appendArray($settings);
    }
    
    $toolAbr = '';
    $abr = explode(" ", strtolower("Magic Thumb"));
    foreach ($abr as $word) $toolAbr .= $word{0};
    
     $corePath = preg_replace('/https?:\/\/[^\/]*/is', '', get_option("siteurl"));
     $corePath .= '/wp-content/'.preg_replace('/^.*?\/(plugins\/.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__))).'/core';
    ?>
	<style>
        .<?php echo $toolAbr; ?>params { margin:20px 0; width:90%; border:1px solid #dfdfdf; }
        .<?php echo $toolAbr; ?>params .params { margin:0; width:100%;}
        .<?php echo $toolAbr; ?>params .params th { <? /*white-space:nowrap; */ ?> vertical-align:middle; border-bottom:1px solid #dfdfdf; padding:15px 5px; font-weight:bold; background:#fff; text-align:left; padding:0 20px; }
        .<?php echo $toolAbr; ?>params .params td { vertical-align:middle; border-bottom:1px solid #dfdfdf; padding:10px 5px; background:#fff; width:100%; }
        .<?php echo $toolAbr; ?>params .params tr.back th, .<?php echo $toolAbr; ?>params .params tr.back td { background:#f9f9f9; }
        .<?php echo $toolAbr; ?>params .params tr.last th, .<?php echo $toolAbr; ?>params .params tr.last td { border:none; }
        .afterText {font-size:10px;font-style:normal;font-weight:normal;}
        .settingsTitle {font-size: 1.5em;font-weight: normal;margin: 1.7em 0 1em 0;}
        input[type="checkbox"],input[type="radio"] {margin:5px;vertical-align:middle !important;}
        td img {vertical-align:middle !important; margin-right:10px;}
        td span {vertical-align:middle !important; margin-right:10px;}
		#footer , #wpfooter {position:relative;}
    </style>
    
    <div class="icon32" id="icon-options-general"><br></div>
    <h2>Magic Thumb Settings</h2><br/>
    <p style="font-size:15px;">Learn about all the <a href="http://www.magictoolbox.com/magicthumb/integration/" target="_blank">Magic Thumb&trade; settings and examples too!</a>&nbsp;|&nbsp;<a href="http://www.magictoolbox.com/contact/">Get support</a></p>
    <form action="" method="post" id="magicthumb-config-form">
            <?php
                $groups = array();
                $imgArray = array('zoom & expand','zoom&expand','yes','zoom','expand','swap images only','original','expanded','no','left','top left','top','top right', 'right', 'bottom right', 'bottom', 'bottom left'); //array for the images ordering

                foreach($settings as $name => $s) { 
                
		    $s['value'] = $GLOBALS['magictoolbox'][$id]->params->getValue($name);
		    
                    if (strtolower($s['id']) == 'disable-expand' || strtolower($s['id']) == 'disable-zoom') continue;
                    if (strtolower($s['id']) == 'direction') continue;
                    
                    
                    if (!isset($groups[$s['group']])) {
                        $groups[$s['group']] = array();
                    }

                    //$s['value'] = $GLOBALS['magictoolbox'][$id]->params->getValue($name);

                    if (strpos($s["label"],'(')) {
                        $before = substr($s["label"],0,strpos($s["label"],'('));
                        $after = ' '.str_replace(')','',substr($s["label"],strpos($s["label"],'(')+1));
                    } else {
                        $before = $s["label"];
                        $after = '';
                    }
                    if (strpos($after,'%')) $after = ' %';
                    if (strpos($after,'in pixels')) $after = ' pixels';
                    if (strpos($after,'milliseconds')) $after = ' milliseconds';

                    $html  .= '<tr>';
                    $html  .= '<th width="50%">';
                    $html  .= '<label for="magicthumbsettings'. ucwords(strtolower($name)).'">'.$before.'</label>';

                    if(($s['type'] != 'array') && isset($s['values'])) $html .= '<br/> <span class="afterText">' . implode(', ',$s['values']).'</span>';

                    $html .= '</th>';
                    $html .= '<td width="50%">';

                    switch($s["type"]) {
                        case "array": 
                                $rButtons = array();
                                foreach($s["values"] as $p) {
                                    $rButtons[strtolower($p)] = '<label><input type="radio" value="'.$p.'"'. ($s["value"]==$p?"checked=\"checked\"":"").' name="magicthumbsettings'.ucwords(strtolower($name)).'" id="magicthumbsettings'. ucwords(strtolower($name)).$p.'">';
                                    $pName = ucwords($p);
                                    if(strtolower($p) == "yes")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/yes.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "no")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/no.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "left")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/left.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "right")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/right.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "top")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/top.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "bottom")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/bottom.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "bottom left")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/bottom-left.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "bottom right")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/bottom-right.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "top left")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/top-left.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    elseif(strtolower($p) == "top right")
                                        $rButtons[strtolower($p)] .= '<img src="'.$corePath.'/admin_graphics/top-right.gif" alt="'.$pName.'" title="'.$pName.'" /></label>';
                                    else {
                                        if (strtolower($p) == 'load,hover') $p = 'Load & hover';
                                        if (strtolower($p) == 'load,click') $p = 'Load & click';
                                        $rButtons[strtolower($p)] .= '<span>'.ucwords($p).'</span></label>';
                                    }
                                }
                                foreach ($imgArray as $img){
                                    if (isset($rButtons[$img])) {
                                        $html .= $rButtons[$img];
                                        unset($rButtons[$img]);
                                    }
                                }
                                $html .= implode('',$rButtons);
                            break;
                        case "num": 
                        case "text": 
                        default:
                            if (strtolower($name) == 'message') { $width = 'style="width:95%;"';} else {$width = '';}
                            $html .= '<input '.$width.' type="text" name="magicthumbsettings'.ucwords(strtolower($name)).'" id="magicthumbsettings'. ucwords(strtolower($name)).'" value="'.$s["value"].'" />';
                            break;
                    }
                    $html .= '<span class="afterText">'.$after.'</span>';
                    $html .= '</td>';
                    $html .= '</tr>';
                    $groups[$s['group']][] = $html;
                    $html = '';
                }
            

            foreach ($groups as $name => $group) {
                $i = 0;
                $group[count($group)-1] = str_replace('<tr','<tr class="last"',$group[count($group)-1]); //set "last" class
                echo '<h3 class="settingsTitle">'.$name.'</h3>
                            <div class="'.$toolAbr.'params">
                            <table class="params" cellspacing="0">';
                if (is_array($group)) {
		    foreach ($group as $g) {
			if (++$i%2==0) { //set stripes
			    if (strpos($g,'class="last"')) {
				$g = str_replace('class="last"','class="back last"',$g);
			    } else {
				$g = str_replace('<tr','<tr class="back"',$g);
			    }
			}
			echo $g;
		    }
                }
                echo '</table> </div>';
            }
            ?>
            
            <p><input type="submit" name="submit" class="button-primary" value="Save settings" />&nbsp;<a href="plugins.php?page=WooCommerceMagicThumb-config-page&reset_settings=true">Reset to defaults</a></p>
        </form>

   
    </div>
    <?php
}



function  magictoolbox_WooCommerce_MagicThumb_styles() {
    if(!defined('MAGICTOOLBOX_MAGICTHUMB_HEADERS_LOADED')) {
        $plugin = $GLOBALS['magictoolbox']['WooCommerceMagicThumb'];
		if (function_exists('plugins_url')) {
			$core_url = plugins_url();
		} else {
			$core_url = get_option("siteurl").'/wp-content/plugins';
		}


        $path = preg_replace('/^.*?\/plugins\/(.*?)$/is', '$1', str_replace("\\","/",dirname(__FILE__)));
        
        $headers = $plugin->headers($core_url."/{$path}/core");

            $scroll = WooCommerce_MagicThumb_LoadScroll($plugin);
            if($scroll) {
                $headers .= $scroll->headers($core_url."/{$path}/core");
            }
        echo $headers;
        define('MAGICTOOLBOX_MAGICTHUMB_HEADERS_LOADED', true);
    }
}

function start_parsing () {
    $GLOBALS['magictoolbox']['WooCommerce_MagicThumb']['parse_status'] = 'started';
    ob_start();
}

function end_parsing () {
    $GLOBALS['magictoolbox']['WooCommerce_MagicThumb']['parse_status'] = 'ended';
	$content = ob_get_contents();
    ob_end_clean();
	$content = magictoolbox_WooCommerce_MagicThumb_create($content);
	echo $content;
}

function start_alternative_parsing () {
    if (!isset($GLOBALS['magictoolbox']['WooCommerce_MagicThumb']['parse_status'])) ob_start();
}

function end_alternative_parsing () {
    if (!isset($GLOBALS['magictoolbox']['WooCommerce_MagicThumb']['parse_status'])) {
        $content = ob_get_contents();
        ob_end_clean();
        $content = magictoolbox_WooCommerce_MagicThumb_create($content);
        echo $content;
    }
}
function contentClean ($content) {
    global $wp_query;
    $plugin = $GLOBALS['magictoolbox']['WooCommerceMagicThumb'];
    if (!$plugin->params->checkValue('use-effect-on-product-page','No') && isset($wp_query->query_vars['post_type']) && $plugin->params->checkValue('use_only_product_gallery','No') && $wp_query->query_vars['post_type'] == 'product') {
        $content = preg_replace('/(?:<a([^>]*)>)[^<]*<img([^>]*)(?:>)(?:[^<]*<\/img>)?(.*?)[^<]*?<\/a>/is','',$content); //TODO delete only what we really need.
        $content = preg_replace ('/<div id=\"attachment\_[0-9]+\"[^>]*?>.*?<\/div>/is','',$content); 
        $content = preg_replace ('/<div[^>]id=[\"\']gallery-1[\"\'][^>]*>.*?<\/div>/is','',$content);  
    }
    return $content;
}


function  magictoolbox_WooCommerce_MagicThumb_create($content) {
    $plugin = $GLOBALS['magictoolbox']['WooCommerceMagicThumb'];

    $cat = WooCommerce_MagicThumb_page_check('WooCommerce');
    if ($cat === false) {
        $pattern = "(?:<a([^>]*(?:rel|class|data-rel)=[\'\"][^\"]*(?:thumbnails|prettyPhoto|zoom)[^\"]*[\'\"][^>]*)>)(?:<[^>]*>)?[^<]*<img([^>]*)(?:>)(?:[^<]*<\/img>)?(.*?)[^<]*?<\/a>";
        
    } else if ($cat === true) {
        $pattern = "(?:<a([^>]*)>)[^<]*(?:<span[^>]*>[^<]*<\/span>)?[^<]*<img([^>]*)(?:>)(?:[^<]*<\/img>)?(.*?)<\/a>";
    } else {
        return $content;
    }

    $oldContent = $content;
    global $wp_query;
    $post_id = $wp_query->post->ID;
        $content = preg_replace_callback("/{$pattern}/is","magictoolbox_WooCommerce_MagicThumb_callback",$content);
        if ($content == $oldContent) return $content;

    if (isset($GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS'])) { //if there any additional images present
        $selectors = '<div class="MagicToolboxSelectorsContainer">'.implode($GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS']).'</div>';
        $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS}',$selectors,$content); // insert selectors under main image

        $contentWithGallery = $content;

      
    }

    /*$content = str_replace('{MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR}',$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR'],$content);  //add main image selector to other
    $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS}','',$content); //if no selectors - remove constant
     onlyForModend  */


    if (!$plugin->params->checkValue('template','original') && $plugin->type == 'standard' && isset($GLOBALS['magictoolbox']['MagicThumb']['main'])) {
        // template helper class
        require_once(dirname(__FILE__) . '/core/magictoolbox.templatehelper.class.php');
        MagicToolboxTemplateHelperClass::setPath(dirname(__FILE__).'/core/templates');
        MagicToolboxTemplateHelperClass::setOptions($plugin->params);
        if (!WooCommerce_MagicThumb_page_check('WooCommerce')) { //do not render thumbs on category pages
            $thumbs = WooCommerce_MagicThumb_get_prepared_selectors();
        } else {
            $thumbs = array();
        }
        if(isset($GLOBALS['magictoolbox']['prods_info'])){
            $pid= $GLOBALS['magictoolbox']['prods_info']['product_id'];
        }
        else $pid='';
        $html = MagicToolboxTemplateHelperClass::render(array(
            'main' => $GLOBALS['magictoolbox']['MagicThumb']['main'],
            'thumbs' => (count($thumbs) >= 1) ? $thumbs : array(),
            'pid' => $pid,
        ));

        $content = str_replace('MAGICTOOLBOX_PLACEHOLDER', $html, $content);
    } else if ($plugin->params->checkValue('template','original') || $plugin->type != 'standard') {
        $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR}',$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR'],$content);  //add main image selector to other
        $html = $GLOBALS['magictoolbox']['MagicThumb']['main'];
        $content = str_replace('MAGICTOOLBOX_PLACEHOLDER', $html, $content);
    }
    $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR}','',$content); 
    $content = str_replace('{MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS}','',$content); //if no selectors - remove constant
    $content = preg_replace ('/<div[^>]*?class="thumbnails"[^>]*?>.*?div>/is','',$content); // remove selectors div
    $content = preg_replace ('/<span[^>]*?class="onsale"[^>]*?>.*?span>/is','',$content); // remove promo span


    return $content;
}
function  magictoolbox_WooCommerce_MagicThumb_callback($matches) {
    $plugin = $GLOBALS['magictoolbox']['WooCommerceMagicThumb'];
    $cat = WooCommerce_MagicThumb_page_check('WooCommerce');
    if ($cat === 'error') return $matches[0];
    $plugin_enabled = true;
    $is_selector = true;
    $is_main = true;
    //if(!preg_match("/class\s*=\s*[\'\"]zoom[\'\"]/iUs",$matches[0]) && !preg_match("/class=[\'\"]attachment-shop_catalog wp-post-image[\'\"]/iUs",$matches[0])) {
    if(!preg_match("/class\s*=\s*[\'\"][^\"]*?zoom[^\"]*?[\'\"]/iUs",$matches[0]) && !preg_match("/class=[\'\"]attachment-shop_(?:catalog|single) wp-post-image[\'\"]/iUs",$matches[0])) {
        $is_main = false;
    }
    if(!preg_match("/class\s*=\s*[\'\"][^\"]*?(?:zoom|attachment-thumbnail)[^\"]*?[\'\"]/iUs",$matches[0])) {
        $is_selector = false;
    }
    if (!$is_selector && !$is_main) {
        $plugin_enabled = false;
    }
    if ($plugin_enabled) {
        if ($cat && $plugin->params->checkValue('use-effect-on-category-page','No')) return $matches[0];
        if (!$cat && $plugin->params->checkValue('use-effect-on-product-page','No')) return $matches[0];
    } else {
        return $matches[0];
    }


    $alignclass = preg_replace('/^.*?align(left|right|center|none).*$/is', '$1', $matches[2]);
    if($alignclass != $matches[2]) {
        $alignclass = ' align'.$alignclass;
    } else {
        $alignclass='';
        $float = preg_replace('/^.*?float:\s*(left|right|none).*$/is', '$1', $matches[2]);
        if($float == $matches[2]) {
            $float = '';
        } else {
            $float = ' float: ' . $float . ';';
        }
    }

    // get needed attributes 
    global $wp_query;
    $alt = preg_replace("/^.*?alt\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[2]);
    if (isset($matches[1]) && !empty($matches[1])) { // thecartpress fix
	$img = preg_replace("/^.*?href\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[1]);
	$thumb = preg_replace("/^.*?src\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[2]);
    } else {
	$thumb = $img = preg_replace("/^.*?href\s*=\s*[\"\'](.*?)[\"\'].*$/is","$1",$matches[2]); // only thecartpress
    }
    $prod_name = $wp_query->post->post_title;
    $title = $prod_name;

    $id = '_Main';//$wp_query->post->ID;

    if (!$cat) {
        $additionalDescription = preg_replace ('/<a[^>]*><img[^>]*><\/a>/is','',$wp_query->post->post_excerpt);
        $description = preg_replace ('/<a[^>]*><img[^>]*><\/a>/is','',$wp_query->post->post_content);
        $description = preg_replace ('/\[caption id=\"attachment_[0-9]+\"[^\]]*?\][^\[]*?\[\/caption\]/is','',$description);
    } else {
        $description = $additionalDescription = '';
        $link = $img;
        $info = substr($matches[3],0,-1);
        $info = preg_replace('/(.*?)(<strong>.*?<\/strong>)(.*)/is','$1 <a href="'.$link.'">$2</a>$3',$info);
        $info = '<a href="'.$link.'">'.$info.'</a>';
        $plugin->params->set('show-message', 'no');
        if (!$plugin->params->checkValue('link-to-product-page', 'Yes')) {
            $link = false;
        }
    }
    

    $aStyles = $matches[1];
    $imgStyles = $matches[2];
    // remove id,rel,class,href,title,rev attributes from link 
    $matches[1] = preg_replace("/^(.*?)rel\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
	$matches[1] = preg_replace("/^(.*?)id\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)class\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)title\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)rev\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    $matches[1] = preg_replace("/^(.*?)href\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[1]);
    // remove src attribute from img 
    $matches[2] = preg_replace("/^(.*?)src\s*=\s*[\"\'].*?[\"\']/is","$1",$matches[2]);
    $matches[2] = preg_replace("/\/\s*$/is"," ",$matches[2]);
    if ($is_main) { //if it is MAIN IMAGE
    	//$id = '_Main';
        if ($cat) $id = $id.md5(rand());
    	if (isset($GLOBALS['magictoolbox_main_image_set']) && !$cat) {
    		return $matches[0];
    	}
    	$GLOBALS['magictoolbox_main_image_set'] = true;

        $alt = $title;
        $img_name = str_replace(site_url(),'',$thumb);
        $img_name = preg_replace('/(.*)-[0-9]+x[0-9]+(\.(jpg|png|jpeg|gif))/is','$1$2',$img_name);
        if ($cat) {
          $thumb = WooCommerce_MagicThumb_get_product_image($img_name,'category-thumb');
        } else {
          $thumb = WooCommerce_MagicThumb_get_product_image($img_name,'thumb');
          $jsonVariations = WooCommerce_MagicThumb_get_product_variations();
        }
        $img = WooCommerce_MagicThumb_get_product_image($img_name,'original');
        $invisImg = '<a class="zoom invisImg" href="'.$img.'" style="display:none;"><img style="display:none;" src="'.$thumb.'"/></a>';

        if (!$cat) {
            $result = 'MAGICTOOLBOX_PLACEHOLDER';
            $result = $result.$jsonVariations;

            $GLOBALS['magictoolbox']['MagicThumb']['main'] = $plugin->template(compact('img','thumb','id','title','description','additionalDescription','link'));
        } else {
            $result = $plugin->template(compact('img','thumb','id','title','description','additionalDescription','link'));
        }


        if (!$plugin->params->checkValue('create-main-image-selector','No') && !$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SET']) {
            $medium = WooCommerce_MagicThumb_get_product_image($img_name,'thumb');
            $thumb = WooCommerce_MagicThumb_get_product_image($img_name,'selector');
            $alt = $title;
            //$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR'] = $plugin->subTemplate(compact('alt','img','medium','thumb','id')); //save main image selector to globals
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR'] = $GLOBALS['magictoolbox']['MagicThumb']['selectors'][] = $plugin->subTemplate(compact('alt','img','medium','thumb','id')); //save main image selector to globals
            //$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR'] = str_replace('<img','<img class="attachment-90x90" ',$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR']);
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR'] = str_replace('<img','<img class="attachment-90x90" ',$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR']);
		}
    }
     if ($is_selector && !$is_main && !$cat) { //if image is SELECTOR
        $alt = $title;
        $medium_name = str_replace(site_url(),'',$thumb);
        $medium_name = preg_replace('/(.*)-[0-9]+x[0-9]+(\.(jpg|png|jpeg|gif))/is','$1$2',$medium_name);
        $medium = WooCommerce_MagicThumb_get_product_image($medium_name,'thumb');
        $img = WooCommerce_MagicThumb_get_product_image($medium_name,'original');
        $thumb = WooCommerce_MagicThumb_get_product_image($medium_name,'selector');
        //$result = $plugin->subTemplate(compact('alt','img','medium','thumb','id','title'));
        if ($plugin->params->checkValue('template','original')) {
            $result = $plugin->subTemplate(compact('alt','img','medium','thumb','id','title'));
        } else {
            $result = '';
            $GLOBALS['magictoolbox']['MagicThumb']['selectors'][] = $plugin->subTemplate(compact('alt','img','medium','thumb','id','title'));
        }

        if (!$GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR_SET']) { 
            $prefix = '{MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR}';
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SELECTOR_SET'] = true;
        }
    }
    $result = preg_replace("/^(.*?)<a(.*?)$/is","$1<a {$matches[1]}$2",$result);
    $result = preg_replace("/^(.*?)<img(.*?)$/is","$1<img {$matches[2]}$2",$result);
    

     if ($is_main) {
         if(isset($prefix)){
             $prefix=$prefix;
         }
         else{
             $prefix='';
         }
        $prefix = $prefix . $invisImg;
        $result = $prefix."<div style=\"{$float}\" class=\"MagicToolboxContainer\">{$result}</div>";
         if(isset($info)){
             $info=$info;
         }
         else{
             $info='';
         }
        $result = $result . $info;
        if ($plugin->params->checkValue('keep-selectors-position','No')) {//load selectors under main image
            $result = $result.'{MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS}';
        }
        if (!$cat) {
            
            if (isset($GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SET'])) $result = $matches[0];
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_MAIN_IMAGE_SET'] = 'true';
        }
    } else if ($is_selector) {
        $result = $prefix.$result;
         if ($plugin->params->checkValue('keep-selectors-position','No')) {//load selectors under main image
            $GLOBALS['MAGICTOOLBOX_'.strtoupper('magicthumb').'_SELECTORS'][] = $result;
            $result = $matches[0];
        }
    }

    return $result;
    //return $matches[0];
}

function WooCommerce_MagicThumb_get_product_image($title,$size = 'thumb')  {
    $plugin = $GLOBALS["magictoolbox"]["WooCommerceMagicThumb"];
    
    if (!isset($GLOBALS['imagehelper'])) {
	require_once(dirname(__FILE__) . '/core/magictoolbox.imagehelper.class.php');
	$image_dir = 'wp-content/uploads/';
	$url = site_url();
	$shop_dir = ABSPATH;   
	$GLOBALS['imagehelper'] = new MagicToolboxImageHelperClass($shop_dir, $image_dir.'magictoolbox_cache', $plugin->params, null, $url);
    }
    if(isset($post_id)){
        $post_id=$post_id;
    }
    else{$post_id='';}
    return $GLOBALS['imagehelper']->create( $title, $size, $post_id);
                
}

function WooCommerce_MagicThumb_get_post_attachments()  {
    global $wp_query;
    $plugin = $GLOBALS["magictoolbox"]["WooCommerceMagicThumb"];
    $post_id = $wp_query->post->ID;
    $attachments = array();
    //global $product;
    $product = get_product( $post_id );
    $metaGallery = $product->get_gallery_attachment_ids();

    foreach ($metaGallery as $attr_id) {
        $attachments[$attr_id] = get_post($attr_id);
    }
    if (count($metaGallery) > 0){
        foreach ($metaGallery as $attr_id) {
            $attachments[$attr_id] = get_post($attr_id);
        }
    }

    
    $mainImage = get_post(get_post_thumbnail_id( $post_id ));
    $mainImageAdded = false;
    if (count($attachments) == 1) {
        if(isset($attachments[0]->guid)){
            $guid=$attachments[0]->guid;
        }else $guid='';
	if ($mainImage->guid != $guid) {
	    $attachments_to_add[get_post_thumbnail_id( $post_id )] = $mainImage;
	    array_splice($attachments, 0, 0, $attachments_to_add);
	    $mainImageAdded = true;
	}
    }
    /*if (!$plugin->params->checkValue('create-main-image-selector','No') && !$mainImageAdded) {
	$attachments_to_add[get_post_thumbnail_id( $post_id )] = $mainImage;
	array_splice($attachments, 0, 0, $attachments_to_add);
    }*/


    return $attachments;
}


function WooCommerce_MagicThumb_get_product_variations ($product_id = false) {

    global $product;

    $varImages = false;
    if ( $product->product_type == 'variable') {
        $variations = $product->get_available_variations();
        if (is_array($variations) && count($variations) > 0) {
            $varImages = array();
            foreach ($variations as $variation) {
                //if (isset($variation['image_src']) && isset($variation['image_link'])) {
                if (isset($variation['image_src']) && !empty($variation['image_src']) && isset($variation['image_link']) && !empty($variation['image_link'])) {
                    $img_name = str_replace(site_url(),'',$variation['image_link']);
                    $img = WooCommerce_MagicThumb_get_product_image($img_name,'original');
                    $thumb = WooCommerce_MagicThumb_get_product_image($img_name);
                    $selector = WooCommerce_MagicThumb_get_product_image($img_name,'selector');
                    $varImages[$variation['variation_id']] = array('link' => $variation['image_link'],
                                         'original' => $img,
                                         'thumb' => $thumb,
                                         'selector' => $selector); //array vith variations images
                }
            }
        }
    }
    //return $varImages;
    $jsonVariations = json_encode($varImages);
    if (empty($jsonVariations) || $jsonVariations == '' || $jsonVariations == false) {
        $jsonVariations = '';
    } else {
        $jsonVariations = '<script type="text/javascript">var WooCommerce_MagicThumb_variations = '.$jsonVariations.'
			      $mjs(document).je1(\'domready\', function() {
                                  if(typeof product_variations_'.$product->id.' === \'undefined\'){
                                      product_variations_'.$product->id.' = jQuery.parseJSON(jQuery(\'.variations_form\').attr(\'data-product_variations\'));
                                  };
                                  jQuery.each(WooCommerce_MagicThumb_variations,function(index,value) {
                                                                                                            if (typeof product_variations_'.$product->id.' != \'undefined\') {
														var resEl = jQuery.grep(product_variations_'.$product->id.', function(e){ return e.variation_id == index; });  
													    } else {
														var resEl = jQuery.grep(jQuery(\'form.variations_form\').data(\'product_variations\'), function(e){ return e.variation_id == index; });  
													    } 
                                                                                                            resEl[0].image_src = value.thumb; 
                                                                                                            resEl[0].image_link = value.original;
                                  });
                                  var onVarChange = jQuery._data(jQuery(\'form.variations_form\')[0], \'events\').found_variation[0].handler
                                  var onVarReset = jQuery._data(jQuery(\'form.variations_form\')[0], \'events\').reset_image[0].handler;
                                  if (typeof onVarChange !== \'undefined\') {
                                      jQuery(\'form.variations_form\').on(\'found_variation\',function(){
                                                                                                        onVarChange(t=false,n=false);
                                                                                                        MagicThumb.stop();
													jQuery(\'.MagicThumb\').attr(\'href\',jQuery(\'.invisImg\').attr(\'href\'));
													jQuery(\'.MagicThumb img\').attr(\'src\',jQuery(\'.invisImg img\').attr(\'src\'));
													MagicThumb.start();
                                                                                                        
                                                                                                        });
                                  }
                                  if (typeof onVarReset !== \'undefined\') {
                                      jQuery(\'form.variations_form\').on(\'reset_image\',function(){
                                                                                                        onVarReset(event=false);
                                                                                                        MagicThumb.stop();
													jQuery(\'.MagicThumb\').attr(\'href\',jQuery(\'.invisImg\').attr(\'href\'));
													jQuery(\'.MagicThumb img\').attr(\'src\',jQuery(\'.invisImg img\').attr(\'src\'));
													MagicThumb.start();
                                                                                                        });
                                  }
                              });
                          </script>';
    }
    return $jsonVariations;
}
function WooCommerce_MagicThumb_get_prepared_selectors () {
    require_once(dirname(__FILE__) . '/core/magictoolbox.imagehelper.class.php');
    $selectors = array();
    $plugin = $GLOBALS['magictoolbox']['WooCommerceMagicThumb'];
    $attachments = WooCommerce_MagicThumb_get_post_attachments();
    
    $id = '_Main';//$attachment->ID;
    $url = site_url();
    $shop_dir = ABSPATH;   
    $image_dir = 'wp-content/uploads/';
    $imagehelper = new MagicToolboxImageHelperClass($shop_dir, $image_dir.'magictoolbox_cache', $plugin->params, null, $url);
    
    if (isset($GLOBALS['MAGICTOOLBOX_'.strtoupper('MagicThumb').'_MAIN_IMAGE_SELECTOR'])) $selectors[] = $GLOBALS['MAGICTOOLBOX_'.strtoupper('MagicThumb').'_MAIN_IMAGE_SELECTOR'];
     
    if (isset($GLOBALS['MAGICTOOLBOX_'.strtoupper('MagicThumb').'_MAIN_IMAGE_SELECTOR'])) {
	$test_link = preg_replace('/.*?href=[\'\"](.*?)[\'\"].*/is','$1',$GLOBALS['MAGICTOOLBOX_'.strtoupper('MagicThumb').'_MAIN_IMAGE_SELECTOR']);
	if (count($attachments) == 1) {
	  if (basename($attachments[0]->guid) == basename($test_link)) return false;
	}
    } else {
	$test_link = false;
    }
    
    foreach ($attachments as $attachment) {
	if (is_object($attachment)) {
	    if (!preg_match('/image/is',$attachment->post_mime_type)) continue;
	    $meta = wp_get_attachment_metadata($attachment->ID);
	    if ($test_link) {
		if (basename($attachment->guid) == basename($test_link)) continue;
	    }
	    //$title = $alt = '';
	    $title = $alt = $attachment->post_title;
	    
	    if(isset($post_id)){
             $post_id=$post_id;
         }
         else{
             $post_id='';
         }
	    $img = $imagehelper->create( '/'.$image_dir.$meta['file'], 'original', $post_id);//$url.'/'.$image_dir.$meta['file'];
	    $medium = $imagehelper->create( '/'.$image_dir.$meta['file'], array($plugin->params->getValue('thumb-max-width'),$plugin->params->getValue('thumb-max-height')), $post_id);
	    $thumb = $imagehelper->create( '/'.$image_dir.$meta['file'], array($plugin->params->getValue('selector-max-width'),$plugin->params->getValue('selector-max-height')), $post_id);
	    $selectors[] = $plugin->subTemplate(compact('alt','img','medium','thumb','id','title'));
	} else { // thecartpress
	    $title = $alt = 'NO TITLE YET';
	    $file = preg_replace('/^.*?wp-content\/uploads\//is','',$attachment);
	    $img = $imagehelper->create( '/'.$image_dir.$file, 'original', $post_id);
	    $medium = $imagehelper->create( '/'.$image_dir.$file, array($plugin->params->getValue('thumb-max-width'),$plugin->params->getValue('thumb-max-height')), $post_id);
	    $thumb = $imagehelper->create( '/'.$image_dir.$file, array($plugin->params->getValue('selector-max-width'),$plugin->params->getValue('selector-max-height')), $post_id);
	    $selectors[] = $plugin->subTemplate(compact('alt','img','medium','thumb','id','title'));
	}
    }
    return $selectors;
}


function WooCommerce_MagicThumb_page_check ($moduleName = false) {
    switch (strtolower($moduleName)) {
        case 'wpecommerce' : {
            if (!WPSC_VERSION) return 'error';
            if (WPSC_PRESENTABLE_VERSION == '3.7.6.3' || WPSC_PRESENTABLE_VERSION == '3.7.6.4' || WPSC_PRESENTABLE_VERSION == '3.7.8') {
                if ($GLOBALS["wpsc_title_data"]["product"]) {
                    $cat = false;
                }else {
                    $cat = true;
                } 
            } else if (WPSC_VERSION == '3.8') {
                if (isset($GLOBALS['wp_the_query']->query_vars['wpsc-product']) && $GLOBALS['wp_the_query']->query_vars['wpsc-product'] != '') {
                    $cat = false;
                } else {
                    $cat = true;
                }
            } else if (WPSC_VERSION >= '3.8.1') {
                    if ( $GLOBALS['wp_the_query']->is_single == '1') { /*isset($GLOBALS['wp_the_query']->is_product) && $GLOBALS['wp_the_query']->is_product == '1'*/
                        $cat = false;
                    } else {
                        $cat = true;
                    }
            } else {
                if (!empty($GLOBALS['wp_query']->query_vars['product_url_name']) && $GLOBALS['wp_query']->query_vars['product_url_name'] != '') {
                    $cat = false;
                } else {
                    $cat = true;
                }
            }
        break;}
        case 'jigoshop' : {
            if (!JIGOSHOP_VERSION) return 'error';
            if (function_exists('is_product') && function_exists('is_product_list')) {
              if (is_product()) $cat = false; else $cat = true;
              if (is_product_list()) $cat = true; else $cat = false;
            } else {
              return 'error';
            }
        break;}
	case 'woocommerce' : {
            if (!WOOCOMMERCE_VERSION) return 'error';
            if (function_exists('is_product') && function_exists('is_product_category')) {
              if (is_product()) $cat = false; else $cat = true;
              //if (is_product_category()) $cat = true; else $cat = false;
            } else {
              return 'error';
            }
        break;}
        case 'thecartpress' : {
	    global $thecartpress;
            if (!isset($thecartpress->settings)) return 'error';
            if (function_exists('is_single')) {
              if (is_single()) $cat = false; else $cat = true;
            } else {
              return 'error';
            }
        break;}

        default : return 'error';
    }
    return $cat;
}

?>
