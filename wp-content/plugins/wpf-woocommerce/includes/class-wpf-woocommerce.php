<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WPF_WC class.
 */
class WPF_WC extends WC_Payment_Gateway {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->id					= 'wpfortify';
		$this->method_title 		= __( 'wpFortify (Stripe)', 'wpf-woocommerce' );
		$this->method_description   = sprintf( '<a href="https://wpfortify.com/" target="_blank">wpFortify</a> %s', __( 'provides fast, easy and secure hosted SSL checkout pages for Stripe.', 'wpf-woocommerce' ) );
		$this->has_fields 			= true;
		$this->supports 			= array( 'products' );

		// Icon
		$icon       = WC()->countries->get_base_country() == 'US' ? 'cards.png' : 'eu_cards.png';
		$this->icon = apply_filters( 'wpf_woocommerce_icon', plugins_url( '/assets/images/' . $icon, dirname( __FILE__ ) ) );

		// Load the form fields
		$this->init_form_fields();

		// Load the settings.
		$this->init_settings();

		// Get setting values
		$this->title               = $this->get_option( 'title' );
		$this->description         = $this->get_option( 'description' ); $this->settings['description'];
		$this->enabled             = $this->get_option( 'enabled' ); $this->settings['enabled'];
		$this->testmode            = $this->get_option( 'testmode' ) === "yes" ? true : false;
		$this->capture             = $this->get_option( 'capture' ) === "yes" ? true : false;
		$this->secret_key          = $this->get_option( 'secret_key' );
		$this->public_key          = $this->get_option( 'public_key' );
		$this->custom_checkout     = $this->get_option( 'custom_checkout' );
		$this->checkout_image      = $this->get_option( 'checkout_image' );
		$this->custom_title        = $this->get_option( 'custom_title' );
		$this->custom_description  = $this->get_option( 'custom_description' );
		$this->custom_save_card    = $this->get_option( 'custom_save_card' );
		$this->custom_button       = $this->get_option( 'custom_button' );
		$this->order_button_text   = __( 'Enter payment details', 'wpf-woocommerce' );

