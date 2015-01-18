<?php
/*
Plugin Name: Ecwid Shopping Cart
Plugin URI: http://www.ecwid.com?source=wporg
Description: Ecwid is a free full-featured shopping cart. It can be easily integrated with any Wordpress blog and takes less than 5 minutes to set up.
Text Domain: ecwid-shopping-cart
Author: Ecwid Team
Version: 2.7.4.1
Author URI: http://www.ecwid.com?source=wporg
*/

register_activation_hook( __FILE__, 'ecwid_store_activate' );
register_deactivation_hook( __FILE__, 'ecwid_store_deactivate' );

define("APP_ECWID_COM", 'app.ecwid.com');
define("ECWID_DEMO_STORE_ID", 1003);


if ( ! defined( 'ECWID_PLUGIN_DIR' ) ) {
	define( 'ECWID_PLUGIN_DIR', plugin_dir_path( realpath(__FILE__) ) );
}

if ( ! defined( 'ECWID_PLUGIN_URL' ) ) {
	define( 'ECWID_PLUGIN_URL', plugin_dir_url( realpath(__FILE__) ) );
}


// Older versions of Google XML Sitemaps plugin generate it in admin, newer in site area, so the hook should be assigned in both of them
add_action('sm_buildmap', 'ecwid_build_sitemap_pages');

// Needs to be in both front-end and back-end to allow admin zone recognize the shortcode
add_shortcode('ecwid_productbrowser', 'ecwid_productbrowser_shortcode');

if ( is_admin() ){ 
  add_action('admin_init', 'ecwid_settings_api_init');
	add_action('admin_init', 'ecwid_check_version');
  add_action('admin_notices', 'ecwid_show_admin_messages');
  add_action('admin_menu', 'ecwid_options_add_page');
  add_action('wp_dashboard_setup', 'ecwid_add_dashboard_widgets' );
  add_action('admin_enqueue_scripts', 'ecwid_common_admin_scripts');
  add_action('admin_enqueue_scripts', 'ecwid_register_admin_styles');
  add_action('admin_enqueue_scripts', 'ecwid_register_settings_styles');
  add_action('wp_ajax_ecwid_hide_vote_message', 'ecwid_hide_vote_message');
  add_action('wp_ajax_ecwid_hide_message', 'ecwid_ajax_hide_message');
  add_filter('plugins_loaded', 'ecwid_load_textdomain');
  add_filter('plugin_action_links_ecwid-shopping-cart/ecwid-shopping-cart.php', 'ecwid_plugin_actions');
  add_action('admin_head', 'ecwid_ie8_fonts_inclusion');
  add_action('admin_head', 'ecwid_send_stats');
  add_action('save_post', 'ecwid_save_post');
  add_action('init', 'ecwid_apply_theme');
	add_action('get_footer', 'ecwid_admin_get_footer');
} else {
  add_shortcode('ecwid_script', 'ecwid_script_shortcode');
  add_shortcode('ecwid_minicart', 'ecwid_minicart_shortcode');
  add_shortcode('ecwid_searchbox', 'ecwid_searchbox_shortcode');
  add_shortcode('ecwid_categories', 'ecwid_categories_shortcode');
  add_shortcode('ecwid_product', 'ecwid_product_shortcode');
	add_shortcode('ecwid', 'ecwid_shortcode');
  add_action('init', 'ecwid_backward_compatibility');
  add_action('send_headers', 'ecwid_503_on_store_closed');
  add_action('template_redirect', 'ecwid_seo_compatibility_template_redirect');
  add_action('template_redirect', 'ecwid_404_on_broken_escaped_fragment');
  add_action('template_redirect', 'ecwid_apply_theme');
  add_action('wp_enqueue_scripts', 'ecwid_add_frontend_styles');
  add_action('wp', 'ecwid_seo_ultimate_compatibility', 0);
  add_action('wp', 'ecwid_remove_default_canonical');
  add_filter('wp_title', 'ecwid_seo_compatibility_init', 0);
  add_filter('wp_title', 'ecwid_seo_title', 20);
  add_action('plugins_loaded', 'ecwid_minifier_compatibility', 0);
  add_action('wp_head', 'ecwid_meta_description', 0);
  add_action('wp_head', 'ecwid_ajax_crawling_fragment');
  add_action('wp_head', 'ecwid_meta');
  add_action('wp_head', 'ecwid_canonical');
  add_action('wp_head', 'ecwid_seo_compatibility_restore', 1000);
  add_filter( 'widget_meta_poweredby', 'ecwid_add_credits');
  add_filter('the_content', 'ecwid_content_started', 0);
  add_filter('body_class', 'ecwid_body_class');
  $ecwid_seo_title = '';
}
add_action('admin_bar_menu', 'add_ecwid_admin_bar_node', 1000);

$ecwid_script_rendered = false; // controls single script.js on page

require_once plugin_dir_path(__FILE__) . '/includes/themes.php';
require_once plugin_dir_path(__FILE__) . '/includes/class-ecwid-message-manager.php';
require_once plugin_dir_path(__FILE__) . '/includes/class-ecwid-store-editor.php';


$version = get_bloginfo('version');

function ecwid_add_breadcrumbs_navxt($trail)
{
	$breadcrumb = new bcn_breadcrumb('Ecwid', '', '', 'http://ecwid.com');
	$trail->add($breadcrumb);
}

function ecwid_add_breadcrumb_links_wpseo($links)
{
	return array_merge((array)$links, array(
		array(
		'text' => 'ecwid.com',
		'url' => 'http://ecwid.com'
		)
	));
}
if (version_compare($version, '3.6') < 0) {
    /**
     * A copy of has_shortcode functionality from wordpress 3.6
     * http://core.trac.wordpress.org/browser/tags/3.6/wp-includes/shortcodes.php
     */

	if (!function_exists('shortcode_exists')) {
		function shortcode_exists( $tag ) {
			global $shortcode_tags;
				return array_key_exists( $tag, $shortcode_tags );
		}
	}

	if (!function_exists('has_shortcode')) {
		function has_shortcode( $content, $tag ) {
			if ( shortcode_exists( $tag ) ) {
				preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
				if ( empty( $matches ) )
					return false;

				foreach ( $matches as $shortcode ) {
					if ( $tag === $shortcode[2] ) {
						return true;
					}
				}
			}
			return false;
		}
	}
}

if (is_admin()) {
	$main_button_class = "";
	if (version_compare($version, '3.8-beta') > 0) {
		$main_button_class = "button-primary";
	} else {
		$main_button_class = "pure-button pure-button-primary";
	}

	define('ECWID_MAIN_BUTTON_CLASS', $main_button_class);
}

function ecwid_body_class($classes)
{
	if (ecwid_page_has_productbrowser()) {
		$classes[] = 'ecwid-shopping-cart';
	}

	return $classes;
}

function ecwid_ie8_fonts_inclusion()
{
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 8') === false) return;

	$url = ECWID_PLUGIN_URL . '/fonts/ecwid-logo.eot';
	echo <<<HTML
<style>
@font-face {
	font-family: 'ecwid-logo';
	src:url($url);
}
</style>
<script type="text/javascript">
</script>
HTML;

}

function ecwid_add_frontend_styles() {
	wp_enqueue_style('ecwid-css', plugins_url('ecwid-shopping-cart/css/frontend.css'));
}

