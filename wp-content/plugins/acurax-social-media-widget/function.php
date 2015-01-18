<?php
error_reporting(0);
//*************** Include style.css in Header ********
// Getting Option From DB *****************************	
$acx_widget_si_theme = get_option('acx_widget_si_theme');
$acx_widget_si_credit = get_option('acx_widget_si_credit');
$acx_widget_si_facebook = get_option('acx_widget_si_facebook');
$acx_widget_si_youtube = get_option('acx_widget_si_youtube');
$acx_widget_si_twitter = get_option('acx_widget_si_twitter');
$acx_widget_si_linkedin = get_option('acx_widget_si_linkedin');
$acx_widget_si_gplus = get_option('acx_widget_si_gplus');
$acx_widget_si_pinterest = get_option('acx_widget_si_pinterest');
$acx_widget_si_feed = get_option('acx_widget_si_feed');
$acx_widget_si_icon_size = get_option('acx_widget_si_icon_size');
$acx_si_smw_menu_highlight = get_option('acx_si_smw_menu_highlight');
$acx_si_smw_float_fix = get_option('acx_si_smw_float_fix');
$acx_si_smw_theme_warning_ignore = get_option('acx_si_smw_theme_warning_ignore');
// *****************************************************

// Options Value Checker
function acx_widget_option_value_check($option_name,$yes,$no)
{ 	$acx_widget_si_option_set = get_option($option_name);
	if ($acx_widget_si_option_set != "") { echo $yes; } else { echo $no; }
}
function acurax_si_widget_simple($theme = "")
{
	// Getting Globals *****************************	
	global $acx_widget_si_theme, $acx_widget_si_credit , $acx_widget_si_twitter, $acx_widget_si_facebook, $acx_widget_si_youtube,$acx_widget_si_gplus,
	$acx_widget_si_linkedin, $acx_widget_si_pinterest, $acx_widget_si_feed, $acx_widget_si_icon_size;
	// *****************************************************
	if ($theme == "") { $acx_widget_si_touse_theme = $acx_widget_si_theme; } else { $acx_widget_si_touse_theme = $theme; }
		//******** MAKING EACH BUTTON LINKS ********************
		if	($acx_widget_si_twitter == "") { $twitter_link = ""; } else 
		{
			$twitter_link = "<a href='http://www.twitter.com/". $acx_widget_si_twitter ."' target='_blank' title='Visit Us On Twitter'>" . "<img src=" . 
			plugins_url('images/themes/'. $acx_widget_si_touse_theme .'/twitter.png', __FILE__) . " style='border:0px;' alt='Visit Us On Twitter' /></a>";
		}
		if	($acx_widget_si_facebook == "") { $facebook_link = ""; } else 
		{
			$facebook_link = "<a href='". $acx_widget_si_facebook ."' target='_blank' title='Visit Us On Facebook'>" . "<img src=" . plugins_url('images/themes/'
			. $acx_widget_si_touse_theme .'/facebook.png', __FILE__) . " style='border:0px;' alt='Visit Us On Facebook' /></a>";
		}
		if	($acx_widget_si_gplus == "") { $gplus_link = ""; } else 
		{
			$gplus_link = "<a href='". $acx_widget_si_gplus ."' target='_blank' title='Visit Us On GooglePlus'>" . "<img src=" . plugins_url('images/themes/'. 
			$acx_widget_si_touse_theme .'/googleplus.png', __FILE__) . " style='border:0px;' alt='Visit Us On GooglePlus' /></a>";
		}
		if	($acx_widget_si_pinterest == "") { $pinterest_link = ""; } else 
		{
			$pinterest_link = "<a href='". $acx_widget_si_pinterest ."' target='_blank' title='Visit Us On Pinterest'>" . "<img src=" . plugins_url(
			'images/themes/'. $acx_widget_si_touse_theme .'/pinterest.png', __FILE__) . " style='border:0px;' alt='Visit Us On Pinterest' /></a>";
		}
		if	($acx_widget_si_youtube == "") { $youtube_link = ""; } else 
		{
			$youtube_link = "<a href='". $acx_widget_si_youtube ."' target='_blank' title='Visit Us On Youtube'>" . "<img src=" . plugins_url('images/themes/'. 
			$acx_widget_si_touse_theme .'/youtube.png', __FILE__) . " style='border:0px;' alt='Visit Us On Youtube' /></a>";
		}
		if	($acx_widget_si_linkedin == "") { $linkedin_link = ""; } else 
		{
			$linkedin_link = "<a href='". $acx_widget_si_linkedin ."' target='_blank' title='Visit Us On Linkedin'>" . "<img src=" . plugins_url('images/themes/'
			. $acx_widget_si_touse_theme .'/linkedin.png', __FILE__) . " style='border:0px;' alt='Visit Us On Linkedin' /></a>";
		}
		if	($acx_widget_si_feed == "") { $feed_link = ""; } else 
		{
			$feed_link = "<a href='". $acx_widget_si_feed ."' target='_blank' title='Check Our Feed'>" . "<img src=" . plugins_url('images/themes/'
			. $acx_widget_si_touse_theme .'/feed.png', __FILE__) . " style='border:0px;' alt='Check Our Feed' /></a>";
		}
		$social_widget_icon_array_order = get_option('social_widget_icon_array_order');
	$social_widget_icon_array_order = unserialize($social_widget_icon_array_order);
	foreach ($social_widget_icon_array_order as $key => $value)
	{
		if ($value == 0) { echo $twitter_link; } 
		else if ($value == 1) { echo $facebook_link; } 
		else if ($value == 2) { echo $gplus_link; } 
		else if ($value == 3) { echo $pinterest_link; } 
		else if ($value == 4) { echo $youtube_link; } 
		else if ($value == 5) { echo $linkedin_link; } 
		
		else if ($value == 6) { echo $feed_link; }
	}
} //acurax_si_widget_simple()
// Check Credit Link
function check_widget_acx_credit($yes,$no)
{ 	$acx_widget_si_credit = get_option('acx_widget_si_credit');
	if($acx_widget_si_credit != "no") { echo $yes; } else { echo $no; } 
}
function acx_widget_theme_check_wp_head() {
	$template_directory = get_template_directory();
	// If header.php exists in the current theme, scan for "wp_head"
	$file = $template_directory . '/header.php';
	if (is_file($file)) {
		$search_string = "wp_head";
		$file_lines = @file($file);
		
		foreach ($file_lines as $line) {
			$searchCount = substr_count($line, $search_string);
			if ($searchCount > 0) {
				return true;
			}
		}
		
		// wp_head() not found:
		echo "<div class=\"highlight\" style=\"width: 99%; margin-top: 10px; margin-bottom: 10px; border: 1px solid darkred;\">" . "Your theme needs to be fixed for plugins to work. To fix your theme, use the <a href=\"theme-editor.php\">Theme Editor</a> to insert <code>&lt;?php wp_head(); ?&gt;</code> just before the <code>&lt;/head&gt;</code> line of your theme's <code>header.php</code> file." . "</div>";
	}
} // theme check 
if($acx_si_smw_theme_warning_ignore != "yes")
{
add_action('admin_notices', 'acx_widget_theme_check_wp_head');
}
function acurax_widget_icons()
{
	global $acx_widget_si_theme, $acx_widget_si_credit, $acx_widget_si_twitter, $acx_widget_si_facebook, $acx_widget_si_youtube, 		
	$acx_widget_si_linkedin, $acx_widget_si_gplus, $acx_widget_si_pinterest, $acx_widget_si_feed, $acx_widget_si_icon_size;
			
	if($acx_widget_si_twitter != "" || $acx_widget_si_facebook != "" || $acx_widget_si_youtube != "" || $acx_widget_si_linkedin != ""  || 
	$acx_widget_si_pinterest != "" || $acx_widget_si_gplus != "" || $acx_widget_si_feed != "")
	{
	//*********************** STARTED DISPLAYING THE ICONS ***********************
		echo "\n\n\n<!-- Starting Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n";
		echo "<div id='acx_social_widget' style='text-align:center;'>";
		acurax_si_widget_simple();		
		echo "</div>\n";
		echo "<!-- Ending Icon Display Code For Social Media Icon From Acurax International www.acurax.com -->\n\n\n";
	//*****************************************************************************
	} // Chking null fields
	
} // Ending acurax_widget_icons();
function extra_style_acx_widget_icon()
{
	global $acx_widget_si_icon_size;
	global $acx_si_smw_float_fix;
		echo "\n\n\n<!-- Starting Styles For Social Media Icon From Acurax International www.acurax.com -->\n<style type='text/css'>\n";
		echo "#acx_social_widget img \n{\n";
		echo "width: " . $acx_widget_si_icon_size . "px; \n}\n";
				echo "#acx_social_widget \n{\n";
				echo "min-width:0px; \n";
				echo "position: static; \n}\n";
			if ($acx_si_smw_float_fix == "yes") 
			{
				echo ".acx_smw_float_fix a \n{\n";
				echo "display:inline-block; \n}\n";
			}
				
		echo "</style>\n<!-- Ending Styles For Social Media Icon From Acurax International www.acurax.com -->\n\n\n\n";
}	add_action('admin_head', 'extra_style_acx_widget_icon'); // ADMIN
	add_action('wp_head', 'extra_style_acx_widget_icon'); // PUBLIC 
