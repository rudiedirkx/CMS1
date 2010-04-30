
Asset.extend({
	doAllTextareas: function() {
		$$('textarea').each(function(ta) {
			if ( ta.id ) {
				CKEDITOR.replace(ta.id, { 'customConfig' : '/admin/_resources/ckeditor/config.js.php' });
			}
		});
	}
});

function doMySortable( obj ) {
	return new Sortables(obj, {
		ghost: false,
		onStart: function(tr){ tr.css('background-color', 'green'); },
		onComplete: function(tr){ tr.css('background-color', ''); }
	});
}

Document.addEvent('domready', function() {

	try { document.forms[0].elements[0].focus(); }
	catch (ex) {}

	Asset.doAllTextareas();

});
