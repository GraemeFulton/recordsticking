<?php
/*
Plugin Name: EGW Hover Effects
Plugin URI: http://scriptsell.net/
Description: A simple widget that makes it a breeze to add images, content, and CSS3 hover Animation to your sidebars.
Author: Saif Sohel(proscriptsell@gmail.com)
Version:1.1
Author URI: http://scriptsell.net/
Tags: widget, hover Effects, colorful, CSS3 Image Hover, Text effect, image effect,html, image, images, responsive, text, 
upload, uploader, widget, widget-only, widgets, plugins, portfolio, thumbnails, web designer, websites,gallery slider, 
image, image album, image gallery, images, images gallery, media, photo, photo album, photo albums, photo gallery, 
photogallery, photos, photoset, picture, pictures, responsive wordpress photo gallery, Simple gallery, video gallery, 
website gallery, widget gallery, wordpress gallery, wordpress gallery plugin, wordpress photo gallery plugin, wp gallery
*/

$egw_setup = new egw_Setup();

class egw_Setup {
	
	protected $load_egw_backend = false;
	
	public function __construct() {
		add_action('admin_enqueue_scripts', array($this, 'action_admin_enqueue_scripts'));
		add_action('widgets_init', array($this, 'action_widgets_init'));
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
		add_action('plugins_loaded', array( &$this, 'lang') );
		if (stristr($_SERVER['REQUEST_URI'], 'widgets.php')) {
			$this->load_egw_backend = true;
		}
	}
	
	public function action_admin_enqueue_scripts() {
		if ($this->load_egw_backend) {
			wp_enqueue_media();
			wp_enqueue_script('color-picker',plugins_url( 'assets/js/colpick.js', __FILE__ ),array( 'jquery' ));
			wp_enqueue_script('egw-back-end',plugins_url( 'assets/js/back-end.js', __FILE__ ),array( 'jquery' ));
			wp_enqueue_style( 'widget-images-effects', plugins_url( 'assets/css/back-end.css', __FILE__ ) );
			wp_enqueue_style( 'colpick-picker-css', plugins_url( 'assets/css/colpick.css', __FILE__ ) );
			wp_localize_script( 'egw-back-end','objectL10n', array(
				'insertMedia' => __( 'Insert Media', 'egw' ),
				'returnToLibrary' => __( 'Return to Library', 'egw' ),
				'selectImage' => __( 'Select Image', 'egw' ),
				'insertImage' => __( 'Insert Image', 'egw' ),
			),'color-picker'); 

		}
	}
	function action_widgets_init() {
		register_widget( 'EGW_Hover_Effects_Widget' );
	}
   //load plugin languages
    function lang() {
        load_plugin_textdomain( 'egw', false, plugin_dir_path(__FILE__) . 'languages/' ); 
    }
	
	// Load Front-end Css File.
	function enqueue_scripts(){
		wp_register_style('egw-widget-style', plugins_url('/assets/css/front-end.css', __FILE__));
		wp_enqueue_style('egw-widget-style');
	}
	
}


class EGW_Hover_Effects_Widget extends WP_Widget {

	protected $widget_id = 'egw';

	/**
	 * Default constructor.
	 */
	function __construct() {
		$widget_ops = array('description' => __(' A simple widget that makes it a breeze to add images,Content, And CSS3 Hover Animation to your sidebars.', 'egw'));
		parent::__construct($this->widget_id, 'EGW Hover Effects ', $widget_ops);
		
	}

	/**
	* \see WP_Widget::form
	*/
	function form($instance) {
		$widget_id = (isset($this->id) ? $this->id : '0');
		
		$div_id = $widget_id;

		// Load widget defaults and ovveride them with user defined settings.
		$instance = $this->merge_arrays($this->get_defaults(), $instance);

		// Display form.
		include 'includes/back-end.php';
	}

