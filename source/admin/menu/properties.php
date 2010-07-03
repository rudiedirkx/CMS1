<?php

require_once('cfg_admin.php');

logincheck();

$objMenu = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['max_depth']) ) {
	// Update implementation
	$db->update('implementations', "id = '".addslashes($_POST['id'])."', title = '".addslashes($_POST['title'])."'", "id = '".addslashes($objMenu->id)."'");

	// Update menu
	$db->update('menu_implementations', array(
		'max_depth' => (int)$_POST['max_depth'],
		'content_1' => $_POST['content_1']
	), 'implementation_id = '.$objMenu->implementation_id);

	foreach ( array('special_1','special_2','special_3') AS $name ) {
		$objMenu->setConfig($name, empty($_POST[$name]) ? null : $_POST[$name]);
	}

	header('Location: edit.php?id='.$objMenu->id);
	exit;
}

tpl_header();

echo '<h1>Editing menu: '.$objMenu->title.'</h1>';

?>
<p><a href="properties.php?id=<?=$objMenu->id?>">Properties</a> | <a href="items.php?id=<?=$objMenu->id?>">Items</a></p>

<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="">

	<p>ID:<br /><input type="text" name="id" size="20" maxlength="50" value="<?=htmlspecialchars($objMenu->id)?>" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="<?=htmlspecialchars($objMenu->title)?>" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="11" cols="80"><?=htmlspecialchars($objMenu->content_1)?></textarea></p>

	<input type="hidden" name="max_depth" value="10" /><!--<p>Max depth:<br /><input type="text" name="max_depth" size="10" value="<?=htmlspecialchars($objMenu->max_depth)?>" /></p>-->

	<p>Special 1: <input type="text" name="special_1" value="<?=$objMenu->special_1?>" /><br />Special 2: <input type="text" name="special_2" value="<?=$objMenu->special_2?>" /><br />Special 3: <input type="text" name="special_3" value="<?=$objMenu->special_3?>" /></p>

	<p><input type="submit" value="Save" /></p>

</form>


