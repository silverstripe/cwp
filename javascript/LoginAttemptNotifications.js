(function($) {
	$.entwine('ss.loginattemptnotifications', function($) {

		$('.cms-container').entwine({

			onafterstatechange: function(e, params) {
				this.showMessage(params.xhr.getResponseHeader('X-LoginAttemptNotifications'));
			},

			onaftersubmitform: function(e, params) {
				this.showMessage(params.xhr.getResponseHeader('X-LoginAttemptNotifications'));
			},

			showMessage: function(message) {
				if (message) {
					text = jQuery('<div/>').text(message).html();
					jQuery.noticeAdd({text: text, stay: true, type: 'notice'});
				}
			}

		});

	});
}(jQuery));
