<?php

require_once('inc.config.php');

if ( isset($_POST['commands']) ) {

	foreach ( $arrSites AS $site ) {

		$db = new $_dbtype(SQL_HOST, ROOT_SQL_USER, ROOT_SQL_PASS, ROOT_SQL_DB.$site);
		foreach ( $_POST['commands'] AS $cmd ) {
			if ( $cmd ) {
				$r = $db->query($cmd);
				echo '<pre class="'.( $r ? 'success' : 'fail' ).'">'.$cmd.'</pre>';
				if ( !$r ) {
					echo '<div class="error">'.$db->error.'</div>';
				}
			}
		}

		$db->close();
		$db = null;

		echo '<hr />';

	}

}

require_once('inc.tpl.header.php');

?>
<style type="text/css">
textarea { display:block; clear:both; margin-bottom:10px; width:800px; height:80px; }
input { margin:10px; padding:7px 20px; }
pre { border:solid 2px green; background-color:#afa; padding:10px; margin:10px 0 4px; }
pre.fail { border-color:#d00; background-color:#faa; }
div.error { margin-bottom:30px; }
</style>

<p>Execute into sites: <b><?=implode('</b>, <b>', $arrSites)?></b></p>

<form method="post" action="">

<input type="submit" />

<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>
<textarea name="commands[]"></textarea>

<input type="submit" />

</form>


