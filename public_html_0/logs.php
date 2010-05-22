<?php

require_once('inc.config.php');

require_once('inc.tpl.header.php');

$arrSqlQuery = '';
foreach ( $arrSites AS $szSitename ) {
	$arrSqlQuery[] = '(SELECT \''.$szSitename.'\' AS site, action, table_name, FROM_UNIXTIME(`utc`) AS datetime, (SELECT username FROM cms_users WHERE id = logs.user_id) AS user, extra FROM '.ROOT_SQL_DB.$szSitename.'.logs)';
}
$szSqlQuery = implode(' UNION ', $arrSqlQuery).' ORDER BY datetime DESC LIMIT 0, 200';

$arrLogs = $root->fetch($szSqlQuery);
echo $root->error;
//var_dump($arrLogs);

?>
<style>tr:first-child td, tr td:nth-child(2) { text-transform:uppercase; font-weight:bold; }</style>
<?php

array_unshift($arrLogs, array_keys((array)$arrLogs[0]));
echo '<table border="1" cellpadding="4" cellspacing="0"><tr>'.implode('</tr><tr>', array_map(create_function('$l', 'return "<td>".implode("</td><td>", (array)$l)."</td>";'), $arrLogs)).'</tr></table>';


