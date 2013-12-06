<?php
class Customer_Image{
        protected $dir;
        protected $customer_image;
     //instantiate new display_taxonomy class
    public static function init() 
    {
        $class = __CLASS__;
        new $class;
    }

    //use constructor to kickstart things
    public function __construct() 
    {
       $this->register_actions();
       $this->dir=plugin_dir_path( __FILE__ );
    }
    
    /*
     * register_actions
     * registers the required filters and actions needed 
     */
    private function register_actions(){
      
      global $woocommerce;

      // Display on the front end 
      add_shortcode('graylien_customer_image', array(&$this,'short_code_display_template_form'), 10);
      add_action('woocommerce_after_add_to_cart_button', array(&$this, 'display_template_form'), 10 );
      add_action('wp_ajax_nopriv_customer_image_upload', array($this,'handle_customer_image_upload'));
      add_action('wp_ajax_customer_image_upload', array($this,'handle_customer_image_upload'));
    
      //Cart filters    
      add_filter( 'woocommerce_add_cart_item_data', array( $this, 'add_cart_item_data' ), 10, 2 );
      add_filter( 'woocommerce_get_cart_item_from_session', array( $this, 'get_cart_item_from_session' ), 10, 2 );
      add_filter( 'woocommerce_get_item_data', array( $this, 'get_item_data' ), 10, 2 );
      add_action( 'woocommerce_add_order_item_meta', array( $this, 'add_order_item_meta' ), 10, 2 );

    }
    
   /*
     * register_styles
     * registers and enqueues plugin css
     */
    private function register_styles(){
	
      
       if(is_single(109)){
        wp_register_style( 'upload_form', plugins_url('/css/upload_form.css', __FILE__) );
        wp_enqueue_style( 'upload_form' );
        }
    }
    
    
    /*
     * display_template_form
     * includes the config for the form(which just provides plugin dir)
     * prints out HTML form view (from view folder) 
     */
    public function display_template_form()
    {        
        global $post;
        $graylien_wc_options = get_post_meta($post->ID, '_graylien_wc_options', true);
        if (isset($graylien_wc_options['display_form']) && $graylien_wc_options['display_form']) {
	$this->register_styles();
        include('config.php');
        include('views/customer-upload-form.php');
        }
    }
    
    public function short_code_display_template_form(){
        
        include('config.php');
        include('views/customer-upload-form.php');
    }
    
    /*
     *
     * Handles the image uploaded by the user
     * saves it to the wordpress upload directory.
     */
    public function handle_customer_image_upload()
    {
        
        global $woocommerce;

        if (!empty($_FILES["customer-image"]))
        {
            if (!function_exists('wp_handle_upload')){
                $url = admin_url();
                require_once( $url.'includes/file.php' );
            }

            $uploadedfile = $_FILES['customer-image'];
            $upload_overrides = array('test_form' => false);
                                    
            $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
            $this->customer_image= $movefile['url'];
            if ($movefile)
            {
                $urlParts = parse_url($this->customer_image); 
                $upload_dir= $urlParts['path']; // 'elderly-care-advocacy'
                echo $upload_dir;die;
            }
        }
    }    
    
    /*
     *
     * add_customer_image_to_cart_item
     * if an image has been uploaded, post data exists in the hidden input, 
     * so we add this to the woocommerce cart item $data
     * 
     */
    public function add_cart_item_data($cart_item_meta, $product_id){
     global $woocommerce;
    
     $customer_image_enabled = get_post_meta($product_id, '_graylien_wc_options', true);
     
     if (isset($customer_image_enabled['display_form']) && $customer_image_enabled['display_form']) {
             
       if (!empty($_POST['uploaded-customer-image']))
        {
         //  $image = $_POST['uploaded-customer-image'];
           $cart_item_meta['customer_image'] = $_POST['uploaded-customer-image'];
        }
     }
     return $cart_item_meta;
        
    }
    
    
    /*
     * get_custom_image_item_from_session
     * if cart item data has been added, it is present in the cart item data
     * Add the form options meta to the cart item in case you want to do special stuff on the check out page.
     */
    public function get_cart_item_from_session($cart_item, $values)
    {        global $woocommerce;

       if (isset($values['customer_image'])) {
            $cart_item['customer_image'] = $values['customer_image'];
        }
 
        return $cart_item;
    }
    
    
      function get_item_data($other_data, $cart_item) {
       
          if ( ! empty( $cart_item['customer_image'] ) ){
                 $url=parse_url(get_site_url());
                 $host=$url['scheme'].'://'.$url['host'];
                 
			$item_data[] = array(
				'name'    => __( 'Personalized Image' ),
				'value'   => __( $cart_item['customer_image'] ),
				'display' => __( '<div id="image-prev-cart"><img id="img-upload" src="'.$host.$cart_item['customer_image'].'"/></div>' )
			);
                        
         return $item_data;

          }
	
          
    }
    
    
    	/**
	 * After ordering, add the data to the order line items.
	 *
	 * @access public
	 * @param mixed $item_id
	 * @param mixed $values
	 * @return void
	 */
	public function add_order_item_meta( $item_id, $cart_item ) {
            
              $url=parse_url(get_site_url());
                 $host=$url['scheme'].'://'.$url['host'];
		if ( ! empty( $cart_item['customer_image'] ) ){
			woocommerce_add_order_item_meta( $item_id, __( 'Personalized Image'), __('<div id="image-prev-cart"><img id="img-upload" src="'.$host.$cart_item['customer_image'].'"/></div>') );
                } 
        
    }
}
?>
