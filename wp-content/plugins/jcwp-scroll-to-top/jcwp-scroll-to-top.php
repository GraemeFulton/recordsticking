<?php
  /*
    Plugin Name: jcwp scroll to top
    Plugin URI: http://jaspreetchahal.org/wordpress-scroll-to-top-plugin
    Description: This plugin gives you granular control on styles and positioning of your 'Scroll to top' text. Many variety of easing animations supported.  
    Author: Jaspreet Chahal
    Version: 1.7
    Author URI: http://jaspreetchahal.org
    License: GPLv2 or later
    */

    /*
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    */
    
    // if not an admin just block access
    if(preg_match('/admin\.php/',$_SERVER['REQUEST_URI']) && is_admin() == false) {
        return false;
    }
    require_once 'JCUCNMobile_Detect.php';
    $detectjcucn = new JCUCNMobile_Detect();
    register_activation_hook(__FILE__,'jcorgstp_activate');
    function jcorgstp_activate() {
            add_option('jcorgstp_active','1');
            add_option('jcorgstp_duration',1000);
            add_option('jcorgstp_scroleActivateAt',200);
            add_option('jcorgstp_scrollElementId',"jcScrollTop");
            add_option('jcorgstp_easingType',"easeInOutQuad");
            add_option('jcorgstp_position','right');
            add_option('jcorgstp_scrollText',"Scroll to top");
            add_option('jcorgstp_backgroundColor','#c00');
            add_option('jcorgstp_foreColor','#FFF');
            add_option('jcorgstp_fontFamily','Calibri');
            add_option('jcorgstp_fontSize','15px');
            add_option('jcorgstp_fontWeight','bold');
            add_option('jcorgstp_textPadding','5px');
            add_option('jcorgstp_zindex','999999 !important');
            add_option('jcorgstp_containerWidth','120px');
            add_option('jcorgstp_containerBorder','#960404');
            add_option('jcorgstp_borderRadius','10px 10px 0px 0px');
            add_option('jcorgstp_disableon_tablet','');
            add_option('jcorgstp_disableon_mobile','');
            add_option('jcorgstp_callback','function(){}');
            add_option('jcorgstp_linkback','No');
    }
    
    add_action("admin_menu","jcorgstp_menu");
    function jcorgstp_menu() {
        add_options_page('JCWP SrollToTop', 'JCWP Scroll To Top', 'manage_options', 'jcorgstp-plugin', 'jcorgstp_plugin_options');
    }
    add_action('admin_init','jcorgstp_regsettings');
    function jcorgstp_regsettings() {
        add_option("jcorgstp_linkback_text","");
        register_setting("jcorgstp-setting","jcorgstp_active");
        register_setting("jcorgstp-setting","jcorgstp_duration");
        register_setting("jcorgstp-setting","jcorgstp_scroleActivateAt");
        register_setting("jcorgstp-setting","jcorgstp_scrollElementId");
        register_setting("jcorgstp-setting","jcorgstp_easingType");     
        register_setting("jcorgstp-setting","jcorgstp_position");     
        register_setting("jcorgstp-setting","jcorgstp_scrollText");     
        register_setting("jcorgstp-setting","jcorgstp_backgroundColor");     
        register_setting("jcorgstp-setting","jcorgstp_foreColor");     
        register_setting("jcorgstp-setting","jcorgstp_fontSize");     
        register_setting("jcorgstp-setting","jcorgstp_fontFamily");     
        register_setting("jcorgstp-setting","jcorgstp_fontWeight");     
        register_setting("jcorgstp-setting","jcorgstp_textPadding");     
        register_setting("jcorgstp-setting","jcorgstp_containerWidth");     
        register_setting("jcorgstp-setting","jcorgstp_zindex");     
        register_setting("jcorgstp-setting","jcorgstp_containerBorder");     
        register_setting("jcorgstp-setting","jcorgstp_borderRadius");     
        register_setting("jcorgstp-setting","jcorgstp_callback");
        register_setting("jcorgstp-setting","jcorgstp_disableon_mobile");
        register_setting("jcorgstp-setting","jcorgstp_disableon_tablet");
        register_setting("jcorgstp-setting","jcorgstp_linkback");
        wp_enqueue_script('jquery');
        wp_enqueue_script('jqueryui');
    }
    
    
    add_action('wp_head','jcorgstp_init');
    function jcorgstp_init() {
        global $detectjcucn;
        if((get_option("jcorgstp_disableon_mobile") == "Yes" && $detectjcucn->isMobile()) || (get_option("jcorgstp_disableon_tablet") == "Yes" && $detectjcucn->isTablet())) {
            return;
        }
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');    
        wp_enqueue_script('jcorgstp_script',plugins_url("jcScrollTop.min.js",__FILE__), array('jquery', 'jquery-ui-core', 'jquery-effects-core'),'1.5');
            
    }
    add_action('wp_footer','jcorgstp_inclscript',20);
    function jcorgstp_inclscript() {
        global $detectjcucn;
        if((get_option("jcorgstp_disableon_mobile") == "Yes" && $detectjcucn->isMobile()) || (get_option("jcorgstp_disableon_tablet") == "Yes" && $detectjcucn->isTablet())) {
            return;
        }
        if(get_option('jcorgstp_active') == "1") {
        ?> 
         <script> 
         jQuery(window).load(function() {
            jQuery().jcScrollTop({
                duration:<?php echo strlen(trim(get_option("jcorgstp_duration")))>0?trim(get_option("jcorgstp_duration")):'1000'?>, 
               scroleActivateAt:<?php echo strlen(trim(get_option("jcorgstp_scroleActivateAt")))>0?trim(get_option("jcorgstp_scroleActivateAt")):'200'?>,
               scrollElementId:"<?php echo strlen(trim(get_option("jcorgstp_scrollElementId")))>0?trim(get_option("jcorgstp_scrollElementId")):'jcorgScrollToTop'?>",
               easingType:"<?php echo strlen(trim(get_option("jcorgstp_easingType")))>0?trim(get_option("jcorgstp_easingType")):'linear'?>",
               position:'<?php echo strlen(trim(get_option("jcorgstp_position")))>0?trim(get_option("jcorgstp_position")):'right'?>',
               scrollText:"<?php echo strlen(trim(get_option("jcorgstp_scrollText")))>0?trim(get_option("jcorgstp_scrollText")):'Scroll to top'?>",
               backgroundColor:'<?php echo strlen(trim(get_option("jcorgstp_backgroundColor")))>0?trim(get_option("jcorgstp_backgroundColor")):'#c00'?>',
               foreColor:"<?php echo strlen(trim(get_option("jcorgstp_foreColor")))>0?trim(get_option("jcorgstp_foreColor")):'#FFF'?>",
               fontFamily:"<?php echo strlen(trim(get_option("jcorgstp_fontFamily")))>0?trim(get_option("jcorgstp_fontFamily")):'Calibri'?>",
                fontSize:'<?php echo strlen(trim(get_option("jcorgstp_fontSize")))>0?trim(get_option("jcorgstp_fontSize")):'15px'?>',
                zIndex:'<?php echo strlen(trim(get_option("jcorgstp_zindex")))>0?trim(get_option("jcorgstp_zindex")):'1 !important'?>',
                fontWeight:'<?php echo strlen(trim(get_option("jcorgstp_fontWeight")))>0?trim(get_option("jcorgstp_fontWeight")):'bold'?>',
               textPadding:'<?php echo strlen(trim(get_option("jcorgstp_textPadding")))>0?trim(get_option("jcorgstp_textPadding")):'5px'?>',
               containerWidth:'<?php echo strlen(trim(get_option("jcorgstp_containerWidth")))>0?trim(get_option("jcorgstp_containerWidth")):'120px'?>',
               containerBorder:'2px solid <?php echo strlen(trim(get_option("jcorgstp_containerBorder")))>0?trim(get_option("jcorgstp_containerBorder")):'#960404'?>',
               borderRadius:'<?php echo strlen(trim(get_option("jcorgstp_borderRadius")))>0?trim(get_option("jcorgstp_borderRadius")):'10px 10px 0px 0px'?>',           
               callback:<?php echo strlen(trim(get_option("jcorgstp_callback")))>0?trim(get_option("jcorgstp_callback")):'function(){}'?>
            });  
         });
         </script>
         
        <?php

            if(get_option('jcorgstp_linkback') =="Yes") {
                $link_text = array("Scroll to top plugin","Scroll to top WordPress plugin","Scroll Plugin by JaspreetChahal.org","WordPress Scroll to top plugin","WordPress Scroll to top plugin powered by JaspreetChahal.org","http://jaspreetchahal.org","WordPress Scroll to top plugin by Jaspreet Chahal","WordPress Scroll to top plugin powered by Jaspreet Chahal","Animated Scroll to top plugin by Jaspreet Chahal","Ultimate Scroll to top plugin","Wordpress Ultimate scroll to top plugin","Smooth scroll to top plugin","Wordpress Slow scroll to top plugin","Scroll plugin by JaspreetChahal.org","Wordpress scroll plugin by JaspreetChahal.org","Wordpress smooth scroll to top plugin","Smooth Back to top plugin by http://jaspreetchahal.org","Back to top plugin by JaspreetChahal.org","Wordpress Back to top plugin","Wordpress Back to top plugin by Jaspreet Chahal","Wordpress Back to top plugin powered by http://jaspreetchahal.org");
                if(get_option("jcorgstp_linkback_text") === FALSE || get_option("jcorgstp_linkback_text") == "") {
                    add_option("jcorgstp_linkback_text","");
                    update_option("jcorgstp_linkback_text",$link_text[rand(0,count($link_text)-1)]);
                }
                echo '<a style="margin-left:45%;color:transparent;cursor:default;font-size:0.01em !important;" href="http://jaspreetchahal.org">'.get_option("jcorgstp_linkback_text").'</a>';
            }


        }
    }
    
    function jcorgstp_plugin_options() {
        jcorgStpDonationDetail();
           
        ?> 
        <style type="text/css">
        .jcorgbsuccess, .jcorgberror {   border: 1px solid #ccc; margin:0px; padding:15px 10px 15px 50px; font-size:12px;}
        .jcorgbsuccess {color: #FFF;background: green; border: 1px solid  #FEE7D8;}
        .jcorgberror {color: #B70000;border: 1px solid  #FEE7D8;}
        .jcorgb-errors-title {font-size:12px;color:black;font-weight:bold;}
        .jcorgb-errors { border: #FFD7C4 1px solid;padding:5px; background: #FFF1EA;}
        .jcorgb-errors ul {list-style:none; color:black; font-size:12px;margin-left:10px;}
        .jcorgb-errors ul li {list-style:circle;line-height:150%;/*background: url(/images/icons/star_red.png) no-repeat left;*/font-size:11px;margin-left:10px; margin-top:5px;font-weight:normal;padding-left:15px}
        td {font-weight: normal;}
        </style><br>
        <div class="wrap" style="float: left;" >
            <?php             
            
            screen_icon('tools');?>
            <h2>JaspreetChahal's Scroll to top plugin settings</h2>
            <?php 
                $errors = get_settings_errors("",true);
                $errmsgs = array();
                $msgs = "";
                if(count($errors) >0)
                foreach ($errors as $error) {
                    if($error["type"] == "error")
                        $errmsgs[] = $error["message"];
                    else if($error["type"] == "updated")
                        $msgs = $error["message"];
                }

                echo jcorgStpMakeErrorsHtml($errmsgs,'warning1');
                if(strlen($msgs) > 0) {
                    echo "<div class='jcorgbsuccess' style='width:90%'>$msgs</div>";
                }

            ?><br><br>
            <form action="options.php" method="post" id="jcorgbotinfo_settings_form">
            <?php settings_fields("jcorgstp-setting");?>
            <table class="widefat" style="width: 700px;" cellpadding="7">
                <tr valign="top">
                    <th scope="row">Enabled</th>
                    <td><input type="radio" name="jcorgstp_active" <?php if(get_option('jcorgstp_active') == "1"|| get_option('jcorgstp_active') == "") echo "checked='checked'";?>
                            value="1" 
                            /> Yes
                            <input type="radio" name="jcorgstp_active" <?php if(get_option('jcorgstp_active') == "0" ) echo "checked='checked'";?>
                            value="0" 
                            /> No 
                    </td>
                </tr>  
                <tr valign="top">
                    <th width="25%" scope="row">Animation Duration</th>
                    <td><input type="number" name="jcorgstp_duration"
                            value="<?php echo get_option('jcorgstp_duration'); ?>"  style="padding:5px" size="40"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show when scroll at</th>
                    <td><input type="number" name="jcorgstp_scroleActivateAt"
                            value="<?php echo get_option('jcorgstp_scroleActivateAt'); ?>"  style="padding:5px" size="40"/>px (number only)</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show Element ID</th>
                    <td><input type="text" name="jcorgstp_scrollElementId"
                               value="<?php echo get_option('jcorgstp_scrollElementId'); ?>"  style="padding:5px" size="40"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Element Z-Index</th>
                    <td><input type="text" name="jcorgstp_zindex"
                               value="<?php echo get_option('jcorgstp_zindex'); ?>"  style="padding:5px" size="40"/> (value with !important is recommended in many cases)</td>
                </tr>
                <tr valign="top">
                    <th scope="row">Easing type</th>
                    <td>
                    <select name="jcorgstp_easingType">
                    <option value="linear" <?php if(get_option('jcorgstp_easingType') == "linear"){  _e('selected');}?> >linear</option>
                    <option value="swing" <?php if(get_option('jcorgstp_easingType') == "swing") { _e('selected');}?> >swing</option>
                    <option value="easeInQuad" <?php if(get_option('jcorgstp_easingType') == "easeInQuad") { _e('selected');}?> >easeInQuad</option>
                    <option value="easeOutQuad" <?php if(get_option('jcorgstp_easingType') == "easeOutQuad") { _e('selected');}?> >easeOutQuad</option>
                    <option value="easeInOutQuad" <?php if(get_option('jcorgstp_easingType') == "easeInOutQuad") { _e('selected');}?> >easeInOutQuad</option>
                    <option value="easeInCubic" <?php if(get_option('jcorgstp_easingType') == "easeInCubic") { _e('selected');}?> >easeInCubic</option>
                    <option value="easeOutCubic" <?php if(get_option('jcorgstp_easingType') == "easeOutCubic") { _e('selected');}?> >easeOutCubic</option>
                    <option value="easeInOutCubic" <?php if(get_option('jcorgstp_easingType') == "easeInOutCubic") { _e('selected');}?> >easeInOutCubic</option>
                    <option value="easeInQuart" <?php if(get_option('jcorgstp_easingType') == "easeInQuart") { _e('selected');}?> >easeInQuart</option>
                    <option value="easeOutQuart" <?php if(get_option('jcorgstp_easingType') == "easeOutQuart") { _e('selected');}?> >easeOutQuart</option>
                    <option value="easeInOutQuart" <?php if(get_option('jcorgstp_easingType') == "easeInOutQuart") { _e('selected');}?> >easeInOutQuart</option>
                    <option value="easeInQuint" <?php if(get_option('jcorgstp_easingType') == "easeInQuint") { _e('selected');}?> >easeInQuint</option>
                    <option value="easeOutQuint" <?php if(get_option('jcorgstp_easingType') == "easeOutQuint") { _e('selected');}?> >easeOutQuint</option>
                    <option value="easeInOutQuint" <?php if(get_option('jcorgstp_easingType') == "easeInOutQuint") { _e('selected');}?> >easeInOutQuint</option>
                    <option value="easeInSine" <?php if(get_option('jcorgstp_easingType') == "easeInSine") { _e('selected');}?> >easeInSine</option>
                    <option value="easeOutSine" <?php if(get_option('jcorgstp_easingType') == "easeOutSine") { _e('selected');}?> >easeOutSine</option>
                    <option value="easeInOutSine" <?php if(get_option('jcorgstp_easingType') == "easeInOutSine") { _e('selected');}?> >easeInOutSine</option>
                    <option value="easeInExpo" <?php if(get_option('jcorgstp_easingType') == "easeInExpo") { _e('selected');}?> >easeInExpo</option>
                    <option value="easeOutExpo" <?php if(get_option('jcorgstp_easingType') == "easeOutExpo") { _e('selected');}?> >easeOutExpo</option>
                    <option value="easeInOutExpo" <?php if(get_option('jcorgstp_easingType') == "easeInOutExpo") { _e('selected');}?> >easeInOutExpo</option>
                    <option value="easeInElastic" <?php if(get_option('jcorgstp_easingType') == "easeInElastic") { _e('selected');}?> >easeInElastic</option>
                    <option value="easeOutElastic" <?php if(get_option('jcorgstp_easingType') == "easeOutElastic") { _e('selected');}?> >easeOutElastic</option>
                    <option value="easeInOutElastic" <?php if(get_option('jcorgstp_easingType') == "easeInOutElastic") { _e('selected');}?> >easeInOutElastic</option>
                    <option value="easeInOutBack" <?php if(get_option('jcorgstp_easingType') == "easeInOutBack") { _e('selected');}?> >easeInOutBack</option>
                    <option value="easeInOutBounce" <?php if(get_option('jcorgstp_easingType') == "easeInOutBounce") { _e('selected');}?> >easeInOutBounce</option>
                    </select>
               </tr>
                <tr valign="top">
                    <th scope="row">Position</th>
                    <td><input type="radio" name="jcorgstp_position" <?php if(get_option('jcorgstp_position') == "left") echo "checked='checked'";?>
                            value="left" 
                            /> Left
                            <input type="radio" name="jcorgstp_position" <?php if(get_option('jcorgstp_position') == "center" || get_option('jcorgstp_position') == "") echo "checked='checked'";?>
                            value="center" 
                            /> Center 
                            <input type="radio" name="jcorgstp_position" <?php if(get_option('jcorgstp_position') == "right") echo "checked='checked'";?>
                            value="right" 
                            /> Right 
                    </td>
                </tr> 
                   
        
                <tr valign="top">
                    <th scope="row">Text to display</th>
                    <td><input type="text" name="jcorgstp_scrollText"
                            value="<?php echo get_option('jcorgstp_scrollText'); ?>"  style="padding:5px" size="40"/> e.g. Scroll To Top</td>
                </tr> 
                <tr valign="top">
                    <th scope="row">Background Color</th>
                    <td><input type="text" name="jcorgstp_backgroundColor" id="jcorgstp_backgroundColor"
                            value="<?php echo get_option('jcorgstp_backgroundColor'); ?>"  style="padding:5px" size="40"/> e.g. #C00</td>
                </tr>  
                <tr valign="top">
                    <th scope="row">Font Color</th>
                    <td><input type="text" name="jcorgstp_foreColor"
                            value="<?php echo get_option('jcorgstp_foreColor'); ?>"  style="padding:5px" size="40"/> e.g. #FFF</td>
                </tr>  
                <tr valign="top">
                    <th scope="row">Font Size</th>
                    <td><input type="text" name="jcorgstp_fontSize"
                            value="<?php echo get_option('jcorgstp_fontSize'); ?>"  style="padding:5px" size="40"/> e.g. 18px</td>
                </tr>   
                <tr valign="top">
                    <th scope="row">Font family</th>
                    <td><input type="text" name="jcorgstp_fontFamily"
                            value="<?php echo get_option('jcorgstp_fontFamily'); ?>"  style="padding:5px" size="40"/> e.g. 18px</td>
                </tr>  
                <tr valign="top">
                    <th scope="row">Font weight</th>
                    <td><input type="radio" name="jcorgstp_fontWeight" <?php if(get_option('jcorgstp_fontWeight') == "normal") echo "checked='checked'";?>
                            value="normal" 
                            /> Normal
                            <input type="radio" name="jcorgstp_fontWeight" <?php if(get_option('jcorgstp_fontWeight') == "bold" || get_option('jcorgstp_fontWeight') == "") echo "checked='checked'";?>
                            value="bold" 
                            /> Bold 
                    </td>
                </tr>        
                <tr valign="top">
                    <th scope="row">Text Padding</th>
                    <td><input type="text" name="jcorgstp_textPadding"
                            value="<?php echo get_option('jcorgstp_textPadding'); ?>"  style="padding:5px" size="40"/> e.g. 5px</td>
                </tr>     
                <tr valign="top">
                    <th scope="row">Container Width</th>
                    <td><input type="text" name="jcorgstp_containerWidth"
                            value="<?php echo get_option('jcorgstp_containerWidth'); ?>"  style="padding:5px" size="40"/> e.g. 120px</td>
                </tr>         
                <tr valign="top">
                    <th scope="row">Container Border Colour</th>
                    <td><input type="text" name="jcorgstp_containerBorder"
                            value="<?php echo get_option('jcorgstp_containerBorder'); ?>"  style="padding:5px" size="40"/> e.g. #000</td>
                </tr> 
                <tr valign="top">
                    <th scope="row">Container Border Radius</th>
                    <td><input type="text" name="jcorgstp_borderRadius"
                            value="<?php echo get_option('jcorgstp_borderRadius'); ?>"  style="padding:5px" size="40"/> e.g. 10px 10px 0px 0px</td>
                </tr> 
                <tr valign="top">
                    <th scope="row">Callback Function </th>
                    <td><input type="text" name="jcorgstp_callback"
                            value="<?php echo get_option('jcorgstp_callback'); ?>"  style="padding:5px" size="40"/> <br>
                            If you want to glue some function to be called when scroll to top has finished. <br><Strong>Leave blank if not required or just keep the default value</strong></td>
                </tr> 
                <tr valign="top">
                    <th scope="row">Disable on</th>
                    <td>
                        <input type="checkbox" name="jcorgstp_disableon_mobile"
                            value="Yes" <?php if(get_option('jcorgstp_disableon_mobile') =="Yes") echo "checked='checked'";?> /> Mobile Phones <br>
                        <input type="checkbox" name="jcorgstp_disableon_tablet"
                            value="Yes" <?php if(get_option('jcorgstp_disableon_tablet') =="Yes") echo "checked='checked'";?> /> Tablets
                            </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Link to authors website</th>
                    <td><input type="checkbox" name="jcorgstp_linkback"
                               value="Yes" <?php if(get_option('jcorgstp_linkback') =="Yes") echo "checked='checked'";?> /> <br>
                        <Strong>An un-noticeable link will be placed in the footer which points to authors website http://jaspreetchahal.org. Please check this checkbox to support this plugin for future.</strong></td>
                </tr>
            </table>
        <p class="submit">
            <input type="submit" class="button-primary"
                value="Save Changes" />
        </p>          
            </form>
        </div>
        <?php     
        echo "<div style='float:left;margin-left:20px;margin-top:75px'>".jcorgStpfeeds()."</div>";
    }
    
    function jcorgStpDonationDetail() {
        ?>    
        <style type="text/css"> .jcorgcr_donation_uses li {float:left; margin-left:20px;font-weight: bold;} </style> 
        <div style="padding: 10px; background: #f1f1f1;border:1px #EEE solid; border-radius:15px;width:98%"> 
        <h2>If you like this Plugin, please consider donating</h2> 
        You can choose your own amount. Developing this awesome plugin took a lot of effort and time; days and weeks of continuous voluntary unpaid work. 
        If you like this plugin or if you are using it for commercial websites, please consider a donation to the author to 
        help support future updates and development. 
        <div class="jcorgcr_donation_uses"> 
        <span style="font-weight:bold">Main uses of Donations</span><ol ><li>Web Hosting Fees</li><li>Cable Internet Fees</li><li>Time/Value Reimbursement</li><li>Motivation for Continuous Improvements</li></ol> </div> <br class="clear"> <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MHMQ6E37TYW3N"><img src="https://www.paypalobjects.com/en_AU/i/btn/btn_donateCC_LG.gif" /></a> <br><br><strong>For help please visit </strong><br> 
        <a href="http://jaspreetchahal.org/wordpress-scroll-to-top-plugin">http://jaspreetchahal.org/wordpress-scroll-to-top-plugin</a> <br><strong> </div>
        
        <?php
        
    }
    function jcorgStpfeeds() {
        $list = "
        <table style='width:400px;' class='widefat'>
        <tr>
            <th>
            Latest posts from JaspreetChahal.org
            </th>
        </tr>
        ";
        $max = 5;
        $feeds = fetch_feed("http://feeds.feedburner.com/jaspreetchahal/mtDg");
        $cfeeds = $feeds->get_item_quantity($max); 
        $feed_items = $feeds->get_items(0, $cfeeds); 
        if ($cfeeds > 0) {
            foreach ( $feed_items as $feed ) {    
                if (--$max >= 0) {
                    $list .= " <tr><td><a href='".$feed->get_permalink()."'>".$feed->get_title()."</a> </td></tr>";}
            }            
        }
        return $list."</table>";
    }
    
    
    function jcorgStpMakeErrorsHtml($errors,$type="error")
    {
        $class="jcorgberror";
        $title=__("Please correct the following errors","jcorgbot");
        if($type=="warnings") {
            $class="jcorgberror";
            $title=__("Please review the following Warnings","jcorgbot");
        }
        if($type=="warning1") {
            $class="jcorgbwarning";
            $title=__("Please review the following Warnings","jcorgbot");
        }
        $strCompiledHtmlList = "";
        if(is_array($errors) && count($errors)>0) {
                $strCompiledHtmlList.="<div class='$class' style='width:90% !important'>
                                        <div class='jcorgb-errors-title'>$title: </div><ol>";
                foreach($errors as $error) {
                      $strCompiledHtmlList.="<li>".$error."</li>";
                }
                $strCompiledHtmlList.="</ol></div>";
        return $strCompiledHtmlList;
        }
    }