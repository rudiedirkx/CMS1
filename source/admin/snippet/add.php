<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkAddSnippetAccess();

if ( isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['content_type']) ) {
	$db->insert('snippet_implementations', array(
		'modified_time' => time(),
		'content_type' => $_POST['content_type']
	));
	$iSnippet = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'snippet',
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'implementation_id' => $iSnippet
	));

	$szViewFile = PROJECT_SNIPPETS.'/'.$iSnippet.'.php';
	file_put_contents($szViewFile, $_POST['content']);

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>Creating new snippet</h1>';

?>
<form method="post" action="">

	<p>ID</p>
	<p><input type="text" name="id" size="20" maxlength="50" value="" /></p>

	<p>Title</p>
	<p><input type="text" name="title" size="80" value="" /></p>

	<p>Content</p>
	<p><textarea name="content" rows="21" cols="100" wrap="off"></textarea></p>

	<p>Content-type</p>
	<p><input type="text" name="content_type" size="30" value="text/html" /></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>

