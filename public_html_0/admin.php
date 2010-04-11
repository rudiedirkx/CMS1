<?php

define( 'SQL_DB', '_' );
require_once('cfg_toplevel.php');
$_dbtype = 'db_'.DB_TYPE;

require_once(PROJECT_INCLUDE.'/inc.functions.php');
require_once('cfg_db.php');
require_once(PROJECT_MODELS.'/db/inc.cls.'.$_dbtype.'.php');

$root = new $_dbtype(SQL_HOST, SQL_USER, SQL_PASS, $_db);

$arrSites = array_filter(array_map('basename', glob(dirname(PROJECT_RESOURCES).'/*', GLOB_ONLYDIR)), create_function('$d', 'return 0 !== strpos($d, "__");'));

if ( isset($_GET['users']) && in_array($_GET['users'], $arrSites) ) {
	$arrUsers = $root->select('cms_users', 'sitename = \''.$_GET['users'].'\'');
	echo '<pre>';
	echo implode("\n", array_map(create_function('$u', 'return "[".str_repeat(" ", 3-strlen((string)$u->id)).$u->id."] ".$u->name." (".$u->email.")";'), $arrUsers));
	exit;
}

echo '<table border="1" cellspacing="0" cellpadding="5">';
echo '<tr><th colspan="4">Sites</th></tr>';
echo '<tr><td>Name</td><td>Users</td><td>Size</td><td>Data</td></tr>';
foreach ( $arrSites AS $szSitename ) {
	$szPath = dirname(PROJECT_RESOURCES).'/'.$szSitename;
	echo '<tr>';
	echo '	<th><a href="http://'.$szSitename.'.cms.hotblocks.nl/">'.$szSitename.'</a></th>';
	echo '	<td><a href="?users='.$szSitename.'">'.$root->count('cms_users', 'sitename = \''.$szSitename.'\'').' users</a></td>';
	echo '	<td>~ '.number_format(mfilesize($szPath)/1024, 1, '.', ',').' KB</td>';
	echo '	<td>'.$root->count_rows('SHOW TABLES IN `'.$_db.$szSitename.'`').' tables</td>';
	echo '</tr>';
}
echo '</table>';

function mfilesize( $f_szDir ) {
	$size = 0;
	foreach ( scandir($f_szDir) AS $file ) {
		if ( '.' != $file && '..' != $file ) {
			$path = $f_szDir.'/'.$file;
			if ( is_dir($path) ) {
				$size += mfilesize($path);
			}
			else {
				$size += filesize($path);
			}
		}
	}
	return $size;
}


