<div id="editor-grid"></div>
<?php
global $wpdb, $woocommerce, $wp_version;
$limit = 2;

remove_action( 'admin_init', 'send_frame_options_header', 10, 0 );
remove_action( 'login_init', 'send_frame_options_header', 10, 0 );

if ( !wp_script_is( 'jquery' ) ) {
	wp_enqueue_script( 'jquery' );
}

// to set javascript variable of file exists
$fileExists = (defined('SMPRO') && SMPRO === true) ? 1 : 0;
$wpsc = (defined('WPSC_RUNNING') && WPSC_RUNNING === true) ? 1 :0;
$woo = (defined('WOO_RUNNING') && WOO_RUNNING === true) ? 1 :0;
$wpsc_woo = (defined( 'WPSC_WOO_ACTIVATED' ) && WPSC_WOO_ACTIVATED === true) ? 1 : 0;
$site_url = get_option('	siteurl');
$upgrade = str_word_count("Upgrade In Progress");

//setting limit for the records to be displayed
$limit_record = get_option( '_sm_set_record_limit' );

if( $limit_record == '' ) {
		update_option('_sm_set_record_limit', '100');
		$record_limit_result = '100';
} else {	
		$record_limit_result = $limit_record;		
}


//setting limit for the decimal places for dimensions [i.e. weight, width, height & length]
$decimal_precision = get_option( '_sm_dimensions_decimal_precision' );

if( $decimal_precision == '' ) {
		update_option('_sm_dimensions_decimal_precision', '2');
		$sm_dimensions_decimal_precision = '2';
} else {	
		$sm_dimensions_decimal_precision = $decimal_precision;		
}

//setting limit for the decimal places for amount [i.e. price & saleprice]

$sm_amount_decimal_precision = (get_option( 'woocommerce_price_num_decimals' ) != '') ? get_option( 'woocommerce_price_num_decimals' ) : '2';


// creating a domain name for mutilingual
$sm_domain = 'smart-manager';

//creating the order links
$blog_info = get_bloginfo ( 'url' );

//creating the products links
if ((WPSC_RUNNING === true && WOO_RUNNING === true) || WPSC_RUNNING === true) {
        // $products_details_url = $site_url.'/wp-admin/post.php?post=';
        $products_details_url = ADMIN_URL .'/post.php?post='; // Fix for X-Frame with SameOrigin
} else if (WOO_RUNNING === true) {
        $product_id = '';
	// $products_details_url = $site_url.'/wp-admin/post.php?action=edit&post='.$product_id;
	$products_details_url = ADMIN_URL .'/post.php?action=edit&post='.$product_id; // Fix for X-Frame with SameOrigin
}

$updater = rand(3.0,3.9);

if (WPSC_RUNNING === true) {
	if ( defined('IS_WPSC388') && IS_WPSC388 )	
		$orders_details_url = $site_url . "/wp-admin/index.php?page=wpsc-purchase-logs&c=item_details&id=";
	else
		$orders_details_url = $site_url . "/wp-admin/index.php?page=wpsc-sales-logs&purchaselog_id=";

	$weight_unit ['items']  = array (array ('id' => 0, 'name' => __('Pounds', $sm_domain), 'value' => 'pound' ), array ('id' => 1, 'name' => __('Ounces', $sm_domain), 'value' => 'ounce' ), array ('id' => 2, 'name' => __('Grams', $sm_domain), 'value' => 'gram' ), array ('id' => 3, 'name' => __('Kilograms', $sm_domain), 'value' => 'kilogram' ) );
	$weight_unit ['totalCount'] = count ( $weight_unit ['items'] );
	$encodedWeightUnits = json_encode ( $weight_unit );
	
	// getting orders fieldnames START
	$query = "SELECT processed,track_id,notes FROM " . WPSC_TABLE_PURCHASE_LOGS;
	$result = mysql_query ( $query );
	
	//@todo work on mysql_num_fields instead of data
	if (mysql_num_rows ( $result ) >= 1) {
		while ( $data = mysql_fetch_assoc ( $result ) )
			$ordersfield_data [] = $data;
		$ordersfield_result = $ordersfield_data [0];
	}

	$ordersfield_names = array ();
	$cnt = 0;
	foreach ( ( array ) $ordersfield_result as $ordersfield_name => $ordersfield_value ) {
		$ordersfield_names ['items'] [$cnt] ['id'] = $cnt;
		$ordersfield_names ['items'] [$cnt] ['name'] = ucfirst ( mysql_field_name ( $result, $cnt ) );
		if ($ordersfield_names ['items'] [$cnt] ['name'] == 'Processed')
			$ordersfield_names ['items'] [$cnt] ['name'] = 'Orders Status';
		if ($ordersfield_names ['items'] [$cnt] ['name'] == 'Track_id')
			$ordersfield_names ['items'] [$cnt] ['name'] = 'Track Id';
		
		$ordersfield_names ['items'] [$cnt] ['type'] = mysql_field_type ( $result, $cnt );
		if ($ordersfield_names ['items'] [$cnt] ['type'] == 'int' && $ordersfield_names ['items'] [$cnt] ['name'] == 'Orders Status')
			$ordersfield_names ['items'] [$cnt] ['type'] = 'bigint';
		
		if ($ordersfield_names ['items'] [$cnt] ['type'] == 'string' && $ordersfield_names ['items'] [$cnt] ['name'] == 'Track Id')
			$ordersfield_names ['items'] [$cnt] ['type'] = 'blob';
		$ordersfield_names ['items'] [$cnt] ['value'] = mysql_field_name ( $result, $cnt ) . ', ' . mysql_field_table ( $result, $cnt );
		$cnt ++;
	}
	
	if (count ( $ordersfield_names ) >= 1) {
		if (IS_WPSC38) {
			$query = "SELECT id,name,unique_name
			 		FROM " . WPSC_TABLE_CHECKOUT_FORMS . " 
					WHERE unique_name IN ('shippingfirstname', 'shippinglastname', 'shippingaddress', 'shippingcity', 'shippingstate','shippingcountry', 'shippingpostcode')";
		} elseif (IS_WPSC37) {
			$query = "SELECT id,name,unique_name
			 		FROM " . WPSC_TABLE_CHECKOUT_FORMS . " 
					WHERE unique_name IN ('shippingfirstname', 'shippinglastname', 'shippingaddress', 'shippingcity','shippingcountry', 'shippingpostcode')";
		}
		$res = mysql_query ( $query );
		$cnt = count ( $ordersfield_names ['items'] );
		while ( $data = mysql_fetch_assoc ( $res ) ) {
			$ordersfield_names ['items'] [$cnt] ['id'] = $cnt;
			$ordersfield_names ['items'] [$cnt] ['name'] = "Shipping" . ' ' . $data ['name'];
			$ordersfield_names ['items'] [$cnt] ['type'] = 'blob';
			$ordersfield_names ['items'] [$cnt] ['value'] = 'value' . ',' . WPSC_TABLE_SUBMITED_FORM_DATA . ',' . $data ['id'];
			$ordersfield_names ['totalCount'] = $cnt ++;
		}
		$encodedOrdersFields = json_encode ( $ordersfield_names );
	} else
		$encodedOrdersFields = 0;

	if (IS_WPSC37) {
		global $purchlogs;
		$allstatuses = $purchlogs->the_purch_item_statuses ();
		foreach ( $allstatuses as $status )
			$order_status [$status->id] = $status->name;
		
		$orderstatus_id = 0;
		foreach ( ( array ) $order_status as $status_value => $status_name ) {
			$order_status ['items'] [$orderstatus_id] ['id'] = $orderstatus_id;
			$order_status ['items'] [$orderstatus_id] ['name'] = $status_name;
			$order_status ['items'] [$orderstatus_id] ['value'] = $status_value;
			$order_status ['totalCount'] = $orderstatus_id ++;
		}
	} elseif (IS_WPSC38) {
		$order_status = array ('items' => array (0 => array ('id' => 1, 'name' => 'Incomplete Sale',  'value' => '1' ),
											     1 => array ('id' => 2, 'name' => 'Order Received',   'value' => '2' ),
											     2 => array ('id' => 3, 'name' => 'Accepted Payment', 'value' => '3' ),
											     3 => array ('id' => 4, 'name' => 'Job Dispatched',   'value' => '4' ),
											     4 => array ('id' => 5, 'name' => 'Closed Order',     'value' => '5' ),
											     5 => array ('id' => 6, 'name' => 'Payment Declined', 'value' => '6' )
											     ) 
								);
		$order_status ['totalCount'] = count ( $order_status ['items'] );
	}	
	

$encodedOrderStatus = json_encode ( $order_status );
//getting orders fieldnames END


	//getting customers fieldnames START
	$form_data_query = "SELECT id,name,unique_name FROM " . WPSC_TABLE_CHECKOUT_FORMS . " WHERE unique_name in ('billingfirstname', 'billinglastname', 'billingaddress', 'billingcity', 'billingstate', 'billingcountry', 'billingpostcode', 'billingphone', 'billingemail')";
	$form_data_result = mysql_query ( $form_data_query );
	while ( $data = mysql_fetch_assoc ( $form_data_result ) ) {
		if (IS_WPSC37) {
			if ($data ['unique_name'] != 'billingstate')
				$form_data [$data ['id']] = $data ['name'];
		} elseif (IS_WPSC38)
			$form_data [$data ['id']] = $data ['name'];
	}
	$cnt = 0;
	foreach ( ( array ) $form_data as $form_data_key => $form_data_value ) {
		$customerFields ['items'] [$cnt] ['id'] = $cnt;
		if ($form_data_value == 'Country' || strstr ( $form_data_value, 'Country' )) {
			$customerFields ['items'] [$cnt] ['type'] = 'bigint';
		} else {
			$customerFields ['items'] [$cnt] ['type'] = 'blob';
		}
		
		$customerFields ['items'] [$cnt] ['name'] = __( $form_data_value, 'smart-manager' );
		$customerFields ['items'] [$cnt] ['value'] = 'value' . ', ' . WPSC_TABLE_SUBMITED_FORM_DATA . ', ' . $form_data_key;
		$customerFields ['totalCount'] = $cnt ++;
	}
		if (count ( $customerFields ) >= 1)
			$encodedCustomersFields = json_encode ( $customerFields );
		else
			$encodedCustomersFields = 0;
	
	$query = "SELECT * FROM `" . WPSC_TABLE_CURRENCY_LIST . "` ORDER BY `country` ASC";
	$result = mysql_query ( $query );
	$count = 0;
	if (mysql_num_rows ( $result ) >= 1) {
		while ( $data = mysql_fetch_assoc ( $result ) ) {
			$countries ['items'] [$count] ['id'] = $count;
			$countries ['items'] [$count] ['name'] = $data ['country'];
			$countries ['items'] [$count] ['value'] = $data ['isocode'];
			$countries ['items'] [$count] ['country_id'] = $data ['id'];
			$countries ['totalCount'] = $count ++;
		}
	}
	$encodedCountries = json_encode ( $countries );


$query = "SELECT id,country_id, name, code FROM " . WPSC_TABLE_REGION_TAX;
$result = mysql_query ( $query );
$count = 0;
if (mysql_num_rows ( $result ) >= 1) {
	while ( $data = mysql_fetch_assoc ( $result ) ) {
		if (isset( $old_country_id ) && $old_country_id != $data ['country_id'])
			$count = 0;
		$regions [$data ['country_id']] ['items'] [] = array ('id' => $count, 'name' => $data ['name'], 'value' => $data ['name'], 'region_id' => $data ['id'] );
		$regions ['no_regions'] ['items'] [] = array ('id' => 0, 'name' => '', 'value' => '' );
		$old_country_id = $data ['country_id'];
		$count ++;
	}
}
$encodedRegions = json_encode ( $regions );
}
//BOF Products Fields
$products_cols['id']['name']       ='id';
$products_cols['id']['actionType'] ='';
$products_cols['id']['colName']    ='id';
$products_cols['id']['tableName']  ="{$wpdb->prefix}posts";

