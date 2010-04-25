
Asset.extend({
	doAllTextareas: function() {
		$$('textarea').each(function(ta) {
			if ( ta.id ) {
				CKEDITOR.replace(ta.id, { 'customConfig' : '/admin/_resources/ckeditor/config.js.php' });
			}
		});
	}
});

Document.addEvent('domready', function() {

	document.forms[0].elements[0].focus();

	Asset.doAllTextareas();

});
