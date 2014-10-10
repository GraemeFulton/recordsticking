<?php
   /*
   Plugin Name: WP Fast Cache
   Plugin URI: http://www.webhostingweaver.com/wp-fast-cache/
   Description: Page Caching to make your WP REALLY FREAKING FAST 
   Version: 1.4
   Author:Taylor Hawkes 
   Author URI: http://taylor.woodstitch.com
   License: GPL2
   */
    

/*  Copyright 2013  Taylor Hawkes  (email : thawkes@woodstitch.com)

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
/* stuff to do when we create plugin */

register_activation_hook( __FILE__, 'wp_fast_cache_init_plugin' );
register_deactivation_hook( __FILE__, 'wp_fast_cache_remove_plugin' );


/** Step 2 (from text above). */
add_action( 'admin_menu', 'wp_fast_cache_my_plugin_menu' );
add_action( 'edit_form_after_title', 'add_admin_cache_button' );

/*these are for updting the cache automaticly */
add_action( 'edit_post', 'wp_fast_cache_update_page_cache' );


function add_admin_cache_button() {
?>
    <?php $wp_fast_cache_pe=wp_fast_cache_is_url_cached(get_permalink($_GET['post'])); ?>
    
        <div style="padding:2px;" class="postbox">
        <h3 style="display:inline-block;border:0px;background:none;"> WP Fast Cache: </h3>
        <a id="wp_fast_cache_add_cache" class="button button-small" <?php if($wp_fast_cache_pe){ echo " style='display:none' ";}?>> Add Page To WP Fast Cache </a>
        <a id="wp_fast_cache_remove_cache" class="button button-small" <?php if(!$wp_fast_cache_pe){ echo " style='display:none' ";}?> > Remove Page from WP Fast Cache </a>
        <a id="wp_fast_cache_refresh_cache" class="button button-small" <?php if(!$wp_fast_cache_pe){ echo " style='display:none' ";}?> > Refresh Page Cache </a>
        </div>

<?php
}

add_action( 'admin_footer', 'wp_fast_cache_add_javascript_to_admin' );

function wp_fast_cache_add_javascript_to_admin() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
    //for detecing input change
$("#wp_fast_cache_create_all_posts_number, #wp_fast_cache_create_all_pages_number").on("input",null,null,function(){
    $("#"+$(this).attr('id')+"_d").html($(this).val());
});

    $("#wp_fast_cache_add_cache").click(function(){
        var element=$(this);
        var data = {
            action: 'wp_fast_cache_ajax_create_url',
            url:'<?php echo get_permalink($_GET['post'])?>'
        };
        element.html('Adding to cache...');
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
             element.hide();
        element.html('Add Page To WP Fast Cache');
            $('#wp_fast_cache_remove_cache').show();
            $('#wp_fast_cache_refresh_cache').show();
        });
    });

    /*this is on the actual page*/
 $("#wp_fast_cache_remove_cache").click(function(){
        var element=$(this);
        var data = {
            action: 'wp_fast_cache_ajax_delete_url',
            url:'<?php echo get_permalink($_GET['post'])?>'
        };
        element.html('Deleting from cache...');

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            element.hide();
            $('#wp_fast_cache_refresh_cache').hide();
            element.html(' Remove Page from WP Fast Cache');
            $('#wp_fast_cache_add_cache').show();
        });
    });

$("#wp_fast_cache_refresh_cache").click(function(){
        var element=$(this);
        var data = {
            action: 'wp_fast_cache_ajax_refresh_url',
            url:'<?php echo get_permalink($_GET['post'])?>'
        };
        element.html('Updating cache...');

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            element.html('Refresh Page Cache');
        });
    });


  $(".wp_fast_cache_delete_cache").click(function(){
        $(this).parent().parent().slideUp();
        var data = {
            action: 'wp_fast_cache_ajax_delete_url',
            url: $(this).attr('page_url')
        };


        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            //alert('Got this from the server: ' + response);
        });
    });
  $(".wp_fast_cache_refresh_cache").click(function(){
      var element=$(this);
        $(this).html("Refreshing...");
        var data = {
            action: 'wp_fast_cache_ajax_refresh_url',
            url: $(this).attr('page_url')
        };

        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        $.post(ajaxurl, data, function(response) {
            element.html("Refresh cache");
            //alert('Got this from the server: ' + response);
        });
    });

  $("#wp_fast_cache_delete_all").click(function(){
    var r=confirm("Are you sure? This will delete all cached files. Press ok to delete all cached files.");
    if (r==true)
        {
            $('#wp_fast_cache_bulk_action').val('delete_all');
            $('#wp_fast_cache_bulk_action_form').submit();
        }
      else
        {
        x="You pressed Cancel!";
        }
    });

