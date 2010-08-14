<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkEditViewAccess();

$objView = AROView::finder()->byPK( $_REQUEST['id'] );
$szViewFile = PROJECT_VIEWS.'/'.$objView->id.'.php';

if ( !empty($_GET['deleteme']) ) {
	$objView->delete();
	unlink($szViewFile);
	header('Location: ../');
	exit;
}

else if ( isset($_POST['title'], $_POST['content'], $_POST['type']) ) {

require_once(PROJECT_INCLUDE.'/Dwoo-1.1.1/Dwoo/dwooAutoload.php');
$template_source = $_POST['content'];
$template = new Dwoo_Template_String($template_source);
$dwoo = new Dwoo;
$compiler = new Dwoo_Compiler;
$compiler->setDelimiters('<?', '?>');
$dwoo->setCompiler($compiler);
try {
	$compiled_template_source = $dwoo->testTemplate($template);
//	echo '<pre>'.htmlspecialchars($template_source).'</pre>';
//	echo '<p>is a valid template:</p>';
//	exit('<pre>'.htmlspecialchars(file_get_contents($compiled_template_source)).'</pre>');
}
catch ( Dwoo_Exception $exc ) {
	echo '<pre style="background-color:pink;">'.htmlspecialchars($template_source).'</pre>';
	echo '<p>is NOT a valid template:</p>';
	exit('<pre style="background-color:pink;">'.$exc->getMessage().'</pre>');
}

	$objView->title = $_POST['title'];
	$objView->type = implode(',', $_POST['type']);
	$objView->save();
	file_put_contents($szViewFile, $_POST['content']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

echo '<h1>Editing view: '.$objView->title.'</h1>';

$arrViewTypes = array_map('trim', explode(',', $root->select_one('implementation_types', 'GROUP_CONCAT(view_types SEPARATOR \',\')', 'enabled = 1 AND view_types <> \'\'')));
natcasesort($arrViewTypes);

$arrSelectedTypes = explode(',', $objView->type);

if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
	echo '<p style="color:red;">VIEW NOT SAVED! MISSING FIELDS!</p>';
}

?>
<form method="post" action="">

	<p>Title<br /><input type="text" name="title" size="80" value="<?=htmlspecialchars(isset($_POST['title']) ? $_POST['title'] : $objView->title)?>" /></p>

	<p>Content<br /><textarea wrap="off" name="content" rows="21" style="width:100%;"><?=htmlspecialchars(isset($_POST['content']) ? $_POST['content'] : file_get_contents($szViewFile))?></textarea></p>

	<p>Type<br /><div style="width:750px;"><?foreach($arrViewTypes AS $v){ echo '<label style="float:left;width:250px;"><input type="checkbox" name="type[]" value="'.$v.'"'.( in_array($v, $arrSelectedTypes) ? ' checked="1"' : '' ).' /> '.$v.'</label>'."\n"; }?></div></p>

	<p style="clear:both;"><br /><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
document.forms[0].elements[0].focus();
var ta = $$('textarea')[0], tas = ta.attr('style'), talh = ta.css('border', '0').css('padding', '0').offsetHeight / parseInt(ta.attr('rows'));
$$('textarea')[0].attr('style', tas);
</script>

<?php

tpl_footer();


