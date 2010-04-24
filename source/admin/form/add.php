<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1']) ) {
	$db->insert('form_implementations', array(
		'content_1' => $_POST['content_1'],
		'send_to_email' => $_POST['send_to_email'],
		'send_from_email' => $_POST['send_from_email'],
		'send_from_name' => $_POST['send_from_name'],
	));
	$iForm = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'form',
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'implementation_id' => $iForm
	));

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>Creating new form</h1>';

?>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" maxlength="50" value="" style="border:solid 1px black;border-width:0 0 1px;" /></p> 

	<p>Title:<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"></textarea></p>

	<p>Send to [e-mail]:<br /><input type="text" name="send_to_email" size="80" value="" /></p>

	<p>Send from [e-mail]:<br /><input type="text" name="send_from_email" size="80" value="" /></p>

	<p>Send from [name]:<br /><input type="text" name="send_from_name" size="80" value="" /></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>


