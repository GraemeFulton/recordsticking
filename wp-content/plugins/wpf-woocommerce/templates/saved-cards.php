<h2 id="saved-cards" style="margin-top:40px;"><?php _e( 'Saved cards', 'wpf-woocommerce' ); ?></h2>
<table class="shop_table">
	<thead>
		<tr>
			<th><?php _e( 'Card', 'wpf-woocommerce' ); ?></th>
			<th><?php _e( 'Expires', 'wpf-woocommerce' ); ?></th>
			<th><?php if( $testmode ){ _e( '(TEST MODE)', 'wpf-woocommerce' ); } ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $credit_cards as $i => $credit_card ) : ?>
		<tr>
            <td><?php esc_html_e( $credit_card['card_brand'] . ': ' . $credit_card['card_last4'] ); ?></td>
            <td><?php esc_html_e( $credit_card['card_exp_month'] . '/' . $credit_card['card_exp_year'] ); ?></td>
			<td>
                <form action="" method="POST">
                    <?php wp_nonce_field ( '_wpf_woocommerce_del_card' ); ?>
                    <input type="hidden" name="wpf_woocommerce_delete_card" value="<?php echo esc_attr( $i ); ?>">
	                <input type="hidden" name="testmode" value="<?php echo esc_attr( $testmode ); ?>">
                    <input type="submit" class="button" value="<?php _e( 'Delete card', 'wpf-woocommerce' ); ?>">
                </form>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>