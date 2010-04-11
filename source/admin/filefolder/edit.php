<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

if ( isset($_GET['del']) ) {
	unlink($_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'].'/'.$_GET['del']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

echo '<h1>Contents of folder: '.$_GET['id'].'</h1>';

$rp = realpath($_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'].'/');
if ( empty($_GET['id']) or !$rp or in_array(basename($rp), array('admin', '_resources')) ) {
	exit('Invalid folder');
}
$arrFiles = glob($rp.'/*');

$arrFolders = array();
foreach ( $arrFiles AS $f ) {
	if ( is_dir($f) ) {
		$arrFolders[] = '<a href="?id='.$_GET['id'].'/'.basename($f).'">'.basename($f).'</a>';
	}
}
echo '<p>Child folders: '.implode(' | ', $arrFolders).'<p>';

echo '<p><a href="upload.php?id='.$_GET['id'].'">Upload file</a> | <a href="add.php?into='.$_GET['id'].'">Create folder</a></p>';

echo '<table border="0" cellpadding="5" cellspacing="0">';
foreach ( $arrFiles AS $f ) {
	if ( !is_dir($f) ) {
		echo '<tr><td><a href="/'.$_GET['id'].'/'.basename($f).'"><img src="/'.$_GET['id'].'/'.basename($f).'" width="60" height="60" /></a></td><td><a href="edit_file.php?id='.$_GET['id'].'&file='.basename($f).'">'.basename($f).'</a></td><td>'.ceil(filesize($f)/1024).' KB</td><td><a href="?id='.$_GET['id'].'&del='.urlencode(basename($f)).'">x</a></td></tr>';
	}
}
echo '</table>';