		// Hooks
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_api_wpf_wc', array( $this, 'wpf_listen' ) );
	}

	/**
	 * Admin Panel Options
	 */
  	public function admin_options() {
		?>
		<h3><?php echo $this->method_title; ?></h3>

		<?php if ( empty( $this->secret_key ) || empty( $this->public_key ) ) : ?>
			<div class="updated">
				<p class="main"><strong><?php echo $this->method_description; ?></strong></p>
				<p><a href="https://connect.wpfortify.com/" target="_blank" class="button button-primary"><?php _e( 'Connect now for free', 'wpf-woocommerce' ); ?></a> <a href="https://wpfortify.com/welcome/" target="_blank" class="button"><?php _e( 'Sign In', 'wpf-woocommerce' ); ?></a></p>
			</div>
        <?php elseif ( ! get_option('permalink_structure') ) : ?>
                <div class="error">
                    <p class="main"><strong><?php _e( 'Sorry, wpFortify requires "Pretty Permalinks"', 'wpf-woocommerce' ); ?> (<a href="http://codex.wordpress.org/Introduction_to_Blogging#Pretty_Permalinks" target="_blank"><?php _e( 'learn more', 'wpf-woocommerce' ); ?></a>).</p>
                    <p><a href="options-permalink.php" class="button button-primary"><?php _e( 'Enable permalinks now', 'wpf-woocommerce' ); ?></a></p>
                </div>
            <?php else : ?>
			<p><?php echo $this->method_description; ?></p>
		<?php endif; ?>

		<table class="form-table">
			<?php $this->generate_settings_html(); ?>
		</table>
		<?php
  	}

	/**
     * Check if this gateway is enabled
     */
	public function is_available() {
		if ( $this->enabled == "yes" ) {
			// Required fields check
			if ( ! $this->secret_key || ! $this->public_key ) {
				return false;
			}
            if ( ! get_option('permalink_structure') ) {
                return false;
            }
			return true;
		}
		return false;
	}

	/**
     * Initialise Gateway Settings Form Fields
     */
    public function init_form_fields() {
    	$this->form_fields = apply_filters( 'WPF_WC_GATEWAY_settings', array(
			'enabled' => array(
				'title'       => __( 'Enable/Disable', 'wpf-woocommerce' ),
				'label'       => __( 'Enable wpFortify', 'wpf-woocommerce' ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),
			'secret_key' => array(
				'title'       => __( 'Secret Key', 'wpf-woocommerce' ),
				'type'        => 'text',
				'description' => __( 'Enter the access keys from your wpFortify account.', 'wpf-woocommerce' ),
				'default'     => ''
			),
			'public_key' => array(
				'title'       => __( 'Public Key', 'wpf-woocommerce' ),
				'type'        => 'text',
				'description' => __( 'Enter the access keys from your wpFortify account.', 'wpf-woocommerce' ),
				'default'     => ''
			),
			'title' => array(
				'title'       => __( 'Title', 'wpf-woocommerce' ),
				'type'        => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'wpf-woocommerce' ),
				'default'     => __( 'Credit card', 'wpf-woocommerce' )
			),
			'description' => array(
				'title'       => __( 'Description', 'wpf-woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'This controls the description which the user sees during checkout.', 'wpf-woocommerce' ),
				'default'     => __( 'Pay with your credit card.', 'wpf-woocommerce')
			),
			'testmode' => array(
				'title'       => __( 'Test mode', 'wpf-woocommerce' ),
				'label'       => __( 'Enable Test Mode', 'wpf-woocommerce' ),
				'type'        => 'checkbox',
				'description' => __( 'Place the payment gateway in test mode.', 'wpf-woocommerce' ),
				'default'     => 'yes'
			),
			'capture' => array(
				'title'       => __( 'Capture', 'wpf-woocommerce' ),
				'label'       => __( 'Capture charge immediately', 'wpf-woocommerce' ),
				'type'        => 'checkbox',
				'description' => __( 'Whether or not to immediately capture the charge. When unchecked, the charge issues an authorization and will need to be captured later. Uncaptured charges expire in 7 days.', 'wpf-woocommerce' ),
				'default'     => 'yes'
			),
			'custom_checkout' => array(
				'title'       => __( 'Custom Checkout', 'wpf-woocommerce' ),
				'description' => __( 'Optional: Enter the URL to your custom checkout page. Example: <code>https://example.wpfortify.com/</code>', 'wpf-woocommerce' ),
				'type'        => 'text',
				'default'     => ''
			),
			'checkout_image' => array(
				'title'       => __( 'Checkout Image', 'wpf-woocommerce' ),
				'description' => __( 'Optional: Enter the URL to the secure image from your wpFortify account. Example: <code>https://wpfortify.com/media/example.png</code>', 'wpf-woocommerce' ),
				'type'        => 'text',
				'default'     => ''
			),
			'custom_title' => array(
				'title'       => __( 'Checkout Title', 'wpf-woocommerce' ),
				'description' => __( 'Optional: Enter a new title. Default is "', 'wpf-woocommerce' ) . get_bloginfo() . '".' ,
				'type'        => 'text',
				'default'     => ''
			),
			'custom_description' => array(
				'title'       => __( 'Checkout Description', 'wpf-woocommerce' ),
				'description' => __( 'Optional: Enter a new description. Default is "Order #123 ($456)". Available filters: <code>{{order_id}} {{order_amount}}</code>. Example: <code>Order #{{order_id}} (${{order_amount}})</code>', 'wpf-woocommerce' ),
				'type'        => 'text',
				'default'     => ''
			),
			'custom_save_card' => array(
				'title'       => __( 'Checkout Save Card', 'wpf-woocommerce' ),
				'description' => __( 'Optional: Enter new save card text. Default is "Save this card for future purchases".', 'wpf-woocommerce' ),
				'type'        => 'text',
				'default'     => ''
			),
			'custom_button' => array(
				'title'       => __( 'Checkout Button', 'wpf-woocommerce' ),
				'description' => __( 'Optional: Enter new button text. Default is "Pay with Card". Available filters: <code>{{order_id}} {{order_amount}}</code>. Example: <code>Pay with Card (${{order_amount}})</code>', 'wpf-woocommerce' ),
				'type'        => 'text',
				'default'     => ''
			)
		) );
    }

	/**
     * Payment form on checkout page
     */
	public function payment_fields() {
		if ( $this->testmode ) {
			$credit_cards = get_user_meta( get_current_user_id(), '_wpf_woocommerce_card_details_test', false );
		}else{
			$credit_cards = get_user_meta( get_current_user_id(), '_wpf_woocommerce_card_details_live', false );
		}
		?>
		<fieldset>
			<?php if ( $this->description ) : ?>
				<p><?php echo esc_html( $this->description ); ?></p>
			<?php endif; ?>

			<?php if ( is_user_logged_in() && $credit_cards ) :
				?>
				<p class="form-row form-row-wide">

					<a class="button" style="float:right;" href="<?php echo get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ); ?>#saved-cards"><?php _e( 'Manage cards', 'wpf-woocommerce' ); ?></a>
					<?php
					foreach ( $credit_cards as $i => $credit_card ) :
						?>
						<label style="display:inline;" for="wpfortify_card_<?php echo $i; ?>">
						<input type="radio" id="wpfortify_card_<?php echo $i; ?>" name="wpfortify_card" style="width:auto;" value="<?php echo $i; ?>" onclick="javascript:document.getElementById('place_order').value='Pay now with <?php esc_html_e( $credit_card['card_brand'] ); ?> (<?php esc_html_e( $credit_card['card_last4'] ); ?>)'"/>
						<?php esc_html_e( $credit_card['card_brand'] ); ?> <?php _e( 'card ending with:', 'woocommerce-gateway-stripe' ); ?> <?php esc_html_e( $credit_card['card_last4'] ); ?> (<?php esc_html_e( $credit_card['card_exp_month'] . '/' . $credit_card['card_exp_year'] ); ?>)
						</label><br />
						<?php
					endforeach;
					?>

					<label style="display:inline;" for="wpfortify_card_new">
					<input type="radio" id="wpfortify_card_new" name="wpfortify_card" style="width:auto;" checked="checked" value="new" onclick="javascript:document.getElementById('place_order').value='<?php echo $this->order_button_text; ?>'" />
					<?php _e( 'Use a new credit card', 'wpf-woocommerce' ); ?>
					</label>

				</p>
				<div class="clear"></div>
			<?php endif; ?>
		</fieldset>
		<?php
	}

	/**
     * Process the payment
     */
	public function process_payment( $order_id ) {
		$order = new WC_Order( $order_id );
		if ( $this->testmode ) {
			$customer_id = get_user_meta( get_current_user_id(), '_wpf_woocommerce_customer_id_test', true );
		}else{
			$customer_id = get_user_meta( get_current_user_id(), '_wpf_woocommerce_customer_id_live', true );
		}

		$card_id = null;

		if ( isset( $_POST['wpfortify_card'] ) && $_POST['wpfortify_card'] !== 'new' && is_user_logged_in() ) {
			if ( $this->testmode ) {
				$card_ids = get_user_meta( get_current_user_id(), '_wpf_woocommerce_card_details_test', false );
			}else {
				$card_ids = get_user_meta( get_current_user_id(), '_wpf_woocommerce_card_details_live', false );
			}
			if ( isset( $card_ids[ $_POST['wpfortify_card'] ]['card_id'] ) ) {
				$card_id = $card_ids[ $_POST['wpfortify_card'] ]['card_id'];
			} else {
				WC()->add_error( __( 'Invalid card.', 'wpf-woocommerce' ) );
				return;
			}

		}

		$title       = get_bloginfo();
		$description = sprintf( '%s %s ($%s)', __( 'Order #', 'wpf-woocommerce' ), $order_id, $order->order_total );
		$save_card   = __( 'Save this card for future purchases', 'wpf-woocommercee' );
		$button      = __( 'Pay with Card', 'wpf-woocommerce' );

		if ( $this->custom_title ) {
			$title = $this->custom_title;
		}
		if ( $this->custom_description ) {
			$description = str_replace( array( '{{order_id}}', '{{order_amount}}' ), array( $order_id, $order->order_total ), $this->custom_description );
		}
		if ( $this->custom_save_card ) {
			$save_card = $this->custom_save_card;
		}
		if ( $this->custom_button ) {
			$button = str_replace( array( '{{order_id}}', '{{order_amount}}' ), array( $order_id, $order->order_total ), $this->custom_button );
		}

		// Data for wpFortify
		$wpf_charge = array (
			'wpf_charge' => array(
				'plugin'          => 'wpf-woocommerce',
				'action'          => 'charge_card',
				'site_title'      => $title,
				'site_url'        => site_url(),
				'listen_url'      => site_url( '/wc-api/wpf_wc/' ),
				'return_url'      => $this->get_return_url( $order ),
				'cancel_url'      => get_permalink( get_option( 'woocommerce_checkout_page_id' ) ),
				'custom_checkout' => $this->custom_checkout,
				'image_url'       => $this->checkout_image,
				'customer_id'     => $customer_id,
				'card_id'         => $card_id,
				'email'           => $order->billing_email,
				'amount'          => $order->order_total,
				'description'     => $description,
				'save_card'       => $save_card,
				'button'          => $button,
				'currency'        => strtolower( get_woocommerce_currency() ),
				'testmode'        => $this->testmode,
				'capture'         => $this->capture,
				'metadata'        => array(
					'order_id'    => $order_id,
					'user_id'     => $order->user_id,
					'name'        => $order->billing_first_name . ' ' . $order->billing_last_name,
				)
			)
		);

		if( $card_id ){
			$response = $this->wpf_api( 'repeater', $wpf_charge );

			if ( is_wp_error( $response ) ) {
				WC()->add_error( $response->get_error_message() );
				return;
			}

			if ( $response ) {
				$this->wpf_update_order( $response );
				// Return thank you page redirect
				if ( $this->testmode ){
					$order->add_order_note( __( 'IN TEST MODE', 'wpf-woocommerce' ) );
				}
				return array(
					'result'   => 'success',
					'redirect' => $this->get_return_url( $order )
				);
			} else {
				WC()->add_error( __( 'There was a problem updating the order.', 'wpf-woocommerce' ) );
				return;
			}

		} else {
			$response = $this->wpf_api( 'token', $wpf_charge );

			if ( is_wp_error( $response ) ) {
				WC()->add_error( $response->get_error_message() );
				return;
			}

			if( $response->token ) {
				// Check for previous failed order and update status before going to wpFortify
				if ( in_array( $order->status, array( 'failed' ) ) ) {
					$order->update_status( 'pending' );
				}

				$url = $this->custom_checkout;
				if ( !$url ){
					$url = 'https://checkout.wpfortify.com/';
				}
				$check_out = sprintf( '%s/token/%s/', untrailingslashit( $url ), $response->token );
				if ( $this->testmode ){
					$order->add_order_note( __( 'IN TEST MODE', 'wpf-woocommerce' ) );
				}
				// Redirect to wpFortify
				return array( 'result' => 'success', 'redirect' => $check_out );

			}
		}
	}

	/**
	 * wpFortify API
	 */
	function wpf_api( $endpoint, $array ) {
		$wpf_api = wp_remote_post( sprintf( 'https://api.wpfortify.com/%s/%s/', $endpoint, $this->public_key ), array( 'body' => $this->wpf_mask( $array ) ) );

		if ( is_wp_error( $wpf_api ) ) {
			return new WP_Error( 'wpfortify_error', __( 'There was a problem connecting to the payment gateway, please try again.', 'wpf-woocommerce' ) );
		}

		if ( empty( $wpf_api['body'] ) ) {
			return new WP_Error( 'wpfortify_error', __( 'Empty response.', 'wpf-woocommerce' ) );
		}

		$response = $this->wpf_unmask( $wpf_api['body'] );

		if ( ! empty( $response->error ) ) {
			return new WP_Error( 'wpfortify_error', $response->error );
		} elseif ( empty( $response ) ) {
			return new WP_Error( 'wpfortify_error', __( 'Invalid response.', 'wpf-woocommerce' ) );
		} else {
			return $response;
		}

	}

	/**
	 * wpFortify update order
	 */
	function wpf_update_order( $response ) {
		$order = new WC_Order( $response->metadata->order_id );

		if ( $response->metadata->user_id && $response->card->customer ) {
			if ( $response->livemode ){
				add_user_meta( $response->metadata->user_id, '_wpf_woocommerce_customer_id_live', $response->card->customer, true );
				if ( $response->metadata->save_card ) {
					add_user_meta( $response->metadata->user_id, '_wpf_woocommerce_card_details_live', array(
							'card_id'        => $response->card->id,
							'card_brand'     => $response->card->brand,
							'card_last4'     => $response->card->last4,
							'card_exp_month' => $response->card->exp_month,
							'card_exp_year'  => $response->card->exp_year
						)
					);
				}
			}else{
				add_user_meta( $response->metadata->user_id, '_wpf_woocommerce_customer_id_test', $response->card->customer, true );
				if ( $response->metadata->save_card ) {
					add_user_meta( $response->metadata->user_id, '_wpf_woocommerce_card_details_test', array(
							'card_id'        => $response->card->id,
							'card_brand'     => $response->card->brand,
							'card_last4'     => $response->card->last4,
							'card_exp_month' => $response->card->exp_month,
							'card_exp_year'  => $response->card->exp_year
						)
					);
				}
			}
		}

		update_post_meta( $order->id, '_wpf_woocommerce_card_id',     $response->card->id );
		update_post_meta( $order->id, '_wpf_woocommerce_customer_id', $response->card->customer );
		update_post_meta( $order->id, '_wpf_woocommerce_charge_id',   $response->id );

		if ( $response->captured ) {
			update_post_meta( $order->id, '_wpf_woocommerce_charge_captured', 'yes' );
			$order->add_order_note( sprintf( __( 'wpFortify (Stripe) charge complete. Charge ID: %s', 'wpf-woocommerce' ), $response->id ) );
			$order->payment_complete();
		} else {
			update_post_meta( $order->id, '_wpf_woocommerce_charge_captured', 'no' );
			$order->update_status( 'on-hold', sprintf( __( 'wpFortify (Stripe) charge authorized. Charge ID: %s. Process order to take payment, or cancel to remove the pre-authorization.', 'wpf-woocommerce' ), $response->id ) );
			$order->reduce_order_stock();
		}
	}

	/**
	 * Listen for wpFortify
	 */
	function wpf_listen() {
		$response = $this->wpf_unmask( file_get_contents( 'php://input' ) );

		if ( $response->id ) {
			$this->wpf_update_order( $response );
			echo $this->wpf_mask( array( 'status' => 'order_updated' ) );
			exit;
		} else {
			echo $this->wpf_mask( array( 'error' => 'no order id' ) );
			exit;
		}
	}

	/**
	 * Mask data for wpFortify
	 */
	function wpf_mask( $data ) {
		$iv = mcrypt_create_iv( mcrypt_get_iv_size( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC ), MCRYPT_RAND );
		$json_data = json_encode( $data );
		$mask = mcrypt_encrypt( MCRYPT_RIJNDAEL_128, md5( $this->secret_key ), $json_data . md5( $json_data ), MCRYPT_MODE_CBC, $iv );
		return rtrim( base64_encode( base64_encode( $iv ) . '-' . base64_encode( $mask ) ), '=' );
	}

	/**
	 * Unmask data from wpFortify
	 */
	function wpf_unmask( $data ) {
		list( $iv, $data_decoded ) = array_map( 'base64_decode', explode( '-', base64_decode( $data ), 2 ) );
		if ( $iv && $data_decoded ) {
			$unmask = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_128, md5( $this->secret_key ), $data_decoded, MCRYPT_MODE_CBC, $iv ), "\0\4" );
			$hash = substr( $unmask, -32 );
			$unmask = substr( $unmask, 0, -32 );
			if ( md5( $unmask ) == $hash ) {
				return json_decode( $unmask );
			}
		}
	}
}