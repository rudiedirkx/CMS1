<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['styles'], $_POST['css']) ) {

	$application->setConfig('wysiwyg_styles', $_POST['styles']);
	$application->setConfig('wysiwyg_css', $_POST['css']);

	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

?>
<form action="" method="post">

	<p>Styles:<br /><textarea wrap="off" name="styles" cols="80" rows="8"><?=$application->getConfig('wysiwyg_styles')?></textarea></p>

	<p>CSS:<br /><textarea wrap="off" name="css" cols="80" rows="8"><?=$application->getConfig('wysiwyg_css')?></textarea></p>

	<p><input type="submit" value="Save" /></p>

</form>