$("#wp_fast_cache_refresh_all").click(function(){
    var r=confirm("Are you sure? This will refresh all cached files. Press ok to refresh all cached files.");
    if (r==true)
        {
           //we get all the url's
            $("#wp_fast_cache_url_table .wp_fast_cached_cached_url").each(function(i){
                    
                var element=$(this);
                element.parent().parent().find('.wp_fast_cache_refresh_cache').html('Refreshing...');
                    
                var data = {
                    action: 'wp_fast_cache_ajax_refresh_url',
                    url: element.attr('href')
                };
                $.post(ajaxurl, data, function(response) {
                    element.find('.wp_fast_cache_refreshing').remove();
                    element.parent().parent().find('.wp_fast_cache_refresh_cache').html('Refresh cache');
                });

                
            });
            
           // $('#wp_fast_cache_bulk_action').val('refresh_all');
           // $('#wp_fast_cache_bulk_action_form').submit();
        }
      else
        {
            x="You pressed Cancel!";
        }
    });

$("#wp_fast_cache_create_all_pages").click(function(){
    var r=confirm("Are you sure? This will cache all of your pages. Press ok to continue.");
    if (r==true)
        {
            $('#wp_fast_cache_bulk_action').val('cache_all_pages');
            $('#wp_fast_cache_bulk_action_form').submit();
        }
      else
        {
            x="You pressed Cancel!";
        }
    });

 $("#wp_fast_cache_create_all_posts").click(function(){
    var r=confirm("Are you sure? This will cache all of your posts. Press ok to continue.");
    if (r==true)
        {
            $('#wp_fast_cache_bulk_action').val('cache_all_posts');
            $('#wp_fast_cache_bulk_action_form').submit();
        }
      else
        {
            x="You pressed Cancel!";
        }
    });
 $("#wp_fast_cache_create_all_categories").click(function(){
    var r=confirm("Are you sure? This will cache all of your categories. Press ok to continue.");
    if (r==true)
        {
            $('#wp_fast_cache_bulk_action').val('cache_all_categories');
            $('#wp_fast_cache_bulk_action_form').submit();
        }
      else
        {
            x="You pressed Cancel!";
        }
    });

 $("#wp_fast_cache_specific_url_button").click(function(){
            $('#wp_fast_cache_bulk_action').val('cache_this_url');
            $('#wp_fast_cache_bulk_action_url').val($('#wp_fast_cache_specific_url').val());
            $('#wp_fast_cache_bulk_action_form').submit();

   });   

});   
</script>
<?php
}

/** Step 1. */
function wp_fast_cache_my_plugin_menu() {
    add_menu_page( 'Wp Fast Cache', 'WP Fast Cache', 'publish_posts', 'wp-fast-cache', 'wp_fast_cache_my_plugin_options' );
}

/** Step 3. */

