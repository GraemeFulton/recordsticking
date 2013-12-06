<?php


    /*
     * Including all PHP files from a plugin sub folder and avoiding adding a 
     * unnecessary global just to determine a path that is already available everywhere 
     * just using WP core functions.
     * http://codex.wordpress.org/Function_Reference/plugin_dir_path
     */
    $dir = plugin_dir_url( __FILE__ );
    
//    foreach ( glob( plugin_dir_path( __FILE__ )."subfolder/*.php" ) as $file )
//    include_once $file;

?>
