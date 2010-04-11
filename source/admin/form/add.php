<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

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

echo '<h1>Creating new form</h1>';

?>
<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" value="" style="border:solid 1px black;border-width:0 0 1px;" /></p> 

	<p>Title:<br /><input type="text" name="title" size="80" value="" /></p>

	<p>Content:<br /><textarea name="content_1" rows="12" cols="100"></textarea></p>

	<p>Send to [e-mail]:<br /><input type="text" name="send_to_email" size="80" value="" /></p>

	<p>Send from [e-mail]:<br /><input type="text" name="send_from_email" size="80" value="" /></p>

	<p>Send from [name]:<br /><input type="text" name="send_from_name" size="80" value="" /></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>
