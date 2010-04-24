<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkAddViewAccess();

if ( isset($_POST['type'], $_POST['title'], $_POST['content']) ) {
	$db->insert('views', array(
		'type' => implode(',', $_POST['type']),
		'title' => $_POST['title'],
		'o' => (int)$db->select_one('views', 'max(o)+1', '1')
	));
	$iViewId = $db->insert_id();
	$szViewFile = PROJECT_VIEWS.'/'.$iViewId.'.php';
	$fp = fopen($szViewFile, 'w');
	fwrite($fp, $_POST['content']);
	fclose($fp);
	header('Location: edit.php?id='.$iViewId);
	exit;
}

tpl_header();

echo '<h1>Creating new view</h1>';

$arrViewTypes = array_map('trim', explode(',', $root->select_one('implementation_types', 'GROUP_CONCAT(view_types SEPARATOR \',\')', 'enabled = 1 AND view_types <> \'\'')));
natcasesort($arrViewTypes);

?>
<form method="post" action="">

	<p>Title<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content<br /><textarea wrap="off" name="content" rows="21" style="width:100%;"></textarea></p>

	<p>Type<br /><div style="width:750px;"><?foreach($arrViewTypes AS $v){ echo '<label style="float:left;width:250px;"><input type="checkbox" name="type[]" value="'.$v.'" /> '.$v.'</label>'; }?></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>

