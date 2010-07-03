<?php

require_once('cfg_admin.php');

logincheck();

$_GET['id'] = trim($_GET['id'], '/');
$dir = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'];

if ( isset($_GET['del']) ) {
	unlink($dir.'/'.$_GET['del']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

else if ( isset($_GET['delete']) && '1' === $_GET['delete'] ) {
	if ( @rmdir($dir) ) {
		header('Location: '.( is_int(strpos($_GET['id'], '/')) ? '/admin/filefolder/edit.php?id='.dirname($_GET['id']) : '/admin/?' ).'&successes[]=Folder deleted!');
		createHtaccessForSite();
	}
	else {
		header('Location: '.$_SERVER['HTTP_REFERER'].'&errors[]=Could not delete!');
	}
	exit;
}

tpl_header();

$rp = realpath($dir.'/');
if ( empty($_GET['id']) or !$rp or in_array(basename($rp), array('admin', '_resources')) ) {
	exit('<ul class="error"><li>Invalid folder</li></ul>');
}
//$arrFiles = glob($rp.'/*');
$arrFiles = scandir($rp);

tpl_notices();

echo '<p><a href="rename.php?id='.$_GET['id'].'">Rename this folder</a> | <a href="?id='.$_GET['id'].'&delete=1">Delete this folder</a></p>';

echo '<h1>Contents of folder: /';
$pre = '';
foreach ( explode('/', $_GET['id']) AS $f ) {
	echo '<a href="?id='.$pre.$f.'">'.$f.'</a>/';
	$pre .= $f.'/';
}
echo '</h1>';

$arrFolders = array();
foreach ( $arrFiles AS $f ) {
	if ( is_dir($f) && !in_array($f, array('.', '..')) ) {
		$arrFolders[] = '<a href="?id='.$_GET['id'].'/'.basename($f).'"><b>'.basename($f).'</b></a>';
	}
}
echo '<p style="background-color:#eee;">Child folders: '.implode(' | ', $arrFolders).'<p>';

echo '<p><a href="upload.php?id='.$_GET['id'].'">Upload file</a> | <a href="add.php?into='.$_GET['id'].'">Create subfolder</a></p>';

echo '<table border="0" cellpadding="5" cellspacing="0">';
foreach ( $arrFiles AS $f ) {
	if ( !is_dir($f) ) {
		$realpath = $dir.'/'.$f;
		$relativepath = '/'.$_GET['id'].'/'.$f;
		$img = getImageSize($realpath);
		echo '<tr><td valign="middle" align="center">'.( $img ? '<a href="'.$relativepath.'"><img src="'.$relativepath.'" style="max-width:100px; max-height:100px;" /></a>' : '&nbsp;' ).'</td><td class="filename"><a href="edit_file.php?id='.$_GET['id'].'&file='.$f.'">'.$f.'</a></td><td>'.ceil(filesize($realpath)/1024).' KB</td><td><a href="?id='.$_GET['id'].'&del='.urlencode($f).'">x</a></td>'.( $img ? '</td><td>&nbsp;</td><td><a href="../resize_image.php?image='.$relativepath.'">'.$img[0].' * '.$img[1].'</a>' : '<td colspan="2"></td>' ).'</tr>';
	}
}
echo '</table>';



tpl_footer();