function acx_widget_si_admin_style()  // Adding Style For Admin
{
global $acx_si_smw_menu_highlight;
	echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('style_admin.css', __FILE__). '">';
	if ($acx_si_smw_menu_highlight != "no") {
	echo '<link rel="stylesheet" type="text/css" href="' .plugins_url('dynamic_admin_style.css', __FILE__). '">';
	}
}	add_action('admin_head', 'acx_widget_si_admin_style'); // ADMIN
$acx_widget_si_sc_id = 0; // Defined to assign shortcode unique id
function DISPLAY_WIDGET_acurax_widget_icons_SC($atts)
{
	global $acx_widget_si_icon_size, $acx_widget_si_sc_id;
	extract(shortcode_atts(array(
	"theme" => '',
	"size" => $acx_widget_si_icon_size,
	"autostart" => 'false'
	), $atts));
	if ($theme > ACX_SOCIALMEDIA_WIDGET_TOTAL_THEMES) { $theme = ""; }
	if (!is_numeric($theme)) { $theme = ""; }
	if ($size > 55) { $size = $acx_widget_si_icon_size; }
	if (!is_numeric($size)) { $size = $acx_widget_si_icon_size; }
		$acx_widget_si_sc_id = $acx_widget_si_sc_id + 1;
		ob_start();
		echo "<style>\n";
		echo "#short_code_si_icon img \n {";
		echo "width:" . $size . "px; \n}\n";
		echo ".scid-" . $acx_widget_si_sc_id . " img \n{\n";
		echo "width:" . $size . "px !important; \n}\n";
		echo "</style>";
		echo "<div id='short_code_si_icon' style='text-align:center;' class='acx_smw_float_fix scid-" . $acx_widget_si_sc_id . "'>";
		acurax_si_widget_simple($theme);
		echo "</div>";
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
} // DISPLAY_WIDGET_acurax_widget_icons_SC
			
