<?php

/* 	=============================
   	// !ReduxFramework Sample Config File
   	For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki 
   	============================= */

if ( !class_exists( "ReduxFramework" ) ) { return; }

if ( !class_exists( "jckWooThumbs_config" ) ) {
	class jckWooThumbs_config {

		public $args = array();
		public $sections = array();
		public $theme;
		public $ReduxFramework;
		public $pluginName;
		public $pluginShortname;
		public $pluginSlug;
		public $pluginVersion;
		public $pluginUrl;

		public function __construct() {

			global $jckWooThumbsClass;

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();
			$this->pluginName = $jckWooThumbsClass->name;
			$this->pluginShortname = $jckWooThumbsClass->shortname;
			$this->pluginSlug = $jckWooThumbsClass->slug;
			$this->pluginVersion = $jckWooThumbsClass->version;
			$this->pluginUrl = $jckWooThumbsClass->plugin_url;

			// Set the default arguments
			$this->setArguments();

			// Create the sections and fields
			$this->setSections();

			if ( !isset( $this->args['opt_name'] ) )
				{ // No errors please
				return;
			}

			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

		}


		public function setSections() {

			// ACTUAL DECLARATION OF SECTIONS

			$this->sections[] = array(
				'title' => __('Display Settings', $this->pluginSlug),
				'desc' => __('', $this->pluginSlug),
				'icon' => 'el-icon-picture',
				'fields' => array(
					array(
						'id'=>'imageTransition',
						'type' => 'select',
						'title' => __('Image Transition', $this->pluginSlug),
						// 'subtitle' => __('Select your themes alternative color scheme.', $this->pluginSlug),
						'options' => array('move' => 'Slide', 'fade' => 'Fade'),
						'default' => 'move'
					),
					array(
						'id'=>'scaleMode',
						'type' => 'select',
						'title' => __('Image Scale Mode', $this->pluginSlug),
						'desc' => __('<strong>Fill:</strong> Scales image to completely fill slider viewport.<br> <strong>Fit if Smaller:</strong> Scales image to fit only if size of slider viewport is less then size of image.<br>  <strong>Fit:</strong> Same as above, but enlarges image if it\'s smaller then viewport.<br><strong>None:</strong> Keep the original image size (This is the "Shop Single" size).<br>', $this->pluginSlug),
						'options' => array('fill' => 'Fill', 'fit-if-smaller' => 'Fit if Smaller', 'fit' => 'Fit', 'none' => 'None'),
						'default' => 'fill'
					),
					array(
						'id'=>'slideDirection',
						'type' => 'select',
						'title' => __('Slide Direction', $this->pluginSlug),
						// 'subtitle' => __('Select your themes alternative color scheme.', $this->pluginSlug),
						'required' => array('imageTransition', '=' , 'move'),
						'options' => array('horizontal' => 'Horizontal', 'vertical' => 'Vertical'),
						'default' => 'horizontal'
					),
					array(
						'id'=>'slideSpacing',
						'type' => 'text',
						'title' => __('Slide Spacing', $this->pluginSlug),
						'required' => array('imageTransition', '=' , 'move'),
						'subtitle' => __('The space between each slide. Noticeable only during a slide transition.', $this->pluginSlug),
						'validate' => 'numeric',
						'default' => 0
					),
					array(
				        'id'       => 'slideBgColour',
				        'type'     => 'color',
				        'title'    => __('Background Colour', $this->pluginSlug),
				        'subtitle' => __('Pick a background colour for the slider (default: #000).', $this->pluginSlug),
				        'default'  => '#000000',
				        'validate' => 'color',
				    ),
				    array(
						'id'=>'slideSpeed',
						'type' => 'text',
						'title' => __('Transition Speed', $this->pluginSlug),
						'subtitle' => __('The speed at which slides move or fade in milliseconds.', $this->pluginSlug),
						'validate' => 'numeric',
						'default' => 600
					)	    
				) // fields
			); // section
			
			// ! Dimensions
			
			$this->sections[] = array(
				'title' => __('Slider Dimensions', $this->pluginSlug),
				// 'desc' => __('Choose your method of navigation.', $this->pluginSlug),
				'icon' => 'el-icon-resize-horizontal',
				'fields' => array(			
					array(
					    'id'       => 'sliderWidth',
					    'type'     => 'dimensions',
					    'units'    => array('%', 'px'),
					    'title'    => __('Default Slider Width', $this->pluginSlug),
					    'subtitle' => __('The default width of the slider.', $this->pluginSlug),
					    'height'   => false,
					    'default'  => array(
					        'width'   => '48%',
					        'units'    => '%'
					    )
					),
					array(
						'id'       => 'sliderPosition',
						'type'     => 'image_select',
						'title'    => __('Slider Position', $this->pluginSlug), 
						'subtitle' => __('Float left, right, or not at all.', $this->pluginSlug),
						'options'  => array(
							'left' => array(
								'alt' => 'Left', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-sliderL.png'
							),
							'right' => array(
								'alt' => 'Right', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-sliderR.png'
							),
							'none' => array(
								'alt' => 'None', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-sliderN.png'
							)
						),
						'default' => 'left'
					),
					array(
				        'id'       => 'sliderRatio',
				        'type'     => 'dimensions',
				        'units'    => false,
				        'title'    => __('Slider Ratio', $this->pluginSlug),
				        'subtitle' => __('Define the shape of your slider. For example, <strong>1 : 1</strong> is a square, <strong>1 : 1.5</strong> is a tall rectangle, <strong>1.5 : 1</strong> is a wide rectangle.', $this->pluginSlug),
				        'default'  => array(
				            'width'   => '1', 
				            'height'  => '1'
				        ),
				    ),
					array(
						'id'=>'enableBreakpoint',
						'type' => 'switch',
						'title' => __('Enable Breakpoint?', $this->pluginSlug),
						'subtitle'=> __('If your website is responsive, it would be useful to change the width of the slider after a certain breakpoint.', $this->pluginSlug),
						"default"   => 0,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
					    'id'       => 'breakpoint',
					    'type'     => 'dimensions',
					    'units'    => array('em', 'px'),
					    'title'    => __('Breakpoint', $this->pluginSlug),
					    'subtitle'=> __('The slider width will be affected from this breakpoint and below.', $this->pluginSlug),
					    'required' => array('enableBreakpoint', '=' , 1),
					    'height'   => false,
					    'default'  => array(
					        'width'   => '768px',
					        'units'    => 'px'
					    )
					),
					array(
					    'id'       => 'sliderWidthBreakpoint',
					    'type'     => 'dimensions',
					    'units'    => array('%', 'px'),
					    'title'    => __('Slider Width After Breakpoint', $this->pluginSlug),
					    'subtitle' => __('The width of the slider from the breakpoint down.', $this->pluginSlug),
					    'required' => array('enableBreakpoint', '=' , 1),
					    'height'   => false,
					    'default'  => array(
					        'width'   => '100%',
					        'units'    => '%'
					    )
					),
					array(
						'id'       => 'sliderPositionBreakpoint',
						'type'     => 'image_select',
						'title'    => __('Slider Position After Breakpoint', $this->pluginSlug), 
						'subtitle' => __('Float left, right, or not at all.', $this->pluginSlug),
						'required' => array('enableBreakpoint', '=' , 1),
						'options'  => array(
							'left' => array(
								'alt' => 'Left', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-sliderL.png'
							),
							'right' => array(
								'alt' => 'Right', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-sliderR.png'
							),
							'none' => array(
								'alt' => 'None', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-sliderN.png'
							)
						),
						'default' => 'none'
					),
				)
			);
			
			// ! Thumbnail Settings
			
			$this->sections[] = array(
				'title' => __('Navigation Settings', $this->pluginSlug),
				//'desc' => __('Choose your method of navigation.', $this->pluginSlug),
				'icon' => 'el-icon-th-large',
				'fields' => array(
					// Thumbnails/Bullets/Tabs
					array(
						'id'=>'enableArrows',
						'type' => 'switch',
						'title' => __('Enable Prev/Next Arrows?', $this->pluginSlug),
						'subtitle'=> __('This will display prev/next arrows over the main slider image.', $this->pluginSlug),
						"default"   => 1,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
						'id'=>'arrowsAutohide',
						'type' => 'switch',
						'title' => __('Auto-Hide Prev/Next Arrows?', $this->pluginSlug),
						'required' => array('enableArrows', '=' , 1),
						'subtitle'=> __('The prev/next arrows will only appear when the main image is hovered.', $this->pluginSlug),
						"default"   => 0,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
						'id'=>'enableNavigation',
						'type' => 'switch',
						'title' => __('Enable Navigation?', $this->pluginSlug),
						'subtitle'=> __('Choose whether to enable the thumbnail or bullet navigation.', $this->pluginSlug),
						"default"   => 1,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
						'id'=>'navigationType',
						'type' => 'select',
						'title' => __('Navigation Type', $this->pluginSlug),
						// 'subtitle' => __('Choose your slide navigation type.', $this->pluginSlug),
						'options' => array('thumbnails' => 'Sliding Thumbnails', 'tabs' => 'Stacked Thumbnails', 'bullets' => 'Bullets'),
						'default' => 'thumbnails'
					),
					array(
						'id'       => 'thumbnailLayout',
						'type'     => 'image_select',
						'title'    => __('Thumbnail Layout', $this->pluginSlug), 
						'subtitle' => __('Display the thumbnails above, below, left, or right.', $this->pluginSlug),
						'required' => array('navigationType', '=' , array('thumbnails')),
						'options'  => array(
							'above' => array(
								'alt' => 'Above', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-thumbsA.png'
							),
							'below' => array(
								'alt' => 'Below', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-thumbsB.png'
							),
							'left' => array(
								'alt' => 'Left', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-thumbsL.png'
							),
							'right' => array(
								'alt' => 'Right', 
								'img' => $this->pluginUrl.'assets/admin/img/sel-thumbsR.png'
							)
						),
						'default' => 'below'
					),
					array(
					    'id'       => 'thumbDimensions',
					    'type'     => 'dimensions',
					    'units'    => array('px'),
					    'title'    => __('Thumbnail Dimensions', $this->pluginSlug),
					    'subtitle' => __('The thumbnails used are generated based on the thumbnail size in your global media settings.', $this->pluginSlug),
					    'required' => array('navigationType', '=' , 'thumbnails'),
					    'default'  => array(
					        'width'   => '150px',
					        'height'  => '150px',
					        'units'   => 'px'
					    )
					),
					array(
						'id'=>'enableCentering',
						'type' => 'switch',
						'title' => __('Centre Thumbnails?', $this->pluginSlug),
						'required' => array('navigationType', '=' , 'thumbnails'),
						'subtitle'=> __('If there are only a few thumbnails, they will be centred.', $this->pluginSlug),
						"default"   => 0,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
				        'id'       => 'thumbBgColour',
				        'type'     => 'color',
				        'title'    => __('Background Colour', $this->pluginSlug),
				        'required' => array('navigationType', '=' , 'thumbnails'),
				        'subtitle' => __('Pick a background colour for the thumbnails (default: #000).', $this->pluginSlug),
				        'default'  => '#000000',
				        'validate' => 'color',
				    ),
					array(
						'id'=>'enableThumbArrows',
						'type' => 'switch',
						'title' => __('Enable Thumbnail Prev/Next Arrows?', $this->pluginSlug),
						'subtitle'=> __('If "Navigation Type" is "Sliding Thumbnails", you can choose whether the prev/next arrows are displayed.', $this->pluginSlug),
						"default"   => 1,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
						'id'=>'thumbArrowsAutohide',
						'type' => 'switch',
						'title' => __('Auto-Hide Thumbnail Prev/Next Arrows?', $this->pluginSlug),
						'required' => array('enableThumbArrows', '=' , 1),
						'subtitle'=> __('The prev/next arrows will only appear when the thumbnails are hovered.', $this->pluginSlug),
						"default"   => 0,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
						'id'=>'thumbnailSpeed',
						'type' => 'text',
						'title' => __('Transition Speed', $this->pluginSlug),
						'required' => array('navigationType', '=' , 'thumbnails'),
						'subtitle' => __('The speed at which the sliding thumbnail navigation moves in milliseconds.', $this->pluginSlug),
						'validate' => 'numeric',
						'default' => 600
					),
					array(
						'id'=>'thumbnailSpacing',
						'type' => 'text',
						'title' => __('Thumbnail Spacing', $this->pluginSlug),
						'required' => array('navigationType', '=' , 'thumbnails'),
						'subtitle' => __('The space between each thumbnail.', $this->pluginSlug),
						'validate' => 'numeric',
						'default' => 0
					)
				) // fields
			); // section
			
			// ! Zoom Settings
			
			$this->sections[] = array(
				'title' => __('Zoom Settings', $this->pluginSlug),
				'desc' => __('Please note: The zoom feature works best when your images are square. It uses the "Single Product" image size, from the WooCommerce settings, as the image in the slider, and it uses the "Large" image size, from WordPress\' Settings > Media, as the image you see when hovering.', $this->pluginSlug),
				'icon' => 'el-icon-zoom-in',
				'fields' => array(
					array(
						'id'=>'enableZoom',
						'type' => 'switch',
						'title' => __('Enable Hover Zoom?', $this->pluginSlug),
						// 'subtitle'=> __('Look, it\'s on! Also hidden child elements!', $this->pluginSlug),
						"default"   => 1,
						'on' => 'Yes',
						'off' => 'No',
					),
					array(
						'id'=>'zoomType',
						'type' => 'select',
						'title' => __('Zoom Type', $this->pluginSlug),
						// 'subtitle' => __('Choose your slide navigation type.', $this->pluginSlug),
						'options' => array('inner' => 'Inner', 'standard' => 'Outside', 'follow' => 'Follow'),
						'default' => 'inner'
					),
					array(
						'id'=>'innerShape',
						'type' => 'select',
						'title' => __('Zoom Shape', $this->pluginSlug),
						'required' => array('zoomType', '=' , 'follow'),
						// 'subtitle' => __('Choose your slide navigation type.', $this->pluginSlug),
						'options' => array('circular' => 'Circular', 'square' => 'Square'),
						'default' => 'circular'
					),
				    array(
						'id'=>'zoomPosition',
						'type' => 'select',
						'title' => __('Zoom Position', $this->pluginSlug),
						'required' => array('zoomType', '=' , 'standard'),
						'subtitle' => __('Choose the position of your zoomed image in relation to the main image.', $this->pluginSlug),
						'options' => array('left' => 'Left', 'right' => 'Right'),
						'default' => 'right'
					),
					array(
				        'id'       => 'zoomDimensions',
				        'type'     => 'dimensions',
				        'units'    => false,
				        'required' => array('zoomType', '=' , array('standard','follow')),
				        'title'    => __('Lens Size', $this->pluginSlug),
				        'subtitle' => __('The width and height of your zoom lens.', $this->pluginSlug),
				        'default'  => array(
				            'width'   => '200', 
				            'height'  => '200'
				        ),
				    ),
				    array(
				        'id'       => 'lensColour',
				        'type'     => 'color',
				        'title'    => __('Lens Colour', $this->pluginSlug),
				        'required' => array('zoomType', '=' , 'standard'),
				        'subtitle' => __('Pick a colour for the zoom lens (default: #000).', $this->pluginSlug),
				        'default'  => '#000000',
				        'validate' => 'color',
				    ),
				    array(
						'id'=>'lensOpacity',
						'type' => 'text',
						'title' => __('Lens Opacity', $this->pluginSlug),
						'required' => array('zoomType', '=' , 'standard'),
						'subtitle' => __('Set an opacity for the lens.', $this->pluginSlug),
						'desc' => __('<strong>0</strong> is transparent. <br><strong>1</strong> is opaque. <br><strong>0.5</strong> is 50% transparency.', $this->pluginSlug),
						'validate' => 'numeric',
						'default' => 0.8
					)
				) // fields
			); // section
			
			// ! Lightbox Settings
			
			$this->sections[] = array(
				'title' => __('Lightbox Settings', $this->pluginSlug),
				'desc' => __('If you want to use the Lightbox, please ensure "<strong>Enable Lightbox</strong>" is checked in your WooCommerce settings. Your theme also needs to allow for it.', $this->pluginSlug),
				'icon' => 'el-icon-resize-full',
				'fields' => array(
					array(
						'id'=>'enableLightbox',
						'type' => 'switch',
						'title' => __('Enable Lightbox?', $this->pluginSlug),
						// 'subtitle'=> __('Look, it\'s on! Also hidden child elements!', $this->pluginSlug),
						"default"   => 1,
						'on' => 'Yes',
						'off' => 'No',
					)
				) // fields
			); // section
			
			// ! Additional Settings
			
			$this->sections[] = array(
				'title' => __('Additional Settings', $this->pluginSlug),
				'desc' => __('', $this->pluginSlug),
				'icon' => 'el-icon-cog',
				'fields' => array(
					array(
						'id'=>'additionalCss',
						'type' => 'ace_editor',
						'title' => __('Additional CSS', $this->pluginSlug),
						'desc' => __('Add any additional CSS here.', $this->pluginSlug),
						'mode' => 'css'
					)
				) // fields
			); // section



		}

	/* 	=============================
	   	// !All the possible arguments for Redux.
	   	For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments 
	   	============================= */
	   	
		public function setArguments() {

			$this->args = array(

				// TYPICAL -> Change these values as you need/desire
				'opt_name'           => $this->pluginSlug, // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'   => $this->pluginName, // Name that appears at the top of your panel
				'display_version'  => $this->pluginVersion, // Version that appears at the top of your panel
				'menu_type'           => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'      => true, // Show the sections below the admin menu item or not
				'menu_title'   => __( 'WooThumbs', $this->pluginSlug ),
				'page'       => __( 'WooThumbs', $this->pluginSlug ),
				'google_api_key'      => '', // Must be defined to add google fonts to the typography module
				'global_variable'     => '', // Set a different name for your global variable other than the opt_name
				'dev_mode'            => false, // Show the time the page took to load, etc
				'customizer'          => true, // Enable basic customizer support

				// OPTIONAL -> Give you extra features
				'page_priority'       => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'         => 'woocommerce', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions'    => 'manage_options', // Permissions needed to access the options panel.
				'menu_icon'           => '', // Specify a custom URL to an icon
				'last_tab'            => '', // Force your panel to always open to a specific tab (by id)
				'page_icon'           => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
				'page_slug'           => $this->pluginSlug.'_options', // Page slug used to denote the panel
				'save_defaults'       => true, // On load save the defaults to DB before user clicks save or not
				'default_show'        => false, // If true, shows the default value next to each field that is not the default value.
				'default_mark'        => '', // What to print by the field's title if the value shown is default. Suggested: *


				// CAREFUL -> These options are for advanced use only
				'transient_time'    => 60 * MINUTE_IN_SECONDS,
				'output'             => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'             => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				//'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
				'footer_credit'       => ' ', // Disable the footer credit of Redux. Please leave if you can help it.


				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'            => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!


				'show_import_export'  => true, // REMOVE
				'system_info'         => false, // REMOVE

				'help_tabs'           => array(),
				'help_sidebar'        => '', // __( '', $this->args['domain'] );
			);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			/*
			$this->args['share_icons'][] = array(
				'url' => 'https://github.com/ReduxFramework/ReduxFramework',
				'title' => 'Visit us on GitHub',
				'icon' => 'el-icon-github'
				// 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
			);
			$this->args['share_icons'][] = array(
				'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
				'title' => 'Like us on Facebook',
				'icon' => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url' => 'http://twitter.com/reduxframework',
				'title' => 'Follow us on Twitter',
				'icon' => 'el-icon-twitter'
			);
			$this->args['share_icons'][] = array(
				'url' => 'http://www.linkedin.com/company/redux-framework',
				'title' => 'Find us on LinkedIn',
				'icon' => 'el-icon-linkedin'
			);
			*/

			// Add content after the form.
			// $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', $this->pluginSlug);

		}
	}
	
	new jckWooThumbs_config();
}