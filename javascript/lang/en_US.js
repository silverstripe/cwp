if(typeof(ss) == 'undefined' || typeof(ss.i18n) == 'undefined') {
	if(typeof(console) != 'undefined') console.error('Class ss.i18n not defined');
} else {
	ss.i18n.addDictionary('en_US', {
		'CWP.SPECIFYALTTEXT': '%s has no alt text which is required for non-decorative images.\n\nAre you sure you want to update?'
	});
}