	/**
	 * Returns the default values for this widget.
	 *
	 * \return array Default values for this widget.
	 */
	protected function get_defaults() {
		return apply_filters($this->widget_id . '_get_defaults', array(
			'title' => '',
			'text' => '',
			'src' => '',
			'keep_aspect_ratio' => true,
			'url' => '',
			'new_window' => '',
			'get_bg_effects'=>'zoom_in',
			'disable_captions' => '',
			'get_captions_effects' => 'bounce',
			'captions_bg_color' => '000000',
			'title_color' => 'c5c5c3',
			'text_color' => 'ffffff',
			'padding' => '10',
			'fonts_family'=>'',
			'title_size'=>'16',
			'text_size'=>'13',
			'border_color'=>'ffffff',
			'border_width'=>'3',
			'custom_css'=>'',
			'disable_opacity'=>'',
		));
	}
	/**
	 * Returns a list widget style.
	 *
	 * \return array
	 */
	protected function get_widget_style() {
		return apply_filters($this->widget_id . '_widge_style', array(
			'box' => __('Square ', 'egw'),
			'round' => __('Round', 'egw')
		));
	}	
	/**
	 * Returns a list of  fonts family.
	 *
	 * \return array
	 */
	protected function get_fonts_family() {
		return apply_filters($this->widget_id . '_fonts_family', array(
			'Verdana, Geneva, sans-serif' => __('Verdana, Geneva, sans-serif', 'egw'),
			'Georgia, "Times New Roman", Times, serif' => __('Georgia, "Times New Roman", Times, serif', 'egw'),
			'Arial, Helvetica, sans-serif' => __('Arial, Helvetica, sans-serif', 'egw'),
			'Tahoma, Geneva, sans-serif' => __('Tahoma, Geneva, sans-serif', 'egw'),
			'"Trebuchet MS", Arial, Helvetica, sans-serif' => __('Trebuchet MS, Arial, Helvetica, sans-serif', 'egw'),
			'"Arial Black", Gadget, sans-serif' => __('Arial Black, Gadget, sans-serif', 'egw'),
			'"Times New Roman", Times, serif' => __('Times New Roman, Times, serif', 'egw'),
			'"Palatino Linotype", "Book Antiqua", Palatino, serif' => __('Palatino Linotype, "Book Antiqua", Palatino, serif', 'egw'),
			'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => __('Lucida Sans Unicode, "Lucida Grande", sans-serif', 'egw'),
			'"MS Serif", "New York", serif' =>__('MS Serif, "New York", serif;', 'egw'),
			'"Lucida Console", Monaco, monospace' =>__('"Lucida Console", Monaco, monospace', 'egw'),
			'"Comic Sans MS", cursive' =>__('Comic Sans MS, cursive', 'egw')
		));
	}	
	/**
	 * Returns a list of  background images effects.
	 *
	 * \return array
	 */
	protected function get_bg_effects() {
		return apply_filters($this->widget_id . '_bg_effects', array(
			'fadeout' => __('Fadeout', 'egw'),
		));
	}

	/**
	 * Returns a list captions effects.
	 *
	 * \return array
	 */
	protected function get_captions_effects() {
		return apply_filters($this->widget_id . 'captions_effects', array(
			'fadein' => __('Fadein', 'egw'),
		));
	}


	/**
	 * Merges two arrays withour reindexing, with overwriting (not the same as
	 * PHP array_merge()).
	 *
	 * \param array $array1 First array to merge.
	 * \param array $array2 Second array to merge and overwrite values with.
	 * \return array Merged arrays.
	 */
	protected function merge_arrays($array1, $array2) {
		return array_diff_key($array1, $array2) + $array2;
	}

	/**
	 * \see WP_Widget::widget
	 */
	function widget($args, $instance) {
		extract( $args );

		$instance['title'] = \apply_filters('widget_title', \esc_attr(@$instance['title']));
		$instance['keep_aspect_ratio'] = (isset($instance['keep_aspect_ratio'])) ? true : false;

		// Output widget to front-end.
		echo $before_widget;
		// Allow theme to supply a non-standard template.
		$template = locate_template('egw-template.php');
		if ( $template ) {
			include $template;
		} else {
			include 'includes/egw-template.php';
		}

		echo $after_widget;
	}

	/**
	* \see WP_Widget::update
	*/
	public function update($new_instance, $old_instance) {
		$new_instance['keep_aspect_ratio'] = isset($new_instance['keep_aspect_ratio']);
		return $new_instance;
	}
	
	/**
	* \ Color Converter Hex To RGB
	*/
	function hex2RGB($hexStr, $seperator = ',') {
	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	$rgbArray = array();
	if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
		$colorVal = hexdec($hexStr);
		$rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
		$rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
		$rgbArray['blue'] = 0xFF & $colorVal;
	} elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
		$rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
		$rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
		$rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	} else {
		return false; //Invalid hex color code
	}
	$rgbArray['red']=$rgbArray['red'];
	 $rgbArray['green']=$rgbArray['green'];
	  $rgbArray['blue']=$rgbArray['blue'];
	return implode($seperator, $rgbArray) ; 
	}
	
}


function add_this_script_footer(){ ?>
<a title="Plugind development" href="http://scriptsell.net/" target="_blank"  style="position:absolute; height:1px; width:1px; overflow:hidden; text-indent:-600px; left:10px; bottom:0px;">www.scriptsell.net</a>
<?php } 

add_action('wp_footer', 'add_this_script_footer');
?>
