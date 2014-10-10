=== WP Fast Cache ===
Contributors: Taylor Hawkes
Donate link: 
Tags: cache, wp fast cache,speed, fast, http cache, w3 total cache, batcache, wp cache, wp super cache, quick cache, lite cache, hyper cache, db cache reloaded fix, wp green cache, aoi cache & performance, generate cache,W3TC cache,cash, wp cache, wpo, web performance optimization, performance,page cache, css cache, js cache, db cache, disk cache, disk caching, database cache, http compression, cdn, compress, optimize, optimizer, plugin, yslow, yui, google, google rank, google page speed, mod_pagespeed, htaccess, aws, elasticache, apache, varnish, xcache, apc, eacclerator, wincache, wp minify, bwp-minify, performance,caching
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 1.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Load your web pages as fast as apache will allow with WP Fast Cache.

== Description ==

<a href="http://www.webhostingweaver.com/wp-fast-cache/">WP Fast Cache </a> is built for pure website loading speed - You will not be able to find any cache that loads a webpage faster, simple as that. This caching system allows users to cache, pages, posts, categories and any other url on their website.

This cache works by creating a static html file for every page cached and then serving that page up first, meaning for cache pages apache only has to serve up static html files, no need to run any PHP or make any database calls.

The Caching system has a simple to user interface for creating, managing and updating cached pages. It also hooks into pages/posts for easy to user cache management on a page level.



    
http://www.youtube.com/watch?v=LUftOTA98Ik

<h4>Features: </h4>
    
* Bulk caching of all pages, posts, categories
* caching of all permalink types including /?p=123 format
* Easy to use cache management
* Page/Post level caching management

<h4> Requirements: </h4>
    
* Linux     
* Apache Mod Rewrite
* Writable .htaccess (manual work around available)
* Writable wp-content (manual work around available)

<h4> Notes  </h4>
Wp fast cache is built to be light weight and is best used for caching your top 100 or fewer website pages. We noticed that the vast majority of website traffic lands on relatively few pages, this plugin is devloped around the idea of making your top website pages really fast. Thanks to the team at <a href="http://www.webhostingweaver.com/">Web Hosting Weaver</a> for developing wp fast cache, and we hope you enjoy!  

== Installation ==

1. Upload `WP Fast Cache` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to "Wp Fast Cache" area and follow any instruction.  

== Frequently asked questions ==

= How do I use WP Fast Cache? =

1. Under the "wp fast cache" area add pages,posts, categories or customer url's to your cache. You can also go to a page/post and click "add page to wp fast cache
and the page will be added to the cache. 
2. To see if your pages displayed from WP Fast Cache log out, then navigate to that page, you should notice it loading faster.
3. After a big change to your website be sure to update all the cached pages.

= Do I have to manually cache every page/post? =
No, You can bulk add pages/posts to the cache. 

= What web hosting providers does WP Fast Cache work on? =
WP Fast Cache should work on any hosting provider that is Linux based and runs Apache. It has been tested on most of the <a href="http://www.woodstitch.com/web-hosting-reviews-2014.php">big web hosting companies. </a>

= Do I have to refresh the cache whenever I update a page/post? =
No, WP Fast Cache will do this automaticly for you whenever you update or a new comment is published.

= My server times out when adding too many posts/pages =
For websites with over 100 pages/posts it's pry best to only cache your top 50 or so  pages/posts. You can set how many of your most recent pages/posts to cache 
    
= Does WP Fast Cache Support Multisite setup? =
Not as of version 1.3
    
= Does WP Fast Cache work with mobile? =
Since many sites display different content for mobile devices, WP Fast Cache is disabled for mobile devices as of version 1.3.
    
= Why do I get an error when I install Wp Fast Cache?=
Ensure that your website is run on linux with apache. If you still get an error please log issue under support.  

== Changelog ==
= 1.1 =
* refresh cache on page/post update.
= 1.2 =
* Fixed issue with not creating all caches on some wp setups.
= 1.3 =
* Fixed Mobile Devices not redirecting (does not cache mobile)
* Fixed Logged in users seing cached pages (does not cache logged in users)
* Fixed Bulk Refresh time out
= 1.4 =
* Multisite compatible & Supports multiple Subdomains
* Suppressed PHP Notices
    

== Upgrade notice ==
= 1.1 =
This version will auto refresh cache on page/post update.
= 1.2 =
There is a new update available for wp fast cache. Uninstall this version and install the newest version. 
= 1.3 =
There is a new update available for wp fast cache. Uninstall this version and install the newest version. 