function wp_fast_cache_my_plugin_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($_POST['wp_fast_cache_bulk_action']=="delete_all"){
           wp_fast_cache_bulk_delete_all();      
            $wp_fast_cache_msg=' <div id="message" class="updated"><p>All cached pages have been deleted.</p></div>';
        }     

        if($_POST['wp_fast_cache_bulk_action']=="refresh_all"){
           wp_fast_cache_bulk_refresh_all();      
        $wp_fast_cache_msg=' <div id="message" class="updated"><p>All cached pages have been cleared.</p></div>';
        }

       if($_POST['wp_fast_cache_bulk_action']=="cache_all_pages"){
           wp_fast_cache_bulk_cache_all_pages();      
        $wp_fast_cache_msg=' <div id="message" class="updated"><p>All  pages have been cached.</p></div>';
        }

        if($_POST['wp_fast_cache_bulk_action']=="cache_all_posts"){
           wp_fast_cache_bulk_cache_all_posts();      
            $wp_fast_cache_msg=' <div id="message" class="updated"><p>All posts have been cached.</p></div>';
        }
      if($_POST['wp_fast_cache_bulk_action']=="cache_all_categories"){
           wp_fast_cache_bulk_cache_all_categories();      
            $wp_fast_cache_msg=' <div id="message" class="updated"><p>All categories have been cached.</p></div>';
        }

        if($_POST['wp_fast_cache_bulk_action']=="cache_this_url"){
            if(!wp_fast_cache_add_cached_url($_POST['wp_fast_cache_bulk_action_url'])){
                $wp_fast_cache_msg=' <div id="message" class="error"><p>Could not add this url!</p></div>';
            }else{
                
                $wp_fast_cache_msg=' <div id="message" class="message"><p>'.$_POST['wp_fast_cache_bulk_action_url'].' has been added to cache!</p></div>';
            }
        }

    }
    ?>
   <style>
   .wp_fast_cache_button_left_input{
        width:30px;
        position:relative;
        left:3px;
        padding-top:4px;
    } 
    </style> 
    <div class="wrap">
    <div id="icon-options-general" class="icon32"><br></div>
      <h2 style="margin-bottom:10px;"> WP Fast Cache </h2> 
    <?php echo @$wp_fast_cache_msg ;?>
    <?php
     @$wp_fast_posts_to_cache=($_REQUEST['wp_fast_cache_create_all_posts_number']) ?  $_REQUEST['wp_fast_cache_create_all_posts_number'] : 25;
     @$wp_fast_pages_to_cache=($_REQUEST['wp_fast_cache_create_all_pages_number']) ?  $_REQUEST['wp_fast_cache_create_all_pages_number'] : 25;
    ?>
        <?php wp_fast_cache_get_instalation_instructions()?>
    
           <button class="button-primary" id="wp_fast_cache_delete_all">Delete All Cached Url's</button>
            <button id="wp_fast_cache_refresh_all"class="button-primary">Refresh All Cached Url's</button>
 
        <form style="display:inline" method="post" id="wp_fast_cache_bulk_action_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <input id="wp_fast_cache_bulk_action"type="hidden" name="wp_fast_cache_bulk_action">
            <input id="wp_fast_cache_bulk_action_url"type="hidden" name="wp_fast_cache_bulk_action_url">
    
    
            <input type="text" name="wp_fast_cache_create_all_pages_number" id="wp_fast_cache_create_all_pages_number" class="wp_fast_cache_button_left_input" value="<?php echo $wp_fast_pages_to_cache?>"> 
            <button id="wp_fast_cache_create_all_pages" class="button-primary">Cache <span id="wp_fast_cache_create_all_pages_number_d"><?php echo $wp_fast_pages_to_cache?> </span> Recent Pages</button>
    
            <input type="text" name="wp_fast_cache_create_all_posts_number" id="wp_fast_cache_create_all_posts_number" class="wp_fast_cache_button_left_input" value="<?php echo $wp_fast_posts_to_cache?>"> 
            <button id="wp_fast_cache_create_all_posts" class="button-primary">Cache <span id="wp_fast_cache_create_all_posts_number_d"><?php echo $wp_fast_posts_to_cache?></span> Recent Posts</button>
    
            <button id="wp_fast_cache_create_all_categories" class="button-primary">Cache All Categories</button>
        
        </form>

