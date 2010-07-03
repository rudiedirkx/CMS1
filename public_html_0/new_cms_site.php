<?php

require_once('inc.config.php');

function rcopy( $source, $dest, $folderPermission = 0777 ){ 
	$result = false;
	if ( is_dir($source) ) {
		if ( !is_dir($dest) ) {
			@mkdir($dest, $folderPermission);
			chmod($dest, $folderPermission);
		}
		$result = file_exists($dest) && is_dir($dest);

		if ( substr($source, -1) != '/') { $source=$source."/"; }
		if ( substr($dest, -1) != '/') { $dest=$dest."/"; }

		$dirHandle = opendir($source);
		while ( $file = readdir($dirHandle) ) {
			if ( $file != '.' && $file != '..' ) {
				if ( is_dir($source.$file) ) {
					$result = rcopy( $source.$file, $dest.$file, $folderPermission );
				}
				else if ( '.htaccess' == $file )  {
					$result = copy($source.$file, $dest.$file);
				}
			}
		}
		closedir($dirHandle);
	}
    return $result;
}

function tmp_debug($var) {
	var_dump($var);
}

if ( isset($_GET['vhost']) ) {
	header('Content-type: text/plain');
	exit(file_get_contents(SCRIPT_ROOT.'/_config/vhosts/'.ROOT_SQL_DB.$_GET['vhost'].'.conf'));
}

else if ( isset($_POST['subdomain'], $_POST['urls']) ) {
	$subdomain = $_POST['subdomain'];
	if ( 'zzzzz' == $subdomain || 0 == preg_match('/^[0-9a-z]+(?:\-[0-9a-z]+)?$/i', $subdomain) || 3 > strlen($subdomain) || in_array($subdomain, $arrSites) ) {
		exit('Invalid subdomain: invalid name or already exists');
	}

echo '<pre>';

	$db_name = ROOT_SQL_DB.$_POST['subdomain'];
	$db_user = substr(ROOT_SQL_DB.$_POST['subdomain'], 0, 16);
	$db_pass = getDatabasePasswordForCMSSite($_POST['subdomain']);

	// create VHost
	$szVHost = strtr(file_get_contents(PROJECT_ROOT_RESOURCES.'/generic_vhost.conf'), array(
		'__SERVERNAME__'		=> $subdomain.'.'.$_SERVER['HTTP_HOST'],
		'__SERVERALIASES__'		=> $_POST['urls'],
		'__DOCROOT__'			=> str_replace('CMS_SITE_SUBDOMAIN', $subdomain, PROJECT_IMPARTIAL_PUBLIC),
	));
	var_dump(file_put_contents(SCRIPT_ROOT.'/_config/vhosts/'.ROOT_SQL_DB.$subdomain.'.conf', $szVHost));

	// copy file structure
	rcopy(PROJECT_ROOT_RESOURCES.'/default', PROJECT_RESOURCES.$subdomain.'');
	rcopy(PROJECT_ROOT_RUNTIME.'/default', PROJECT_RUNTIME.$subdomain.'');

	createHtaccessForSite($subdomain);

	// create database
	tmp_debug($root->query('CREATE DATABASE `'.$db_name.'`;'));
echo $root->error."\n";

	// grant user database rights
	tmp_debug($root->query("GRANT SELECT , INSERT , UPDATE , DELETE ON  `".str_replace('_', '\_', $db_name)."` . * TO  '".$db_user."'@'localhost' IDENTIFIED BY '".$db_pass."';"));
echo $root->error."\n";

	// connect with new database
	$db = new $_dbtype(SQL_HOST, ROOT_SQL_USER, ROOT_SQL_PASS, $db_name);

	// copy all tables, without data
	foreach ( $root->fetch('SHOW TABLES IN `'.ROOT_SQL_DB.'default`;') AS $table ) {
		$table = reset($table);
		$create = $root->fetch('SHOW CREATE TABLE `'.ROOT_SQL_DB.'default`.`'.$table.'`');
		$create = $create[0]->{'Create Table'};
		tmp_debug(array('table '.$table, $db->query($create)));
echo $db->error."\n";
	}

echo '</pre>';
echo '<p><a href="?vhost='.$subdomain.'">View VHost</a></p>';

	exit;
}

require_once('inc.tpl.header.php');

?>
<style>
input:not([type=submit]) { width:500px; }
</style>
<form action="" method="post">
<fieldset>

	<legend><b>New CMS site details</b></legend>

	<p>Subdomain<br /><input type="text" name="subdomain" value="example" maxlength="<?php echo 1016-strlen(ROOT_SQL_DB); ?>" /></p>

	<p>VHost [ServerAlias]es<br /><input type="text" name="urls" value="example.com *.example.com" /></p>

	<p><input type="submit" value="Create" />

</fieldset>
</form>


