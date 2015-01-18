<script type="text/javascript">
    jQuery(document).ready(function () {
    	jQuery(".imgLiquidFill").imgLiquid({fill: true});
        jQuery("a[rel^=\"prettyPhoto\"]").prettyPhoto
        ({
            animation_speed: <?php echo $lightbox_fade_in_time;?>, 
            slideshow: <?php echo $slide_interval * 1000; ?>, 
            autoplay_slideshow: <?php echo $autoplay;?>,
            opacity: 0.80, 
            show_title: false,
            allow_resize: true,
            changepicturecallback: onPictureChanged
        });
    });

    function onPictureChanged() 
	{

		jQuery('.pp_social').append('<div style="margin-left:5px; display:inline-block;"><g:plusone data-action="share" href="'+ encodeURIComponent(location.href.replace(location.hash,"")) +'" width="160px" ></g:plusone></div>');

		jQuery('.pp_social').append("<script type='text/javascript'> \
		(function() { \
		var po = document.createElement('script'); \
		po.type = 'text/javascript'; \
		po.async = true; \
		po.src = 'https://apis.google.com/js/plusone.js'; \
		var s = document.getElementsByTagName('script')[0]; \
		s.parentNode.insertBefore(po, s); \
		})(); <" + "/" +  "script>");

	}
</script>