<?php

function exploreFolder( $f_szFolder ) {
	$f_szFolder = str_replace('//', '/', rtrim($f_szFolder, '/'));
//echo 'opening "'.$f_szFolder.'"';
	foreach ( scandir($f_szFolder) AS $szFile ) {
		if ( is_file($f_szFolder.'/'.$szFile) ) {
			if ( 1 or in_array(strrchr($szFile, '.'), array('.html', '.php', '.tpl', '.js', '.css', '.conf', '.htaccess')) ) {
				$m = filemtime($f_szFolder.'/'.$szFile);
				if ( !isset($GLOBALS['g_arrFiles'][$m]) ) {
					$GLOBALS['g_arrFiles'][$m] = array();
				}
				$GLOBALS['g_arrFiles'][$m][] = $f_szFolder.'/'.$szFile;
			}
		}
		else {
			if ( 0 !== strpos($szFile, '.') && !in_array($szFile, $GLOBALS['arrSites']) ) {
				exploreFolder($f_szFolder.'/'.$szFile.'/');
			}
		}
	}
}

require_once('inc.config.php');

require_once('inc.tpl.header.php');

$szStart1 = SCRIPT_ROOT.'/';
$g_arrFiles = array();
exploreFolder($szStart1);
krsort($g_arrFiles);
$g_arrFiles1 = $g_arrFiles;


function filename($file) {
	return substr($file, strlen(SCRIPT_ROOT));
	return $file;
	return substr($file, 0 !== strpos($file, PROJECT_PUBLIC) ? strlen(SCRIPT_SOURCE) : strlen(PROJECT_PUBLIC));
}

?>
<style type="text/css">
th { font-weight:normal; text-align:left; padding-right:7px; border-right:solid 5px #dddddd; }
table table td { padding-left:5px; }
.hd td { font-weight:bold; font-size:24px; padding-left:100px; }
</style>
<?php

echo '<table border="0">';
foreach ( $g_arrFiles1 AS $time => $arrSFiles ) {
	foreach ( $arrSFiles AS $szFile ) {
		echo '<tr><th>'.date('Y-m-d H:i:s', $time).'</th><td>'.filename($szFile).'</td></tr>';
	}
}
echo '</table>';


