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

if ( isset($_POST['subdomain'], $_POST['urls'], $_POST['path']) ) {
	if ( 0 == preg_match('/^[0-9a-z]{2,}(?:\-[0-9a-z]{2,})?$/i', $_POST['subdomain']) || in_array($_POST['subdomain'], $arrSites) ) {
		exit('Invalid subdomain: invalid name or already exists');
	}

	$subdomain = $_POST['subdomain'];
	$db_name = ROOT_SQL_DB.$_POST['subdomain'];
	$db_user = substr(ROOT_SQL_DB.$_POST['subdomain'], 0, 16);
	$db_pass = getDatabasePasswordForCMSSite($_POST['subdomain']);

	// copy file structure
	rcopy(PROJECT_RESOURCES.'default', PROJECT_RESOURCES.$subdomain.'');
	rcopy(PROJECT_RUNTIME.'default', PROJECT_RUNTIME.$subdomain.'');

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

	<p>VHost [ServerAlias]es<br /><input type="text" name="urls" value="www.example.com example.com *.example.com" /></p>

	<p>Root VHost [DocumentRoot]<br /><input type="text" name="path" value="<?php echo SCRIPT_ROOT; ?>" /></p>

	<p><input type="submit" value="Create" />

</fieldset>
</form>


