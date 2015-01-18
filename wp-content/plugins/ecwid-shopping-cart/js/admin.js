jQuery(document).ready(function() {
	jQuery('#hide-vote-message').click(function() {
		jQuery('#hide-vote-message').addClass('hiding');
		jQuery.getJSON(
			'admin-ajax.php',
			{ action:'ecwid_hide_vote_message' }, 
			function(data) {
				jQuery('#hide-vote-message').removeClass('hiding')
						.closest('div.update-nag, div.updated.fade').fadeOut();
			}
		);
	});

	jQuery('a.ecwid-message-hide').click(function() {

		var a = this;
		jQuery(a).css('cursor', 'wait');
		jQuery.getJSON(
			'admin-ajax.php',
			{
				action: 'ecwid_hide_message',
				message: a.name
			},
			function(data) {
				jQuery(a).closest('.ecwid-message').fadeOut();
			}
		);
	});
});