function ecwid_load_textdomain() {
	load_plugin_textdomain( 'ecwid-shopping-cart', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

}

function ecwid_404_on_broken_escaped_fragment() {
	if (!ecwid_is_api_enabled()) {
		return;
	}

	if (!isset($_GET['_escaped_fragment_'])) {
		return;
	}

	$params = ecwid_parse_escaped_fragment($_GET['_escaped_fragment_']);
	$api = ecwid_new_product_api();

	if (isset($params['mode']) && !empty($params['mode']) && isset($params['id'])) {
		$result = array();
		if ($params['mode'] == 'product') {
			$result = $api->get_product($params['id']);
		} elseif ($params['mode'] == 'category') {
			$result = $api->get_category($params['id']);
		}
		if (empty($result)) {
			global $wp_query;

			$wp_query->set_404();
		}
	}
}

function ecwid_503_on_store_closed() {
	if (!ecwid_is_api_enabled()) {
		return;
	}

	if (!isset($_GET['_escaped_fragment_'])) {
		return;
	}

	$api = ecwid_new_product_api();
	$profile = $api->get_profile();

	if ($profile['closed']) {
		header('HTTP/1.1 503 Service Temporarily Unavailable');
		header('Status: 503 Service Temporarily Unavailable');
	}
}

function ecwid_backward_compatibility() {
    // Backward compatibility with 1.1.2 and earlier
    if (isset($_GET['ecwid_product_id']) || isset($_GET['ecwid_category_id'])) {

        if (isset($_GET['ecwid_product_id']))
            $redirect = ecwid_get_product_url(intval($_GET['ecwid_product_id']));
        elseif (isset($_GET['ecwid_category_id']))
            $redirect = ecwid_get_category_url(intval($_GET['ecwid_category_id']));

        wp_redirect($redirect, 301);
        exit();
    }
}


function ecwid_build_sitemap_pages()
{
	if (!ecwid_is_paid_account() || !ecwid_is_store_page_available()) return;

	$page_id = ecwid_get_current_store_page_id();

	if (get_post_status($page_id) == 'publish') {
		include ECWID_PLUGIN_DIR . '/includes/class-ecwid-sitemap-builder.php';

		$sitemap = new EcwidSitemapBuilder(ecwid_get_store_page_url(), 'build_sitemap_callback', ecwid_new_product_api());

		$sitemap->generate();
	}
}

function build_sitemap_callback($url, $priority, $frequency)
{
	static $generatorObject = null;
	if (is_null($generatorObject)) {
		$generatorObject = GoogleSitemapGenerator::GetInstance(); //Please note the "&" sign!
	}

	if($generatorObject != null) {
		$page = new GoogleSitemapGeneratorPage($url, $priority, $frequency);
		$generatorObject->AddElement($page);
	}
}

function ecwid_minifier_compatibility()
{
	if ( !function_exists( 'get_plugins' ) ) { require_once ( ABSPATH . 'wp-admin/includes/plugin.php' ); }

	$plugins = get_plugins();
	$wp_minify_plugin = 'wp-minify/wp-minify.php';
	if (array_key_exists($wp_minify_plugin, $plugins) && is_plugin_active($wp_minify_plugin)) {
		global $wp_minify;

		if (is_object($wp_minify) && array_key_exists('default_exclude', get_object_vars($wp_minify)) && is_array($wp_minify->default_exclude)) {
			$wp_minify->default_exclude[] = 'ecwid.com/script.js';
		}
	}
}

function ecwid_check_version()
{
	$plugin_data = get_plugin_data(__FILE__);
	$current_version = $plugin_data['Version'];
	$stored_version = get_option('ecwid_plugin_version', null);

	$fresh_install = !$stored_version;
	$upgrade = $stored_version && version_compare($current_version, $stored_version) > 0;

	if ($fresh_install) {

		do_action('ecwid_plugin_installed', $current_version);
		add_option('ecwid_plugin_version', $current_version);

	} elseif ($upgrade) {

		do_action('ecwid_plugin_upgraded', array( 'old' => $stored_version, 'new' => $current_version ) );
		update_option('ecwid_plugin_version', $current_version);

	}
}

function ecwid_override_option($name, $new_value = null)
{
    static $overridden = array();

    if (!array_key_exists($name, $overridden)) {
        $overridden[$name] = get_option($name);
    }

    if (!is_null($new_value)) {
        update_option($name, $new_value);
    } else {
        update_option($name, $overridden[$name]);
    }
}

function ecwid_seo_ultimate_compatibility()
{
	global $seo_ultimate;

	if ($seo_ultimate && ecwid_page_has_productbrowser()) {
		remove_action('template_redirect', array($seo_ultimate->modules['titles'], 'before_header'), 0);
		remove_action('wp_head', array($seo_ultimate->modules['titles'], 'after_header'), 1000);
		remove_action('su_head', array($seo_ultimate->modules['meta-descriptions'], 'head_tag_output'));
		remove_action('su_head', array($seo_ultimate->modules['canonical'], 'link_rel_canonical_tag'));
		remove_action('su_head', array($seo_ultimate->modules['canonical'], 'http_link_rel_canonical'));
	}
}

function ecwid_seo_compatibility_template_redirect()
{
	global $wpseo_front;

	// Newer versions of Wordpress SEO assign their rewrite on this stage
	remove_action( 'template_redirect', array( $wpseo_front, 'force_rewrite_output_buffer' ), 99999 );
}

if (!is_admin) add_action('wp', 'ecwid_remove_default_canonical');
function ecwid_remove_default_canonical()
{
	if (array_key_exists('_escaped_fragment_', $_GET) && ecwid_page_has_productbrowser()) {
		remove_action( 'wp_head','rel_canonical');
	}
}

function ecwid_seo_compatibility_init($title)
{
    if (!array_key_exists('_escaped_fragment_', $_GET) || !ecwid_page_has_productbrowser()) {
        return $title;
    }

    // Yoast Wordpress SEO
    global $wpseo_front;
	// Canonical
    remove_action( 'wpseo_head', array( $wpseo_front, 'canonical' ), 20);
	// Title
	remove_action( 'get_header', array( $wpseo_front, 'force_rewrite_output_buffer' ) ); // Older versions of plugin
	remove_action( 'wp_footer', array( $wpseo_front, 'flush_cache'));
	// Description
	remove_action( 'wpseo_head', array( $wpseo_front, 'metadesc' ), 10 );

	// Platinum SEO Pack
    // Canonical
    ecwid_override_option('psp_canonical', false);
    // Title
    ecwid_override_option('aiosp_rewrite_titles', false);

	// All in one SEO Pack
    global $aioseop_options, $aiosp;
    // Canonical
    $aioseop_options['aiosp_can'] = false;
    // Title
	add_filter('aioseop_title', '__return_null');
	// Description
	add_filter('aioseop_description', '__return_null');


	return $title;

}

function ecwid_seo_compatibility_restore()
{
    if (!array_key_exists('_escaped_fragment_', $_GET) || !ecwid_page_has_productbrowser()) {
        return;
    }

    ecwid_override_option('psp_canonical');
    ecwid_override_option('aiosp_rewrite_titles');
}

function add_ecwid_admin_bar_node() {
    global $wp_admin_bar;
     if ( !is_super_admin() || !is_admin_bar_showing() )
        return;

    $wp_admin_bar->add_menu( array(
        'id' => 'ecwid-main',
        'title' => '<span class="ab-icon ecwid-top-menu-item"></span>',
		'href' => 'admin.php?page=ecwid',
    ));
	$wp_admin_bar->add_menu(array(
			"id" => "ecwid-help",
			"title" => __("Get help", 'ecwid-shopping-cart'),
			"parent" => "ecwid-main",
			'href' =>  'http://help.ecwid.com'
		)
	);
    $wp_admin_bar->add_menu(array(
            "id" => "ecwid-home",
            "title" => __("Go to Ecwid site", 'ecwid-shopping-cart'),
            "parent" => "ecwid-main",
            'href' => 'http://www.ecwid.com?source=wporg'
        )
    );
    $wp_admin_bar->add_menu(array(
            "id" => "ecwid-go-to-page",
            "title" => __("Visit storefront", 'ecwid-shopping-cart'),
            "parent" => "ecwid-main",
            'href' => ecwid_get_store_page_url()
        )
    );
    $wp_admin_bar->add_menu(array(
            "id" => "ecwid-control-panel",
            "title" => __("Manage my store", 'ecwid-shopping-cart'),
            "parent" => "ecwid-main",
            'href' =>  'https://my.ecwid.com/cp/?source=wporg#t1=&t2=Dashboard'
        )
    );
	$wp_admin_bar->add_menu(array(
			"id" => "ecwid-settings",
			"title" => __("Manage plugin settings", 'ecwid-shopping-cart'),
			"parent" => "ecwid-main",
			'href' =>  admin_url('admin.php?page=ecwid')
		)
	);
	$wp_admin_bar->add_menu(array(
            "id" => "ecwid-fb-app",
            "title" => __("→ Sell on Facebook", 'ecwid-shopping-cart'),
            "parent" => "ecwid-main",
            'href' =>  'http://apps.facebook.com/ecwid-shop/?fb_source=wp'
        )
    );
}

function ecwid_content_has_productbrowser($content) {

	$result = has_shortcode($content, 'ecwid_productbrowser');

	if (!$result && has_shortcode($content, 'ecwid')) {
		$shortcodes = ecwid_find_shortcodes($content, 'ecwid');
		if ($shortcodes) foreach ($shortcodes as $shortcode) {

			$attributes = shortcode_parse_atts($shortcode[3]);

			if (isset($attributes['widgets'])) {
				$widgets = preg_split('![^0-9^a-z^A-Z^-^_]!', $attributes['widgets']);
				if (is_array($widgets) && in_array('productbrowser', $widgets)) {
					$result = true;
				}
			}
		}
	}

	return $result;
}

function ecwid_page_has_productbrowser($post_id = null)
{
	static $results = null;

	if (is_null($post_id)) {
		$post_id = get_the_ID();
	}

	if (!isset($results[$post_id])) {
		$post_content = get_post($post_id)->post_content;

		$results[$post_id] = ecwid_content_has_productbrowser($post_content);
		$results[$post_id] = apply_filters( 'ecwid_page_has_product_browser', $results[$post_id] );
	}

	return $results[$post_id];
}

function ecwid_ajax_crawling_fragment() {
    if (ecwid_is_api_enabled() && !isset($_GET['_escaped_fragment_']) && ecwid_page_has_productbrowser())
        echo '<meta name="fragment" content="!">' . PHP_EOL; 
}

function ecwid_meta() {

    echo '<link rel="dns-prefetch" href="//images-cdn.ecwid.com/">' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//images.ecwid.com/">' . PHP_EOL;
    echo '<link rel="dns-prefetch" href="//app.ecwid.com/">' . PHP_EOL;

    if (!ecwid_page_has_productbrowser() && ecwid_is_store_page_available()) {
        $page_url = ecwid_get_store_page_url();
        echo '<link rel="prefetch" href="' . $page_url . '" />' . PHP_EOL;
        echo '<link rel="prerender" href="' . $page_url . '" />' . PHP_EOL;
    }
}

function ecwid_canonical() {
	$allowed = ecwid_is_api_enabled() && isset($_GET['_escaped_fragment_']);
	if (!$allowed) return;

	$params = ecwid_parse_escaped_fragment($_GET['_escaped_fragment_']);
	if (!$params) return;

	if (!in_array($params['mode'], array('category', 'product')) || !isset($params['id'])) return;

	$api = ecwid_new_product_api();

	if ($params['mode'] == 'product') {
		$product = $api->get_product($params['id']);
		$link = ecwid_get_product_url($product);
	} else if ($params['mode'] == 'category') {
		$category = $api->get_category($params['id']);
		$link = ecwid_get_category_url($category);
	}

	echo '<link rel="canonical" href="' . esc_attr($link) . '" />' . PHP_EOL;
}

function ecwid_meta_description() {

    $allowed = ecwid_is_api_enabled() && isset($_GET['_escaped_fragment_']);
    if (!$allowed) return;

    $params = ecwid_parse_escaped_fragment($_GET['_escaped_fragment_']);
    if (!$params) return;

    if (!in_array($params['mode'], array('category', 'product')) || !isset($params['id'])) return;

    $api = ecwid_new_product_api();
    if ($params['mode'] == 'product') {
        $product = $api->get_product($params['id']);
        $description = $product['description'];
    } elseif ($params['mode'] == 'category') {
        $category = $api->get_category($params['id']);
        $description = $category['description'];
    } else return;

    $description = strip_tags($description);
    $description = html_entity_decode($description, ENT_NOQUOTES, 'UTF-8');

	$description = preg_replace('![\p{Z}\s]{1,}!u', ' ', $description);
	$description = trim($description, " \t\xA0\n\r"); // Space, tab, non-breaking space, newline, carriage return
	$description = mb_substr($description, 0, 160);
	$description = htmlspecialchars($description, ENT_COMPAT, 'UTF-8');

    echo <<<HTML
<meta name="description" content="$description" />
HTML;
}

function ecwid_ajax_hide_message($params)
{
	if (Ecwid_Message_Manager::disable_message($_GET['message'])) {
		wp_send_json(array('status' => 'success'));
	}
}

function ecwid_hide_vote_message()
{
	update_option('ecwid_show_vote_message', false);
}

function ecwid_get_product_and_category($category_id, $product_id) {
    $params = array 
    (
        array("alias" => "c", "action" => "category", "params" => array("id" => $category_id)),
        array("alias" => "p", "action" => "product", "params" => array("id" => $product_id)),           
    );

    $api = ecwid_new_product_api();
    $batch_result = $api->get_batch_request($params);

	if (false == $batch_result) {
		$product = $api->get_product($product_id);
		$category = false;
	} else {
		$category = $batch_result["c"];
		$product = $batch_result["p"];
	}

    $return = "";

    if (is_array($product)) {
        $return .=$product["name"];
    }

    if(is_array($category)) {
        $return.=" | ";
        $return .=$category["name"];
    }
    return $return;
}

function ecwid_seo_title($content) {
    if (isset($_GET['_escaped_fragment_']) && ecwid_is_api_enabled()) {
    $params = ecwid_parse_escaped_fragment($_GET['_escaped_fragment_']);
    $ecwid_seo_title = '';

    $api = ecwid_new_product_api();

    if (isset($params['mode']) && !empty($params['mode'])) {
        if ($params['mode'] == 'product') {
            if (isset($params['category']) && !empty($params['category'])){
                $ecwid_seo_title = ecwid_get_product_and_category($params['category'], $params['id']);
            } elseif (empty($params['category'])) {
                $ecwid_product = $api->get_product($params['id']);
                $ecwid_seo_title = $ecwid_product['name'];
                if(is_array($ecwid_product['categories'])){
                    foreach ($ecwid_product['categories'] as $ecwid_category){
                        if($ecwid_category['defaultCategory']==true){
                        $ecwid_seo_title .=" | ";
                        $ecwid_seo_title .=  $ecwid_category['name'];
                        }
                    }
                }
            }
        }

        elseif ($params['mode'] == 'category'){
         $api = ecwid_new_product_api();
         $ecwid_category = $api->get_category($params['id']);
         $ecwid_seo_title =  $ecwid_category['name'];
        }
    }

    if (!empty($ecwid_seo_title))
        return $ecwid_seo_title . " | " . $content;
    else
        return $content;

    } else {
        return $content;
    }
}

function ecwid_add_credits($powered_by)
{
	if (!ecwid_is_paid_account()) {

		$new_powered_by = '<li>';
		$new_powered_by .= sprintf(
			__('<a %s>Online store powered by Ecwid</a>', 'ecwid-shopping-cart'),
			'target="_blank" href="//www.ecwid.com?source=wporg-metalink"'
		);
		$new_powered_by .= '</li>';

		$powered_by .= $new_powered_by;
	}

	return $powered_by;
}

function ecwid_content_started($content)
{
	global $ecwid_script_rendered;

	$ecwid_script_rendered = false;

	return $content;
}

function ecwid_wrap_shortcode_content($content, $name)
{
    return "<!-- Ecwid shopping cart plugin v 2.7.4.1 -->"
		   . ecwid_get_scriptjs_code()
	       . "<div class=\"ecwid-shopping-cart-$name\">$content</div>"
		   . "<!-- END Ecwid Shopping Cart v 2.7.4.1 -->";
}

function ecwid_get_scriptjs_code($force_lang = null) {
	global $ecwid_script_rendered;

    if (!$ecwid_script_rendered) {
		$store_id = get_ecwid_store_id();
		$force_lang_str = !is_null($force_lang) ? "&lang=$force_lang" : '';
		$s =  '<script data-cfasync="false" type="text/javascript" src="//' . APP_ECWID_COM . '/script.js?' . $store_id . '&data_platform=wporg' . $force_lang_str . '"></script>';
		$s = $s . ecwid_sso();
		$ecwid_script_rendered = true;

		return $s;
    } else {
		return '';
    }
}

function ecwid_script_shortcode($params) {
	$attributes = shortcode_atts(
		array(
			'lang' => null
		), $params
	);

	$content = "";
	if (!is_null($attributes['lang'])) {
		$content = ecwid_get_scriptjs_code($attributes['lang']);
	}

    return ecwid_wrap_shortcode_content($content, 'script');
}

function ecwid_minicart_shortcode($attributes) {

	$params = shortcode_atts(
		array(
			'layout' => null,
			'is_ecwid_shortcode' => false
		), $attributes
	);

	$layout = $params['layout'];
	if (!in_array($layout, array('', 'attachToCategories', 'floating', 'Mini', 'MiniAttachToProductBrowser'), true)) {
		$layout = 'attachToCategories';
	}

	if ($params['is_ecwid_shortcode']) {
		// it is a part of the ecwid shortcode, we need to show it anyways
		$ecwid_enable_minicart = $ecwid_show_categories = true;
	} else {
		// it is a ecwid_minicart widget that works based on appearance settings
		$ecwid_enable_minicart = get_option('ecwid_enable_minicart');
		$ecwid_show_categories = get_option('ecwid_show_categories');
	}

	$result = '';

	if (!empty($ecwid_enable_minicart) && !empty($ecwid_show_categories)) {
		$result = <<<EOT
<script type="text/javascript"> xMinicart("style=","layout=$layout"); </script>
EOT;
	}

	$result = apply_filters('ecwid_minicart_shortcode_content', $result);

	if (!empty($result)) {
		$result = ecwid_wrap_shortcode_content($result, 'minicart');
	}

	return $result;
}

function ecwid_searchbox_shortcode($attributes) {

	$params = shortcode_atts(
		array(
			'is_ecwid_shortcode' => false
		), $attributes
	);

	$ecwid_show_search_box = $params['is_ecwid_shortcode'] ? true : get_option('ecwid_show_search_box');

	$result = '';
	if (!empty($ecwid_show_search_box)) {
  	$result = <<<EOT
<script type="text/javascript"> xSearchPanel("style="); </script>
EOT;
  }

	$result = apply_filters('ecwid_search_shortcode_content', $result);

	if (!empty($result)) {
		$result = ecwid_wrap_shortcode_content($result, 'search');
	}

	return $result;
}

function ecwid_categories_shortcode($attributes) {

	$params = shortcode_atts(
		array(
			'is_ecwid_shortcode' => false
		), $attributes
	);

  $ecwid_show_categories = $params['is_ecwid_shortcode'] ? true : get_option('ecwid_show_categories');

	$result = '';
  if (!empty($ecwid_show_categories)) {
  	$result = <<<EOT
<script type="text/javascript"> xCategories("style="); </script>
EOT;
  }

	$result = apply_filters('ecwid_categories_shortcode_content', $result);

	if (!empty($result)) {
		$result = ecwid_wrap_shortcode_content($result, 'categories');
	}

	return $result;
}

function ecwid_product_shortcode($shortcode_attributes) {

	$attributes = shortcode_atts(
		array(
			'id' => null,
			'display' => 'picture title price options addtobag',
			'link' => 'yes'
		),
		$shortcode_attributes
	);

	$id = $attributes['id'];

	if (is_null($id) || !is_numeric($id) || $id <= 0) return;

	if ($attributes['link'] == 'yes' && !ecwid_is_store_page_available()) {
		$attributes['link'] = 'no';
	}

	$display_items = array(
		'picture'  => '<div itemprop="picture"></div>',
		'title'    => '<div class="ecwid-title" itemprop="title"></div>',
		'price'    => '<div itemtype="http://schema.org/Offer" itemscope itemprop="offers">'
					    . '<div class="ecwid-productBrowser-price ecwid-price" itemprop="price"></div>'
				 	    . '</div>',
		'options'  => '<div itemprop="options"></div>',
		'qty' 	   => '<div itemprop="qty"></div>',
		'addtobag' => '<div itemprop="addtobag"></div>'
 	);

	$result = sprintf(
		'<div class="ecwid ecwid-SingleProduct ecwid-Product ecwid-Product-%d" '
		. 'itemscope itemtype="http://schema.org/Product" '
		. 'data-single-product-id="%d">',
		$id, $id
	);

	$items = preg_split('![^0-9^a-z^A-Z^\-^_]!', $attributes['display']);

	if (is_array($items) && count($items) > 0) foreach ($items as $item) {
		if (array_key_exists($item, $display_items)) {
			if ($attributes['link'] == 'yes' && in_array($item, array('title', 'picture'))) {
				$product_link = ecwid_get_store_page_url() . '#!/~/product/id=' . $id;
				$result .= '<a href="' . esc_url($product_link) . '">' . $display_items[$item] . '</a>';
			} else {
				$result .= $display_items[$item];
			}
		}
	}

	$result .= '</div>';

	$result .= ecwid_get_product_browser_url_script();
	$result .= '<script type="text/javascript">xSingleProduct()</script>';

	update_option('ecwid_single_product_used', time());

	return ecwid_wrap_shortcode_content($result, 'product');
}

function ecwid_shortcode($attributes)
{
	$attributes = shortcode_atts(
		array(
			'widgets' 					  => 'productbrowser',
			'categories_per_row'  => '3',
			'category_view' 		  => 'grid',
			'search_view' 			  => 'grid',
			'grid' 							  => '3,3',
			'list' 							  => '10',
			'table' 						  => '20',
			'minicart_layout' 	  => 'attachToCategories',
			'default_category_id' => 0
		)
		, $attributes
	);

	$allowed_widgets = array('productbrowser', 'search', 'categories', 'minicart');
	$widgets = preg_split('![^0-9^a-z^A-Z^-^_]!', $attributes['widgets']);
	foreach ($widgets as $key => $widget) {
		if (!in_array($widget, $allowed_widgets)) {
			unset($widgets[$key]);
		}
	}

	if (empty($widgets)) {
		$widgets = array('productbrowser');
	}

	$attributes['layout'] = $attributes['minicart_layout'];
	$attributes['is_ecwid_shortcode'] = true;

	$result = '';

	$widgets_order = array('minicart', 'search', 'categories', 'productbrowser');
	foreach ($widgets_order as $widget) {
		if (in_array($widget, $widgets)) {
			if ($widget == 'search') {
				$widget = 'searchbox';
			}

			$result .= call_user_func_array('ecwid_' . $widget . '_shortcode', array($attributes));
		}
	}

	update_option('ecwid_store_shortcode_used', time());

	return $result;
}

function ecwid_productbrowser_shortcode($shortcode_params) {

		$atts = shortcode_atts(
			array(
				'categories_per_row' => false,
				'grid' => false,
				'list' => false,
				'table' => false,
				'search_view' => false,
				'category_view' => false
			), $shortcode_params
		);

		$grid = explode(',', $atts['grid']);
	  if (count($grid) == 2) {
			$atts['grid_rows'] = intval($grid[0]);
			$atts['grid_cols'] = intval($grid[1]);
		} else {
			list($atts['grid_rows'], $atts['grid_cols']) = array(false, false);
		}

    $store_id = get_ecwid_store_id();
    $list_of_views = array('list','grid','table');

    $ecwid_pb_categoriesperrow = $atts['categories_per_row'] ? $atts['categories_per_row'] : get_option('ecwid_pb_categoriesperrow');
    $ecwid_pb_productspercolumn_grid = $atts['grid_rows'] ? $atts['grid_rows'] : get_option('ecwid_pb_productspercolumn_grid');
    $ecwid_pb_productsperrow_grid = $atts['grid_cols'] ? $atts['grid_cols'] : get_option('ecwid_pb_productsperrow_grid');
    $ecwid_pb_productsperpage_list = $atts['list'] ? $atts['list'] : get_option('ecwid_pb_productsperpage_list');
    $ecwid_pb_productsperpage_table = $atts['table'] ? $atts['table'] : get_option('ecwid_pb_productsperpage_table');
    $ecwid_pb_defaultview = $atts['category_view'] ? $atts['category_view'] : get_option('ecwid_pb_defaultview');
    $ecwid_pb_searchview = $atts['search_view'] ? $atts['search_view'] : get_option('ecwid_pb_searchview');

    $ecwid_mobile_catalog_link = get_option('ecwid_mobile_catalog_link');
    $ecwid_default_category_id =
        !empty($shortcode_params) && array_key_exists('default_category_id', $shortcode_params)
        ? $shortcode_params['default_category_id']
        : get_option('ecwid_default_category_id');

    if (empty($ecwid_pb_categoriesperrow)) {
        $ecwid_pb_categoriesperrow = 3;
    }
    if (empty($ecwid_pb_productspercolumn_grid)) {
        $ecwid_pb_productspercolumn_grid = 3;
    }
    if (empty($ecwid_pb_productsperrow_grid)) {
        $ecwid_pb_productsperrow_grid = 3;
    }
    if (empty($ecwid_pb_productsperpage_list)) {
        $ecwid_pb_productsperpage_list = 10;
    }
    if (empty($ecwid_pb_productsperpage_table)) {
        $ecwid_pb_productsperpage_table = 20;
    }

    if (empty($ecwid_pb_defaultview) || !in_array($ecwid_pb_defaultview, $list_of_views)) {
        $ecwid_pb_defaultview = 'grid';
    }
    if (empty($ecwid_pb_searchview) || !in_array($ecwid_pb_searchview, $list_of_views)) {
        $ecwid_pb_searchview = 'list';
    }

	  if (empty($ecwid_default_category_id)) {
        $ecwid_default_category_str = '';
    } else {
        $ecwid_default_category_str = ',"defaultCategoryId='. $ecwid_default_category_id .'"';
    }

    $plain_content = '';

    if (ecwid_can_display_html_catalog()) {
		$params = ecwid_parse_escaped_fragment($_GET['_escaped_fragment_']);
		include_once WP_PLUGIN_DIR . '/ecwid-shopping-cart/lib/ecwid_product_api.php';
		include_once WP_PLUGIN_DIR . '/ecwid-shopping-cart/lib/ecwid_catalog.php';

		$page_url = get_page_link();

		$catalog = new EcwidCatalog($store_id, $page_url);

		if (isset($params['mode']) && !empty($params['mode'])) {
			if ($params['mode'] == 'product') {
				$plain_content = $catalog->get_product($params['id']);
				$url = ecwid_get_product_url(ecwid_new_product_api()->get_product($params['id']));
			} elseif ($params['mode'] == 'category') {
				$plain_content = $catalog->get_category($params['id']);
				$ecwid_default_category_str = ',"defaultCategoryId=' . $params['id'] . '"';
				$url = ecwid_get_category_url(ecwid_new_product_api()->get_category($params['id']));
			}

		} else {
			$plain_content = $catalog->get_category(intval($ecwid_default_category_id));
			if (empty($plain_content)) {
				$plain_content = $catalog->get_category(0);
			} else {
				$url = ecwid_get_category_url(ecwid_new_product_api()->get_category($params['id']));
			}
		}
		if ($url) {
			$parsed = parse_url($url);
			$plain_content .= '<script type="text/javascript"> if (!document.location.hash) document.location.hash = "'. $parsed['fragment'] . '";</script>';
		}
    }

	$s = '';

	$s = <<<EOT
    <div id="ecwid-store-$store_id">
		{$plain_content}
	</div>
	<script type="text/javascript"> xProductBrowser("categoriesPerRow=$ecwid_pb_categoriesperrow","views=grid($ecwid_pb_productspercolumn_grid,$ecwid_pb_productsperrow_grid) list($ecwid_pb_productsperpage_list) table($ecwid_pb_productsperpage_table)","categoryView=$ecwid_pb_defaultview","searchView=$ecwid_pb_searchview","style="$ecwid_default_category_str, "id=ecwid-store-$store_id");</script>
EOT;
    return ecwid_wrap_shortcode_content($s, 'product-browser');
}


function ecwid_parse_escaped_fragment($escaped_fragment) {
	$fragment = urldecode($escaped_fragment);
	$return = array();

	if (preg_match('/^(\/~\/)([a-z]+)\/(.*)$/', $fragment, $matches)) {
		parse_str($matches[3], $return);
		$return['mode'] = $matches[2];
	} elseif (preg_match('!.*/(p|c)/([0-9]*)!', $fragment, $matches)) {
		if (count($matches) == 3 && in_array($matches[1], array('p', 'c'))) {
			$return  = array(
				'mode' => 'p' == $matches[1] ? 'product' : 'category',
				'id' => $matches[2]
			);
		}
	}

	return $return;
}

function ecwid_store_activate() {
	$my_post = array();
	$content = <<<EOT
<!-- Ecwid code. Please do not remove this line  otherwise your Ecwid shopping cart will not work properly. --> [ecwid widgets="productbrowser search" grid="3,3" list="10" table="20" default_category_id="0" category_view="grid" search_view="grid" minicart_layout="attachToCategories" ] <!-- Ecwid code end -->
EOT;
  	add_option("ecwid_store_page_id", '', '', 'yes');
	add_option("ecwid_store_page_id_auto", '', '', 'yes');

	add_option("ecwid_store_id", ECWID_DEMO_STORE_ID, '', 'yes');
    
    add_option("ecwid_enable_minicart", 'Y', '', 'yes');
    add_option("ecwid_show_categories", '', '', 'yes');
    add_option("ecwid_show_search_box", '', '', 'yes');

    add_option("ecwid_pb_categoriesperrow", '3', '', 'yes');

    add_option("ecwid_pb_productspercolumn_grid", '3', '', 'yes');
    add_option("ecwid_pb_productsperrow_grid", '3', '', 'yes');
    add_option("ecwid_pb_productsperpage_list", '10', '', 'yes');
    add_option("ecwid_pb_productsperpage_table", '20', '', 'yes');

    add_option("ecwid_pb_defaultview", 'grid', '', 'yes');
    add_option("ecwid_pb_searchview", 'list', '', 'yes');

    add_option("ecwid_mobile_catalog_link", '', '', 'yes');  
    add_option("ecwid_default_category_id", '', '', 'yes');  
     
    add_option('ecwid_is_api_enabled', 'on', '', 'yes');
    add_option('ecwid_api_check_time', 0, '', 'yes');

	add_option('ecwid_show_vote_message', true);

    add_option("ecwid_sso_secret_key", '', '', 'yes'); 

	add_option("ecwid_installation_date", time());

	add_option('ecwid_hide_appearance_menu', get_option('ecwid_store_id') == ECWID_DEMO_STORE_ID ? 'Y' : 'N', 'yes');
	// Does not affect updates, automatically turned on for new users only
	add_option("ecwid_advanced_theme_layout", get_option('ecwid_store_id') == ECWID_DEMO_STORE_ID ? 'Y' : 'N', 'yes');

    $id = get_option("ecwid_store_page_id");	
	$_tmp_page = null;
	if (!empty($id) and ($id > 0)) { 
		$_tmp_page = get_post($id);
	}
	if ($_tmp_page !== null) {
		$my_post = array();
		$my_post['ID'] = $id;
		$my_post['post_status'] = 'publish';
		wp_update_post( $my_post );

	} else {
        ecwid_load_textdomain();
		$my_post['post_title'] = __('Store', 'ecwid-shopping-cart');
		$my_post['post_content'] = $content;
		$my_post['post_status'] = 'publish';
		$my_post['post_author'] = 1;
		$my_post['post_type'] = 'page';
		$my_post['comment_status'] = 'closed';
		$id = wp_insert_post( $my_post );
		update_option('ecwid_store_page_id', $id);

		if (ecwid_get_theme_name() == 'Responsive') {
			update_post_meta($id, '_wp_page_template', 'full-width-page.php');
			update_option("ecwid_show_search_box", 'Y');
		}
	}

	Ecwid_Message_Manager::enable_message('on_activate');

}

function ecwid_show_admin_messages() {
	if (is_admin()) {
		Ecwid_Message_Manager::show_messages();
	}
}

function ecwid_show_admin_message($message) {

	$class = version_compare(get_bloginfo('version'), '3.0') < 0 ? "updated fade" : "update-nag";
	echo sprintf('<div class="%s" style="margin-top: 5px">%s</div>', $class, $message);
}

function ecwid_store_deactivate() {
	$ecwid_page_id = get_option("ecwid_store_page_id");
	$_tmp_page = null;
	if (!empty($ecwid_page_id) and ($ecwid_page_id > 0)) {
		$_tmp_page = get_page($ecwid_page_id);
		if ($_tmp_page !== null) {
			$my_post = array();
			$my_post['ID'] = $ecwid_page_id;
			$my_post['post_status'] = 'draft';
			wp_update_post( $my_post );
		} else {
			update_option('ecwid_store_page_id', '');	
		}
	}

	Ecwid_Message_Manager::reset_hidden_messages();
}

function ecwid_abs_intval($value) {
	if (!is_null($value))
    	return abs(intval($value));
	else
		return null;
}

function ecwid_options_add_page() {

	$is_newbie = get_ecwid_store_id() == ECWID_DEMO_STORE_ID;

	add_menu_page(
		__('Ecwid shopping cart settings', 'ecwid-shopping-cart'),
		__('Ecwid Store', 'ecwid-shopping-cart'),
		'manage_options',
		'ecwid',
		'ecwid_general_settings_do_page'
	);


	if ($is_newbie) {
		$title = __('Setup', 'ecwid-shopping-cart');
	} else {
		$title = __('Dashboard', 'ecwid-shopping-cart');
	}
	add_submenu_page(
		'ecwid',
		$title,
		$title,
		'manage_options',
		'ecwid',
		'ecwid_general_settings_do_page'
	);

	if (get_option('ecwid_hide_appearance_menu') != 'Y') {
		add_submenu_page(
			'ecwid',
			__('Appearance settings', 'ecwid-shopping-cart'),
			__('Appearance', 'ecwid-shopping-cart'),
			'manage_options',
			'ecwid-appearance',
			'ecwid_appearance_settings_do_page'
		);
	}

	if (!$is_newbie || $_GET['page'] == 'ecwid-advanced') {
		add_submenu_page(
			'ecwid',
			__('Advanced settings', 'ecwid-shopping-cart'),
			__('Advanced', 'ecwid-shopping-cart'),
			'manage_options',
			'ecwid-advanced',
			'ecwid_advanced_settings_do_page'
		);
	}
	//add_options_page('Ecwid shopping cart settings', 'Ecwid shopping cart', 'manage_options', 'ecwid_options_page', 'ecwid_options_do_page');
}

function ecwid_register_admin_styles() {

	wp_enqueue_style('ecwid-admin-css', plugins_url('ecwid-shopping-cart/css/admin.css'));

	if (version_compare(get_bloginfo('version'), '3.8-beta') > 0) {
		wp_enqueue_style('ecwid-admin38-css', plugins_url('ecwid-shopping-cart/css/admin.3.8.css'), array('ecwid-admin-css'), '', 'all');
	}
}

function ecwid_register_settings_styles() {

	wp_enqueue_style('ecwid-settings-pure-css', plugins_url('ecwid-shopping-cart/css/pure-min.css'), array(), '', 'all');
	wp_enqueue_style('ecwid-settings-css', plugins_url('ecwid-shopping-cart/css/settings.css'), array(), '', 'all');

	if (version_compare(get_bloginfo('version'), '3.8-beta') > 0) {
		wp_enqueue_style('ecwid-settings38-css', plugins_url('ecwid-shopping-cart/css/settings.3.8.css'), array('ecwid-settings-css'), '', 'all');
	}}

function ecwid_plugin_actions($links) {
	$settings_link = "<a href='admin.php?page=ecwid'>"
		. (get_ecwid_store_id() == ECWID_DEMO_STORE_ID ? __('Setup', 'ecwid-shopping-cart') : __('Settings') )
		. "</a>";
	array_unshift( $links, $settings_link );

	return $links;
}


function ecwid_settings_api_init() {

	if (isset($_POST['settings_section'])) switch ($_POST['settings_section']) {
		case 'appearance':
			register_setting('ecwid_options_page', 'ecwid_enable_minicart');

			register_setting('ecwid_options_page', 'ecwid_show_categories');
			register_setting('ecwid_options_page', 'ecwid_show_search_box');

			register_setting('ecwid_options_page', 'ecwid_pb_categoriesperrow', 'ecwid_abs_intval');
			register_setting('ecwid_options_page', 'ecwid_pb_productspercolumn_grid', 'ecwid_abs_intval');
			register_setting('ecwid_options_page', 'ecwid_pb_productsperrow_grid', 'ecwid_abs_intval');
			register_setting('ecwid_options_page', 'ecwid_pb_productsperpage_list', 'ecwid_abs_intval');
			register_setting('ecwid_options_page', 'ecwid_pb_productsperpage_table', 'ecwid_abs_intval');
			register_setting('ecwid_options_page', 'ecwid_pb_defaultview');
			register_setting('ecwid_options_page', 'ecwid_pb_searchview');
			break;

		case 'general':
			register_setting('ecwid_options_page', 'ecwid_store_id','ecwid_abs_intval' );
			if (isset($POST['ecwid_store_id']) && intval($_POST['ecwid_store_id']) == 0) {
				Ecwid_Message_Manager::reset_hidden_messages();
			}
			break;

		case 'advanced':
			register_setting('ecwid_options_page', 'ecwid_default_category_id', 'ecwid_abs_intval');
			register_setting('ecwid_options_page', 'ecwid_sso_secret_key');
			register_setting('ecwid_options_page', 'ecwid_enable_advanced_theme_layout');
			break;
	}

	if (isset($_POST['ecwid_store_id'])) {
		update_option('ecwid_is_api_enabled', 'off');
		update_option('ecwid_api_check_time', 0);
	}
}

function ecwid_common_admin_scripts() {

	wp_enqueue_script('ecwid-admin-js', plugins_url('ecwid-shopping-cart/js/admin.js'));
	wp_enqueue_script('ecwid-modernizr-js', plugins_url('ecwid-shopping-cart/js/modernizr.js'));
}

function ecwid_admin_get_footer() {

}

function ecwid_general_settings_do_page() {

	if (get_ecwid_store_id() == ECWID_DEMO_STORE_ID) {
		require_once plugin_dir_path(__FILE__) . '/templates/setup.php';
	} else {
		require_once plugin_dir_path(__FILE__) . '/templates/dashboard.php';
	}
}

function ecwid_get_categories_for_selector() {
	$categories = false;
	if (ecwid_is_paid_account()) {
		$api = ecwid_new_product_api();
		$categories = $api->get_all_categories();
		$by_id = array();
		foreach ($categories as $key => $category) {
			$by_id[$category['id']] = $category;
		}
		unset($categories);

		foreach ($by_id as $id => $category) {
			$name_path = array($category['name']);
			while (is_array($category) && isset($category['parentId'])) {
				$name = '';
				if (isset($by_id[$category['parentId']])) {
					$name = $by_id[$category['parentId']]['name'];
				} else {
					$name = __('Hidden category', 'ecwid-shopping-cart');
				}
				$name_path[] = $name;
				$category = isset($by_id[$category['parentId']]) ? $by_id[$category['parentId']] : false;
			}

			$by_id[$id]['path'] = array_reverse($name_path);
			$by_id[$id]['path_str'] = implode(" > ", $by_id[$id]['path']);
		}

		function sort_by_path($a, $b) {
			return strcmp($a['path_str'], $b['path_str']);
		}

		uasort($by_id, 'sort_by_path');

		$categories = $by_id;
	}

	return $categories;
}

function ecwid_advanced_settings_do_page() {
	$categories = ecwid_get_categories_for_selector();

	require_once plugin_dir_path(__FILE__) . '/templates/advanced-settings.php';
}

function ecwid_appearance_settings_do_page() {

	wp_register_script('ecwid-appearance-js', plugins_url('ecwid-shopping-cart/js/appearance.js'), array(), '', true);
	wp_enqueue_script('ecwid-appearance-js');

	$disabled = false;
	if (!empty($ecwid_page_id) && ($ecwid_page_id > 0)) {
		$_tmp_page = get_post($ecwid_page_id);
		$content = $_tmp_page->post_content;
		if ( (strpos($content, "[ecwid_productbrowser]") === false) && (strpos($content, "xProductBrowser") !== false) )
			$disabled = true;
	}
	// $disabled_str is used in appearance settings template
	if ($disabled)
		$disabled_str = 'disabled = "disabled"';
	else
		$disabled_str = "";

	require_once ECWID_PLUGIN_DIR . 'templates/appearance-settings.php';
}

function get_ecwid_store_id() {
    static $store_id = null;
    if (is_null($store_id)) {
        $store_id = get_option('ecwid_store_id');
        if (empty($store_id))
          $store_id = ECWID_DEMO_STORE_ID;
    }

	return $store_id;
}

function ecwid_dashboard_widget_function() {
echo "<a href=\"https://my.ecwid.com/\" target=\"_blank\">Go to the Ecwid Control Panel</a><br /><br /><a href=\"http://kb.ecwid.com/\" target=\"_blank\">Ecwid Knowledge Base</a>&nbsp;|&nbsp;<a href=\"http://www.ecwid.com/forums/\" target=\"_blank\">Ecwid Forums</a>";
} 

function ecwid_add_dashboard_widgets() {
  if (current_user_can('administrator')) {
    wp_add_dashboard_widget('ecwid_dashboard_widget','Ecwid Links', 'ecwid_dashboard_widget_function');	
  }
}

function ecwid_save_post($post_id)
{
	// If primary or auto store page gets updated
	if ($post_id == get_option('ecwid_store_page_id') || $post_id == get_option('ecwid_store_page_id_auto')) {
		$new_status = get_post_status($post_id);

		// and the update either disables the page or removes product browser
		if (!in_array($new_status, array('publish', 'private')) || !ecwid_page_has_productbrowser($post_id)) {

			// then look for another enabled page that has a product browser in it
			$pages = get_pages(array('post_status' => 'publish,private'));

			foreach ($pages as $page) {
				if (ecwid_page_has_productbrowser($page->ID)) {
					update_option('ecwid_store_page_id_auto', $page->ID);
					return;
				}
			}
		}
	}

	// if there is no current store page and this new page has a product browser
	if (ecwid_page_has_productbrowser($post_id) && !ecwid_get_current_store_page_id()) {
		// then this page becomes a new store page
		update_option('ecwid_store_page_id_auto', $post_id);
	}
}

function ecwid_get_current_store_page_id()
{
	static $page_id = null;

	if (is_null($page_id)) {
		$page_id = false;
		foreach(array('ecwid_store_page_id', 'ecwid_store_page_id_auto') as $option) {
			$id = get_option($option);
			if ($id) {
				$status = get_post_status($id);

				if ($status == 'publish' || $status == 'private') {
					$page_id = $id;
					break;
				}
			}
		}
	}

	return $page_id;
}

function ecwid_get_store_page_url()
{
	static $link = null;

	if (is_null($link)) {
		$link = get_page_link(ecwid_get_current_store_page_id());
	}

	return $link;
}

function ecwid_is_store_page_available()
{
	return ecwid_get_current_store_page_id() != false;
}

function ecwid_get_product_url($product)
{
	return ecwid_get_entity_url($product, 'p');
}

function ecwid_get_category_url($category)
{
	return ecwid_get_entity_url($category, 'c');
}

function ecwid_get_entity_url($entity, $type) {

	$link = ecwid_get_store_page_url();

	if (is_numeric($entity)) {
		return $link . '#!/' . $type . '/' . $entity;
	} elseif (is_array($entity) && isset($entity['url'])) {
		$link .= substr($entity['url'], strpos($entity['url'], '#'));
	}

	return $link;

}

function ecwid_get_product_browser_url_script()
{
	$str = '';
	if (ecwid_is_store_page_available()) {
		$url = ecwid_get_store_page_url();

		$str = '<script type="text/javascript">var ecwid_ProductBrowserURL = "' . esc_js($url) . '";</script>';
	}

	return $str;

}

class EcwidBadgeWidget extends WP_Widget {

	var $url_template = "http://static.ecwid.com/badges/%s.png";
	var $available_badges;
	
	function EcwidBadgeWidget() {
		$widget_ops = array('classname' => 'widget_ecwid_badge', 'description' => __("If you like Ecwid and want to help it grow and become the most popular e-commerce solution, you can now add a fancy 'Powered by Ecwid' badge on your site to show your visitors that you're a proud user of Ecwid.", 'ecwid-shopping-cart') );
		$this->WP_Widget('ecwidbadge', __('Ecwid Badge', 'ecwid-shopping-cart'), $widget_ops);

		$this->available_badges = array(
			'ecwid-shopping-cart-widget-5' => array (
				'name'   => 'ecwid-shopping-cart-widget-5',
				'width'  => '73',
				'height' => '20',
				'alt'    => __('Ecwid shopping cart widget', 'ecwid-shopping-cart')
			),
			'ecwid-shopping-cart-widget-6' => array (
				'name'   => 'ecwid-shopping-cart-widget-6',
				'width'  => '73',
				'height' => '20',
				'alt'    => __('Ecwid shopping cart widget', 'ecwid-shopping-cart')
			),
			'ecwid-ecommerce-solution-2' => array (
				'name'   => 'ecwid-ecommerce-solution-2',
				'width'  => '165',
				'height' => '58',
				'alt'    => __('Ecwid ecommerce solution', 'ecwid-shopping-cart')
			),
			'ecwid-free-shopping-cart-2' => array (
				'name'   => 'ecwid-free-shopping-cart-2',
				'width'  => '175',
				'height' => '58',
				'alt'    => __('Ecwid free shopping cart', 'ecwid-shopping-cart')
			),
			'ecwid-shopping-cart-3' => array (
				'name'   => 'ecwid-shopping-cart-3',
				'width'  => '165',
				'height' => '56',
				'alt'    => __('Ecwid shopping cart', 'ecwid-shopping-cart')
			),
			'ecwid-ecommerce-widgets-3' => array (
				'name'   => 'ecwid-ecommerce-widgets-3',
				'width'  => '165',
				'height' => '58',
				'alt'    => __('Ecwid e-commerce widgets', 'ecwid-shopping-cart')
			),
			'ecwid-shopping-cart-3' => array (
				'name'   => 'ecwid-shopping-cart-3',
				'width'  => '165',
				'height' => '56',
				'alt'    => __('Ecwid shopping cart', 'ecwid-shopping-cart')
			),
			'ecwid-ecommerce-widgets-3' => array (
				'name'   => 'ecwid-ecommerce-widgets-3',
				'width'  => '165',
				'height' => '58',
				'alt'    => __('Ecwid e-commerce widgets', 'ecwid-shopping-cart')
			),
			'ecwid-ecommerce-solution-3' => array (
				'name'   => 'ecwid-ecommerce-solution-3',
				'width'  => '165',
				'height' => '58',
				'alt'    => __('Ecwid ecommerce solution', 'ecwid-shopping-cart')
			),
			'ecwid-free-shopping-cart-3' => array (
				'name'   => 'ecwid-free-shopping-cart-3',
				'width'  => '175',
				'height' => '58',
				'alt'    => __('Ecwid free shopping cart', 'ecwid-shopping-cart')
			)
		);
	}

	function widget($args, $instance)
	{
		extract($args);

		if (!isset($instance['badge_id']) || !array_key_exists($instance['badge_id'], $this->available_badges)) {
			return;
		}
		$badge = $this->available_badges[$instance['badge_id']];
		$url = sprintf($this->url_template, $badge['name']);

		echo $before_widget;

		echo <<<HTML
<div>
	<a target="_blank" rel="nofollow" href="http://www.ecwid.com?source=wporg-badge">
		<img src="$url" width="$badge[width]" height="$badge[height]" alt="$badge[alt]" />
	</a>
</div>
HTML;

		echo $after_widget;
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['badge_id'] =
			array_key_exists($new_instance['badge_id'], $this->available_badges)
			? $new_instance['badge_id']
			: '';

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('badge_id' => 'ecwid-shopping-cart-widget-5') );

		foreach ($this->available_badges as $id => $widget) {
			$element_id = "badge-$id";
			$name = $this->get_field_name('badge_id');
			$checked = '';
			if (isset($instance['badge_id']) && $instance['badge_id'] == $id) {
				$checked = 'checked="checked"';
			}
			$url = sprintf($this->url_template, $id);
			$content = <<<HTML
				<label class="ecwid-badge">
					<div class="checkbox">
						<input name="$name" type="radio" value="$widget[name]"$checked/>
					</div>
					<div class="image">
						<img src="$url" width="$widget[width]" height="$widget[height]" alt="$widget[alt]" />
					</div>
				</label>
HTML;
			echo $content;
		}
	}
}

