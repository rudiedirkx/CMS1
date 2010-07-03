CKEDITOR.addStylesSet('my_styles', [
	{ name : 'Semiquote', element : 'p', attributes : { 'class' : 'semiquote' } }
]);
CKEDITOR.editorConfig = function( config ) {
	config.toolbar = 'CMS1';
	config.toolbar_CMS1 = [
	    ['Source','-','Save','-','Templates'],
	    ['Cut','Copy','PasteText'],
	    ['Undo','Redo','-','SelectAll','RemoveFormat'],
	    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['Link','Unlink'],
	    ['Image','Flash','Table','HorizontalRule','SpecialChar'],
	    '/',
	    ['Styles','Format','Font','FontSize'],
	    ['TextColor','BGColor'],
	    ['Maximize', 'ShowBlocks','-','About']
	];
	config.skin = 'office2003';
//	config.removePlugins = '';
	config.resize_enabled = true;
	config.height = 300;
	config.stylesCombo_stylesSet = 'my_styles';
};