$products_cols['image']['name']       =__( 'Image', $sm_domain );
$products_cols['image']['actionType'] ='setStrActions';
$products_cols['image']['colName']    ='thumbnail';
$products_cols['image']['tableName']  ="{$wpdb->prefix}postmeta";

$products_cols['name']['name']      =__( 'Name', $sm_domain );
$products_cols['name']['actionType']='modStrActions';
$products_cols['name']['colName']   ='post_title';
$products_cols['name']['tableName'] ="{$wpdb->prefix}posts";

$products_cols['price']['name']=__( 'Price', $sm_domain );
$products_cols['price']['actionType']='price_actions';
$products_cols['price']['tableName']="{$wpdb->prefix}postmeta";
$products_cols['price']['updateColName']='meta_value';

$products_cols['salePrice']['name']=__( 'Sale Price', $sm_domain );
$products_cols['salePrice']['actionType']='salesprice_actions';
$products_cols['salePrice']['tableName']="{$wpdb->prefix}postmeta";
$products_cols['salePrice']['updateColName']='meta_value';
	
$products_cols['inventory']['name']=__( 'Inventory', $sm_domain );
$products_cols['inventory']['actionType']='modIntActions';
$products_cols['inventory']['tableName']="{$wpdb->prefix}postmeta";
$products_cols['inventory']['updateColName']='meta_value';

$products_cols['sku']['name']=__( 'SKU', $sm_domain );
$products_cols['sku']['actionType']='modStrActions';
$products_cols['sku']['tableName']="{$wpdb->prefix}postmeta";
$products_cols['sku']['updateColName']='meta_value';

$products_cols['group']['name']=__( 'Group', $sm_domain );
$products_cols['group']['actionType']='setAdDelActions';
$products_cols['group']['colName']='category';
$products_cols['group']['tableName']="{$wpdb->prefix}term_relationships";
$products_cols['group']['updateColName']='term_taxonomy_id';

$products_cols['weight']['name']=__( 'Weight', $sm_domain );
$products_cols['weight']['actionType']='modIntPercentActions';
$products_cols['weight']['tableName']="{$wpdb->prefix}postmeta";

$products_cols['publish']['name']=__( 'Publish', $sm_domain );
$products_cols['publish']['actionType']='YesNoActions';
$products_cols['publish']['colName']='post_status';
$products_cols['publish']['tableName']="{$wpdb->prefix}posts";

$products_cols['desc']['name']=__( 'Description', $sm_domain );
$products_cols['desc']['actionType']='modStrActions';
$products_cols['desc']['colName']='post_content';
$products_cols['desc']['tableName']="{$wpdb->prefix}posts";

$products_cols['addDesc']['name']=__( 'Additional Description', $sm_domain );
$products_cols['addDesc']['actionType']='modStrActions';
$products_cols['addDesc']['colName']='post_excerpt';
$products_cols['addDesc']['tableName']="{$wpdb->prefix}posts";

$products_cols['height']['name']=__( 'Height', $sm_domain );
$products_cols['height']['actionType']='modIntPercentActions';
$products_cols['height']['tableName']="{$wpdb->prefix}postmeta";

$products_cols['width']['name']=__( 'Width', $sm_domain );
$products_cols['width']['actionType']='modIntPercentActions';
$products_cols['width']['tableName']="{$wpdb->prefix}postmeta";

$products_cols['lengthCol']['name']=__( 'Length', $sm_domain );
$products_cols['lengthCol']['actionType']='modIntPercentActions';
$products_cols['lengthCol']['tableName']="{$wpdb->prefix}postmeta";

