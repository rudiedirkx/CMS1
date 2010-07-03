<?php

require_once('cfg_admin.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

$objCat = AROShopProductCategory::finder()->findOne('id = ? AND shop_implementation_id = ?', $_GET['cat'], $objShop->implementation_id)->init($objShop);

if ( isset($_POST['url_id'], $_POST['title'], $_POST['content_1']) ) {
	$arrUpdate = array(
		'url_id' => $_POST['url_id'],
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1'],
	);

	foreach ( array('1', '2') AS $n ) {
		$szColName = 'image_'.$n;
		if ( !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = substr(strrchr($_FILES[$szColName]['name'], '.'), 1);
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/product_category_'.$objCat->id.'_'.$n.'.'.$szExt) ) {
					$arrUpdate[$szColName] = $szExt;
				}
			}
		}
	}

	$db->update('shop_product_categories', $arrUpdate, 'id = '.$objCat->id);

	header('Location: categories.php?id='.$objShop->id);
	exit;
}

?>
<form method="post" action="" enctype="multipart/form-data">

<p>ID:<br /><input type="text" name="url_id" value="<?=$objCat->url_id?>" /></p>

<p>Title:<br /><input type="text" name="title" value="<?=$objCat->title?>" /></p>

<p>Description:<br /><textarea cols="60" rows="12" name="content_1"><?=htmlspecialchars($objCat->content_1)?></textarea></p>

<p>Image 1:<br /><?if($objCat->image_1){?><a href="<?=$objCat->image_1?>"><img src="<?=$objCat->image_1?>" width="50" height="50" /></a><br /><?}?><input type="file" name="image_1" /></p>

<p>Image 2:<br /><?if($objCat->image_2){?><a href="<?=$objCat->image_2?>"><img src="<?=$objCat->image_2?>" width="50" height="50" /></a><br /><?}?><input type="file" name="image_2" /></p>

<p><input type="submit" value="Save" /></p>

</form>


