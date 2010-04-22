<?php

define( 'SCRIPT_ROOT',			'/SERVER/www/websites/CMS1' );

define( 'PROJECT_LOGIC',		SCRIPT_ROOT . '/source' );
define( 'PROJECT_INCLUDE',		PROJECT_LOGIC . '/include' );
define( 'PROJECT_SMARTY',		PROJECT_INCLUDE . '/Smarty-2.6.26' );
define( 'PROJECT_MODELS',		PROJECT_LOGIC . '/models' );
define( 'PROJECT_MODULES',		PROJECT_LOGIC . '/modules' );
define( 'PROJECT_RUNTIME',		PROJECT_LOGIC . '/runtime/'.CMS_SITE_SUBDOMAIN );
define( 'PROJECT_RESOURCES',	PROJECT_LOGIC . '/resources/'.CMS_SITE_SUBDOMAIN );
define( 'PROJECT_VIEWS',		PROJECT_RESOURCES . '/views' );
define( 'PROJECT_SNIPPETS',		PROJECT_RESOURCES . '/snippets' );
define( 'PROJECT_PUBLIC',		PROJECT_RESOURCES . '/public_html' );

define( 'PROJECT_RESOURCES_FOLDER', '_images' );
define( 'PROJECT_PUBLIC_RESOURCES', PROJECT_PUBLIC . '/' . PROJECT_RESOURCES_FOLDER );

define( 'DB_TYPE', 'mysqli' );

