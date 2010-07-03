<?php

require_once('cfg_admin.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['parent'], $_POST['url_id'], $_POST['title']) ) {
	$db->insert('shop_product_categories', array(
		'url_id' => $_POST['url_id'],
		'shop_implementation_id' => $objShop->implementation_id,
		'parent_category_id' => '0' === $_POST['parent'] ? null : (int)$_POST['parent'],
		'title' => $_POST['title'],
		'content_1' => ''
	));
	header('Location: categories.php?id='.$objShop->id);
	exit;
}

echo '<h1>New category in shop: '.$objShop->title.'</h1>';

echo '<form method="post" action="">';

$_GET['selected'] = isset($_GET['selected']) ? (int)$_GET['selected'] : 0;
echo '<p>In category: <select name="parent"><option value="0">MAIN</option>'.printCats( AROShopProductCategory::finder()->findMany('shop_implementation_id = ? AND parent_category_id IS NULL', $objShop->implementation_id) ).'</select>';

echo '<p>ID: <input type="text" name="url_id" /></p>';

echo '<p>Title: <input type="text" name="title" size="60" /></p>';

echo '<p<input type="submit" value="Save" /></p>';

echo '</form>';

?>
<script type="text/javascript">document.forms[0].elements[<?=($_GET['selected']?1:0)?>].focus();</script>
<?php

function printCats( $f_arrCats, $f_iLevel = 1 ) {
	$szOptions = '';
	foreach ( $f_arrCats AS $objCat ) {
		$szOptions .= '<option value="'.$objCat->id.'"'.( $_GET['selected'] == (int)$objCat->id ? ' selected="1"' : '' ).'>'.trim(str_repeat('&nbsp;&gt;', $f_iLevel).' '.htmlspecialchars($objCat->title)).'</option';
		$arrSubCats = AROShopProductCategory::finder()->findMany('parent_category_id = ?', $objCat->id);
		$szOptions .= printCats($arrSubCats, $f_iLevel+1);
	}
	return $szOptions;
}

