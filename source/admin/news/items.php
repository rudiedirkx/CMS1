<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_GET['del']) ) {
	$db->delete('news_items', 'id = '.$_GET['del'].' AND menu_implementation_id = '.$objNews->implementation_id);
	header('Location: ?id='.$objNews->id);
	exit;
}

tpl_header();

?>
<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="items.php?id=<?=$_GET['id']?>">Items</a> | <a href="new_item.php?id=<?=$_GET['id']?>">New item</a></p>
<?php

echo '<h1>Existing items in: &quot;'.$objNews->title.'&quot;</h1>';

$arrNews = $objNews->getNewsItems();

echo '<table border="1" cellpadding="4" cellspacing="0">';
echo '<tr><th>ID</th><th>Title</th><th>Type</th><th>Created</th></tr>';
foreach ( $arrNews AS $item ) {
	echo '<tr>';
	echo '<td><a href="edit_item.php?id='.$_GET['id'].'&item='.$item->id.'">'.$item->id.'</a></td>';
	echo '<td><a href="edit_item.php?id='.$_GET['id'].'&item='.$item->id.'">'.$item->title.'</a></td>';
	echo '<td>'.ucfirst($item->type).'</td>';
	echo '<td>'.date('Y-m-d H:i:s', $item->created).'</td>';
	echo '</tr>';
}
echo '</table>';


