<?php

require_once('cfg_admin.php');

logincheck();

$objPage = AROImplementation::loadImplementationByID( $_GET['id'] );

/*if ( !empty($_GET['new']) ) {
	$db->insert('menu_items', array(
		'title' => '?',
		'link' => '?',
		'menu_implementation_id' => $objMenu->implementation_id,
	));
	header('Location: ?id='.$objMenu->id.'&edit='.$db->insert_id());
	exit;
}

else*/ if ( isset($_GET['del']) ) {
	$db->delete('page_implementations', 'implementation_id = '.$_GET['del']);
	$db->delete('implementations', 'type = \'page\' AND implementation_id = '.$_GET['del']);
	header('Location: ?id='.$_GET['id']);
	exit;
}

else if ( isset($_POST['sortorder']) ) {
	$arrOrder = explode(',', $_POST['sortorder']);
	foreach ( $arrOrder AS $o => $id ) {
		$db->update('page_implementations', 'o = '.(int)$o, 'parent_page_id = '.$objPage->implementation_id.' AND implementation_id = '.(int)$id);
	}
	header('Location: ?id='.$_GET['id']);
	exit;
}

tpl_header();

echo '<h1>Pages in page: '.$objPage->title.'</h1>';

?>
<p><a href="properties.php?id=<?=$objPage->id?>">Properties</a> | <a href="pages.php?id=<?=$objPage->id?>">Child pages</a> | <a href="new_page.php?id=<?=$objPage->id?>">New page</a> | <a href="?id=<?=$objPage->id?>&sort=1">Sort</a></p>
<?php

echo '<table id="sortable" border="0" cellpadding="3" cellspacing="2" bordercolor="white">';
echo '<thead><tr><th>o</th><th>Title</th><th>URL</th><th></th></tr></thead><tbody>';
foreach ( $objPage->getPages() AS $page ) {
	echo '<tr mid="'.$page->implementation_id.'"'.( empty($_GET['sort']) ? '' : ' bgcolor="#cccccc"' ).'>';
	echo '<td><a href="properties.php?id='.$objPage->id.'/'.$page->id.'">'.$page->o.'</a></td>';
	echo '<td><a href="properties.php?id='.$objPage->id.'/'.$page->id.'">'.$page->title.'</a></td>';
	echo '<td>'.$page->id.' <a href="pages.php?id='.$objPage->id.'/'.$page->id.'">&gt;</a></td>';
	echo '<td><a href="?id='.$objPage->id.'&del='.$page->implementation_id.'">x</a></td>';
	echo '</tr>';
}
echo '</tbody></table>';

if ( empty($_GET['sort']) ) {
	exit;
}

?>
<form method="post" action="" onsubmit="this.elements.sortorder.value=getOrder();">
<input type="hidden" name="sortorder" value="" />
<input type="submit" value="Save order" />
</form>
<script type="text/javascript">
function getOrder() {
	return $$('#sortable tr[mid]').map(function(tr){ return tr.attr('mid'); }).join(',');
}
new Sortables($$('tbody')[0]);
</script>