$products_cols['post_parent']['colName']='post_parent';
$products_cols['post_parent']['actionType']='';

if (WPSC_RUNNING === true) {
	
	$products_cols['price']['colName']='_wpsc_price';
	$products_cols['salePrice']['colName']='_wpsc_special_price';
	$products_cols['inventory']['colName']='_wpsc_stock';
	$products_cols['sku']['colName']='_wpsc_sku';

	$products_cols['disregardShipping']['name']=__( 'Disregard Shipping', $sm_domain );
	$products_cols['disregardShipping']['actionType']='YesNoActions';
	$products_cols['disregardShipping']['colName']='no_shipping';
	$products_cols['disregardShipping']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['pnp']['name']=__( 'Local Shipping Fee', $sm_domain );
	$products_cols['pnp']['actionType']='modIntPercentActions';
	$products_cols['pnp']['colName']='local';
	$products_cols['pnp']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['intPnp']['name']=__( 'International Shipping Fee', $sm_domain );
	$products_cols['intPnp']['actionType']='modIntPercentActions';
	$products_cols['intPnp']['colName']='international';
	$products_cols['intPnp']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['weight']['colName']='weight';
	$products_cols['height']['colName']='height';
	$products_cols['width']['colName']='width';
	$products_cols['lengthCol']['colName']='length';

	$products_cols['weightUnit']['name']=__( 'Unit', $sm_domain );
	$products_cols['weightUnit']['actionType']='';
	$products_cols['weightUnit']['colName']='weight_unit';
	$products_cols['weightUnit']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['heightUnit']['name']=__( 'Unit', $sm_domain );
	$products_cols['heightUnit']['actionType']='';
	$products_cols['heightUnit']['colName']='height_unit';
	$products_cols['heightUnit']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['widthUnit']['name']=__( 'Unit', $sm_domain );
	$products_cols['widthUnit']['actionType']='';
	$products_cols['widthUnit']['colName']='width_unit';
	$products_cols['widthUnit']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['lengthUnit']['name']=__( 'Unit', $sm_domain );
	$products_cols['lengthUnit']['actionType']='';
	$products_cols['lengthUnit']['colName']='length_unit';
	$products_cols['lengthUnit']['tableName']="{$wpdb->prefix}postmeta";
	
	$products_cols['qtyLimited']['name']=__( 'Stock: Quantity Limited', $sm_domain ) ;
	$products_cols['qtyLimited']['actionType']='YesNoActions';
	$products_cols['qtyLimited']['tableName']="{$wpdb->prefix}postmeta";
	$products_cols['qtyLimited']['updateColName']='meta_value';
	
	$products_cols['oos']['name']=__( 'Stock: Inform When Out Of Stock', $sm_domain );
	$products_cols['oos']['actionType']='YesNoActions';
	$products_cols['oos']['colName']='unpublish_when_none_left';
	$products_cols['oos']['tableName']="{$wpdb->prefix}postmeta";

	$products_cols['weight']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['weightUnit']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['disregardShipping']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['pnp']['colFilter']='meta_key:_wpsc_product_metadata:shipping';
	$products_cols['intPnp']['colFilter']='meta_key:_wpsc_product_metadata:shipping';
	$products_cols['height']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['heightUnit']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['width']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['widthUnit']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['lengthCol']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['lengthUnit']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['oos']['colFilter']='meta_key:_wpsc_product_metadata';
	$products_cols['price']['colFilter']='meta_key:_wpsc_price';
	$products_cols['salePrice']['colFilter']='meta_key:_wpsc_special_price';
	$products_cols['inventory']['colFilter']='meta_key:_wpsc_stock';
	$products_cols['sku']['colFilter']='meta_key:_wpsc_sku';
	$products_cols['qtyLimited']['colName']='_wpsc_stock';// @todo: check the serialized quantity limited value
	$products_cols['qtyLimited']['colFilter']='meta_key:_wpsc_stock';	

} else if (WOO_RUNNING === true) {

	// ==============================================================
	// Coupons Code
	// ==============================================================

	$couponfieldsResults = array();

	$couponfieldsquery = "SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key IN
															('discount_type','coupon_amount','individual_use','coupon_title_suffix',
																'apply_before_tax','free_shipping','coupon_title_prefix','exclude_sale_items',
																'usage_limit','expiry_date','minimum_amount','usage_count')";
	$couponfieldsResults = $wpdb->get_results ($couponfieldsquery , ARRAY_A);

	if ( empty( $couponfieldsResults ) ) {
		$couponfieldsResults =array ( array ( 'meta_key' => 'apply_before_tax' ), 
									  array ( 'meta_key' => 'coupon_amount' ),
									  array ( 'meta_key' => 'discount_type' ),
									  array ( 'meta_key' => 'exclude_sale_items' ),
									  array ( 'meta_key' => 'expiry_date' ),
									  array ( 'meta_key' => 'free_shipping' ),
									  array ( 'meta_key' => 'individual_use' ),
									  array ( 'meta_key' => 'minimum_amount' ),
									  array ( 'meta_key' => 'usage_count' ),
									  array ( 'meta_key' => 'usage_limit' ));
	}

	$select_box = $woocommerce->get_coupon_discount_types();

	$select_box_keys = array_keys($select_box);

	$couponfield_names_select = array();

	$i = 0;

	foreach ($select_box as $select_box1) {
		$couponfield_names_select [$i][0] = $select_box_keys [$i];
		$couponfield_names_select [$i][1] = $select_box1;
		$i++;
	}

	$cnt = 0;

	$couponfield_names ['items'] [$cnt] ['id'] = $cnt;
	$couponfield_names ['items'] [$cnt] ['name'] = 'Coupon Name';
	$couponfield_names ['items'] [$cnt] ['type'] = 'string';
	$couponfield_names ['items'] [$cnt] ['table'] ="posts";
	$couponfield_names ['items'] [$cnt] ['value'] = 'post_title';

	$cnt ++;

	foreach ($couponfieldsResults as $obj) {
		$couponfield_names ['items'] [$cnt] ['id'] = $cnt;
		$couponfield_names ['items'] [$cnt] ['name'] = ucwords(str_replace('_', ' ', $obj['meta_key']));

		if($obj['meta_key'] == "individual_use" || $obj['meta_key'] == "apply_before_tax"|| $obj['meta_key'] == "free_shipping"
			|| $obj['meta_key'] == "exclude_sale_items") {

			$couponfield_names ['items'] [$cnt] ['type'] = 'bool';

		} elseif ($obj['meta_key'] == "expiry_date") {
			$couponfield_names ['items'] [$cnt] ['type'] = 'datetime';
		} elseif ($obj['meta_key'] == "discount_type") {
			$couponfield_names ['items'] [$cnt] ['type'] = 'select';
			// $couponfield_names ['items'] [$cnt] ['data'] = $woocommerce->get_coupon_discount_types();
			$couponfield_names ['items'] [$cnt] ['data'] = $couponfield_names_select;
		} else {
			$couponfield_names ['items'] [$cnt] ['type'] = 'string';	
		}
	
		// $couponfield_names ['items'] [$cnt] ['value'] = $obj['meta_key'] . ",`{$wpdb->prefix}postmeta`";
		$couponfield_names ['items'] [$cnt] ['value'] = $obj['meta_key'];
		$couponfield_names ['items'] [$cnt] ['table'] ="postmeta";
		$couponfield_names ['totalCount'] = $cnt ++;
	}

	$coupon_details['title'] = 'Coupons';
	$coupon_details['column'] = $couponfield_names;


	$user_defined_fields['coupon_dashbd'] = $coupon_details;

	$encodedcouponfields = json_encode ( $user_defined_fields );


	// ================================================================================

	$orders_details_url = ADMIN_URL . "/post.php?post=";
	
	$orderFieldsQuery = "SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key IN 
																					('_shipping_first_name' , '_shipping_last_name' , 
																					'_shipping_address_1', '_shipping_address_2',
																					'_shipping_city', '_shipping_state', '_shipping_country','_shipping_postcode')";
	$orderFieldsResults = $wpdb->get_results ($orderFieldsQuery);

	$cnt = 0;
	foreach ($orderFieldsResults as $obj) {
		$ordersfield_names ['items'] [$cnt] ['id'] = $cnt;
		$ordersfield_names ['items'] [$cnt] ['name'] = ucwords(str_replace('_', ' ', substr($obj->meta_key, 1)));
		if ($ordersfield_names ['items'] [$cnt] ['name'] == 'Country') {
			$ordersfield_names ['items'] [$cnt] ['type'] = 'bigint';
		} else {
			$ordersfield_names ['items'] [$cnt] ['type'] = 'blob';
		}
		$ordersfield_names ['items'] [$cnt] ['value'] = $obj->meta_key . ",`{$wpdb->prefix}postmeta`";
		$ordersfield_names ['totalCount'] = $cnt ++;
	}

	$ordersfield_names ['items'] [$cnt] ['id'] = $cnt;
	$ordersfield_names ['items'] [$cnt] ['name'] = 'Order Status';
	$ordersfield_names ['items'] [$cnt] ['type'] = 'bigint';
	$ordersfield_names ['items'] [$cnt] ['value'] = " ,`{$wpdb->prefix}term_relationships`";

	$encodedOrdersFields = json_encode ( $ordersfield_names );
	
	$customerFieldsQuery = "SELECT DISTINCT meta_key FROM {$wpdb->prefix}postmeta WHERE meta_key IN 
																					('_billing_first_name' , '_billing_last_name' , 
																					'_billing_address_1', '_billing_address_2',
																					'_billing_city', '_billing_state', '_billing_country','_billing_postcode',
																					'_billing_email', '_billing_phone')";
	$customerFieldsResults = $wpdb->get_results ($customerFieldsQuery);
        $cnt = 0;
    if (!empty($customerFieldsResults)) {
    	foreach ($customerFieldsResults as $obj) {
			$customerFields ['items'] [$cnt] ['id'] = $cnt;
			$customerFields ['items'] [$cnt] ['name'] = __( ucwords(str_replace('_', ' ', substr($obj->meta_key, 9))), 'smart-manager' );
			if ($customerFields ['items'] [$cnt] ['name'] == 'Country') {
				$customerFields ['items'] [$cnt] ['type'] = 'bigint';
			} else {
				$customerFields ['items'] [$cnt] ['type'] = 'blob';
			}
			$customerFields ['items'] [$cnt] ['value'] = $obj->meta_key . ",`{$wpdb->prefix}postmeta`";
			$customerFields ['totalCount'] = $cnt ++;
		}	
    }    
    else {
    	$customerFields = 0;
    }
	
	
	$encodedCustomersFields = json_encode ( $customerFields );
	$count = 0;
	foreach ($woocommerce->countries->countries as $key => $value) {
		$countries ['items'] [$count] ['id'] = $count;
		$countries ['items'] [$count] ['name'] = $value;
		$countries ['items'] [$count] ['value'] = $key;
		$countries ['totalCount'] = $count++;
	}
	
	$encodedCountries = json_encode ( $countries );
	
	$products_cols['price']['colName']='_regular_price'; // for woo
	$products_cols['salePrice']['colName']='_sale_price'; // for woo
	$products_cols['inventory']['colName']='_stock'; // for woo
	$products_cols['sku']['colName']='_sku'; // for woo
	
	$products_cols['salePriceFrom']['name']=__( 'From', $sm_domain );
	$products_cols['salePriceFrom']['actionType']='';
	$products_cols['salePriceFrom']['colName']='_sale_price_dates_from';
	$products_cols['salePriceFrom']['tableName']="{$wpdb->prefix}postmeta";
	$products_cols['salePriceFrom']['updateColName']='meta_value';
	
	$products_cols['salePriceTo']['name']=__( 'To', $sm_domain );
	$products_cols['salePriceTo']['actionType']='';
	$products_cols['salePriceTo']['colName']='_sale_price_dates_to';
	$products_cols['salePriceTo']['tableName']="{$wpdb->prefix}postmeta";
	$products_cols['salePriceTo']['updateColName']='meta_value';
	
	$products_cols['weight']['colName']='_weight';
	$products_cols['height']['colName']='_height';
	$products_cols['width']['colName']='_width';
	$products_cols['lengthCol']['colName']='_length';
	
	$products_cols['taxStatus']['name']=__( 'Tax Status', $sm_domain );
	$products_cols['taxStatus']['actionType']='setStrActions';
	$products_cols['taxStatus']['colName']='_tax_status';
	$products_cols['taxStatus']['tableName']="{$wpdb->prefix}postmeta";
	$products_cols['taxStatus']['updateColName']='meta_value';

    $products_cols['visibility']['name']=__( 'Visibility', $sm_domain );
    $products_cols['visibility']['actionType']='setStrActions';
    $products_cols['visibility']['colName']='_visibility';
    $products_cols['visibility']['tableName']="{$wpdb->prefix}postmeta";
    $products_cols['visibility']['updateColName']='meta_value';

    $products_cols['attributes']['name']=__( 'Attributes', $sm_domain );
	$products_cols['attributes']['actionType']='setStrActions';
	$products_cols['attributes']['colName']='product_attributes';
	$products_cols['attributes']['tableName']="{$wpdb->prefix}postmeta";
	$products_cols['attributes']['updateColName']='meta_value';

} 

