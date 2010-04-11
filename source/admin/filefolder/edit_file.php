<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$szPreAmp = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'].'/';
if ( !file_exists($szPreAmp.$_GET['file']) ) {
	exit('Invalid file!');
}

if ( isset($_GET['id'], $_GET['file'], $_POST['filename']) ) {
	rename($szPreAmp.$_GET['file'], $szPreAmp.$_POST['filename']);
	if ( !empty($_FILES['newfile']) && empty($_FILES['newfile']['error']) ) {
		move_uploaded_file($_FILES['newfile']['tmp_name'], $szPreAmp.$_POST['filename']);
	}
	header('Location: edit.php?id='.$_GET['id']);
	exit;
}

echo '<h1>Change: &quot;'.$_GET['file'].'&quot;</h1>';

?>
<form action="" method="post" enctype="multipart/form-data">

	<p>Filename:<br /><input type="text" name="filename" size="80" value="<?=$_GET['file']?>" /></p>

	<p>Upload replacement:<br /><input type="file" name="newfile" /></p>

	<p><input type="submit" value="Save" /></p>

</form>