<?php
/*
Plugin Name: IBM Navbar
Plugin URI: http://ibm.com/
Description: Bootstrap navigation bar (extends wordpress walker)
Version: 1.0
Author: Graeme Fulton
Author URI: http://gfulton.me.uk
*/
    
    add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
    function wpt_setup() {
    	register_nav_menu( 'primary', __( 'Primary navigation', 'wptuts' ) );
    } endif;
    
    /*include the nav bar class*/
    require_once('templates/wp_bootstrap_navwalker.php');
    
    add_action('bp_after_header', 'gray_bootstrap_navbar');
    function gray_bootstrap_navbar(){
        //include template
    	require_once('templates/template_navbar.php');
    }
//
//    // Load bootstrap.
//    add_action( 'wp_enqueue_scripts', 'bootstrap_styles'  );
//    add_action( 'wp_enqueue_scripts', 'bootstrap_scripts'  );   
//    
//    function bootstrap_styles(){
//        
//      wp_enqueue_style( 'bootstrap-plugin-styles', plugins_url( 'css/bootstrap.min.css', __FILE__ ));
//
//        
//    }
//    
//    function boostrap_scripts(){
//                     
//        wp_enqueue_script( 'bootstrap-plugin-script', plugins_url( 'js/bootstrap.js', __FILE__ ) );
//
//    }
 
?>
