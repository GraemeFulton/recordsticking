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

		$return = '';
		
		if (is_array($product)) 
		{
		
			$return = '<div itemscope itemtype="http://schema.org/Product">';
			$return .= '<h2 class="ecwid_catalog_product_name" itemprop="name">' . esc_html($product["name"]) . '</h2>';
			$return .= '<p class="ecwid_catalog_product_sku" itemprop="sku">' . esc_html($product["sku"]) . '</p>';
			
			if (!empty($product["thumbnailUrl"])) 
			{
				$return .= sprintf(
					'<div class="ecwid_catalog_product_image"><img itemprop="image" src="%s" alt="%s" /></div>',
					esc_attr($product['thumbnailUrl']),
					esc_attr($product['name'] . ' ' . $product['sku'])
				);
			}
			
			if(is_array($product["categories"]))
			{
				foreach ($product["categories"] as $ecwid_category) 
				{
					if($ecwid_category["defaultCategory"] == true)
					{
						$return .= '<div class="ecwid_catalog_product_category" itemprop="category">' . esc_html($ecwid_category['name']) . '</div>';
					}
				}
			}
			
			$return .= '<div class="ecwid_catalog_product_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
			$return .=  __('Price', 'ecwid-shopping-cart') . ': <span itemprop="price">' . esc_html($product["price"]) . '</span>&nbsp;';
			$return .= '<span itemprop="priceCurrency">' . esc_html($profile['currency']) . '</span></div>';
			
			if (!isset($product['quantity']) || (isset($product['quantity']) && $product['quantity'] > 0))
			{
				$return .= '<div class="ecwid_catalog_quantity" itemprop="availability" itemscope itemtype="http://schema.org/InStock"><span>In Stock</span></div>';
			}
			$return .= '<div class="ecwid_catalog_product_description" itemprop="description">'
				. $product['description']
				. '</div>';

			if (is_array($product["options"]))
			{
				$allowed_types = array('TEXTFIELD', 'DATE', 'TEXTAREA', 'SELECT', 'RADIO', 'CHECKBOX');
				foreach($product["options"] as $product_options)
				{
					if (in_array($product_options['type'], $allowed_types)) {
						$return .= '<div class="ecwid_catalog_product_options" itemprop="offers"><span itemprop="condition">'
							. esc_html($product_options["name"])
							. '</span></div>';
					} else {
						continue;
					}
					if($product_options["type"] == "TEXTFIELD" || $product_options["type"] == "DATE")
					{
						$return .='<input type="text" size="40" name="'. esc_attr($product_options["name"]) . '">';
					}
				   	if($product_options["type"] == "TEXTAREA")
					{
					 	$return .='<textarea name="' . esc_attr($product_options["name"]) . '></textarea>';
					}
					if ($product_options["type"] == "SELECT")
					{
						$return .= '<select name='. $product_options["name"].'>';
						foreach ($product_options["choices"] as $options_param) 
						{ 
							$return .= sprintf(
								'<option value="%s">%s (%s)</option>',
								esc_attr($options_param['text']),
								esc_html($options_param['text']),
								esc_html($options_param['priceModifier'])
							);
						}
						$return .= '</select>';
					}
					if($product_options["type"] == "RADIO")
					{
						foreach ($product_options["choices"] as $options_param) 
						{
							$return .= sprintf(
								'<input type="radio" name="%s" value="%s" />%s (%s)<br />',
								esc_attr($product_options['name']),
								esc_attr($options_param['text']),
								esc_html($options_param['text']),
								esc_html($options_param['priceModifier'])
							);
						}
					}
					if($product_options["type"] == "CHECKBOX")
					{
						foreach ($product_options["choices"] as $options_param)
						{
							$return .= sprintf(
								'<input type="checkbox" name="%s" value="%s" />%s (%s)<br />',
								esc_attr($product_options['name']),
								esc_attr($options_param['text']),
								esc_html($options_param['text']),
								esc_html($options_param['priceModifier'])
						 	);
					 	}
					}
				}
			}				
						
			if (is_array($product["galleryImages"])) 
			{
				foreach ($product["galleryImages"] as $galleryimage) 
				{
					if (empty($galleryimage["alt"]))  $galleryimage["alt"] = htmlspecialchars($product["name"]);
					$return .= sprintf(
						'<img src="%s" alt="%s" title="%s" /><br />',
						esc_attr($galleryimage['url']),
						esc_attr($galleryimage['alt']),
						esc_attr($galleryimage['alt'])
					);
				}
			}

			$return .= "</div>" . PHP_EOL;
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

		$category 	= $batch_result["category"];
		$categories = $batch_result["c"];
		$products   = $batch_result["p"];
		$profile	= $batch_result["pf"];

		$return = '<h2>' . esc_html($category['name']) . '</h2>';
		$return .= '<div>' . $category['description'] . '</div';

		if (is_array($categories)) 
		{
			foreach ($categories as $category) 
			{
				$category_url = $this->build_url($this->store_base_url . "#!/~/category/id=" . $category["id"]);

				$category_name = $category["name"];
				$return .= sprintf(
					'<div class="ecwid_catalog_category_name"><a href="%s">%s</a></div>' . PHP_EOL,
					esc_attr($category_url),
					esc_html($category_name)
				);
			}
		}

		if (is_array($products)) 
		{
			foreach ($products as $product) 
			{
				$product_url = $this->store_base_url . "#!/~/product/id=" . $product["id"];
				$this->build_url($product["url"]);
				$product_name = $product["name"];
				$product_price = $product["price"] . "&nbsp;" . $profile["currency"];
				$return .= "<div>";
				$return .= "<span class='ecwid_product_name'><a href='" . esc_attr($product_url) . "'>" . esc_html($product_name) . "</a></span>";
				$return .= "&nbsp;&nbsp;<span class='ecwid_product_price'>" . esc_html($product_price) . "</span>";
				$return .= "</div>" . PHP_EOL;
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
