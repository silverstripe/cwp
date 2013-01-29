(function($) {
	$.entwine('ss', function($) {
		$('form.htmleditorfield-mediaform').entwine({
			onsubmit: function() {
				var items = $('div.ss-uploadfield-files .ss-uploadfield-item');

				for(var i = 0; i < items.length; i++) {
					var self = $(items[i]);
					var input = self.find('input[name="AltText"]');
					var container = self.find('.ss-uploadfield-item-editform');

					if(input.length == 0) {
						continue;
					}

					container.height(0);
					input.css('border', '1px solid #b3b3b3');

					if(input.val().length == 0) {
						container.height('auto');
						input.css('border', '1px solid red');
						alert('Please specify alternative text for ' + $.trim(self.find('.ss-uploadfield-item-name span').html()));
						return false;
					}
				}

				this._super();
				return false;
			}
		});
	});
}(jQuery));

