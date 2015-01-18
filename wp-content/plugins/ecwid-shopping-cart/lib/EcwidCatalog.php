<?php

class EcwidCatalog
{
	var $store_id = 0;
	var $store_base_url = '';
	var $ecwid_api = null;

	function __construct($store_id, $store_base_url)
	{
		$this->store_id = intval($store_id);
		$this->store_base_url = $store_base_url;	
		$this->ecwid_api = new EcwidProductApi($this->store_id);
	}

	function EcwidCatalog($store_id)
	{
		if(version_compare(PHP_VERSION,"5.0.0","<"))
			$this->__construct($store_id);
	}

	function _l($code, $indent_change = 0)
	{
		static $indent = 0;

		if ($indent_change < 0) $indent -= 1;
		$str = str_repeat('    ', $indent) . $code . "\n";
		if ($indent_change > 0) $indent += 1;

		return $str;
	}

	function get_product($id)
	{
		$params = array 
		(
			array("alias" => "p", "action" => "product", "params" => array("id" => $id)),
			array("alias" => "pf", "action" => "profile")
		);

		$batch_result = $this->ecwid_api->get_batch_request($params);
		$product = $batch_result["p"];
		$profile = $batch_result["pf"];

		$return = $this->_l('');
		
		if (is_array($product)) 
		{
		
			$return .= $this->_l('<div itemscope itemtype="http://schema.org/Product">', 1);
			$return .= $this->_l('<h2 class="ecwid_catalog_product_name" itemprop="name">' . esc_html($product["name"]) . '</h2>');
			$return .= $this->_l('<p class="ecwid_catalog_product_sku" itemprop="sku">' . esc_html($product["sku"]) . '</p>');
			
			if (!empty($product["thumbnailUrl"])) 
			{
				$return .= $this->_l('<div class="ecwid_catalog_product_image">', 1);
				$return .= $this->_l(
					sprintf(
						'<img itemprop="image" src="%s" alt="%s" />',
						esc_attr($product['thumbnailUrl']),
						esc_attr($product['name'] . ' ' . $product['sku'])
					)
				);
				$return .= $this->_l('</div>', -1);
			}
			
			if(is_array($product["categories"]))
			{
				foreach ($product["categories"] as $ecwid_category) 
				{
					if($ecwid_category["defaultCategory"] == true)
					{
						$return .= $this->_l('<div class="ecwid_catalog_product_category">' . esc_html($ecwid_category['name']) . '</div>');
					}
				}
			}
			
			$return .= $this->_l('<div class="ecwid_catalog_product_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">', 1);
			$return .=  $this->_l(__('Price', 'ecwid-shopping-cart') . ': <span itemprop="price">' . esc_html($product["price"]) . '</span>');

			$return .= $this->_l('<span itemprop="priceCurrency">' . esc_html($profile['currency']) . '</span>');
			if (!isset($product['quantity']) || (isset($product['quantity']) && $product['quantity'] > 0)) {
				$return .= $this->_l('<link itemprop="availability" href="http://schema.org/InStock" />In stock');
			}
			$return .= $this->_l('</div>', -1);

			$return .= $this->_l('<div class="ecwid_catalog_product_description" itemprop="description">', 1);
			$return .= $this->_l($product['description']);
			$return .= $this->_l('</div>', -1);

			if (is_array($product['attributes']) && !empty($product['attributes'])) {

				foreach ($product['attributes'] as $attribute) {
					if (trim($attribute['value']) != '') {
						$return .= $this->_l('<div class="ecwid_catalog_product_attribute">', 1);

						$attr_string = $attribute['name'] . ':';

						if (isset($attribute['internalName']) && $attribute['internalName'] == 'Brand') {
							$attr_string .= '<span itemprop="brand">' . $attribute['value'] . '</span>';
						} else {
							$attr_string .= $attribute['value'];
						}

						$return .= $this->_l($attr_string);
						$return .= $this->_l('</div>', -1);
					}
				}
			}

			if (is_array($product["options"]))
			{
				$allowed_types = array('TEXTFIELD', 'DATE', 'TEXTAREA', 'SELECT', 'RADIO', 'CHECKBOX');
				foreach($product["options"] as $product_options)
				{
					if (!in_array($product_options['type'], $allowed_types)) continue;

					$return .= $this->_l('<div class="ecwid_catalog_product_options">', 1);
					$return .=$this->_l('<span>' . esc_html($product_options["name"]) . '</span>');

					if($product_options["type"] == "TEXTFIELD" || $product_options["type"] == "DATE")
					{
						$return .=$this->_l('<input type="text" size="40" name="'. esc_attr($product_options["name"]) . '">');
					}
				   	if($product_options["type"] == "TEXTAREA")
					{
					 	$return .=$this->_l('<textarea name="' . esc_attr($product_options["name"]) . '></textarea>');
					}
					if ($product_options["type"] == "SELECT")
					{
						$return .= $this->_l('<select name='. $product_options["name"].'>', 1);
						foreach ($product_options["choices"] as $options_param) 
						{ 
							$return .= $this->_l(
								sprintf(
									'<option value="%s">%s (%s)</option>',
									esc_attr($options_param['text']),
									esc_html($options_param['text']),
									esc_html($options_param['priceModifier'])
								)
							);
						}
						$return .= $this->_l('</select>', -1);
					}
					if($product_options["type"] == "RADIO")
					{
						foreach ($product_options["choices"] as $options_param) 
						{
							$return .= $this->_l(
								sprintf(
									'<input type="radio" name="%s" value="%s" />%s (%s)',
									esc_attr($product_options['name']),
									esc_attr($options_param['text']),
									esc_html($options_param['text']),
									esc_html($options_param['priceModifier'])
								)
							);
						}
					}
					if($product_options["type"] == "CHECKBOX")
					{
						foreach ($product_options["choices"] as $options_param)
						{
							$return .= $this->_l(
								sprintf(
									'<input type="checkbox" name="%s" value="%s" />%s (%s)',
									esc_attr($product_options['name']),
									esc_attr($options_param['text']),
									esc_html($options_param['text']),
									esc_html($options_param['priceModifier'])
								)
							);
					 	}
					}

					$return .= $this->_l('</div>', -1);
				}
			}				
						
			if (is_array($product["galleryImages"])) 
			{
				foreach ($product["galleryImages"] as $galleryimage) 
				{
					if (empty($galleryimage["alt"]))  $galleryimage["alt"] = htmlspecialchars($product["name"]);
					$return .= $this->_l(
						sprintf(
							'<img src="%s" alt="%s" title="%s" />',
							esc_attr($galleryimage['url']),
							esc_attr($galleryimage['alt']),
							esc_attr($galleryimage['alt'])
						)
					);
				}
			}

			$return .= $this->_l("</div>", -1);
		}

		return $return;
	}

