<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['max_depth']) ) {
	$db->insert('menu_implementations', array(
		'max_depth' => (int)$_POST['max_depth'],
		'content_1' => $_POST['content_1']
	));
	$iMenuId = $db->insert_Id();

	// Update implementation
	$db->insert('implementations', array(
		'id' => $_POST['id'],
		'type' => 'menu',
		'implementation_id' => $iMenuId,
		'title' => $_POST['title']
	));

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>New menu</h1>';

?>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="">

	<p>ID:<br /><input type="text" name="id" size="20" maxlength="50" value="" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="11" cols="80"></textarea></p>

	<p>Max depth:<br /><input type="text" name="max_depth" size="10" value="1" /></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>

