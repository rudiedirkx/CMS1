<?php

define( 'CMS_SITE_SUBDOMAIN', '' );

require_once('cfg_toplevel.php');

require_once(PROJECT_INCLUDE.'/inc.functions.php');

require_once('cfg_db.php');

$_dbtype = 'db_'.DB_TYPE;
require_once(PROJECT_MODELS.'/db/inc.cls.'.$_dbtype.'.php');
$root = new $_dbtype(SQL_HOST, ROOT_SQL_USER, ROOT_SQL_PASS, ROOT_SQL_DB);
if ( !$root->connected() ) {
	exit('No connection to &root.'."\n");
}

$arrSites = array_filter(array_map('basename', glob(PROJECT_RESOURCES.'/*', GLOB_ONLYDIR)), create_function('$d', 'return 0 !== strpos($d, "__");'));