	function get_category($id)
	{
		$params = array
		(
			array("alias" => "c", "action" => "categories", "params" => array("parent" => $id)),
			array("alias" => "p", "action" => "products", "params" => array("category" => $id)),
			array("alias" => "pf", "action" => "profile")
		);
		if ($id > 0) {
			$params[] = array('alias' => 'category', "action" => "category", "params" => array("id" => $id));
		}

		$batch_result = $this->ecwid_api->get_batch_request($params);

		$category 	= $id > 0 ? $batch_result['category'] : null;
		$categories = $batch_result["c"];
		$products   = $batch_result["p"];
		$profile	= $batch_result["pf"];

		$return = $this->_l('');

		if (!is_null($category)) {
			$return .= $this->_l('<h2>' . esc_html($category['name']) . '</h2>');
			$return .= $this->_l('<div>' . $category['description'] . '</div>');
		}

		if (is_array($categories)) 
		{
			foreach ($categories as $category) 
			{
				$category_url = ecwid_get_category_url($category);

				$category_name = $category["name"];
				$return .= $this->_l('<div class="ecwid_catalog_category_name">', 1);
				$return .= $this->_l('<a href="' . esc_attr($category_url) . '">' . esc_html($category_name) . '</a>');
				$return .= $this->_l('</div>', -1);
			}
		}

		if (is_array($products)) 
		{
			foreach ($products as $product) 
			{

				$product_url = ecwid_get_product_url($product);

				$product_name = $product['name'];
				$product_price = $product['price'] . ' ' . $profile['currency'];
				$return .= $this->_l('<div>', 1);
				$return .= $this->_l('<span class="ecwid_product_name">', 1);
				$return .= $this->_l('<a href="' . esc_attr($product_url) . '">' . esc_html($product_name) . '</a>');
				$return .= $this->_l('</span>', -1);
				$return .= $this->_l('<span class="ecwid_product_price">' . esc_html($product_price) . '</span>');
				$return .= $this->_l('</div>', -1);
			}
		}

		return $return;
	}

	function build_url($url_from_ecwid)
	{
		if (preg_match('/(.*)(#!)(.*)/', $url_from_ecwid, $matches))
			return $this->store_base_url . $matches[2] . $matches[3]; 
		else
			return '';
	}
}
