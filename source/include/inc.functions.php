<?php

function ifsetor( &$value, $alternative = '' ) {
	return isset($value) ? $value : $alternative;
}

function createHtaccessForSite( $site = CMS_SITE_SUBDOMAIN ) {
	$szDocRoot = str_replace('CMS_SITE_SUBDOMAIN', $site, PROJECT_IMPARTIAL_PUBLIC);
	$arrFolders = glob($szDocRoot.'/*');
	foreach ( $arrFolders AS $k => $f ) {
		if ( !is_dir($f) ) {
			unset($arrFolders[$k]);
		}
		else {
			$arrFolders[$k] = basename($f);
		}
	}
	$szHtaccess = str_replace('__FOLDERS__', str_replace('.', '\.', implode('|', $arrFolders)), file_get_contents(PROJECT_ROOT_RESOURCES.'/generic_htaccess.txt'));
	return file_put_contents($szDocRoot.'/.htaccess', $szHtaccess);
}


