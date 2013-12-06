<hr>

<div id="customer-upload-form">
     <h1>1. Upload Your Image:</h1> 
    <form method="post" enctype="form-data"  action="">  
      <input type="file" name="customer-image" id="customer-image" multiple /> 
	<div id="file" class="customer-button">Upload Photo</div>
	
      <button type="submit" id="btn">Upload Files!</button>  
    </form> 
 
    <input type="hidden" id="uploaded-customer-image" name="uploaded-customer-image" />
  
    <div id="response"></div>  
   
    <div id="image-pre"></div>
 
<hr><br> 
 <h1>2. Add To Shopping Bag</h1>
	<div id="add-to-cart" class="customer-button">Add To Bag</div>

<hr><br>
 <h1>3. Go To Checkout</h1>

	<a href="http://www.therecordsticking.co.uk/checkout/"><div id="add-to-cart" class="customer-button">Checkout</div></a>
 <hr><br>
    
  </div> 
<div style="clear:both;"></div>
<br>
<script src="<?php echo $dir?>js/customer_image_style_buttons.js"></script>
<script src="<?php echo $dir?>js/customer_image_upload.js"></script>