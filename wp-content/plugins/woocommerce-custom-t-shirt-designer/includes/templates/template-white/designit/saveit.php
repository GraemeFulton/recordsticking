<?php
require_once("/config.php");
$con = mysql_connect('localhost','sort','');
if (!$con)
 {
 	die('Could not connect: ' . mysql_error());
 }
 if(isset($_GET['pId'])){
 	$newId = uniqid();
	$sql = "insert into design(product_id,image,cartId) values('" . $_GET['pId'] . "','',$newId)";
	
 }
 
?> 
