<?php

require_once('cfg_admin.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );
$objProd = AROShopProduct::finder()->findOne('id = ? AND shop_implementation_id = ?', $_GET['prod'], $objShop->implementation_id)->init($objShop);

echo '<h1>Editing shop: '.$objShop->title.' | '.$objProd->title.' | Product imagess</h1>';

$arrImages = $objProd->images;
print_r($arrImages);

?>
<p><a href="edit.php?id=<?=$objShop->id?>">Return to shop</a></p>
<?php

echo '<table border="0" cellpadding="5" cellspacing="0">';
echo '<tr><td colspan="2" align="center"><a href="new_product_image.php?id='.$objShop->id.'&prod='.$objProd->id.'">Add image</a></td></tr>';
foreach ( $arrImages AS $img ) {
	echo '<tr><td><a href="'.$img->image.'"><img src="'.$img->image.'" width="30" height="30" /></a></td><td><a href="edit_product_image.php?id='.$objShop->id.'&prod='.$objProd->id.'&img='.$img->id.'">'.$img->title.'</a></td></tr>';
}
echo '</table>';


