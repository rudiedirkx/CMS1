<?php

require_once('cfg_toplevel.php');

require_once(PROJECT_INCLUDE.'/inc.functions.php');

require_once('cfg_db.php');

$_dbtype = 'db_'.DB_TYPE;
require_once(PROJECT_MODELS.'/db/inc.cls.'.$_dbtype.'.php');
$db = new $_dbtype(SQL_HOST, SQL_USER, SQL_PASS, $_db.SQL_DB);
$root = new $_dbtype(SQL_HOST, SQL_USER, SQL_PASS, $_db);

require_once(PROJECT_MODELS.'/inc.cls.activerecordobject.php');
ActiveRecordObject::setDbObject($db);

function __autoload($class) {
	if ( file_exists(PROJECT_MODELS.'/inc.cls.'.strtolower($class).'.php') ) {
		require_once(PROJECT_MODELS.'/inc.cls.'.strtolower($class).'.php');
	}
	else if ( file_exists(PROJECT_MODELS.'/db/inc.cls.'.strtolower($class).'.php') ) {
		require_once(PROJECT_MODELS.'/db/inc.cls.'.strtolower($class).'.php');
	}
	else if ( file_exists(PROJECT_INCLUDE.'/inc.cls.'.strtolower($class).'.php') ) {
		require_once(PROJECT_INCLUDE.'/inc.cls.'.strtolower($class).'.php');
	}
	else {
		exit('Class `'.$class.'` can not be loaded.');
	}
}


