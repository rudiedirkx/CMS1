<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['id'], $_POST['into']) ) {
	$szFolder = trim(trim($_POST['into'], './').'/'.trim(strtr($_POST['id'], array('.' => '', ' ' => '', '/' => '')), './'), './');
	mkdir($_SERVER['DOCUMENT_ROOT'].'/'.$szFolder);
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/'.$szFolder.'/.htaccess', 'SetHandler This_is_a_security_line_DO_NOT_REMOVE');

	createHtaccessForSite();

	header('Location: edit.php?id='.$szFolder);
	exit;
}

tpl_header();

echo '<h1>Creating new file folder</h1>';

?>
<form method="post" action="">

	<p>URL:<br />/<?=isset($_GET['into']) ? trim($_GET['into'], '/').'/' : ''?><input type="text" name="id" value="" maxlength="50" style="border:solid 1px black;border-width:0 0 1px;" /></p> 

	<p><input type="submit" value="Save" /></p>

	<input type="hidden" name="into" value="<?=isset($_GET['into']) ? trim($_GET['into'], '/') : '.'?>" />

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>

<?php

tpl_footer();

