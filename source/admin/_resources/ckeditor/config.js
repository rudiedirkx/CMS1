CKEDITOR.editorConfig = function( config ) {
	config.toolbar = 'CMS';
	config.toolbar_CMS = [
	    ['Source','-','Save','-','Templates'],
	    ['Cut','Copy','Paste','PasteText','PasteFromWord'],
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
	config.removePlugins = 'elementspath';
	config.resize_enabled = false;
	config.height = 300;
	config.stylesCombo_stylesSet = 'my_styles';
};
