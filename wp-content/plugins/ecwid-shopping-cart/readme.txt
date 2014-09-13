=== Ecwid Shopping Cart ===
Contributors: Ecwid Team
Tags: ecwid, shopping cart, ecommerce, wordpress ecommerce, wp e-commerce, paypal, e-commerce, online store, store, shop, cart, online shop, shopping, digital goods, downloadable products, product catalog, ecomerce, products, facebook, f-commerce
Requires at least: 2.8
Tested up to: 3.8
Stable tag: 2.3.1

Ecwid is a free full-featured shopping cart that can easily be added to any blog
and takes less than 5 minutes to set up.

== Description ==
Ecwid is a full-featured shopping cart and an e-commerce solution that can easily be added to any blog or Facebook profile. It offers the performance and flexibility you need, with none of the hassles you don't.  
"Ecwid" stands for "ecommerce widgets".

There are eight key advantages to Ecwid:

- Free plan is always available.
- It has AJAX everywhere and supports drag-and-drop.
- It can be easily integrated to any existing site or Facebook profile in minutes.
- It can be mirrored on many sites at the same time. Add your store to many sites, manage it from one place.
- Integrates with social networks. Run your own store on Facebook, mySpace and many others, or let your customers share the links to your products and their purchases.
- Simple to use and maintain. For both store owner and customer.
- Lightning fast. New-gen technologies make Ecwid much faster than usual
  shopping carts regardless the hosting service you use.
- Seamless upgrades. You just wake up one day and enjoy new features.

Links