<hr style="border:0px;border-top: 1px solid #ccc;margin:5px 0px;">
    <div style="float:left"> <!-- start floating left-->
    <table class="widefat" style="width:auto">
    <tr>
    <td style="padding:8px;"> <input style="width:460px;" type="text" id="wp_fast_cache_specific_url" name="wp_fast_cache_specific_url"> </td>
    <td style="padding:8px;"> <button id="wp_fast_cache_specific_url_button" class="button-primary">Cache This Url</button></td>
    </tr>
    </table>

        <h3> Cached Url's </h3>
        
        <table id="wp_fast_cache_url_table"class="wp-list-table widefat" style="width:auto;min-width:600px;">
        <thead> <tr><th> Url </th> <th> Delete </th> <th> Update </th></tr></thead>
            <?php wp_fast_cache_get_cached_urls() ?> 
        </table>
        </div>  <!-- end floating left-->
    
       <div style="float:right;">

 <iframe scrolling="no" src="http://www.webhostingweaver.com/wp-fast-cache-block.php" style="border:1px solid #ccc;height:200px;width:200px;overflow:hidden;"> </iframe> </div>
        <div style="clear:both"> </div> 


        </div>
    <?php
}
  
 
function wp_fast_cache_get_instalation_instructions(){

    $htaccess=$_SERVER['DOCUMENT_ROOT']."/.htaccess";
    $ht_access_status=  wp_fast_cache_write_htacess();
    $ht_needs_rules=($ht_access_status ===2) ? true : false;

    $cache_dir_status=wp_fast_cache_create_cache_dir();
    $cache_needs_create = ($cache_dir_status ===2) ? true : false;

?>

<?php if($cache_needs_create || $ht_needs_rules){ ?>
<div style="padding:10px;" class="updated">
<h3>Installation Not Complete </h3>
<?php if($ht_needs_rules){ ?>
<strong>1. Put this code at the very BEGINNING of your .htaccess file! </strong>
<p>If your <code>.htaccess</code> file were <a href="http://codex.wordpress.org/Changing_File_Permissions">writable</a>, we could do this automatically, but it isn’t so these are the mod_rewrite rules you should have in your <code>.htaccess</code> file. Click in the field and press <kbd>CTRL + a</kbd> to select all.</p>
<textarea style="margin-bottom:15px;"rows="6" class="large-text readonly" name="rules" id="rules" readonly="readonly">
<?php echo wp_fast_cache_get_htacess_content() ;?>
</textarea>
<?php } ?>
<?php if($cache_needs_create){ ?>
<strong>2. Make your wp-content directory writable </strong>
<code> chmod 777 wp-content </code>
<?php } ?>

</div>
<?php }//end if installtion ?>

<?php
    
}


/* tries to write .htaccess if we can */
function wp_fast_cache_write_htacess(){

$htaccess=$_SERVER['DOCUMENT_ROOT']."/.htaccess";
$ht_content=file_get_contents($htaccess);
if(strpos($ht_content,"start_wp_fast_cache")){ return 1;}
if(!is_writable($htaccess)){ return 2; }


$rewrite=wp_fast_cache_get_htacess_content();

$rewrite_content=$rewrite.$ht_content;
file_put_contents($htaccess,$rewrite_content);
return 3;
}

function wp_fast_cache_get_htacess_content(){

$cache_dir= WP_CONTENT_DIR."/wp_fast_cache/";
$rewrite='#start_wp_fast_cache - do not remove this comment 
<IfModule mod_rewrite.c>
 RewriteEngine On
 RewriteCond %{REQUEST_METHOD} ^(GET)
 RewriteCond '.$cache_dir.'%{HTTP_HOST}%{REQUEST_URI}x__query__x%{QUERY_STRING}index.html -f
 RewriteCond %{HTTP_USER_AGENT} !(iPhone|Windows\sCE|BlackBerry|NetFront|Opera\sMini|Palm\sOS|Blazer|Elaine|^WAP.*$|Plucker|AvantGo|Nokia)
 RewriteCond %{HTTP_COOKIE} !(wordpress_logged_in) [NC]
 RewriteRule ^(.*)$ '.$cache_dir.'%{HTTP_HOST}%{REQUEST_URI}x__query__x%{QUERY_STRING}index.html [L]
    
 RewriteCond %{REQUEST_METHOD} ^(GET)
 RewriteCond %{QUERY_STRING} ^$
 RewriteCond '.$cache_dir.'%{HTTP_HOST}%{REQUEST_URI}index.html -f 
 RewriteCond %{HTTP_USER_AGENT} !(iPhone|Windows\sCE|BlackBerry|NetFront|Opera\sMini|Palm\sOS|Blazer|Elaine|^WAP.*$|Plucker|AvantGo|Nokia)
 RewriteCond %{HTTP_COOKIE} !(wordpress_logged_in) [NC]
 RewriteRule ^(.*)$ '.$cache_dir.'%{HTTP_HOST}%{REQUEST_URI}index.html [L]
 
</IfModule>
#end_wp_fast_cache
';   
return $rewrite;

}
/*this removes the codes form .htaccess*/
function wp_fast_cache_remove_plugin(){
 
$htaccess=$_SERVER['DOCUMENT_ROOT']."/.htaccess";
if(!is_writable($htaccess)){
   return 2;
}
$ht_content=file_get_contents($htaccess);
if(!strpos($ht_content,"start_wp_fast_cache") || !strpos($ht_content,"end_wp_fast_cache")){ return 1;}

$ht_content=preg_replace('/#start_wp_fast_cache(.*?)#end_wp_fast_cache/s',"",$ht_content);
file_put_contents($htaccess,$ht_content);   
}

