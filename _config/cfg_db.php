<?php

define( 'SQL_HOST',				'localhost' );

define( 'ROOT_SQL_USER',		'cms1' );
define( 'ROOT_SQL_PASS',		'powertothe1cms' );
define( 'ROOT_SQL_DB',			'cms1_' );

define( 'SITE_SQL_USER',		substr(ROOT_SQL_DB.CMS_SITE_SUBDOMAIN, 0, 16) );
define( 'SITE_SQL_PASS',		getDatabasePasswordForCMSSite(CMS_SITE_SUBDOMAIN) );
define( 'SITE_SQL_DB',			ROOT_SQL_DB.CMS_SITE_SUBDOMAIN );


function getDatabasePasswordForCMSSite( $site ) {
	return '1'.strrev($site);
}