- You can see the demo there: [www.ecwid.com/demo-frontend.html](http://www.ecwid.com/demo-frontend.html)
- More features:
[www.ecwid.com/key-features.html](http://www.ecwid.com/key-features.html)

== Installation ==

= Automatic installation (the easiest way) =

1. Go to your WP admin panel → Plugins → Add New
2. Under Search, type in 'Ecwid', click Search
3. In the search results find the 'Ecwid Shopping Cart' plugin and click 'Install now' to install it
4. When plugin is installed click 'Activate Plugin' link
5. Log in into Ecwid control panel at https://my.ecwid.com and copy your numeric Store ID. Go to 'Ecwid Store → General' page in WP admin panel and paste Store ID in the corresponding field.

**IMPORTANT**: when the plugin is installed, you will need to activate it on the Plugins page (click 'Activate' link) and configure it on the 'Ecwid Store → General' page (at least, you will need to set your store ID there).


= Alternative ways =

**Uploading the plugin zip archive in your admin panel**

1. Download the Ecwid plugin from this page (click 'Download' button)
2. Go to WP admin panel → Plugins → Add new
3. Click 'Upload' link and choose the saved zip file in the appeared dialog window.
4. Click 'Install'

**Uploading plugin folder to the WP directory on your server**

1. Download the Ecwid plugin from this page (click 'Download' button)
2. Unpack the downloaded zip archive
3. Upload ecwid-shopping-cart directory from the archive to the /wp-content/plugins/ directory on your server

Please refer to this article for the details and troubleshooting on plugin installation in Wordpress:
http://codex.wordpress.org/Managing_Plugins#Installing_Plugins

== Screenshots ==

1. Store home page
2. Category page
3. Product details page
4. Shopping bag
5. Ecwid control panel
6. Adding new product
7. Shipping settings
8. Translations

== Frequently Asked Questions ==

- FAQ: [http://www.ecwid.com/faq.html](http://www.ecwid.com/faq.html)
- Knowledge Base: [http://kb.ecwid.com](http://kb.ecwid.com)

== Changelog ==
= 2.3.1 =
- Automatic generation of the rel="canonical" links for SEO. Canonical links are aimed to specify the preferred (canonical) URL of the web page for search engines to prevent possible duplicate content issues. Ecwid plugin now generates such links automatically for product and categories pages in your store to provide search crawlers with well-structured content and help them better index your store.
- Improved compatibility with CloudFlare Rocket Loader. The merchants who use CloudFlare Rocket Loader extensions on their sites might previously experience issues with loading of their Ecwid stores. We've further improved the plugin code to prevent such issues in the future. Now Ecwid plugin should perfectly work with CloudFlare extensions.
- Several minor fixes and enhancements

= 2.3 =
- Added compatibility with Google XML Sitemaps plugin. Now you can submit your store items links along with the other site pages to search engines.  To use this feature, please install the "Google XML Sitemaps" plugin (http://wordpress.org/plugins/google-sitemap-generator/), generate a sitemap (it will include your products and categories links) and submit it to the search engines to help them better crawl and categorize your site.

- Improved compatibility with SEO Ultimate plugin. Ecwid plugin always displays your store pages in a proper SEO-friendly format to make the store indexable by search engines. Moreover, we constantly adjust the plugin to make it work fine with popular third party SEO modules. So Ecwid is perfectly compatible with "Wordpress SEO by Yoast", "All in one SEO Pack", "Platinum SEO Pack" and now with "SEO Ultimate" plugin.

- Minor design improvements of the plugin settings pages to make them mobile-friendly for better compatibility with the backend layout of new Wordpress versions. Now you can manage Ecwid plugin settings in your Wordpress administrator panel using your mobile device.

- New "Ecwid badges" widget is available. If you like Ecwid and want to help it grow and become the most popular e-commerce solution, you can now add a fancy 'Powered by Ecwid' badge on your site to show your visitors that you're a proud user of Ecwid. Please find the new widget under 'Appearance → Widgets' section in your Wordpress backend. 

= 2.2.1 =
- Fixed layout error on General Settings page in Firefox

= 2.2 =
- Improved compatibility with the new Wordpress version 3.8 which brings great features like brand new responsive theme, revamped admin backend and other improvements. Ecwid plugin is now ready for that, so your store will work perfectly with the new Wordpress version
- The plugin settings pages are now available in seven languages: English, Italian, Russian, French, German, Spanish, Brazilian Portuguese. Ecwid itself is available in 45 languages, so customers from all over the world can purchase from your store
- Design improvements of the plugin settings pages including Retina-ready icons

= 2.1 =
- Our plugin backend is now available in Italian, Russian and English. Thanks to Luciano Del Fico for the great help with the Italian translation.

- Improvements and bug fixes, including
  - Better SEO for store pages: search engines will now index product options list and category descriptions
  - Compatibility with WP Minify (Wordpress sites optimization plugin)
  - Improved compatibility with Yoast WP SEO plugin: Ecwid SEO page titles are shown properly with enabled Yoast's "Force Rewrite Titles" option
  - Minor text and design tweaks of the plugin settings pages


= 2.0 =
- **New revamped plugin settings**: the new settings layout makes the plugin easy and intuitive for starters, yet powerful and advanced for experienced merchants.

- **Multilingual plugin backend**: the plugin settings now support multilanguage. Currently available in English and Russian. More translations are coming!

- **SEO improvements**
  - Auto generated meta description tags for the product and category pages. Now, Google should properly index product/category descriptions and display them in the search results.
  - &lt;title&gt; tags for categories. The SEO category pages in your store now include both title and description tags so they will appear in Google search results properly.

- **Smooth HTTP/HTTPS switch**: Ecwid always transfers all sensitive data using secure HTTPS connection and a special 'HTTPS' option in the Ecwid plugin settings is not necessary anymore. Now, the plugin detects connection type and adjust Ecwid integration codes automatically. No manual adjustments are needed regardless of whether you run your site under HTTP or HTTPS.

- **Improved compatibility with CloudFlare Rocket Loader**: previously, using CloudFlare Rocket Loader along with Ecwid might cause intermittent loading issues for some stores. We've improved the plugin code to prevent such issues.

= 1.8.1 =
- [!] Fixed meta title tag display issue on the main store page appeared with the version 1.8 : in some cases, the store page title tag was stripped. Now it should work OK.

= 1.8 =
- [+] Improved compatibility with popular SEO plugins (Yoast WordPress SEO, All in one SEO Pack and Platinum SEO pack) : now Ecwid prevents them from generating wrong title and canonical tags on the product pages.
- [+] Ability to display separate categories on separate pages with custom shortcodes. Now, the plugin allows setting different default categories for different store pages. So if you have multiple store pages and want to display specific categories on them, you can set up a default category for each of them in the [ecwid\_productbrowser] shortcode like this: [ecwid\_productbrowser default\_category\_id="12345"] . On the other hand, if you have one store page, you can set the default category on the plugin settings page as usual.
- [+] A few more SEO improvements:
   - Product browser's default category ID setting is now taken into consideration by SEO part of the plugin. If you have multiple store pages displaying specific categories of your shop, search engines will index those pages starting from the proper category (not from the store's root)
   - &lt;meta fragment="!"&gt; tag is now displayed on every page where [ecwid\_productbrowser] tag is added so search engines will better index each store page
- [+] We also released a lot of new Ecwid features. You can read about them there: http://www.ecwid.com/blog/new-releases/

= 1.7 =
- [+] various additions to the indexable representation of Ecwid pages (product category in the title and on the page, product options, product SKU). Thanks to Uliya B.
= 1.5 = 
- [!] fixed a problem where in some rare occasions the SEO catalog would show a PHP error.
= 1.4 =
- [!] enhanced the backward compatibility with the older inline SEO links
- [+] increased the priority of the product-specific titles in order to work side-by-side with various SEO-related plugins.
= 1.3 =
- [+] Backward compatibility with old Inline SEO Catalog links.
= 1.2 =
- [+] A lot of changes in Ecwid shopping cart: http://www.ecwid.com/blog/new-releases/
- [+] Support of the Google’s “AJAX Crawling” API for native indexing of AJAX applications has been added. This will significantly improve the indexation of Ecwid stores and is a successor of the Inline SEO Catalog feature. More details at https://developers.google.com/webmasters/ajax-crawling/  (This feature requires a paid Ecwid subscription)
- [+] Auto-generated titles for product pages.
- [+] Support of microformats to get rich snippets in search engine results pages.
- [+] New Ecwid section has been added to the admin menu.

= 1.1.2 =
- [!] Issue with the way how widgets are embedded into the page for the free users was fixed.

= 1.1.1 =
- [!] Issue with the way how inline SEO catalog is embedded into the page was fixed.

= 1.1 =
- [+] Improved the compatibility with AJAX-based themes for WP and some web search engines out there.

= 1.0 =
- [!] The "Single Sign-on" feature didn't work properly in some cases. Fixed.

= 0.9 =
- [+] The "Single Sign-on" feature has been added. This feature allows your customers to sign into your WordPress site and fully use your store without having to sign into Ecwid. 

= 0.8 =
- [+] New minicart widget: http://kb.ecwid.com/w/page/15853298/Minicart#Miniview
- [+] Stores are loaded faster now, if some Ecwid sidebar widgets are enabled. 
- [+] Inline SEO Catalog generates "clean" SEO-friendly page titles now.
- [!] Issue with Inline SEO Catalog and enabled "Canonical URLs" feature has been fixed. 

= 0.7 =
- [!] The "Inline SEO catalog" feature didn't work correctly with WP
  permalinks. Fixed.

= 0.6 =
- [+] The "Inline SEO catalog" option was added.

= 0.5 =
- [+] Plugin settings page was updated.
- [+] Two new options: "Full link to your mobile catalog" and "Default category ID".

= 0.4 =
- [+] Instruction in the plugin settings was updated.
- [+] New plugin option to use on secure pages was added.
- [+] Some code tweaks and optimizations.

= 0.3 =
- [+] Ecwid integration code was updated to the last vesion
- [+] New product browser parameters: http://kb.ecwid.com/Product-Browser
- [+] New built-in "ecwid_ProductBrowserURL" feature: http://kb.ecwid.com/ecwid_ProductBrowserURL

= 0.2 =
- [+] New sidebar widgets were added: search box, minicart and vertical categories
- [+] New options effecting the store appearance
- [!] Minor bugfixes

= 0.1 =
- [+] Initial version
