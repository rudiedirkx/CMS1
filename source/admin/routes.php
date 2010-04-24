<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['from'], $_POST['to']) ) {
	$arrRoute = array(
		'path_from' => $_POST['from'],
		'path_to' => $_POST['to'],
	);
	if ( isset($_GET['route']) ) {
		$db->update('routes', $arrRoute, 'id = '.(int)$_GET['route']);
	}
	else {
		$db->insert('routes', $arrRoute);
	}
	echo $db->error;
	header('Location: routes.php');
	exit;
}
else if ( isset($_GET['route']) ) {
	$arrRoutes = $db->select('routes', 'id = '.(int)$_GET['route']);
	if ( !$arrRoutes ) {
		exit('Invalid ID');
	}
	$objRoute = reset($arrRoutes);
	echo '<form method="post" action="?route='.$_GET['route'].'">';
	echo '<p>From:<br /><input type="text" name="from" size="60" value="'.$objRoute->path_from.'" /></p>';
	echo '<p>To:<br /><input type="text" name="to" size="60" value="'.$objRoute->path_to.'" /></p>';
	echo '<p><input type="submit" value="Save" /></p>';
	echo '</form>';
	exit;
}
else if ( isset($_GET['toggle'], $_GET['field']) && in_array($_GET['field'], array('enabled','forward')) ) {
	$db->update('routes', $_GET['field'].' = IF('.$_GET['field'].'=\'1\', \'0\', \'1\')', 'id = '.(int)$_GET['toggle']);
	echo $db->error;
	header('Location: routes.php');
	exit;
}

tpl_header();

$arrRoutes = $db->select('routes', '1 ORDER BY o ASC');

echo '<form method="post" action=""><table border="1" cellpadding="5" cellspacing="1" bordercolor="white">';
echo '<thead><tr><th width="10">o</th><th width="20">ID</th><th>From path</th><th>To path</th><th width="20">Forward?</th><th width="20">Enabled?</th></tr></thead><tbody id="tbody">';
foreach ( $arrRoutes AS $route ) {
	echo '<tr bgcolor="#cccccc">';
	echo '<td>'.$route->o.'</td>';
	echo '<td><a href="?route='.$route->id.'">'.$route->id.'</a></td>';
	echo '<td>'.$route->path_from.'</td>';
	echo '<td>'.$route->path_to.'</td>';
	echo '<td><a href="?field=forward&toggle='.$route->id.'">'.( $route->forward ? 'Y' : 'N' ).'</a></td>';
	echo '<td><a href="?field=enabled&toggle='.$route->id.'">'.( $route->enabled ? 'Y' : 'N' ).'</a></td>';
	echo '</tr>';
}
echo '</tbody><tfoot><tr>';
echo '<td colspan="3"><input type="text" name="from" size="30" value="" /></td>';
echo '<td colspan="3"><input type="text" name="to" size="40" value="" /></td>';
echo '<td><input type="submit" value="Save" /></td>';
echo '</tr></tfoot>';
echo '</table></form>';

?>

<form method="post" action="" onsubmit="this.elements.sortorder.value=getOrder();">
<input type="hidden" name="sortorder" value="" />
<input type="submit" value="Save order" />
</form>
<script type="text/javascript">
function getOrder() {
	return $$('#sortable tr[mid]').map(function(tr){ return tr.attr('mid'); }).join(',');
}
new Sortables($$('tbody')[0], {ghost:false});
</script>


