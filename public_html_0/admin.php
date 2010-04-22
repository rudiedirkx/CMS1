<?php

require_once('inc.config.php');

require_once('inc.tpl.header.php');

if ( isset($_GET['users']) && in_array($_GET['users'], $arrSites) ) {
	$arrUsers = $root->select('cms_users', 'sitename = \''.$_GET['users'].'\'');
	echo '<pre>';
	echo implode("\n", array_map(create_function('$u', 'return "[".str_repeat(" ", 3-strlen((string)$u->id)).$u->id."] ".$u->name." (".$u->email.")";'), $arrUsers));
	exit;
}

echo '<table border="1" cellspacing="0" cellpadding="5">';
echo '<tr><th colspan="5">Sites</th></tr>';
echo '<tr><th>Name</th><th>Users</th><th>Files</th><th colspan="2">Database</th></tr>';
foreach ( $arrSites AS $szSitename ) {
	$szPath1 = PROJECT_RESOURCES.$szSitename;
	$szPath2 = PROJECT_RUNTIME.$szSitename;
	echo '<tr>';
	echo '	<th><a href="http://'.$szSitename.'.'.$_SERVER['HTTP_HOST'].'/">'.$szSitename.'</a></th>';
	echo '	<td><a href="?users='.$szSitename.'">'.$root->count('cms_users', 'sitename = \''.$szSitename.'\'').' users</a></td>';
	echo '	<td>~ '.number_format(mfilesize($szPath1)/1024/1024+mfilesize($szPath2)/1024/1024, 1, '.', ' ').' MB</td>';
	echo '	<td>'.$root->count_rows('SHOW TABLES IN `'.ROOT_SQL_DB.$szSitename.'`').' tables</td>';
	echo '	<td>~ '.number_format((int)$root->select_one('information_schema.TABLES', 'SUM(data_length+index_length)', "table_schema = 'cms1_default'")/1024, 1, '.', ' ').' KB</td>';
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


