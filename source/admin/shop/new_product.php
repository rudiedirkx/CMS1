<?php

require_once('cfg_admin.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['title']) ) {
	$db->insert('shop_products', array(
		'shop_implementation_id' => $objShop->implementation_id,
		'title' => $_POST['title']
	));
	header('Location: edit_product.php?id='.$objShop->id.'&prod='.$db->insert_id());
	exit;
}

echo '<h1>New product in shop: '.$objShop->title.'</h1>';

echo '<form method="post" action="">';

echo '<p>Title: <input type="text" name="title" size="60" /></p>';

echo '<p<input type="submit" value="Save" /></p>';

echo '</form>';

?>
<script type="text/javascript">document.forms[0].elements[0].focus();</script>

