<?php

define( 'CMS_SITE_SUBDOMAIN', basename(dirname($_SERVER['DOCUMENT_ROOT'])) );

require_once('cfg_toplevel.php');

require_once(PROJECT_INCLUDE.'/inc.functions.php');

require_once('cfg_db.php');

$_dbtype = 'db_'.DB_TYPE;
require_once(PROJECT_MODELS.'/db/inc.cls.'.$_dbtype.'.php');
$db = new $_dbtype(SQL_HOST, SITE_SQL_USER, SITE_SQL_PASS, SITE_SQL_DB);
if ( !$db->connected() ) {
	exit('No connection to &site.'."\n");
}

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


