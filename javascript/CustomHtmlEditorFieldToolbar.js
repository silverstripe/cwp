(function($) {
	$.entwine('ss', function($) {

		$('.ss-uploadfield-item').entwine({
			/**
			 * Default alt inputs to empty for upload items.
			 */
			onmatch: function() {
				var alt = this.find('input[name="AltText"]');
				if (alt.prop('defaultValue')===alt.val()) alt.val('');

				this._super();
			}
		});

		$('form.htmleditorfield-mediaform').entwine({
			/**
			 * Validate the form for the presence of the alt attribute.
			 */
			onsubmit: function() {
				var items = $('div.ss-uploadfield-files .ss-uploadfield-item');

				// Look through the current file items and validate each.
				for (var i = 0; i < items.length; i++) {
					var self = $(items[i]);
					var input = self.find('input[name="AltText"]');
					var container = self.find('.ss-uploadfield-item-editform');

					// Check for the presence of Alt.
					if (input.length == 0) {
						continue;
					}

					// Collapse all items, so we can highlight the invalid ones.
					container.height(0);

					// Reset the borders for the ones that have already been fixed.
					input.css('border', '1px solid #b3b3b3');

					// Validate
					if (input.val().length == 0) {
						// Mark field as invalid.
						container.height('auto');
						input.css('border', '1px solid red');

						// Ask the user to confirm proceeding.
						var response = confirm(
							ss.i18n.sprintf(
								ss.i18n._t('CWP.SPECIFYALTTEXT'),
								$.trim(self.find('.ss-uploadfield-item-name span').html())
							)
						);
						if (response===false) {
							return false;
						}
					}
				}

				this._super();
				return false;
			}
		});

	});
}(jQuery));
