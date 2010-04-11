<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content']) ) {
	$db->insert('shop_implementations', array(
		'content_1' => $_POST['content'],
		'content_2' => ''
	));
	$iShop = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'shop',
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'implementation_id' => $iShop
	));

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

echo '<h1>Adding shop</h1>';

?>
<form method="post" action="">

<p>ID:<br /><input type="text" name="id" value="" /></p>

<p>Title:<br /><input type="text" name="title" value="" size="60" /></p>

<p>Content 1:<br /><textarea cols="60" rows="12" name="content"></textarea></p>

<p><input type="submit" value="Save" /></p>

</form>


