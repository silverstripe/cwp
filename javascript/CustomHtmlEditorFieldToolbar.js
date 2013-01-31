(function($) {
	$.entwine('ss', function($) {
		$('form.htmleditorfield-mediaform').entwine({
			onsubmit: function() {
				var items = $('div.ss-uploadfield-files .ss-uploadfield-item');

				for (var i = 0; i < items.length; i++) {
					var self = $(items[i]);
					var input = self.find('input[name="AltText"]');
					var container = self.find('.ss-uploadfield-item-editform');

					if (input.length == 0) {
						continue;
					}

					container.height(0);
					input.css('border', '1px solid #b3b3b3');

					if (input.val().length == 0) {
						container.height('auto');
						input.css('border', '1px solid red');
						alert(
							ss.i18n.sprintf(
								ss.i18n._t('CWP.SPECIFYALTTEXT'),
								$.trim(self.find('.ss-uploadfield-item-name span').html())
							)
						);
						return false;
					}
				}

				this._super();
				return false;
			}
		});

		$('form.htmleditorfield-mediaform .ss-htmleditorfield-file.image').entwine({
			getHTML: function() {
				/* NOP */
			},
			/**
			 * Logic similar to TinyMCE 'advimage' plugin, insertAndClose() method.
			 */
			insertHTML: function(ed) {
				var form = this.closest('form'), node = form.getSelection(), ed = form.getEditor();

				// Get the attributes & extra data
				var attrs = this.getAttributes(), extraData = this.getExtraData();

				// Find the element we are replacing - either the img, it's figure parent, or nothing (if creating)
				var replacee = (node && node.is('img')) ? node : null;
				if (replacee && replacee.parent().is('figure')) replacee = replacee.parent();

				// Find the img node - either the existing img or a new one, and update it
				var img = (node && node.is('img')) ? node : $('<img />');
				img.attr(attrs);

				// The element we are replacing the replacee with
				var replacer = img;

				// Any existing figure or caption node
				var figure = img.parent('figure'), caption = figure.find('figcaption');

				// If we've got caption text, we need a wrapping figure & a figcaption element
				if (extraData.CaptionText) {
					if (!figure.length) {
						figure = $('<figure></figure>');
						figure.attr('class', attrs['class']);
					}

					replacer = figure;

					if (!caption.length) {
						caption = $('<figcaption></figcaption>');
						figure.append(caption);
					}

					caption.text(extraData.CaptionText);
				}
				// Otherwise forget they exist
				else {
					figure = caption = null;
				}
				
				// If we're replacing something, and it's not with itself, do so
				if (replacee && replacee.not(replacer).length) {
					replacee.replaceWith(replacer);
				}

				// If we have a figure element, make sure the img is the first child - img might be the
				// replacee, and figure the replacer, and we can't do this till after the replace has happened
				if (figure) {
					figure.prepend(img);
				}

				// If we don't have a replacee, then we need to insert the whole HTML
				if (!replacee) {
					// Otherwise insert the whole HTML content
					ed.repaint();
					ed.insertContent($('<div />').append(replacer).html(), {skip_undo : 1});
				}

				ed.addUndo();
				ed.repaint();
			},
			updateFromNode: function(node) {
				this._super();
				this.find(':input[name=CaptionText]').val(node.siblings('figcaption:first').text());
			}
		});
	});
}(jQuery));