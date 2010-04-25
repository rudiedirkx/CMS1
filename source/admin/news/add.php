<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1']) ) {
	$db->insert('news_implementations', array(
		'content_1' => $_POST['content_1'],
		'content_2' => '',
	));
	$iNewsId = $db->insert_id();

	// Update implementation
	$db->insert('implementations', array(
		'id' => $_POST['id'],
		'type' => 'news',
		'implementation_id' => $iNewsId,
		'title' => $_POST['title']
	));

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>New news collection</h1>';

?>
<form method="post" action="">

	<p>ID:<br /><input type="text" name="id" maxlength="50" size="20" value="" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="11" cols="80"></textarea></p>

	<p><input type="submit" value="Save" /></p>

</form>


