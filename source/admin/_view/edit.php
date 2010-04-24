<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkEditViewAccess();

$objView = AROView::finder()->byPK( $_REQUEST['id'] );
$szViewFile = PROJECT_VIEWS.'/'.$objView->id.'.php';

if ( !empty($_POST['delete']) ) {
	$objView->delete();
	unlink($szViewFile);
	header('Location: ../');
	exit;
}

if ( isset($_POST['title'], $_POST['content'], $_POST['type']) ) {
	$objView->title = $_POST['title'];
	$objView->type = implode(',', $_POST['type']);
	$objView->save();
	file_put_contents($szViewFile, $_POST['content']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

echo '<h1>Editing view: '.$objView->title.'</h1>';

$arrViewTypes = array_map('trim', explode(',', $root->select_one('implementation_types', 'GROUP_CONCAT(view_types SEPARATOR \',\')', 'view_types <> \'\'')));
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

<script type="text/javascript">document.forms[0].elements[0].focus();</script>

