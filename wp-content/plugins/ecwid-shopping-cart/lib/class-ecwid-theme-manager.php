<?php

class Ecwid_Theme_Manager
{
	protected $themes_map = array();

	protected $current_theme = '';

	protected $theme_name = '';

	public function Ecwid_Theme_Manager()
	{
		$this->init_themes_map();
		$this->detect_current_theme();

		add_filter('ecwid_minicart_shortcode_content', array($this, 'minicart_shortcode_content'));
		add_filter('ecwid_categories_shortcode_content', array($this, 'categories_shortcode_content'));
		add_filter('ecwid_search_shortcode_content', array($this, 'search_shortcode_content'));
	}

	public static function get_instance()
	{
		static $instance = null;

		if (is_null($instance)) {
			$instance = new Ecwid_Theme_Manager();
		}

		return $instance;
	}

	public function get_theme_name()
	{
		return $this->theme_name;
	}

	public function apply_adjustments()
	{
		if ( empty( $this->themes ) ) {
			return;
		}

		if ($this->theme_needs_scrolling_adjustment()) {
			wp_enqueue_script(
				'ecwid-scroller',
				plugins_url( 'ecwid-shopping-cart/js/create_scroller.js' ),
				array( 'jquery' )
			);
		}

		if ( !array_key_exists( $this->current_theme, $this->themes ) ) {
			return;
		}

		$theme_data = $this->themes[$this->current_theme];

		if ( $theme_data['callback'] ) {
			$method = 'apply_theme_' . $this->current_theme;
			return $this->$method();
		}

		wp_enqueue_style(
			'ecwid-theme-css',
			plugins_url( 'ecwid-shopping-cart/css/themes/' . $this->current_theme . '.css' ),
			isset( $theme_data['base_css'] ) ? array( $theme_data['base_css'] ) : array(),
			false,
			'all'
		);

		if ( $theme_data['js'] ) {
			wp_enqueue_script(
				'ecwid-theme-js',
				plugins_url( 'ecwid-shopping-cart/js/themes/' . $this->current_theme . '.js' ),
				array( 'jquery' )
			);
		}
	}

	public function minicart_shortcode_content($content)
	{
		return $content;

		if ($this->current_theme == 'responsive' && get_option('ecwid_enable_advanced_theme_layout') == 'Y' && get_the_ID() == get_option('ecwid_store_page_id')) {
			$content = '<script type="text/javascript"> xMinicart("style=","layout=Mini"); </script>';
		}
	}

	public function categories_shortcode_content($content)
	{
		return $content;
	}

	public function search_shortcode_content($content)
	{
		return $content;
	}

	public function has_advanced_layout()
	{
		return false;

		return $this->current_theme == 'responsive';
	}

	protected function detect_current_theme()
	{
		$version = get_bloginfo('version');

		if (version_compare( $version, '3.4' ) < 0) {
			$this->theme_name = get_current_theme();
		} else {
			$theme = wp_get_theme();
			$this->theme_name = $theme->get('Name');
		}

		foreach ( $this->themes as $internal_name => $theme ) {
			if ( $this->theme_name == $theme['name'] ) {
				$this->current_theme = $internal_name;
				break;
			}
		}
	}

	protected function init_themes_map()
	{
		$this->themes = array(

			'2014' => array(
				'name'     => 'Twenty Fourteen',
				'base_css' => 'twentyfourteen-style',
				'js'	   => false,
			),
			'pagelines' => array(
				'name'     => 'PageLines',
				'base_css' => '',
				'js'       => true,
			),
			'responsive' => array(
				'name'	   => 'Responsive'
			)
		);
	}

	protected function theme_needs_scrolling_adjustment() {
		return in_array( $this->current_theme, array( '2014', 'pagelines' ) );
	}

	protected function __apply_theme_responsive()
	{
		wp_enqueue_style( 'ecwid-open-sans-css' , 'http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,cyrillic-ext,cyrillic,greek-ext,vietnamese,greek,latin-ext');
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'ecwid-theme-fixes-css' , plugins_url( 'ecwid-shopping-cart/css/themes/responsive-fixes.css' ), array(), false, 'all' );
		if (get_option('ecwid_enable_advanced_theme_layout') == 'Y') {
			wp_enqueue_style( 'ecwid-theme-adjustments-css' , plugins_url( 'ecwid-shopping-cart/css/themes/responsive-adjustments.css' ), array(), false, 'all' );
			wp_enqueue_script( 'ecwid-theme-js', plugins_url( 'ecwid-shopping-cart/js/themes/responsive.js' ), array( 'jquery' ), false, true );
		}

		add_filter('body_class', array($this, 'body_class_responsive'));
	}

	public function body_class_responsive($classes)
	{
		if (get_option('ecwid_enable_minicart')) {
			$classes[] = 'ecwid-with-minicart';
		}

		if (get_option('ecwid_show_search_box')) {
			$classes[] = 'ecwid-with-search';
		}

		return $classes;
	}
}