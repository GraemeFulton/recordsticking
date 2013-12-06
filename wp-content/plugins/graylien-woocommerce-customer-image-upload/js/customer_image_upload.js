jQuery(document).ready(function ($) {

var input = document.getElementById("customer-image"), 
		formdata = false;

	function showUploadedItem (source) {
            $('#image-pre').hide().empty();
            $('#image-pre').append('<div id="image-prev"><img id="img-upload" src="'+source+'" /></div>').show();
      
	}   

	if (window.FormData) {
  		formdata = new FormData();
  		document.getElementById("btn").style.display = "none";
	}
	
 	input.addEventListener("change", function (evt) {
 		document.getElementById("response").innerHTML = "Uploading . . ."
 		var i = 0, len = this.files.length, img, reader, file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
	
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) { 
						showUploadedItem(e.target.result, file.fileName);
					};
					reader.readAsDataURL(file);
				}
                               if (formdata)
                               {
                                formdata.append("customer-image", file);
                                }
			}	
		}
	        formdata.append("action", 'customer_image_upload');

		if (formdata) {
			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				success: function (resp) {
					 console.log(resp);
                                    if (resp==0){
                                        $('#image-pre').hide().empty();
                                       $('#image-pre').append('<div id="image-prev"><p>Invalid Image</p></div>').show();    
                                       $('#response').html('');

                                    }
                                    else if (resp)
                                    {
                                      $('#uploaded-customer-image').val(resp);
                                      $('#response').html('Image Preview:');
                                    }  
                                         
                                         
				}
			});
		}
	}, false);
});