var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
var fileInput = $(':file').wrap(wrapper);

fileInput.change(function(){
    $this = $(this);
    $('#file').text("File attached");
})

$('#file').click(function(){
    fileInput.click();
}).show();

$('.single_add_to_cart_button').hide();

$('#add-to-cart').click(function(){
	$('.single_add_to_cart_button').click();
});

$('.wp-post-image').remove();