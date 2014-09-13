if (!Modernizr.svg) {
	for (var i in {grid:1,list:1,table:1}) {
		var parent = jQuery('.' + i + ' svg').parent();
		parent.find('svg').remove();
		parent.append('<div class="fallback-image ' + i + '-image"></div>');
	}
}