class EcwidMinicartWidget extends WP_Widget {

    function EcwidMinicartWidget() {
		$widget_ops = array('classname' => 'widget_ecwid_minicart', 'description' => __("Your store's minicart", 'ecwid-shopping-cart') );
    	$this->WP_Widget('ecwidminicart', __('Ecwid Shopping Bag (Normal)', 'ecwid-shopping-cart'), $widget_ops);

	}

    function widget($args, $instance) {
	    extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;

        echo '<div>';

		echo ecwid_get_scriptjs_code();
		echo ecwid_get_product_browser_url_script();
        echo '<script type="text/javascript"> xMinicart("style="); </script>';

		echo '</div>';

        echo $after_widget;
    }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'') );

      $title = htmlspecialchars($instance['title']);

      echo '<p><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width:100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
  }

}

class EcwidMinicartMiniViewWidget extends WP_Widget {

    function EcwidMinicartMiniViewWidget() {
    $widget_ops = array('classname' => 'widget_ecwid_minicart_miniview', 'description' => __("Your store's minicart", 'ecwid-shopping-cart') );
    $this->WP_Widget('ecwidminicart_miniview', __('Ecwid Shopping Bag (Mini view)', 'ecwid-shopping-cart'), $widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);

        echo $before_widget;

        if ( $title )
            echo $before_title . $title . $after_title;


		echo '<div>';

		echo ecwid_get_scriptjs_code();
		echo ecwid_get_product_browser_url_script();
		echo '<script type="text/javascript"> xMinicart("style=left:10px","layout=Mini"); </script>';

		echo '</div>';

        echo $after_widget;
    }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'') );

      $title = htmlspecialchars($instance['title']);

      echo '<p><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width:100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
  }

}


