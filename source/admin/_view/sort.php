<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkEditViewAccess();

if ( isset($_POST['sortorder']) ) {
	foreach ( explode(',', $_POST['sortorder']) AS $o => $vid ) {
		$db->update('views', 'o = '.($o+1), 'id = '.$vid);
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

echo '<table border="1"><thead><tr><th colspan="4">Templates</th></tr></thead><tbody id="tb_views">';
$arrViews = AROView::finder()->findMany('1 ORDER BY o ASC');
foreach ( $arrViews AS $view ) {
	echo '<tr vid="'.$view->id.'"><th>'.$view->o.'</th><td>'.$view->title.'</td><td>&nbsp;</td><td>'.str_replace(',', ', ', $view->type).'</td></tr>';
}
echo '</tbody></table>';

?>

<form method="post" action="" onsubmit="this.elements.sortorder.value=getOrder();">
<input type="hidden" name="sortorder" value="" />
<input type="submit" value="Save order" />
</form>
<script type="text/javascript">
function getOrder() {
	return $$('#tb_views tr[vid]').map(function(tr){ return tr.attr('vid'); }).join(',');
}
doMySortable($('tb_views'));
</script>

<?php

tpl_footer();


