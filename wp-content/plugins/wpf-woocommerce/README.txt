=== wpFortify for WooCommerce ===
Contributors: rossdev
Tags: stripe, payment, payments, credit cards, online payment, woo, woocommerce
Donate link: https://wpfortify.com
Requires at least: 3.9
Tested up to: 4.1
Stable tag: 2.4
License: GPLv2+
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Start accepting payments now with Stripe! Fast, easy and secure with hosted SSL checkout pages.

== Description ==
[wpFortify](https://wpfortify.com "Hosted SSL Checkout Pages For Stripe") provides a fast, easy and secure hosted SSL checkout page for [Stripe](https://stripe.com "Stripe") payments.

Safely accept credit cards in WooCommerce without the need to set up and maintain SSL certificates on your server or worry about PCI compliance.

= Benefits & Features =

* Charge credit cards without having to purchase or install a SSL certificate.
* PCI compliant for all credit card processing with 256-bit SSL encryption.
* No set up, or monthly fees.
* No contracts, cancel anytime.
* Ability to create custom checkout pages to match your current site.

= Fees =

Unlike other hosted checkout pages we believe you should keep more of your money. 

wpFortify charges a low 5¢ fee per successful charge ( Stripe fee not included ), and all test charges are always free.

== Installation ==

= Minimum Requirements =

* WooCommerce 2.1.0 or later

= Automatic installation =

Automatic installation via the WordPress dashboard is the easiest, and fastest option. To do an automatic install of wpFortify for WooCommerce, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "wpFortify for WooCommerce" and click Search Plugins. Once you've found our plugin you can install the plugin by clicking "Install Now".

= Manual installation =

Downloading our plugin and upload it to your server via a FTP application or via WordPress dashboard. The WordPress codex contains [instructions on how to do this here](http://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation).

= Set up =

1. [Connect](https://connect.wpfortify.com "Connect") your Stripe account to wpFortify to get access keys.
2. On your WordPress dashboard navigate to "WooCommerce -> Settings -> Checkout - > wpFortify (Stripe)".
3. Enter your access keys and enable the gateway.

That's it!

= Updating =

Automatic updates should work as normal via your WordPress dashboard.

== Frequently Asked Questions ==

= Stripe says SSL (https://) is required on my site? =

Nope, when you use the "wpFortify for WooCommerce" plugin for payments SSL is not required on your site. We take care of all that for you so you don't have to worry about it.

= Do you support subscriptions? =

Sorry we currently don't support WooCommerce subscriptions, but it's on the short list to add in the future.

= Feature Requests & Support =

[Submit feature requests or support questions to the plugin forum](https://wordpress.org/support/plugin/wpf-woocommerce) or at [wpFortify](https://wpfortify.com) 

== Screenshots ==
1. WooCommerce set up screen
2. wpFortify access keys
3. wpFortify default checkout page

== Changelog ==

= 2.4 =
* Moved name to token metadata.

= 2.3 =
* Added name to token for Stripe.
* Changed version numbering format.

= 0.2.2 =
* Fix: Corrected customer_id error when moving between test and live mode.
* Feature: Added "IN TEST MODE" to order notes when making test purchase.

= 0.2.1 =
* Feature: Added permalink nag
* Changed to GPLv2+.

= 0.2.0 =
* Feature: Added new custom checkout text for title.
* Feature: Added new custom checkout text for description.
* Feature: Added new custom checkout text for save card.
* Feature: Added new custom checkout text for payment button.
* Fix: $iv warning in unmask function.
* Fix: corrected identifiers for translate strings.

= 0.1.1 =
* Fix: php warning in admin.

= 0.1.0 =
* Initial release.

== Upgrade Notice ==

= 2.3 =