class EcwidSearchWidget extends WP_Widget {

    function EcwidSearchWidget() {
    $widget_ops = array('classname' => 'widget_ecwid_search', 'description' => __("Your store's search box", 'ecwid-shopping-cart'));
    $this->WP_Widget('ecwidsearch', __('Ecwid Search Box', 'ecwid-shopping-cart'), $widget_ops);
    }

    function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;

		echo '<div>';

		echo ecwid_get_scriptjs_code();
		echo ecwid_get_product_browser_url_script();
		echo '<script type="text/javascript"> xSearchPanel("style="); </script>';

		echo '</div>';

      
		echo $after_widget;
    }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'') );

      $title = htmlspecialchars($instance['title']);

      echo '<p><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width:100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
  }

}

class EcwidVCategoriesWidget extends WP_Widget {

    function EcwidVCategoriesWidget() {
    $widget_ops = array('classname' => 'widget_ecwid_vcategories', 'description' => __('Vertical menu of categories', 'ecwid-shopping-cart'));
    $this->WP_Widget('ecwidvcategories', __('Ecwid Vertical Categories', 'ecwid-shopping-cart'), $widget_ops);
    }

    function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title']);

		echo $before_widget;

		if ( $title )
		echo $before_title . $title . $after_title;

		echo '<div>';

