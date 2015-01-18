<?php
/*
Plugin Name: wp e-commerce postcode shipping module
Plugin URI: http://tomas.zhu.bz
Description: WP E-commerce Postcode Shipping Module is a plugin which allows to calculate the shipping cost by postcode/zipcode.
Version: 1.0.0
Author: Tomas Zhu
Author URI: http://tomas.zhu.bz
License: GPL2

  Copyright 2014 Tomas Zhu (email : expert2wordpress@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class wpsc_postcode_shipping {

	var $internal_name, $name;


	function wpsc_postcode_shipping() {
		$this->internal_name = "postcode_shipping";
		$this->name="Postcode Rate";
		$this->is_external=false;
		$this->needs_zipcode = true;
		return true;
	}


	function getName() {
		return $this->name;
	}
	
	
	function getInternalName() {
		return $this->internal_name;
	}



	private function output_row( $postcode = '', $charge = '') 
	{
		$currency = wpsc_get_currency_symbol();
		$class = ( $this->alt ) ? 'class="alternate"' : '';
		$this->alt = ! $this->alt;
		?>
			<tr>
				<td <?php echo $class; ?>>
					<div class="cell-wrapper">
						<?php
						echo "<input type='text' name='wpsc_shipping_postcoderate_layer[]' value='$postcode' style='width:50px;' />";
						?>
					</div>
				</td>
				<td <?php echo $class; ?>>
					<div class="cell-wrapper">
						<small><?php echo esc_html( $currency ); ?></small>
						<?php
						echo "<input type='text' name='wpsc_shipping_postcoderate_shipping[]' value='$charge' style='width:50px;' />";
						?>
						<span class="actions">
							<a tabindex="-1" title="<?php _e( 'Delete Layer', 'wpsc' ); ?>" class="button-secondary wpsc-button-round wpsc-button-minus" href="#"><?php echo _x( '&ndash;', 'delete item', 'wpsc' ); ?></a>
							<a tabindex="-1" title="<?php _e( 'Add Layer', 'wpsc' ); ?>" class="button-secondary wpsc-button-round wpsc-button-plus" href="#"><?php echo _x( '+', 'add item', 'wpsc' ); ?></a>
						</span>
					</div>
				</td>
			</tr>
		<?php
	}
	
	function getForm() {
		$this->alt = false;
		ob_start();
		$postcoderate_layers_option = get_option( 'postcoderate_layers', array() );

?>
		<tr>
			<td colspan='2'>
				<table>
					<thead>
						<tr>
							<th class="option"><?php _e('Postcode', 'wpsc' ); ?></th>
							<th class="shipping"><?php _e( 'Shipping Price', 'wpsc' ); ?></th>
						</tr>
					</thead>
					<tbody class="table-rate">
						<tr class="js-warning">
							<td colspan="2">
								<small><?php echo sprintf( __( 'To remove a rate layer, simply leave the values on that row blank. By the way, <a href="%s">enable JavaScript</a> for a better user experience.', 'wpsc'), 'http://www.google.com/support/bin/answer.py?answer=23852' ); ?></small>
							</td>
						</tr>
						<?php if ( ! empty( $postcoderate_layers_option ) ): ?>
							<?php
								foreach ($postcoderate_layers_option as $key => $shipping)
								{
									$this->output_row( $key, $shipping);
								}
							?>
						<?php else: ?>
							<?php $this->output_row(); ?>
						<?php endif ?>
					</tbody>
				</table>
			</td>
		</tr>
<?php
		return ob_get_clean();
	}


	function submit_form() {
		global $wpdb;
		if ( ! isset( $_POST['wpsc_shipping_postcoderate_layer'] ) || ! isset( $_POST['wpsc_shipping_postcoderate_shipping'] ) )
			return false;		

		$new_layers = array();
		$layers = (array)$_POST['wpsc_shipping_postcoderate_layer'];
		$shippings = (array)$_POST['wpsc_shipping_postcoderate_shipping'];

		if ( !empty($shippings) ) {

			foreach ($shippings as $key => $price) {
				if ( empty( $price ) || empty( $layers[$key] ) )
					continue;

				$new_layers[$layers[$key]] = $price;

			}

		}

		krsort( $new_layers );
		update_option( 'postcoderate_layers', $new_layers );
		return true;
		
	}


	function getQuote() {

		global $wpdb, $wpsc_cart,$table_prefix;
		$m_cart_items = 0;
		
		$m_cart_items = $wpsc_cart->cart_item->quantity;

		$destzipcode = '';
		if(isset($_POST['zipcode'])) {
			$destzipcode = $_POST['zipcode'];      
			$_SESSION['wpsc_zipcode'] = $_POST['zipcode'];
		} else if(isset($_SESSION['wpsc_zipcode'])) {
			$destzipcode = $_SESSION['wpsc_zipcode'];
		}		
		
	
		$postcoderate_layers_option = get_option( 'postcoderate_layers', array() );
		$returnarray = array();
		
		if (!(empty($postcoderate_layers_option)))
		{
			foreach ($postcoderate_layers_option as $key=>$price)
			{
				if ($key == $destzipcode)
				{
					$returnarray['Postcode Shipping'] = ($price * $m_cart_items);
					return $returnarray;
				}
			}
		}

		return $returnarray;
		
		
	}

	function get_item_shipping(&$cart_item) {
		
		global $wpdb, $wpsc_cart,$table_prefix;
		$quantity = $cart_item->quantity;
		
		$destzipcode = '';
		if(isset($_POST['zipcode'])) {
			$destzipcode = $_POST['zipcode'];      
			$_SESSION['wpsc_zipcode'] = $_POST['zipcode'];
		} else if(isset($_SESSION['wpsc_zipcode'])) {
			$destzipcode = $_SESSION['wpsc_zipcode'];
		}		
		
		$shipping = 0;
		$postcoderate_layers_option = get_option( 'postcoderate_layers', array() );
		
		if (!(empty($postcoderate_layers_option)))
		{
			foreach ($postcoderate_layers_option as $key=>$price)
			{
				if ($key == $destzipcode)
				{
					$shipping = ($chargesresult1 * $quantity);
					return $shipping;
				}
			}
		}

		return $shipping;
	}
}

	global $wpsc_shipping_modules;
	$simple_shipping = new wpsc_postcode_shipping();
	$wpsc_shipping_modules[$simple_shipping->getInternalName()] = $simple_shipping;

?>