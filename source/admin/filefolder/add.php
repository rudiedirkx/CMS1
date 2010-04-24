<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

if ( isset($_POST['id'], $_POST['into']) ) {
	$szFolder = trim(trim($_POST['into'], './').'/'.trim(strtr($_POST['id'], array('.' => '', ' ' => '', '/' => '')), './'), './');
	mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$szFolder);

	$arrFolders = glob($_SERVER['DOCUMENT_ROOT'].'/*');
	foreach ( $arrFolders AS $k => $f ) {
		if ( !is_dir($f) ) {
			unset($arrFolders[$k]);
		}
		else {
			$arrFolders[$k] = basename($f);
		}
	}
	$szHtaccess = str_replace('__FOLDERS__', str_replace('.', '\.', implode('|', $arrFolders)), file_get_contents(dirname(PROJECT_RESOURCES).'/generic_htaccess.txt'));
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/.htaccess', $szHtaccess);

	header('Location: edit.php?id='.$szFolder);
	exit;
}

echo '<h1>Creating new file folder</h1>';

?>
<form method="post" action="">
	<input type="hidden" name="into" value="<?=isset($_GET['into']) ? trim($_GET['into'], '/') : '.'?>" />

	<p>URL:<br />/<?=isset($_GET['into']) ? trim($_GET['into'], '/').'/' : ''?><input type="text" name="id" value="" maxlength="50" style="border:solid 1px black;border-width:0 0 1px;" /></p> 

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>
