<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_GET['del']) ) {
	$db->delete('shop_products', 'shop_implementation_id = '.$objShop->implementation_id.' AND id = '.$_GET['del']);
	header('Location: ?id='.$objShop->id);
	exit;
}

echo '<h1>Editing shop: '.$objShop->title.' | Products</h1>';

$arrProducts = AROShopProduct::finder()->findMany('shop_implementation_id = ?', $objShop->implementation_id);

?>
<p><a href="properties.php?id=<?=$objShop->id?>">Properties</a> | <a href="categories.php?id=<?=$objShop->id?>">Categories</a> | <a href="edit.php?id=<?=$objShop->id?>">Products</a></p>
<?php

echo '<table border="0" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="2" align="center"><a href="new_product.php?id='.$objShop->id.'">New product</a></td></tr>';
foreach ( $arrProducts AS $prod ) {
	$prod->init($objShop);
	echo '<tr><td><a href="'.$prod->image_1.'"><img src="'.$prod->image_1.'" width="30" height="30" /></a></td><td><a href="edit_product.php?id='.$objShop->id.'&prod='.$prod->id.'">'.$prod->title.'</a></td><td><a href="?id='.$objShop->id.'&del='.$prod->id.'">x</a></td></tr>';
}
echo '</table>';


