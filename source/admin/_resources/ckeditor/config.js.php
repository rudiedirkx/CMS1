<?php

require_once('cfg_admin.php');

header('Content-type: text/javascript');

?>
CKEDITOR.addStylesSet('my_styles', [
<?php

$szStyles = trim($application->getConfig('wysiwyg_styles'));
if ( $szStyles ) {
	$arrStyles = explode("\n", $szStyles);
	foreach ( $arrStyles AS $k => $style ) {
		$s = array_map('trim', explode('|', trim($style)));
		echo ( 0 < $k ? ',' : '' )."	{ name : '".$s[0]."', element : '".$s[1]."', attributes : { 'class' : '".$s[2]."' } }\n";
	}
}

?>
]);

CKEDITOR.editorConfig = function( config ) {
	config.contentsCss = '/admin/_resources/ckeditor/style.css.php' ;
	config.toolbar = [
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
	    ['TextColor','BGColor'] /*,
	    ['Maximize', 'ShowBlocks','-','About'] */
	];
	config.skin = 'office2003';
//	config.removePlugins = '';
	config.resize_enabled = true;
	config.height = 300;

	config.filebrowserBrowseUrl = '/admin/_resources/ckeditor/browse.php';
	config.filebrowserWindowWidth = '400';
//	config.filebrowserUploadUrl = '/admin/_resources/ckeditor/upload.php';

	config.stylesCombo_stylesSet = 'my_styles';
};