/* this inits the plugin */
function wp_fast_cache_init_plugin(){
wp_fast_cache_create_cache_dir();
wp_fast_cache_write_htacess();
}
    
/*so i will find all the files that exhist */
function wp_fast_cache_get_cached_urls(){
$cache_dir= WP_CONTENT_DIR."/wp_fast_cache/";
$files = wp_fast_cache_directoryToArray($cache_dir,1);

$urls=array();
foreach($files as $file){
        $urls[]=wp_fast_cache_build_url_from_file($file);    
}
foreach($urls as $url){?>
    
    <tr> 
        <td><a class="wp_fast_cached_cached_url" target="_blank" href="<?php echo $url ?>"> <?php echo $url?></td>
        <td> <a href="#" class="wp_fast_cache_delete_cache"  page_url="<?php echo $url?>"> Delete from cache </a> </td>
        <td><a href="#" class="wp_fast_cache_refresh_cache" page_url="<?php echo $url?>"> Refresh cache </a> </td>
    </tr>

<?php }  

}
###############################################################################
# Auto refreshing cache 
###############################################################################
function wp_fast_cache_update_page_cache($post_id){
    $url = get_permalink($post_id);
        
    // we should only update if the page is cached
    if(wp_fast_cache_is_url_cached($url)){
         wp_fast_cache_refresh_cached_url($url);
    }
}
        
###############################################################################
# BULK CRUD 
###############################################################################

function wp_fast_cache_bulk_cache_all_categories(){
 $pages=get_categories("");   
    foreach($pages as $page){
     wp_fast_cache_add_cached_url(get_category_link($page->term_id));
    }
}

function wp_fast_cache_bulk_cache_all_pages(){
   $num=$_POST['wp_fast_cache_create_all_pages_number'];
    if(!$num){$num=25;}
$args = array(
    'sort_order' => 'DESC',
    'sort_column' => 'post_id',
    'hierarchical' => 1,
    'exclude' => '',
    'include' => '',
    'meta_key' => '',
    'meta_value' => '',
    'authors' => '',
    'child_of' => 0,
    'parent' => -1,
    'exclude_tree' => '',
    'number' => $num,
    'offset' => 0,
    'post_type' => 'page',
    'post_status' => 'publish'
); 
$pages = get_pages($args); 
foreach($pages as $page){
 wp_fast_cache_add_cached_url(get_permalink($page->ID));
}

}

