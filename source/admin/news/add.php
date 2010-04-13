<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

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

echo '<h1>New news collection</h1>';

?>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="">

	<p>ID:<br /><input type="text" name="id" size="20" value="" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="11" cols="80"></textarea></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>

