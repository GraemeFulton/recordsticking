<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

</div><!-- / end page container, begun in the header -->

<footer class="site-footer" role="contentinfo">
	<div class="site-info container">
		
		<p>The <a href="http://www.therecordsticking.co.uk" rel="theme">Record's Ticking</a> 
			by <a href="http://www.therecordsticking.co.uk" rel="generator">Robert Hume</a> 
			website by <a href="http://twitter.com/graeme_fulton" rel="designer">Graeme Fulton</a>
		</p>
		
	</div><!-- .site-info -->
</footer><!-- #colophon .site-footer -->

<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>

</body>
</html>
