<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {
	$db->insert('page_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
	));
	$iPage = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'page',
		'id' => strtolower(strtr($_POST['id'], array(' ' => '-'))),
		'title' => $_POST['title'],
		'implementation_id' => $iPage
	));

	$g_objAdmin->addLog('insert', 'page_implementations', $iPage);

	header('Location: ../');
	exit;
}

echo '<h1>Creating new web page</h1>';

?>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" value="" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"></textarea></p>

	<p>Title 2:<br /><input type="text" name="title_2" size="80" value="" /></p>

	<p>Content 2:<br /><textarea id="content_2" name="content_2" rows="12" cols="100"></textarea></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>

