<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1']) ) {
	$db->insert('guestbook_implementations', array(
		'content_1' => $_POST['content_1'],
		'content_2' => ''
	));
	$iGB = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'guestbook',
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'implementation_id' => $iGB
	));

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

echo '<h1>Creating new guestbook</h1>';

?>
<form method="post" action="">

	<p>ID</p>
	<p><input type="text" name="id" size="20" value="" /></p>

	<p>Title</p>
	<p><input type="text" name="title" size="80" value="" /></p>

	<p>Content</p>
	<p><textarea name="content_1" rows="12" cols="100"></textarea></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>

