<?php
/*
Plugin Name: Graylien Customer Image Upload
Plugin URI: http://graylien.tumblr.com
Description: Allows customers to upload an image
Version: 1.0
Author: Graylien
*/

    //include the class library
    include("customer-image-admin-libs.php");

    include("customer-image-libs.php");

    
   //initiate the customer image class, create a new object, and register action hooks through init function
    add_action( 'woocommerce_init', array( 'Customer_Image_Admin', 'init' ));
    add_action( 'woocommerce_init', array( 'Customer_Image', 'init' ));

   
?>