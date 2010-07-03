<?php

require_once('cfg_admin.php');

logincheck();

$_GET['id'] = trim($_GET['id'], '/');
$dir = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'];
$bIsSubfolder = is_int(strpos($_GET['id'], '/'));

if ( isset($_POST['new_id']) ) {
	$ndir = dirname($dir).'/'.$_POST['new_id'];
//var_dump(file_exists($dir));
exit($dir.'<br />'.$ndir);
	if ( rename($dir, $ndir) ) {
		header('Location: /admin/filefolder/edit.php?id='.( $bIsSubfolder ? dirname($_GET['id']).'/'.$_POST['new_id'] : $_POST['new_id'] ).'&successes[]=Folder renamed to '.$_POST['new_id'].'!');
		createHtaccessForSite();
	}
	else {
		header('Location: /admin/filefolder/edit.php?id='.$_GET['id'].'&errors[]=Could not rename!');
	}
	exit;
}

tpl_header();

$rp = realpath($dir.'/');
if ( empty($_GET['id']) or !$rp or in_array(basename($rp), array('admin', '_resources')) ) {
	exit('<ul class="error"><li>Invalid folder</li></ul>');
}
$arrFiles = glob($rp.'/*');

echo '<h1>Folder: /'.$_GET['id'].'/</h1>';

?>
<form method="post">

	<p>Rename to:<br />/<?=$bIsSubfolder ? dirname($_GET['id']).'/' : ''; ?><input type="text" name="new_id" value="<?=basename($_GET['id'])?>" /></p>

	<p><input type="submit" value="Rename!" />

</form>

<?php

tpl_footer();