function acx_widget_si_custom_admin_js()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
}	add_action( 'admin_enqueue_scripts', 'acx_widget_si_custom_admin_js' );
// wp-admin Notices >> Finish Upgrade
function acx_widget_si_pluign_upgrade_not_finished()
{
    echo '<div class="error">
		  <p><b>Thanks for updating Acurax Social Media Widget Plugin... You need to visit <a href="admin.php?page=Acurax-Social-Widget-Settings">Plugin\'s Settings Page</a> to Complete the Updating Process - <a href="admin.php?page=Acurax-Social-Widget-Settings">Click Here Visit Social Icon Plugin Settings</a></b></p>
		  </div>';
}
$total_arrays = 7; // Number Of Services
$social_widget_icon_array_order = get_option('social_widget_icon_array_order');
$social_widget_icon_array_order = unserialize($social_widget_icon_array_order);
$social_widget_icon_array_count = count($social_widget_icon_array_order); 
if ($social_widget_icon_array_count < $total_arrays) 
{
	add_action('admin_notices', 'acx_widget_si_pluign_upgrade_not_finished',1);
}
function enqueue_acx_widget_si_style()
{
	wp_enqueue_style ( 'acx-widget-si-style', plugins_url('style.css', __FILE__) );
}	add_action( 'wp_print_styles', 'enqueue_acx_widget_si_style' );
function acx_widget_si_pluign_finish_version_update()
{
    echo '<div id="message" class="updated">
		  <p><b>Thanks for updating Acurax Social Media Widget Plugin... You need to visit <a href="admin.php?page=Acurax-Social-Widget-Settings&status=updated#updated">Plugin\'s Settings Page</a> to Complete the Updating Process - <a href="admin.php?page=Acurax-Social-Widget-Settings&status=updated#updated">Click Here Visit Social Icon Plugin Settings</a></b></p>
		  </div>';
}
$acx_widget_si_current_version = get_option('acx_widget_si_current_version');
if($acx_widget_si_current_version != '2.2') // Current Version
{
if (get_option('social_widget_icon_array_order') != "")
{
	add_action('admin_notices', 'acx_widget_si_pluign_finish_version_update',1);
}
}
// wp-admin Notices >> Plugin not configured
function acx_widget_si_pluign_not_configured()
{
    echo '<div class="error">
	<p><b>Acurax Social Media Widget Plugin is not configured. You need to configure your social media profile URL\'s 
		  to start showing the Acurax Social Media Widgets - <a href="admin.php?page=Acurax-Social-Widget-Settings">Click 
		  here to configure</a></b></p>
		  </div>';
}
if ($social_widget_icon_array_count == $total_arrays) 
{
if ($acx_widget_si_twitter == "" && $acx_widget_si_facebook == "" && $acx_widget_si_youtube == "" && $acx_widget_si_linkedin == ""  && $acx_widget_si_pinterest == "" && $acx_widget_si_gplus == "" && $acx_widget_si_feed == "")
{
	add_action('admin_notices', 'acx_widget_si_pluign_not_configured',1);
} // Chking If Plugin Not Configured
} // Chking $social_widget_icon_array_count == $total_arrays
// wp-admin Notices >> Plugin not configured
function acx_widget_si_pluign_promotion()
{
    echo '<div id="acx_td" class="error" style="background: none repeat scroll 0pt 0pt infobackground; border: 1px solid inactivecaption; padding: 5px;line-height:16px;">
	<p>It looks like you have been enjoying using Acurax Social Media Widget plugin from <a href="http://www.acurax.com?utm_source=plugin&utm_medium=thirtyday&utm_campaign=thirtyday" title="Acurax Web Designing Company" target="_blank">Acurax</a> for atleast 30 days.Would you consider upgrading to <a href="admin.php?page=Acurax-Social-Widget-Premium#compare" title="Premium Acurax Social Media Widget">premium version</a> to enjoy more features and help support continued development of the plugin? - Spreading the world about this plugin. Thank you for using the plugin</p>
	<p>
	<a href="http://wordpress.org/support/view/plugin-reviews/acurax-social-media-widget/" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;" target="_blank">Rate it 5★\'s on wordpress</a>
	<a href="admin.php?page=Acurax-Social-Widget-Premium#compare" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;">Need More Features?</a>
	<a href="admin.php?page=Acurax-Social-Widget-Premium&td=hide" class="button" style="color:black;text-decoration:none;padding:5px;margin-right:4px;margin-left:20px;">Don\'t Show This Again</a>
</p>
		  
		  </div>';
}
$acx_widget_si_installed_date = get_option('acx_widget_si_installed_date');
if ($acx_widget_si_installed_date=="") { $acx_widget_si_installed_date = time();}
if($acx_widget_si_installed_date < ( time() - 2952000 ))
{
if (get_option('acx_widget_si_td') != "hide")
{
add_action('admin_notices', 'acx_widget_si_pluign_promotion',1);
}
}
// Starting Widget Code
class acx_social_widget_icons_Widget extends WP_Widget
{
    // Register the widget
    function acx_social_widget_icons_Widget() 
	{
        // Set some widget options
        $widget_options = array( 'description' => 'Allow users to show Social Media Icons via Acurax Social Media Widget 
		Plugin', 'classname' => 'acx-social-icons-desc' );
        // Set some control options (width, height etc)
        $control_options = array( 'width' => 300 );
        // Actually create the widget (widget id, widget name, options...)
        $this->WP_Widget( 'acx-social-icons-widget', 'Acurax Social Media Widget', $widget_options, $control_options );
    }
    // Output the content of the widget
    function widget($args, $instance) 
	{
        extract( $args ); // Don't worry about this
        // Get our variables
        $title = apply_filters( 'widget_title', $instance['title'] );
		$icon_size = $instance['icon_size'];
		$icon_theme = $instance['icon_theme'];
		$icon_align = $instance['icon_align'];
        // This is defined when you register a sidebar
        echo $before_widget;
        // If our title isn't empty then show it
        if ( $title ) 
		{
            echo $before_title . $title . $after_title;
        }
		echo "<style>\n";
		echo "." . $this->get_field_id('widget') . " img \n{\n";
		echo "width:" . $icon_size . "px; \n } \n";
		echo "</style>";
		echo "<div id='acurax_si_widget_simple' class='acx_smw_float_fix " . $this->get_field_id('widget') . "'";
		if($icon_align != "") { echo " style='text-align:" . $icon_align . ";'>"; } else { echo " style='text-align:center;'>"; }
		acurax_si_widget_simple($icon_theme);
		echo "</div>";
        // This is defined when you register a sidebar
        echo $after_widget;
    }
	// Output the admin options form
	function form($instance) 
	{
		$total_themes = ACX_SOCIALMEDIA_WIDGET_TOTAL_THEMES;
		$total_themes = $total_themes + 1;
		// These are our default values
		$defaults = array( 'title' => 'Social Media Icons','icon_size' => '32' );
		// This overwrites any default values with saved values
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
				value="<?php echo $instance['title']; ?>" type="text" class="widefat" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_size'); ?>"><?php _e('Icon Size:'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('icon_size'); ?>" id="<?php echo $this
				->get_field_id('icon_size'); ?>">
				<option value="16"<?php if ($instance['icon_size'] == "16") { echo 'selected="selected"'; } ?>>16px X 16px </
				option>
				<option value="25"<?php if ($instance['icon_size'] == "25") { echo 'selected="selected"'; } ?>>25px X 25px </
				option>
				<option value="32"<?php if ($instance['icon_size'] == "32") { echo 'selected="selected"'; } ?>>32px X 32px </
				option>
				<option value="40"<?php if ($instance['icon_size'] == "40") { echo 'selected="selected"'; } ?>>40px X 40px </
				option>
				<option value="48"<?php if ($instance['icon_size'] == "48") { echo 'selected="selected"'; } ?>>48px X 48px </
				option>
				<option value="55"<?php if ($instance['icon_size'] == "55") { echo 'selected="selected"'; } ?>>55px X 55px </
				option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_theme'); ?>"><?php _e('Icon Theme:'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('icon_theme'); ?>" id="<?php echo $this
				->get_field_id('icon_theme'); ?>">
				<option value=""<?php if ($instance['icon_theme'] == "") { echo 
				'selected="selected"'; } ?>>Default Theme Design</option>
				<?php
				for ($i=1; $i < $total_themes; $i++)
				{
					?>
					<option value="<?php echo $i; ?>"<?php if ($instance['icon_theme'] == $i) { echo 
					'selected="selected"'; } ?>>Theme Design <?php echo $i; ?> </option>
					<?php
				}	?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_align'); ?>"><?php _e('Icon Align:'); ?></label>
				<select class="widefat" name="<?php echo $this->get_field_name('icon_align'); ?>" id="<?php echo $this
				->get_field_id('icon_align'); ?>">
				<option value=""<?php if ($instance['icon_align'] == "") { echo 'selected="selected"'; } ?>>Default </
				option>
				<option value="left"<?php if ($instance['icon_align'] == "left") { echo 'selected="selected"'; } ?>>Left </
				option>
				<option value="center"<?php if ($instance['icon_align'] == "center") { echo 'selected="selected"'; } ?>>Center </
				option>
				<option value="right"<?php if ($instance['icon_align'] == "right") { echo 'selected="selected"'; } ?>>Right </
				option>
				</select>
			</p>
		<?php
	}
	// Processes the admin options form when saved
	function update($new_instance, $old_instance) 
	{
		// Get the old values
		$instance = $old_instance;
		// Update with any new values (and sanitise input)
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icon_size'] = strip_tags( $new_instance['icon_size'] );
		$instance['icon_theme'] = strip_tags( $new_instance['icon_theme'] );
		$instance['icon_align'] = strip_tags( $new_instance['icon_align'] );
		return $instance;
	}
} add_action('widgets_init', create_function('', 'return register_widget("acx_social_widget_icons_Widget");'));
// Ending Widget Codes
function socialicons_widget_comparison($ad=2)
{
$ad_1 = '
</hr>
<a name="compare"></a><div id="ss_middle_wrapper"> 
		<div id="ss_middle_center"> 
			<div id="ss_middle_inline_block"> 
			
				<div class="middle_h2_1"> 
					<h2>Limited on Features ?</h2>
					<h3>Compare and Decide</h3>
				</div><!-- middle_h2_1 -->
				
<div id="ss_features_table"> 
				
					<div id="ss_table_header"> 
						<div class="tb_h1"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
							<div class="tb_h2"> <h3>Features</h3> </div><!-- tb_h2 -->
							<div class="tb_h3"> <div class="ss_download"> </div><!-- ss_download --> </div><!-- tb_h3 -->
						<div class="tb_h4 fsmi_tb_h4"> <a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_asmw_settings_table&utm_medium=link&utm_campaign=compare_buynow" target="_blank"><div class="ss_buy_now"> </div><!-- ss_buy_now --></a> </div><!-- tb_h4 -->
					</div><!-- ss_table_header -->
						
					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 197px;"> Display </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>More Sharp Quality Icons</li>
									<li>20+ Icon Theme/Style</li>
										<li>Can Choose Icon Theme/Style</li>
											<li>Can Choose Icon Size</li>
												<li>Automatic/Manual Integration</li>
													<li>Set MouseOver text for each icon in Share Mode</li>
												<li>Set MouseOver text for each icon in Profile Link Mode</li>
											<li>Option to HIDE Invididual Share Icon</li>
										<li><strong>Set Floating Icons in Vertical</strong></li>
									<li><strong>Define how many icons in 1 row</strong></li>
								<li class="ss_last_one"><strong>Add Custom Icons</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
												<div class="ss_no"> </div><!-- ss_no -->
											<div class="ss_no"> </div><!-- ss_no -->
										<div class="ss_no"> </div><!-- ss_no -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
												<div class="ss_yes"> </div><!-- ss_yes -->
											<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->
					
					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> Icon Function </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Link to Social Media Profile</li>
								<li class="ss_last_one"><strong>Share On Social Media</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->			

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> Animation </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Fly Animation</li>
								<li class="ss_last_one"><strong>Mouse Over Effects</strong></li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 84px;"> Fly Animation Repeat Interval</div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Based On Time in Seconds</li>
									<li><strong>Based On Time in Minutes</strong></li>
										<li>Based On Time in Hours</li>
									<li>Based on Page Views</li>
								<li class="ss_last_one">Based On Page Views and Time</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 30px;"> Multiple Fly Animation<br/></div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Can Choose Fly Start Position</li>
								<li class="ss_last_one">Can Choose Fly End Position</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->				

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 52px;">Easy to Configure</div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Ajax Based Settings Page</li>
									<li>Drag & Drop Reorder Icons</li>
								<li class="ss_last_one">Easy to Configure</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder"> 
							<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->			

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 106px;">Widget Support </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Multiple Widgets</li>
									<li>Separate Icon Style/Theme For Each</li>
										<li>Separate Icon Size For Each</li>
										<li>Set whether the icons to Link Profiles/SHARE</li>
									<li><strong>Separate Mouse Over Multiple Animation for Each</strong></li>
								<li class="ss_last_one">Separate Default Opacity for Each</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 106px;">Shortcode Support </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Multiple Instances</li>
									<li>Separate Icon Style/Theme For Each</li>
										<li><strong>Separate Icon Size For Each</strong></li>
										<li>Set whether the icons to Link Profiles/SHARE</li>
									<li>Separate Mouse Over Multiple Animation for Each</li>
								<li class="ss_last_one">Separate Default Opacity for Each</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->	

					<div class="ss_column_holder"> 
					
						<div class="tb_h1 mini"> <h3>Feature Group</h3> </div><!-- tb_h1 -->
						<div class="ss_feature_group" style="padding-top: 126px;">PHP Code Support </div><!-- -->
						<div class="tb_h1 mini"> <h3>Features</h3> </div><!-- tb_h1 -->
						<div class="ss_features"> 
							<ul>
								<li>Multiple Instances</li>
									<li>Use Outside Loop</li>
										<li>Separate Icon Style/Theme For Each</li>
											<li>Separate Icon Size For Each</li>
										<li><strong>Set whether the icons to Link Profiles/SHARE</strong></li>
									<li>Separate Mouse Over Multiple Animation for Each</li>
								<li class="ss_last_one">Separate Default Opacity for Each</li>
							</ul>
						</div><!-- ss_features -->
						
						<div class="tb_h1 mini"> <h3>FREE &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <span style="color: #ffe400;">PREMIUM</span></h3> </div><!-- tb_h1 -->
						<div class="ss_y_n_holder">
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_no"> </div><!-- ss_no -->
								<div class="ss_no"> </div><!-- ss_no -->
							<div class="ss_no ss_last_one"> </div><!-- ss_no -->
						</div><!-- ss_y_n_holder -->
						
						<div class="ss_y_n_holder"> 
							<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
										<div class="ss_yes"> </div><!-- ss_yes -->
									<div class="ss_yes"> </div><!-- ss_yes -->
								<div class="ss_yes"> </div><!-- ss_yes -->
							<div class="ss_yes ss_last_one"> </div><!-- ss_yes -->
						</div><!-- ss_y_n_holder -->						
						
					</div><!-- column_holder -->						
					
				
					
				</div><!-- ss_features_table -->		

			<div id="ad_fsmi_2_button_order" style="float: left; width: 100%;">
<a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_asmw_settings&utm_medium=banner&utm_campaign=plugin_yellow_order" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --></div></div></div>';
$ad_2='<div id="ad_fsmi_2"> <a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_smw_settings&utm_medium=banner&utm_campaign=plugin_enjoy" target="_blank"><div id="ad_fsmi_2_button"></div></a> </div> <!-- ad_fsmi_2 --><br>
<div id="ad_fsmi_2_button_order">
<a href="http://clients.acurax.com/floating-socialmedia.php?utm_source=plugin_smw_settings&utm_medium=banner&utm_campaign=plugin_yellow_order" target="_blank"><div id="ad_fsmi_2_button_order_link"></div></a></div> <!-- ad_fsmi_2_button_order --> ';
if($ad=="" || $ad == 2) { echo $ad_2; } else if ($ad == 1) { echo $ad_1; } else { echo $ad_2; } 
}
function acx_asmw_saveorder_callback()
{
	global $wpdb;
$social_widget_icon_array_order = $_POST['recordsArray'];
if (current_user_can('manage_options')) {
	$social_widget_icon_array_order = serialize($social_widget_icon_array_order);
	update_option('social_widget_icon_array_order', $social_widget_icon_array_order);
	echo "<div id='acurax_notice' align='center' style='width: 420px; font-family: arial; font-weight: normal; font-size: 22px;'>";
	echo "Social Media Icon's Order Saved";
	echo "</div><br>";
}
	die(); // this is required to return a proper result
} add_action('wp_ajax_acx_asmw_saveorder', 'acx_asmw_saveorder_callback');
function acx_quick_widget_request_submit_callback()
{
	$acx_name =  $_POST['acx_name'];
	$acx_email =  $_POST['acx_email'];
	$acx_phone =  $_POST['acx_phone'];
	$acx_weburl =  $_POST['acx_weburl'];
	$acx_subject =  $_POST['acx_subject'];
	$acx_question =  $_POST['acx_question'];
if($acx_name == "" || $acx_email == "" || $acx_weburl == "" || $acx_subject == "" || $acx_question == "")
{
echo 2;
} else
{
$current_user_acx = wp_get_current_user();
$current_user_acx = $current_user->user_email;
if($current_user_acx == "")
{
$current_user_acx = $acx_email;
}
$headers[] = 'From: ' . $acx_name . ' <' . $current_user_acx . '>';
$headers[] = 'Content-Type: text/html; charset=UTF-8'; 
$message = "Name: ".$acx_name . "\r\n <br>";
$message = $message . "Email: ".$acx_email . "\r\n <br>";
if($acx_phone != "")
{
$message = $message . "Phone: ".$acx_phone . "\r\n <br>";
}
// In case any of our lines are larger than 70 characters, we should use wordwrap()
$acx_question = wordwrap($acx_question, 70, "\r\n <br>");
$message = $message . "Website: ".$acx_weburl . "\r\n <br>";
$message = $message . "Question: ".$acx_question . "\r\n <br>";
$message = stripslashes($message);
$acx_subject = "Quick Support - " . $acx_subject;
$emailed = wp_mail( 'info@acurax.com', $acx_subject, $message, $headers );
if($emailed)
{
echo 1;
} else
{
echo 0;
}
}
	die(); // this is required to return a proper result
}add_action('wp_ajax_acx_quick_widget_request_submit','acx_quick_widget_request_submit_callback');
?>