
Asset.extend({
	doAllTextareas: function() {
		$$('textarea').each(function(ta) {
			if ( ta.id ) {
				CKEDITOR.replace(ta.id, { 'customConfig' : '/admin/_resources/ckeditor/config.js.php' });
			}
		});
	}
});

Element.extend({
	animate: function(props, duration) {
//console.log(this);
		var fx = new Fx.Styles(this, {'duration': duration});
		fx.start(props);
//		return this.effects({'duration': duration});
//		var fx = new Fx.Styles(props, {duration: duration});
//		return fx.start();
	}
});

String.extend({
	startsWith: function(str) {
		if ( 'array' != $type(str) ) str = [str];
		for ( var i=0; i<str.length; i++ ) {
			if ( 0 == this.indexOf(str[i]) ) {
				return true;
			}
		}
		return false;
	},
	endsWith: function(str) {
		if ( 'array' != $type(str) ) str = [str];
		for ( var i=0; i<str.length; i++ ) {
			if ( -1 != this.indexOf(str[i]) && this.length-str[i].length == this.indexOf(str[i]) ) {
				return true;
			}
		}
		return false;
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