function wp_fast_cache_bulk_cache_all_posts(){
    $num=$_POST['wp_fast_cache_create_all_posts_number'];
    if(!$num){$num=25;}
    
$args = array(
    'numberposts'=>$num,
    'orderby'         => 'post_id',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish');
    
$pages = get_posts($args); 
    
foreach($pages as $page){
 wp_fast_cache_add_cached_url(get_permalink($page->ID));
}

}

function wp_fast_cache_bulk_delete_all(){
$dir= WP_CONTENT_DIR."/wp_fast_cache/";
wp_fast_cache_rrmdir($dir);
}

function wp_fast_cache_bulk_refresh_all(){
$cache_dir= WP_CONTENT_DIR."/wp_fast_cache/";
$files = wp_fast_cache_directoryToArray($cache_dir,1);

$urls=array();
    foreach($files as $file){
            $url=wp_fast_cache_build_url_from_file($file);    
             wp_fast_cache_delete_cached_url($url);
             wp_fast_cache_add_cached_url($url);
    }
}




###############################################################################
# CONVERTING URL TO FILE AND VISE VERSA
###############################################################################

/*Get the Url from the file */ 
function wp_fast_cache_build_url_from_file($file){
$cache_dir= WP_CONTENT_DIR."/wp_fast_cache/";
$file=str_replace($cache_dir,"",$file);

$file=preg_replace("/(index\.html)$/","",$file);

//revert the x__query__x
$file=str_replace("x__query__x","?",$file);
$url="http://".$file;
//$url=site_url()."/".$file;
return $url ;
} 

//get the file from a url
function wp_fast_cache_get_file_from_url($url){
    $url=trim($url);
        
    //let get path then 
    $f=parse_url($url) ;
    
    //multisite-so we create directory for host
    $path=$f['host'];
        
    $path.=$f['path'];
     //if we have query qe are always going to be afiles 
     if($f['query']){
         $path.="x__query__x".$f['query']."index.html";
     }else{
        $path.="index.html";    
    }

    $cache_dir= WP_CONTENT_DIR."/wp_fast_cache/";

    $file=$cache_dir.$path;

    return $file;
}




###############################################################################
# CRUD ADDING/ UPDATING Files
###############################################################################

/* check if this page is cached */
function wp_fast_cache_is_url_cached($url){
    $file=wp_fast_cache_get_file_from_url($url);
    return file_exists($file);
}

/*i delete this given url */
function wp_fast_cache_delete_cached_url($url){
    $file=wp_fast_cache_get_file_from_url($url);
    return unlink($file);
}
 
/*I add a cached page*/ 
function wp_fast_cache_add_cached_url($url){
    //if page is cached we should not add again return true 
   if(wp_fast_cache_is_url_cached($url)) {return true;} 
    
    $target_file= wp_fast_cache_get_file_from_url($url);
    $content=file_get_contents($url);
    return wp_fast_cache_file_force_contents($target_file,$content); 
}

/* refresh a cached url*/
function wp_fast_cache_refresh_cached_url($url){
wp_fast_cache_delete_cached_url($url);
return wp_fast_cache_add_cached_url($url);
}
    
function wp_fast_cache_create_cache_dir(){
    $cache_dir= WP_CONTENT_DIR."/wp_fast_cache/";
    if(is_writable(WP_CONTENT_DIR."/wp_fast_cache/")){return 1;}//we are good
    if(!is_writable(WP_CONTENT_DIR)) {return 2;} //we cant write it
    mkdir($cache_dir);
    return 3;
}



###############################################################################
# AJAX REGISTERS FUNCTION FOR CRUD 
###############################################################################

  
add_action('wp_ajax_wp_fast_cache_ajax_create_url', 'wp_fast_cache_ajax_create_url'); 
function wp_fast_cache_ajax_create_url(){
    wp_fast_cache_add_cached_url($_POST['url']); 
    return true;
}

add_action('wp_ajax_wp_fast_cache_ajax_delete_url', 'wp_fast_cache_ajax_delete_url'); 
function wp_fast_cache_ajax_delete_url(){
     wp_fast_cache_delete_cached_url($_POST['url']); 
    return true;
}

add_action('wp_ajax_wp_fast_cache_ajax_refresh_url', 'wp_fast_cache_ajax_refresh_url'); 
function wp_fast_cache_ajax_refresh_url(){
     wp_fast_cache_refresh_cached_url($_POST['url']); 
    return true;
}

###############################################################################
# VARIOUS HELPER FUNCTIONS 
###############################################################################

/*
* Create a array of all files ina directory
*/
function wp_fast_cache_directoryToArray($directory, $recursive) {

    if(!is_dir($directory)){return;}
    $array_items = array();
    if ($handle = opendir($directory)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (is_dir($directory. "/" . $file)) {
                    if($recursive) {
                        $array_items = array_merge($array_items, wp_fast_cache_directoryToArray($directory. "/" . $file, $recursive));
                    }
                    $file = $directory . "/" . $file;
                    $array_items[] = preg_replace("/\/\//si", "/", $file);
                } else {
                    $file = $directory . "/" . $file;
                    $array_items[] = preg_replace("/\/\//si", "/", $file);
                }
            }
        }
        closedir($handle);
    }

    //only return files
    $all_files=array();
    foreach($array_items as $item) {
        if(is_file($item)){
            $all_files[]=$item; 
            }    
    }

    return $all_files;
}

/*
* Writes the files and create directories if neede
* return true on success false on fail 
*/
function wp_fast_cache_file_force_contents($dir, $contents){
        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part){
            if(!is_dir($dir .= "/$part")) mkdir($dir);
        }

        return file_put_contents("$dir/$file", $contents);
}

/*recursivel deltes everthing in a diretory */
function wp_fast_cache_rrmdir($dir){
if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           wp_fast_cache_rrmdir($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
}


?>
