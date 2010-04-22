<?php

require_once('cfg_complete.php');

require_once(PROJECT_INCLUDE.'/inc.cls.application.php');
$application = new Application(SITE_SQL_DB);

require_once(PROJECT_INCLUDE.'/inc.cls.smartytpl.php');

/** dispatcher **/
if ( 1 < count($x = explode('?', $_SERVER['REQUEST_URI'], 2)) ) {
	$_SERVER['REQUEST_URI'] = $x[0];
	parse_str($x[1], $_GET);
}
$g_szRequestUri = $_SERVER['REQUEST_URI'];
$g_szUseRequestUri = $g_szRequestUri;
$arrRoutes = array_merge($db->select('routes', 'enabled = \'1\' ORDER BY o ASC'), array(new SimpleArrayObject(array('use_new_path' => '1', 'forward' => '0', 'path_from' => '/', 'path_to' => '/index'))));
//print_r($arrRoutes);exit;
foreach ( $arrRoutes AS $route ) {
	$szFrom = $route->path_from;
	$szTo = $route->path_to;
	$pattern = strtr($szFrom, array('#' => '(\d+)', '*' => '([^/]*)', '%' => '(.*?)'));
//echo $pattern." :: ";
	$m = preg_match('#^'.$pattern.'$#i', $g_szRequestUri, $parrMatches);
	if ( 0 < $m ) {
		$args = $parrMatches;
		$args[0] = preg_replace('/\$(\d+)/', '%$1$s', $szTo);
		$g_szUseRequestUri = call_user_func_array('sprintf', $args);
//echo $g_szUseRequestUri;
		if ( $route->forward ) {
			header('Location: '.$g_szUseRequestUri);
			exit;
		}
		else if ( $route->use_new_path ) {
			$g_szRequestUri = $g_szUseRequestUri;
		}
		break;
	}
}
//echo '[['.$g_szUseRequestUri.']]';
$arrLoad = explode('/', trim($g_szUseRequestUri, '/'));

$szModuleID = array_shift($arrLoad);
/** dispatcher **/

try {
	$objImplementation = AROImplementation::loadImplementationByID( $szModuleID, $arrLoad );
}
catch ( AROException $ex ) {
	exit('No object `'.$szModuleID.'` found.');
}

$page = $objImplementation;

try {
	$mvParsed = $objImplementation->parse($pszViewType);
} catch (Exception $ex) {
	exit('Error in parsing page: '.$ex->getMessage().'');
}
if ( false === $mvParsed ) {
	exit('No view found of type \''.$pszViewType.'\'.');
}
else if ( -2 === $mvParsed ) {
	exit('Page not found');
}