		echo ecwid_get_scriptjs_code();
		echo ecwid_get_product_browser_url_script();
		echo '<script type="text/javascript"> xVCategories("style="); </script>';

		echo '</div>';

		echo $after_widget;
  }

    function update($new_instance, $old_instance){
      $instance = $old_instance;
      $instance['title'] = strip_tags(stripslashes($new_instance['title']));

    return $instance;
  }

    function form($instance){
      $instance = wp_parse_args( (array) $instance, array('title'=>'') );

      $title = htmlspecialchars($instance['title']);

      echo '<p><label for="' . $this->get_field_name('title') . '">' . __('Title:') . ' <input style="width:100%;" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></label></p>';
  }

}

class EcwidStoreLinkWidget extends WP_Widget {

	function EcwidStoreLinkWidget() {
		$widget_ops = array('classname' => 'widget_ecwid_store_link', 'description' => __('A link to your store page', 'ecwid-shopping-cart'));
		$this->WP_Widget('ecwidstorelink', __('Ecwid Store Page Link', 'ecwid-shopping-cart'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args);
		echo $before_widget;

		echo '<div>';

		echo '<a href="' . ecwid_get_store_page_url() . '">' . $instance['label'] . '</a>';
		echo '</div>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['label'] = strip_tags(stripslashes($new_instance['label']));

		return $instance;
	}

	function form($instance){
		$instance = wp_parse_args( (array) $instance, array( 'label' => __('Shop', 'ecwid-shopping-cart') ) );

		$label = htmlspecialchars($instance['label']);

		echo '<p><label for="' . $this->get_field_name('label') . '">' . __('Text') . ': <input style="width:100%;" id="' . $this->get_field_id('label') . '" name="' . $this->get_field_name('label') . '" type="text" value="' . $label . '" /></label></p>';
	}

}


function ecwid_send_stats()
{
	$storeid = get_ecwid_store_id();

	if ($storeid == ECWID_DEMO_STORE_ID) return;

	$last_stats_sent = get_option('ecwid_stats_sent_date');
	if (!$last_stats_sent) {
		add_option('ecwid_stats_sent_date', time());
	} else if ($last_stats_sent + 24*60*60 > time()) {
		return;
	}

	$stats = ecwid_gather_stats();

	$url = 'http://' . APP_ECWID_COM . '/script.js?' . $storeid . '&data_platform=wporg';

	foreach ($stats as $name => $value) {
		$url .= '&data_wporg_' . $name . '=' . urlencode($value);
	}

	$link = '';
	if (ecwid_is_store_page_available()) {
		$link = ecwid_get_store_page_url();
	} else {
		$link = get_bloginfo('url');
	}

	wp_remote_get($url, array('headers' => array('Referer' => $link)));

	update_option('ecwid_stats_sent_date', time());
}

function ecwid_gather_stats()
{
	$usage_version = 1;

	$stats = array();

	$stats['version'] = get_bloginfo('version');
	$stats['theme'] = ecwid_get_theme_name();

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	$usage_params = array(
		'paid',
		'display_search',
		'horizontal_categories_enabled',
		'minicart_enabled',
		'search_widget',
		'vcategories_widget',
		'minicart_normal_widget',
		'minicart_mini_widget',
		'badge_widget',
		'sso_enabled',
		'default_category',
		'google_xml_sitemaps_used',
		'ecwid_product_advisor_used',
		'ecwid_single_product_used',
		'ecwid_store_shortcode_used',
		'store_link_widget'
	);

	$usage_stats = ecwid_gather_usage_stats();
	$stats['usage'] = '';

	$usage = '';
	foreach ($usage_params as $index => $item) {
		$usage[$index] = (int)$usage_stats[$item];
	}

	$stats['usage'] = $usage_version . '_' . implode('', $usage);

	return $stats;
}

function ecwid_gather_usage_stats()
{
	$usage_params = array(
		'paid',
		'display_search',
		'horizontal_categories_enabled',
		'minicart_enabled',
		'search_widget',
		'vcategories_widget',
		'minicart_normal_widget',
		'minicart_mini_widget',
		'badge_widget',
		'sso_enabled',
		'default_category',
		'google_xml_sitemaps_used',
		'ecwid_product_advisor_used',
		'ecwid_single_product_used',
		'ecwid_store_shortcode_used',
		'store_link_widget'
	);

	$usage_stats = array();
	$usage_stats['paid'] = ecwid_is_paid_account();
	$usage_stats['display_search'] = (bool) get_option('ecwid_show_search_box');
	$usage_stats['horizontal_categories_enabled'] = (bool) get_option('ecwid_show_categories');
	$usage_stats['minicart_enabled'] = (bool) get_option('ecwid_enable_minicart');
	$usage_stats['search_widget'] = (bool) is_active_widget(false, false, 'ecwidsearch');
	$usage_stats['vcategories_widget'] = (bool) is_active_widget(false, false, 'ecwidvcategories');
	$usage_stats['minicart_normal_widget'] = (bool) is_active_widget(false, false, 'ecwidminicart');
	$usage_stats['minicart_mini_widget'] = (bool) is_active_widget(false, false, 'ecwidminicart_miniview');
	$usage_stats['badge_widget'] = (bool) is_active_widget(false, false, 'ecwidbadge');
	$usage_stats['sso_enabled'] = (bool) get_option('ecwid_sso_secret_key');
	$usage_stats['default_category'] = (bool) get_option('ecwid_default_category_id');
	$usage_stats['google_xml_sitemaps_used'] = (bool) is_plugin_active('google-sitemap-generator/sitemap.php');
	$usage_stats['ecwid_product_advisor_used'] = (bool) is_plugin_active('ecwid-useful-tools/ecwid-product-advisor.php');
	$usage_stats['ecwid_single_product_used'] = (bool) (get_option('ecwid_single_product_used') + 60*60*24*14 > time());
	$usage_stats['ecwid_store_shortcode_used'] = (bool) (get_option('ecwid_store_shortcode_used') + 60*60*24*14 > time());
	$usage_stats['store_link_widget'] = (bool) is_active_widget(false, false, 'ecwidstorelink');

	return $usage_stats;
}

function ecwid_sidebar_widgets_init() {
	register_widget('EcwidMinicartWidget');
	register_widget('EcwidSearchWidget');
	register_widget('EcwidVCategoriesWidget');
	register_widget('EcwidMinicartMiniViewWidget');
	register_widget('EcwidBadgeWidget');
	register_widget('EcwidStoreLinkWidget');
}

add_action('widgets_init', 'ecwid_sidebar_widgets_init');

function ecwid_sso() {
    $key = get_option('ecwid_sso_secret_key');
    if (empty($key)) {
        return "";
    }

    global $current_user;
    get_currentuserinfo();

    if ($current_user->ID) {
        $user_data = array(
            'appId' => "wp_" . get_ecwid_store_id(),
            'userId' => "{$current_user->ID}",
            'profile' => array(
            'email' => $current_user->user_email,
            'billingPerson' => array(
                'name' => $current_user->display_name
            )
            )
        );
   $user_data = base64_encode(json_encode($user_data));
    $time = time();
    $hmac = ecwid_hmacsha1("$user_data $time", $key);
    return "<script> var ecwid_sso_profile='$user_data $hmac $time' </script>";   
    }
    else {
        return "<script> var ecwid_sso_profile='' </script>";
    }

 
}

// from: http://www.php.net/manual/en/function.sha1.php#39492

function ecwid_hmacsha1($data, $key) {
  if (function_exists("hash_hmac")) {
    return hash_hmac('sha1', $data, $key);
  } else {
    $blocksize=64;
    $hashfunc='sha1';
    if (strlen($key)>$blocksize)
        $key=pack('H*', $hashfunc($key));
    $key=str_pad($key,$blocksize,chr(0x00));
    $ipad=str_repeat(chr(0x36),$blocksize);
    $opad=str_repeat(chr(0x5c),$blocksize);
    $hmac = pack(
                'H*',$hashfunc(
                    ($key^$opad).pack(
                        'H*',$hashfunc(
                            ($key^$ipad).$data
                        )
                    )
                )
            );
    return bin2hex($hmac);
    }
}

function ecwid_can_display_html_catalog()
{
	if (!isset($_GET['_escaped_fragment_'])) return;

	$api = ecwid_new_product_api();
	if (!$api) return;

	$profile = $api->get_profile();
	if (!$profile) return;
	return $profile['closed'] != true;
}

function ecwid_is_paid_account()
{
	return ecwid_is_api_enabled() && get_ecwid_store_id() != ECWID_DEMO_STORE_ID;
}

function ecwid_is_api_enabled()
{
    $ecwid_is_api_enabled = get_option('ecwid_is_api_enabled');
    $ecwid_api_check_time = get_option('ecwid_api_check_time');
    $now = time() + 60*60*24;

    if ($now > ($ecwid_api_check_time + 60 * 60 * 3)) {
        // check whether API is available once in 3 hours
        $ecwid = ecwid_new_product_api();

        $ecwid_is_api_enabled = ($ecwid->is_api_enabled() ? 'on' : 'off');
        update_option('ecwid_is_api_enabled', $ecwid_is_api_enabled);
        update_option('ecwid_api_check_time', $now);
    }

    if ('on' == $ecwid_is_api_enabled)
        return true;
    else
        return false;
}

function ecwid_new_product_api()
{
    include_once WP_PLUGIN_DIR . '/ecwid-shopping-cart/lib/ecwid_product_api.php';
    $ecwid_store_id = intval(get_ecwid_store_id());
    $api = new EcwidProductApi($ecwid_store_id);

    return $api;
}

function ecwid_embed_svg($name) {
	$code = file_get_contents(ECWID_PLUGIN_DIR . '/images/' . $name . '.svg');

	echo $code;
}

/*
 * Basically a copy of has_shortcode that returns the matched shortcode
 */
function ecwid_find_shortcodes( $content, $tag ) {

	if ( shortcode_exists( $tag ) ) {
		preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
		if ( empty( $matches ) )
			return false;

		$result = array();
		foreach ( $matches as $shortcode ) {
			if ( $tag === $shortcode[2] ) {
				$result[] = $shortcode;
			}
		}

		if (empty($result)) {
			$result = false;
		}
		return $result;
	}
	return false;
}
?>
