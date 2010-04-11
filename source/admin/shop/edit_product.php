<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

$objProd = AROShopProduct::finder()->findOne('id = ? AND shop_implementation_id = ?', $_GET['prod'], $objShop->implementation_id)->init($objShop);

if ( isset($_POST['title'], $_POST['content_1']) ) {
	$arrUpdate = array(
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1'],
	);

	foreach ( array('1') AS $n ) {
		$szColName = 'image_'.$n;
		if ( !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/shop_product_'.$objProd->id.'_'.$n.'.'.$szExt) ) {
					$arrUpdate[$szColName] = $szExt;
				}
			}
		}
	}

	$db->update('shop_products', $arrUpdate, 'id = '.$objProd->id);

	$db->delete('shop_products_in_categories', 'shop_product_id = '.$objProd->id);
	foreach ( isset($_POST['cats']) ? (array)$_POST['cats'] : array() AS $cat ) {
		$db->insert('shop_products_in_categories', array(
			'shop_product_id' => $objProd->id,
			'shop_category_id' => $cat,
		));
	}

	header('Location: edit.php?id='.$objShop->id);
	exit;
}

echo '<h1>Editing shop: '.$objShop->title.' | '.$objProd->title.'</h1>';

$arrSelectedCats = (array)$db->select_fields('shop_products_in_categories', 'shop_category_id,shop_category_id', 'shop_product_id = '.$objProd->id);

?>
<p><a href="product_images.php?id=<?=$objShop->id?>&prod=<?=$objProd->id?>">Images</a></p>

<form method="post" action="" enctype="multipart/form-data">

<p>Title:<br /><input type="text" name="title" value="<?=$objProd->title?>" /></p>

<p>Description:<br /><textarea cols="60" rows="12" name="content_1"><?=htmlspecialchars($objProd->content_1)?></textarea></p>

<p>Image:<br /><?if($objProd->image_1){?><a href="<?=$objProd->image_1?>"><img src="<?=$objProd->image_1?>" width="50" height="50" /></a><br /><?}?><input type="file" name="image_1" /></p>

<p>Categories:<br /><select size="8" multiple="1" name="cats[]" style="width:600px;"><?=printCats(AROShopProductCategory::finder()->findMany('shop_implementation_id = ? AND parent_category_id IS NULL', $objShop->implementation_id), 1, $arrSelectedCats)?></select></p>

<p><input type="submit" value="Save" /></p>

</form>
<?php

function printCats( $f_arrCats, $f_iLevel = 1, $selected ) {
	$szOptions = '';
	foreach ( $f_arrCats AS $objCat ) {
		$szOptions .= '<option value="'.$objCat->id.'"'.( in_array($objCat->id, $selected) ? ' selected="1"' : '' ).'>'.trim(str_repeat('&nbsp;&gt;', $f_iLevel).' '.htmlspecialchars($objCat->title)).'</option';
		$arrSubCats = AROShopProductCategory::finder()->findMany('parent_category_id = ?', $objCat->id);
		$szOptions .= printCats($arrSubCats, $f_iLevel+1, $selected);
	}
	return $szOptions;
}


