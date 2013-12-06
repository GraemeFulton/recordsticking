<?php
/**
 * Check if WooCommerce is active
 **/
    class Customer_Image_Admin {
        
        //instantiate new display_taxonomy class
        public static function init() 
        {
            $class = __CLASS__;
            new $class;
        }
        
        
        public function __construct() {
           
            // Write Panel
            add_action('add_meta_boxes', array(&$this, 'customer_image_add_meta_box'));
            add_action('woocommerce_process_product_meta', array($this, 'write_panel_save'));
            
        }

        /* ----------------------------------------------------------------------------------- */
        /* Write Panel */
        /* ----------------------------------------------------------------------------------- */

        // Add the meta box to the Admin Product Page.
        function customer_image_add_meta_box() {
            global $post;
            add_meta_box('woocommerce-graylien-wc-form-meta', 'Graylien Customer Image Upload Options', array(&$this, 'customer_image_meta_box'), 'product', 'normal', 'default');
        }

        // On your Admin Project Pages, you should now see the following form near the bottom.
        function customer_image_meta_box($post) {
            ?>

            <div class="panel-wrap product_data woocommerce">
                <ul class="tabs wc-tabs">

                    <li class="active"><a href="#graylien_wc_data"><?php echo 'General'; ?></a></li>

                </ul>

                <div id="graylien_wc_data" class="panel woocommerce_options_panel">

                    <?php
                    $graylien_wc_options = get_post_meta($post->ID, '_graylien_wc_options', true);
                    // Add a check box to turn the custom form on or off
                    ?>
                    <div class="options_group">
                        <?php
                        woocommerce_wp_checkbox(array(
                            'id' => 'graylien-display_form',
                            'label' => 'Display Customer Image Upload Form',
                            'value' => isset($graylien_wc_options['display_form']) && $graylien_wc_options['display_form'] ? 'yes' : ''));
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }

        // Process the meta box and set the values
        function write_panel_save($post_id, $post) {
            global $woocommerce_errors;

            if (isset($_POST['graylien-display_form'])) {

                $graylien_wc_options = array(
                    'display_form' => isset($_POST['graylien-display_form']) ? true : false
                );
                update_post_meta($post_id, '_graylien_wc_options', $graylien_wc_options);
            } else {
                delete_post_meta($post_id, '_graylien_wc_options');
            }
        }
    }
?>