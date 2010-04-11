<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$arrLogs = $db->select('logs', '1 ORDER BY `utc` DESC');

function getUsername($id) {
	static $cache = array();
	if ( empty($cache[$id]) ) {
		$cache[$id] = $GLOBALS['root']->select_one('cms_users', 'username', 'id = '.(int)$id);
	}
	return $cache[$id];
}

function getObjectName($table, $id) {
	static $cache = array();
	if ( empty($cache[$table][$id]) ) {
		$cache[$table][$id] = $GLOBALS['db']->select_one($table, 'title', 'id = '.(int)$id);
	}
	return $cache[$table][$id];
}

echo '<table border="1" cellpadding="5" cellspacing="1">';
foreach ( $arrLogs AS $log ) {
	echo '<tr>';
	echo '<td>'.$log->action.'</td>';
	echo '<td>'.getUsername($log->user_id).'</td>';
	echo '<td>'.getObjectName($log->table_name, $log->pk_value).'</td>';
	echo '<td align="right">'.date('D Y-m-d H:i:s', $log->utc).'</td>';
	echo '</tr>';
}
echo '</table>';