//Updating The Files Recieved in SM
$successful = ($updater * $upgrade)/$updater;

if (WPSC_RUNNING === true) {
	// BOF Product category
	if (IS_WPSC37) {
		// to fetch Product categories START
		$query = "SELECT pc.id   as category_id,
						cg.name as group_name, 
						pc.name as category_name, 
						group_id
					
	          FROM  " . WPSC_TABLE_PRODUCT_CATEGORIES . " AS pc, 
	          		" . WPSC_TABLE_CATEGORISATION_GROUPS . " AS cg
	          		
	          WHERE cg.active = 1 AND 
	          		pc.active = 1 AND 
	          		cg.id     = pc.group_id 
	          ORDER BY pc.id";
	
	} else { // is_wpc38
		
			$query = "SELECT {$wpdb->prefix}term_taxonomy.term_taxonomy_id as category_id,
			          {$wpdb->prefix}terms.name as category_name,
			          {$wpdb->prefix}term_taxonomy.parent as group_id,
			          IFNULL(parent_terms.name,'Categories') as group_name
			          
					FROM {$wpdb->prefix}term_taxonomy join  {$wpdb->prefix}terms on ({$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id)
					left join {$wpdb->prefix}terms as parent_terms on (parent_terms.term_id = {$wpdb->prefix}term_taxonomy.parent)
					where taxonomy = 'wpsc_product_category' ORDER BY group_id ASC
			        ";
		 
	}
} else if (WOO_RUNNING === true) {
		$query = "SELECT {$wpdb->prefix}term_taxonomy.term_taxonomy_id as category_id,
		          {$wpdb->prefix}terms.name as category_name,
		          {$wpdb->prefix}term_taxonomy.parent as group_id,
		          IFNULL(parent_terms.name,'Categories') as group_name
		          
				FROM {$wpdb->prefix}term_taxonomy join  {$wpdb->prefix}terms on ({$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id)
				left join {$wpdb->prefix}terms as parent_terms on (parent_terms.term_id = {$wpdb->prefix}term_taxonomy.parent)
				where taxonomy = 'product_cat' ORDER BY group_id ASC
		        ";
		
		$attribute_list_query = "SELECT attribute_label, attribute_name FROM {$wpdb->prefix}woocommerce_attribute_taxonomies";
}

$result = mysql_query ( $query );

$categories = array();

while ( $data = mysql_fetch_assoc ( $result ) ) {

	$count = (isset( $old_group_id ) && $old_group_id != $data ['group_id']) ? 0 : ++ $count;
	
	 if($count == 0){//setting the default categories for new product
	 	$cat_id = $data ['category_id'];
	 	$cat_name = $wpdb->_real_escape ( $data ['category_name']);
	 }
	
	$categories ["category-" . $data ['group_id']] [$count] [0] = $wpdb->_real_escape ( $data ['category_id'] );
	$categories ["category-" . $data ['group_id']] [$count] [1] = $wpdb->_real_escape ( $data ['category_name'] );
	
	$products_cols ["group" . $data ['group_id']] ['name'] =  __( 'Group', 'smart-manager') . ":" .  $wpdb->_real_escape ( $data ['group_name'] );
	$products_cols ["group" . $data ['group_id']] ['actionType'] = "category_actions";
	if (WPSC_RUNNING === true) {
		$products_cols ["group" . $data ['group_id']] ['colName'] = (IS_WPSC37) ? "category_id" : "term_taxonomy_id";
		$products_cols ["group" . $data ['group_id']] ['tableName'] = (IS_WPSC37) ? WPSC_TABLE_ITEM_CATEGORY_ASSOC : "{$wpdb->prefix}term_relationships";
	} elseif (WOO_RUNNING === true){
		$products_cols ["group" . $data ['group_id']] ['colName'] = "term_taxonomy_id";
		$products_cols ["group" . $data ['group_id']] ['tableName'] = "{$wpdb->prefix}term_relationships";		
	}
	
	$products_cols ["group" . $data ['group_id']] ['colFilter'] = $wpdb->_real_escape ( $data ['group_id'] );
	$old_group_id = $data ['group_id']; //string the group_id as old id
}

if (WPSC_RUNNING === true && IS_WPSC38) {
	
	$query = "SELECT {$wpdb->prefix}term_taxonomy.term_id as category_id,
			          {$wpdb->prefix}terms.name as category_name,
			          {$wpdb->prefix}term_taxonomy.parent as group_id,
			          IFNULL(parent_terms.name,'Sets') as group_name
			          
					FROM {$wpdb->prefix}term_taxonomy join  {$wpdb->prefix}terms on ({$wpdb->prefix}terms.term_id = {$wpdb->prefix}term_taxonomy.term_id)
					left join {$wpdb->prefix}terms as parent_terms on (parent_terms.term_id = {$wpdb->prefix}term_taxonomy.parent)
					where taxonomy = 'wpsc-variation' ORDER BY group_id
			        ";
	
	$result = mysql_query ( $query );
	while ( $data = mysql_fetch_assoc ( $result ) ) {

		$count = ($old_group_id != $data ['group_id']) ? 0 : ++ $count;
		
		 if($count == 0){//setting the default categories for new product
		 	$cat_id = $data ['category_id'];
		 	$cat_name = $wpdb->_real_escape ( $data ['category_name']);
		 }
		
		$categories ["category-Variation" . $data ['group_id']] [$count] [0] = $wpdb->_real_escape ( $data ['category_id'] );
		$categories ["category-Variation" . $data ['group_id']] [$count] [1] = $wpdb->_real_escape ( $data ['category_name'] );
		
		$products_cols ["groupVariation" . $data ['group_id']] ['name'] = __("Variation: ",$sm_domain) . $wpdb->_real_escape ( $data ['group_name'] ); 
		$products_cols ["groupVariation" . $data ['group_id']] ['actionType'] = "category_actions";
		$products_cols ["groupVariation" . $data ['group_id']] ['colName'] = (IS_WPSC37) ? "category_id" : "term_taxonomy_id";
		$products_cols ["groupVariation" . $data ['group_id']] ['tableName'] = (IS_WPSC37) ? WPSC_TABLE_ITEM_CATEGORY_ASSOC : "{$wpdb->prefix}term_relationships";
		$products_cols ["groupVariation" . $data ['group_id']] ['colFilter'] = "Variation" . $wpdb->_real_escape ( $data ['group_id'] );
		$old_group_id = $data ['group_id']; //string the group_id as old id
	}
	
} elseif (WOO_RUNNING === true) {
	
	$attribute_results = $wpdb->get_results( $attribute_list_query, 'ARRAY_A' );
	$att_count = 0;
	$attribute [$att_count] [] = $att_count;
	$attribute [$att_count] [] = "Custom";
	$attribute [$att_count] [] = "custom";
	$att_count++;
	foreach ( $attribute_results AS $attribute_result ) {
		$attribute [$att_count] [] = $att_count;
		$attribute [$att_count] [] = $wpdb->_real_escape ( $attribute_result ['attribute_label'] );
		$attribute [$att_count] [] = $wpdb->_real_escape ( $attribute_result ['attribute_name'] );
		$att_count++;
	
	}
	
	$products_cols ["groupAttributeAdd"] ['name'] = __("Add Attribute",$sm_domain); 
	$products_cols ["groupAttributeAdd"] ['actionType'] = "attribute_action";
	$products_cols ["groupAttributeAdd"] ['colName'] = "term_taxonomy_id";
	$products_cols ["groupAttributeAdd"] ['tableName'] = "{$wpdb->prefix}term_relationships";		
	$products_cols ["groupAttributeAdd"] ['colFilter'] = "AttributeAdd";
	
	$products_cols ["groupAttributeChange"] ['name'] = __("Change Attribute",$sm_domain);
	$products_cols ["groupAttributeChange"] ['actionType'] = "attribute_action";
	$products_cols ["groupAttributeChange"] ['colName'] = "term_taxonomy_id";
	$products_cols ["groupAttributeChange"] ['tableName'] = "{$wpdb->prefix}term_relationships";		
	$products_cols ["groupAttributeChange"] ['colFilter'] = "AttributeChange";
	
	$products_cols ["groupAttributeRemove"] ['name'] = __("Remove Attribute",$sm_domain);
	$products_cols ["groupAttributeRemove"] ['actionType'] = "attribute_action";
	$products_cols ["groupAttributeRemove"] ['colName'] = "term_taxonomy_id";
	$products_cols ["groupAttributeRemove"] ['tableName'] = "{$wpdb->prefix}term_relationships";		
	$products_cols ["groupAttributeRemove"] ['colFilter'] = "AttributeRemove";

}

$encoded_categories = json_encode ( $categories );
$products_cols = json_encode( $products_cols );
if ( isset( $attribute ) ) {
	$attribute = addslashes(json_encode( $attribute )); // addslashes was done as one client was facing issue with attributes
}
// EOF Product category
// BOF Products Fields

        $timezone = get_option( 'gmt_offset' );
        
//        var IS_WOO20            =  '" . ((WOO_RUNNING === true) ? IS_WOO20 : '') . "';
        
	//getting customers fieldnames END

	echo "<script type='text/javascript'>

	
	var isWPSC37            =  '" . ((WPSC_RUNNING === true) ? IS_WPSC37 : '') . "';
        var isWPSC38            =  '" . ((WPSC_RUNNING === true) ? IS_WPSC38 : '') . "';
        var SM_IS_WOO16            =  '" . ((WOO_RUNNING === true) ? SM_IS_WOO16 : '') . "';
        var IS_WP35             =  '" . ((version_compare ( $wp_version, '3.5', '>=' )) ? IS_WP35 : '') . "';
        var time_zone           = '" . $timezone . "';
	
	var ordersFields        =  " . $encodedOrdersFields . ";
	var updated_data     	=  " . $successful . ";
	var customersFields     =  " . $encodedCustomersFields . ";
	var categories 			=  " . $encoded_categories . ";
	var countries           =  " . $encodedCountries . ";
	var site_url            =  '" . $site_url . "';
	var wpContentUrl        =  '" . WP_CONTENT_URL . "';
	var sm_record_limit 	=  '".$record_limit_result."';		
	var sm_amount_decimal_precision 	=  '".$sm_amount_decimal_precision."';	
	var sm_dimensions_decimal_precision 	=  '".$sm_dimensions_decimal_precision."';";	//Decimal Precision for Dimensions fields 
	

if ( MULTISITE == 1 ) {
	echo "
	var uploadBlogsDir      =  '" . UPLOADBLOGSDIR . "';
	var uploads        		=  '" . UPLOADS . "';";
}
	
if (WPSC_RUNNING === true) {
	echo "
        var regions             =  " . $encodedRegions . ";
	var ordersStatus        =  " . $encodedOrderStatus . ";
	var weightUnits         =  " . $encodedWeightUnits . ";
	var wpscUploadUrl       =  '" . WPSC_UPLOAD_URL . "';";
        
} else {
	echo "
        var regions             =  '" . (isset($encodedRegions) ? $encodedRegions : '') . "';
	var ordersStatus        =  '" . (isset($encodedOrderStatus) ? $encodedOrderStatus : '') . "';
	var weightUnits         =  '" . (isset($encodedWeightUnits) ? $encodedWeightUnits : '') . "';
	var couponFields        =  " . $encodedcouponfields . "; // For WooCoupons
	var attribute           =  '" . $attribute  . "';";
}
	echo "
	var newCatName          = '" . (isset($cat_name) ? $cat_name : '') . "';
	var fileExists          = '" . $fileExists . "';
	var wpscRunning         = '" . $wpsc . "';
	var wooRunning          = '" . $woo . "';
	var wpsc_woo			= '" . $wpsc_woo . "';
	var newCatId            = '" . (isset($cat_id) ? $cat_id : '') . "';
	var jsonURL             = '" . JSON_URL . "';
	var imgURL              = '" . IMG_URL . "';
	var productsDetailsLink = '" . $products_details_url . "';	
	var ordersDetailsLink   = '" . $orders_details_url . "';
	
	var getText = function( oldText ) {
	
		var oldTextKey = oldText.replace( /[-.'?:%&,()|/+\s]/g, '_' ).toLowerCase();
		var lang 				= new Object;
		lang.products			= '" . __('Products',$sm_domain) . "';
		lang.customers			= '" . __('Customers',$sm_domain) . "';
		lang.orders				= '" . __('Orders',$sm_domain) . "';
		lang.add_product        = '" . __('Add Product',$sm_domain) . "';
		lang.add_a_new_product  = '" . __('Add a new product',$sm_domain) . "';
                lang.duplicate_product        = '" . __('Duplicate Product',$sm_domain) . "';
                lang.selected_products        = '" . __('Selected Products',$sm_domain) . "';
                lang.duplicate_store        = '" . __('Duplicate Store',$sm_domain) . "';
		lang.smart_manager     	= '" . __('Smart Manager',$sm_domain) . "';
		lang.add_product_feature_is_available_only_in_pro_version  = '" . __('Add product feature is available only in Pro version',$sm_domain) . "';
		lang.print		        = '" . __('Print',$sm_domain) . "';
		lang.print_order = '" . __('Print Order',$sm_domain) . "';
		lang.print_preview_feature_is_available_only_in_pro_version	= '" . __('Print Preview feature is available only in Pro version',$sm_domain) . "';
		lang.delete         	= '" . __('Delete',$sm_domain) . "';
		lang.delete_the_selected_items = '" . __('Delete the selected items',$sm_domain) . "'; 
		lang.type	         	= '" . __('Type',$sm_domain) . "';
		lang.product_images	   	= '" . __('Product Images',$sm_domain) . "';
		lang.product_name	    = '" . __('Product Name',$sm_domain) . "'
		lang.price	         	= '" . __('Price',$sm_domain) . "';
		lang.sale_price			= '" . __('Sale Price',$sm_domain) . "';
		lang.sale_price_from	= '" . __('Sale Price From',$sm_domain) . "';
		lang.sale_price_to		= '" . __('Sale Price To',$sm_domain) . "';
		lang.inventory	        = '" . __('Inventory',$sm_domain) . "';
		lang.sku	            = '" . __('SKU',$sm_domain) . "';
		lang.category	        = '" . __('Category',$sm_domain) . "';
		lang.attributes	        = '" . __('Attributes',$sm_domain) . "';
		lang.weight		        = '" . __('Weight',$sm_domain) . "';
		lang.product_status		= '" . __('Product Status',$sm_domain) . "';
		lang.description		= '" . __('Description',$sm_domain) . "';
		lang.additional_description	= '" . __('Additional Description',$sm_domain) . "';
		lang.height		        = '" . __('Height',$sm_domain) . "';
		lang.width		        = '" . __('Width',$sm_domain) . "';
		lang.length		        = '" . __('Length',$sm_domain) . "';
		lang.edit				= '" . __('Edit',$sm_domain) . "';
		lang.product_info		= '" . __('Product Info',$sm_domain) . "';
		lang.batch_update		= '" . __('Batch Update',$sm_domain) . "';
		lang.update_selected_items = '" . __('Update selected items',$sm_domain) . "';
		lang.save		        = '" . __('Save',$sm_domain) . "';
		lang.save_all_changes	= '" . __('Save all Changes',$sm_domain) . "';
		lang.export_csv		    = '" . __('Export CSV',$sm_domain) . "';
		lang.download_csv_file	= '" . __('Download CSV file',$sm_domain) . "';
		lang.export_csv_feature_is_available_only_in_pro_version	= '" . __('Export CSV feature is available only in Pro version',$sm_domain) . "';
                lang.duplicate_product_feature_is_available_only_in_pro_version	= '" . __('Duplicate Product feature is available only in Pro version',$sm_domain) . "';
                lang.duplicate_store_feature_is_available_only_in_pro_version	= '" . __('Duplicate Store feature is available only in Pro version',$sm_domain) . "';
		lang.are_you_sure_you_want_to_delete_the_selected_record_	= '" . __('Are you sure you want to delete the selected record?',$sm_domain) . "';
		lang.are_you_sure_you_want_to_delete_the_selected_records_	= '" . __('Are you sure you want to delete the selected records?',$sm_domain) . "';
                lang.are_you_sure_you_want_to_duplicate_the_selected_product_	= '" . __('Are you sure you want to duplicate the selected product?',$sm_domain) . "';
		lang.are_you_sure_you_want_to_duplicate_the_selected_products_	= '" . __('Are you sure you want to duplicate the selected products?',$sm_domain) . "';
		lang.are_you_sure_you_want_to_duplicate_the_entire_store_	= '" . __('Are you sure you want to duplicate the entire store?',$sm_domain) . "';
		lang.confirm_file_delete = '" . __('Confirm File Delete',$sm_domain) . "';
		lang.list_is_empty		= '" . __('list is empty',$sm_domain) . "';
		lang.confirm_save		= '" . __('Confirm Save',$sm_domain) . "';
		lang.do_you_want_to_save_the_modified_records_	= '" . __('Do you want to save the modified records?',$sm_domain) . "';
		lang.search				= '" . __('Search',$sm_domain) . "';
		lang.search_feature_is_available_only_in_pro_version	= '" . __('Search feature is available only in Pro version',$sm_domain) . "';
		lang.please_wait			= '" . __('Please wait',$sm_domain) . "';
		lang.select_a_field		= '" . __('Select a field',$sm_domain) . "';
		lang.only_numbers_are_allowed	= '" . __('Only numbers are allowed',$sm_domain) . "';
		lang.enter_attribute_name	= '" . __('Enter Attribute Name',$sm_domain) . "';
		lang.select_an_action		= '" . __('Select an action',$sm_domain) . "';
		lang.select_a_value		= '" . __('Select a value',$sm_domain) . "';
		lang.enter_the_value		= '" . __('Enter the value',$sm_domain) . "';
		lang.select_a_value	= '" . __('Select a Value',$sm_domain) . "';
		lang.select_a_visibility	= '" . __('Select a Visibility',$sm_domain) . "';
		lang.enter_values		= '" . __('Enter values',$sm_domain) . "';
		lang.important_			= '" . __('Important:',$sm_domain) . "';
		lang.for_more_than_one_values__use_pipe_____as_delimiter	= '" . __('For more than one values, use pipe (|) as delimiter',$sm_domain) . "';
		lang.delete_row			= '" . __('Delete Row',$sm_domain) . "';
		lang.upload_image		= '" . __('Upload Image',$sm_domain) . "';
		lang.add_row			= '" . __('Add Row',$sm_domain) . "';
		lang.add_a_new_row			= '" . __('Add a new row',$sm_domain) . "';
		lang.update				= '" . __('Update',$sm_domain) . "';
		lang.apply_all_changes	= '" . __('Apply all changes',$sm_domain) . "';
                lang.reset				= '" . __('Reset',$sm_domain) . "';
		lang.reset_all_fields	= '" . __('Reset all fields',$sm_domain) . "';
		lang.batch_update___available_only_in_pro_version		= '" . __('Batch Update - available only in Pro version',$sm_domain) . "';
		lang.your_browser_does_not_support_iframes_		= '" . __('Your browser does not support iframes.',$sm_domain) . "';
		lang.first_name			= '" . __('First Name',$sm_domain) . "';
		lang.billing_first_name	= '" . __('Billing First Name',$sm_domain) . "';
		lang.last_name			= '" . __('Last Name',$sm_domain) . "';
		lang.billing_last_name	= '" . __('Billing Last Name',$sm_domain) . "';
		lang.email				= '" . __('Email',$sm_domain) . "';
		lang.email_address		= '" . __('Email Address',$sm_domain) . "';
		lang.address			= '" . __('Address',$sm_domain) . "';
		lang.billing_address		= '" . __('Billing Address',$sm_domain) . "';
		lang.postal_code		= '" . __('Postal Code',$sm_domain) . "';
		lang.billing_postal_code	= '" . __('Billing Postal Code',$sm_domain) . "';
		lang.city				= '" . __('City',$sm_domain) . "';
		lang.billing_city		= '" . __('Billing City',$sm_domain) . "';
		lang.region				= '" . __('Region',$sm_domain) . "';
		lang.billing_region		= '" . __('Billing Region',$sm_domain) . "';
		lang.country			= '" . __('Country',$sm_domain) . "';
		lang.billing_country		= '" . __('Billing Country',$sm_domain) . "';
		lang.total_purchased		= '" . __('Total Purchased',$sm_domain) . "';
		lang.last_order			= '" . __('Last Order',$sm_domain) . "';
		lang.last_order_total	= '" . __('Last Order Total',$sm_domain) . "';
		lang.last_order_details	= '" . __('Last Order Details',$sm_domain) . "';
		lang.phone_number		= '" . __('Phone Number',$sm_domain) . "';
		lang.total_number_of_orders = '" . __('Total Number Of Orders',$sm_domain) . "';
		lang.total_orders_amount	= '" . __('Total Orders Amount',$sm_domain) . "';
		lang.filter_through_date_feature_is_available_only_in_pro_version = '" . __('Filter through Date feature is available only in Pro version',$sm_domain) . "';
		lang.order_id			= '" . __('Order Id',$sm_domain) . "';
		lang.date___time			= '" . __('Date / Time',$sm_domain) . "';
		lang.name				= '" . __('Name',$sm_domain) . "';
		lang.customer_name		= '" . __('Customer Name',$sm_domain) . "';
		lang.amount				= '" . __('Amount',$sm_domain) . "';
		lang.details			= '" . __('Details',$sm_domain) . "';
		lang.track_id			= '" . __('Track Id',$sm_domain) . "';
		lang.payment_method		= '" . __('Payment Method',$sm_domain) . "';
		lang.status				= '" . __('Status',$sm_domain) . "';
		lang.order_status		= '" . __('Order Status',$sm_domain) . "';
		lang.orders_notes			= '" . __('Orders Notes',$sm_domain) . "';
		lang.shipping_method		= '" . __('Shipping Method',$sm_domain) . "';
		lang.shipping_first_name	= '" . __('Shipping First Name',$sm_domain) . "';
		lang.shipping_last_name	= '" . __('Shipping Last Name',$sm_domain) . "';
		lang.shipping_address	= '" . __('Shipping Address',$sm_domain) . "';
		lang.shipping_postal_code	= '" . __('Shipping Postal Code',$sm_domain) . "';
		lang.shipping_city		= '" . __('Shipping City',$sm_domain) . "';
		lang.shipping_region		= '" . __('Shipping Region',$sm_domain) . "';
		lang.shipping_country	= '" . __('Shipping Country',$sm_domain) . "';
                lang.customer_phone_number	= '" . __('Customer Phone Number',$sm_domain) . "';
		lang.show_variations_feature_is_available_only_in_pro_version	= '" . __('Show Variations feature is available only in Pro version',$sm_domain) . "';
		lang.show_variations_feature_is_available_only_for_wpec_3_8_		= '" . __('Show Variations feature is available only for WPeC 3.8+',$sm_domain) . "';
		lang.show_variations	= '" . __('Show Variations',$sm_domain) . "';
		lang.access_denied		= '" . __('Access Denied',$sm_domain) . "';
		lang.you_dont_have_sufficient_permission_to_view_this_page		= '" . __("You dont have sufficient permission to view this page",$sm_domain) . "';
		lang.this_feature_is_available_only_in_pro_version				= '" . __('This feature is available only in Pro version',$sm_domain) . "';
		lang.products_details	= '" . __('Products Details',$sm_domain) . "';
		lang.manage_your_product_images	= '" . __('Manage your Product Images',$sm_domain) . "';
		lang.manage_your_product_images___available_only_in_pro_version = '" . __('Manage your Product Images - Available only in Pro version',$sm_domain) . "';
		lang.batch_update_feature_is_available_only_in_pro_version	= '" . __('Batch Update feature is available only in Pro version',$sm_domain) . "';
		lang.set_to				= '" . __('set to',$sm_domain) . "';
		lang.append			= '" . __('append',$sm_domain) . "';
		lang.prepend			= '" . __('prepend',$sm_domain) . "';
		lang.increase_by__ 		= '" . __('increase by %',$sm_domain) . "';
		lang.decrease_by__		= '" . __('decrease by %',$sm_domain) . "';
		lang.increase_by_number	= '" . __('increase by number',$sm_domain) . "';
		lang.decrease_by_number	= '" . __('decrease by number',$sm_domain) . "';
                lang.set_to_sales_price	= '" . __('set to sales price',$sm_domain) . "';
                lang.set_to_regular_price = '" . __('set to regular price',$sm_domain) . "';
		lang.yes				= '" . __('Yes',$sm_domain) . "';
		lang.no				= '" . __('No',$sm_domain) . "';
		lang.add_to				= '" . __('add to',$sm_domain) . "';
		lang.remove_from		= '" . __('remove from',$sm_domain) . "';
		lang.inches			= '" . __('inches',$sm_domain) . "';
		lang.cm				= '" . __('cm',$sm_domain) . "';
		lang.meter				= '" . __('meter',$sm_domain) . "';
		lang.disregard_shipping	= '" . __('Disregard Shipping',$sm_domain) . "';
		lang.local_shipping_fee	= '" . __('Local Shipping Fee',$sm_domain) . "';
		lang.international_shipping_fee	= '" . __('International Shipping Fee',$sm_domain) . "';
		lang.weight_unit				= '" . __('Weight Unit',$sm_domain) . "';
		lang.height_unit				= '" . __('Height Unit',$sm_domain) . "';
		lang.width_unit				= '" . __('Width Unit',$sm_domain) . "';
		lang.length_unit				= '" . __('Length Unit',$sm_domain) . "';		
        lang.catalog___search	      		= '" . __('Catalog & Search',$sm_domain) . "';
		lang.catalog				    = '" . __('Catalog',$sm_domain) . "';
		lang.search				        = '" . __('Search',$sm_domain) . "';
		lang.hidden			            = '" . __('Hidden',$sm_domain) . "';
		lang.pending			            = '" . __('Pending',$sm_domain) . "';
		lang.failed			            = '" . __('Failed',$sm_domain) . "';
		lang.on_hold			            = '" . __('On Hold',$sm_domain) . "';
		lang.processing			            = '" . __('Processing',$sm_domain) . "';
		lang.completed			            = '" . __('Completed',$sm_domain) . "';
		lang.refunded			            = '" . __('Refunded',$sm_domain) . "';
		lang.cancelled			            = '" . __('Cancelled',$sm_domain) . "';
                    
        lang.product_visibility			= '" . __('Product Visibility',$sm_domain) . "';
        lang.visibility     			= '" . __('Visibility',$sm_domain) . "';
        lang.taxable     			= '" . __('Taxable',$sm_domain) . "';
        lang.shipping_only     			= '" . __('Shipping only',$sm_domain) . "';
        lang.none     			= '" . __('None',$sm_domain) . "';
        lang.pounds     			= '" . __('Pounds',$sm_domain) . "';
        lang.ounces     			= '" . __('Ounces',$sm_domain) . "';
        lang.grams     			= '" . __('Grams',$sm_domain) . "';
        lang.kilograms     			= '" . __('Kilograms',$sm_domain) . "';
        lang.sum_total_of_all_orders     			= '" . __('Sum Total Of All Orders',$sm_domain) . "';
        lang.total_purchased     			= '" . __('Total Purchased',$sm_domain) . "';
        
        lang.order_shipping     			= '" . __('Order Shipping',$sm_domain) . "';
        lang.order_discount     			= '" . __('Order Discount',$sm_domain) . "';
        lang.cart_discount     			= '" . __('Cart Discount',$sm_domain) . "';
        lang.order_tax     			= '" . __('Order Tax',$sm_domain) . "';
        lang.order_shipping_tax     			= '" . __('Order Shipping Tax',$sm_domain) . "';
        lang.order_currency     			= '" . __('Order Currency',$sm_domain) . "';
        lang.coupons_used     			= '" . __('Coupons Used',$sm_domain) . "';
        lang.order_excluding_tax     			= '" . __('Order Excluding Tax',$sm_domain) . "';
        lang.order_total_excluding_tax     			= '" . __('Order Total Excluding Tax',$sm_domain) . "';
        lang.order_notes     			= '" . __('Order Notes',$sm_domain) . "';

		newText = lang[oldTextKey];
		return newText;
	};
	
	/*BOF setting the product fields acc. to the WPSC version*/
	var productsViewCols    = new Array(); /*data indexes of the columns in products view*/
	
	var SM = new Object;
	   	SM.productsCols = ".$products_cols.";
	
	if (wpscRunning == 1) {
		if(isWPSC37 != ''){
			SM.productsCols.id.colName                 = 'id';
			
			SM.productsCols.name.colName               = 'name';
			SM.productsCols.name.tableName             = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			
			SM.productsCols.price.colName              = 'price';
			SM.productsCols.price.tableName            = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			SM.productsCols.price.updateColName        = '';
			 
			SM.productsCols.salePrice.colName          = 'sale_price';
			SM.productsCols.salePrice.tableName        = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			SM.productsCols.salePrice.updateColName    = 'special_price';
			
			SM.productsCols.inventory.colName          = 'quantity'; 
			SM.productsCols.inventory.tableName        = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			
			SM.productsCols.sku.colName                = 'sku';
			SM.productsCols.sku.tableName              = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCTMETA : '') . "';	
			SM.productsCols.sku.updateColName    	   = 'meta_value';
		
			SM.productsCols.weight.tableName 		    = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';	
			
			SM.productsCols.publish.colName             = 'publish';	
			SM.productsCols.publish.tableName           = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			
			SM.productsCols.disregardShipping.tableName  = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			        
			SM.productsCols.desc.colName               = 'description';
			SM.productsCols.desc.tableName             = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			
			SM.productsCols.addDesc.colName            = 'additional_description';
			SM.productsCols.addDesc.tableName          = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
				
			SM.productsCols.pnp.colName                = 'pnp';
			SM.productsCols.pnp.tableName              = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			
			SM.productsCols.intPnp.colName             = 'international_pnp';
			SM.productsCols.intPnp.tableName           = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';
			
			SM.productsCols.qtyLimited.colName         = 'quantity_limited';
			SM.productsCols.qtyLimited.tableName       = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCT_LIST : '') . "';	
			
			SM.productsCols.oos.colName       		   = 'unpublish_oos';
			SM.productsCols.oos.tableName       	   = '" . (WPSC_RUNNING === true ? WPSC_TABLE_PRODUCTMETA : '') . "';
			SM.productsCols.oos.updateColName    	   = 'meta_value'; 
			
			SM.productsCols.variationsPrice		   	   = {
															name       :'Variations: Price', 
															colName    :'price',
															actionType :'modIntPercentActions',
															tableName  :'". (WPSC_RUNNING === true ? WPSC_TABLE_VARIATION_PROPERTIES : '') ."'
														 };
							
			SM.productsCols.variationsWeight	   	   = {
															name       :'Variations: Weight',
															colName    :'weight',
															actionType :'modIntPercentActions',
															tableName  :'". (WPSC_RUNNING === true ? WPSC_TABLE_VARIATION_PROPERTIES : '') ."'
														 };
		}
	}
	var i = 0 ;
	var j = 0;
	
	var productsFields        = new Array();
	productsFields.items      = new Array();
	var prodFieldsStoreData   = new Array();
	prodFieldsStoreData.items = new Array();
	var dontShow 			  = new Array('height', 'width', 'lengthCol');
	

	Ext.iterate(SM.productsCols , function(key,value) { // adding values in the value field
		SM['productsCols'][key]['value'] = key; ";
	
if (WPSC_RUNNING === true) {	
		
		echo " if(isWPSC37 != '' && value.actionType != ''){
			if(value.value != 'height'){
				if(value.value != 'width'){
					if(value.value != 'lengthCol'){
							if(value.value != 'group'){
								productsFields.items.push(value);
								productsFields.totalCount = ++j;
						}
					}
				}
			}
		}else if(isWPSC38 != '' && value.actionType != ''){";   // dropdown without unwanted columns for
} elseif (WOO_RUNNING === true) {
		echo "if(value.actionType != ''){";
}

                //Condition to skip the Description, Additional Description and Group column from SM Batch Update
                
//		echo "if(value.value != 'group' && value.value != 'desc' && value.value != 'addDesc'){
		echo "if(value.value != 'group' && value.value != 'attributes'){
				productsFields.items.push(value);
				productsFields.totalCount = ++j;
			}
		}
		prodFieldsStoreData.items.push(value);
		prodFieldsStoreData.totalCount = ++i;
	},this);
	
	for(var prodcol in SM.productsCols) { 
            if ( productsViewCols.indexOf( SM.productsCols[prodcol]['colName'] ) < 0 ) {
                productsViewCols.push(SM.productsCols[prodcol]['colName']);
            }
        }
	
	</script>";

// Code for handling SSL error for FB Link
$ssl = (is_ssl()) ? "https" : "http";
$fb_link = $ssl . "://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.storeapps.org%2F&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80";
                
?>
<!-- Smart Manager FB Like Button -->

<div class="wrap"><br />
<iframe
	src= <?php echo $fb_link;?>
	scrolling="no" frameborder="0"
	style="border: none; overflow: hidden; width: 450px; height: 80px;"
	allowTransparency="true"></iframe></div>
