<?php

require_once('cfg_admin.php');

logincheck();

$objMenu = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( !empty($_GET['new']) ) {
	$db->insert('menu_items', array(
		'title' => '?',
		'link' => '?',
		'menu_implementation_id' => $objMenu->implementation_id,
	));
	header('Location: ?id='.$objMenu->id.'&edit='.$db->insert_id());
	exit;
}

else if ( isset($_GET['del']) ) {
	function deleteMenuItem( $id ) {
		$item = is_object($id) ? $id : AROMenuItem::finder()->byPK($id);
		foreach ( $item->getMenuItems() AS $sitem ) {
			deleteMenuItem($sitem);
		}
		$GLOBALS['db']->delete('menu_items', 'id = '.$item->id);
	}
	deleteMenuItem($_GET['del']);
	header('Location: ?id='.$objMenu->id);
	exit;
}

else if ( isset($_POST['sortorder']) ) {

	function saveOrder($ids, $level = 1) {
		$arrIDs = explode('['.$level.']', $ids);
		foreach ( $arrIDs AS $o => $id ) {
			$GLOBALS['db']->update('menu_items', 'o = '.$o, 'id = '.(int)$id);
			if ( is_int(strpos($id, '['.($level+1).']')) ) {
				$rest = substr($id, strlen((string)(int)$id)+strlen('['.($level+1).']'));
				saveOrder($rest, $level+1);
			}
		}
	}
	saveOrder($_POST['sortorder']);

	header('Location: ?id='.$_GET['id']);
	exit;
}

tpl_header();

echo '<h1>Menu items in: '.$objMenu->title.'</h1>';

?>
<script type="text/javascript" src="/admin/_resources/mootools_1_11.js"></script>
<style type="text/css">
#sortable li { border:solid 1px white; border-width:1px 0; background-color:#dddddd; }
</style>

<p><a href="properties.php?id=<?=$objMenu->id?>">Properties</a> | <a href="items.php?id=<?=$objMenu->id?>">Items</a> | <a href="new_item.php?id=<?=$objMenu->id?>">New item</a> | <a href="?id=<?=$objMenu->id?>&sort=1">Sort</a></p>
<?php

printMenuItems($objMenu->getMenuItems(), true);
function printMenuItems( $f_arrItems, $f_bTop = false ) {
	echo '<ul'.( $f_bTop && !empty($_GET['sort']) ? ' id="sortable"' : '' ).'>';
	foreach ( $f_arrItems AS $item ) {
		echo '<li'.( empty($_GET['sort']) ? '' : ' mid="'.$item->id.'"' ).'>';
		echo '<div>[<a style="color:black;text-decoration:none;" href="edit_item.php?id='.$_GET['id'].'&item='.$item->id.'">'.$item->o.'</a>] <a href="edit_item.php?id='.$_GET['id'].'&item='.$item->id.'">'.$item->title.'</a> &nbsp; &nbsp; &nbsp; '.$item->link.' (<a href="?id='.$_GET['id'].'&del='.$item->id.'">x</a>)</div>';
		if ( 0 < count($c = $item->getMenuItems()) ) {
			printMenuItems($c);
		}
		echo '</li>';
	}
	echo '</ul>';
}

if ( empty($_GET['sort']) ) {
	exit;
}

?>
<form method="post" action="?id=<?=$_GET['id']?>" onsubmit="this.elements.sortorder.value=getOrder();">
<input type="hidden" name="sortorder" value="" />
<input type="submit" value="Save order" />
</form>
<script type="text/javascript">
function getOrder(p, l) {
	p = p || $('sortable');
	l = l || 1;
	var r = [];
	p.childs('li').each(function(li) {
		r.push( li.attr('mid') + ( li.childs('ul').length ? getOrder(li.childs('ul')[0], l+1) : '' ) );
	});
	return ( l > 1 ? '['+l+']' : '' ) + r.join('['+l+']');
}
$$('#sortable, #sortable ul').each(function(ul) { new Sortables(ul); });
</script>


