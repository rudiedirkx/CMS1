<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

if ( isset($_FILES['file']) ) {
	move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'].'/'.str_replace('.php', '', $_FILES['file']['name']));
	header('Location: edit.php?id='.$_GET['id']);
	exit;
}

echo '<h1>Upload file to folder: '.$_GET['id'].'</h1>';

?>
<form method="post" action="" enctype="multipart/form-data">

	<p>File:<br /><input type="file" name="file" /></p>

	<p><input type="submit" value="Upload" /></p>

</form>