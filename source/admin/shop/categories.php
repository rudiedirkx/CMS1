<?php

require_once('cfg_admin.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_GET['del']) ) {
	$db->delete('shop_product_categories', 'shop_implementation_id = '.$objShop->implementation_id.' AND id = '.$_GET['del']);
	header('Location: ?id='.$objShop->id);
	exit;
}

?>
<style type="text/css">
div.sub { padding:0 25px; }
</style>
<?php

echo '<h1>Editing shop: '.$objShop->title.' | Categories</h1>';

?>
<p><a href="properties.php?id=<?=$objShop->id?>">Properties</a> | <a href="categories.php?id=<?=$objShop->id?>">Categories</a> | <a href="edit.php?id=<?=$objShop->id?>">Products</a></p>

<script type="text/javascript" src="/admin/_resources/mootools_1_11.js"></script>

<p><a href="new_category.php?id=<?=$objShop->id?>">New category</a> | <a href="?id=<?=$objShop->id?>&sort=1">Sort</a></p>
<?php

printCats( AROShopProductCategory::finder()->findMany('shop_implementation_id = ? AND parent_category_id IS NULL', $objShop->implementation_id) );

function printCats( $f_arrCats ) {
	echo '<table border="2" cellpadding="3" cellspacing="0" bordercolor="white" width="300"><tbody>';
	foreach ( $f_arrCats AS $objCat ) {
		echo '<tr'.( empty($_GET['sort']) ? '' : ' bgcolor="#cccccc"' ).'><td>';
		echo '<div>&gt; <a href="edit_category.php?id='.$GLOBALS['objShop']->id.'&cat='.$objCat->id.'">'.htmlspecialchars($objCat->title).' ('.htmlspecialchars($objCat->url_id).')</a> (<a href="new_category.php?id='.$GLOBALS['objShop']->id.'&selected='.$objCat->id.'">+</a>) (<a href="?id='.$GLOBALS['objShop']->id.'&del='.$objCat->id.'">x</a>)</div>';
		$arrSubCats = AROShopProductCategory::finder()->findMany('parent_category_id = ?', $objCat->id);
		if ( 0 < count($arrSubCats) ) {
			echo '<div class="sub">';
			printCats($arrSubCats);
			echo '</div>';
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

if ( empty($_GET['sort']) ) {
	exit;
}

?>
<script type="text/javascript">
$$('tbody').each(function(el) {
	el.sortable = new Sortables(el);
});
</script>


