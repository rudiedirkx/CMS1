<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

$objItem = $objNews->getNewsItem($_GET['item'])->init($objNews);

$objImage = $objItem->getImage($_GET['image'])->init($objItem);

if ( isset($_POST['title'], $_POST['content_1']) ) {
	$arrUpdate = array(
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1']
	);

	if ( !empty($_FILES['image']) && empty($_FILES['image']['error']) ) {
		$szExt = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
		if ( $u=move_uploaded_file($_FILES['image']['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/news_item_'.$objItem->id.'_image_'.$iImage.'.'.$szExt) ) {
			$arrUpdate['image'] = $szExt;
		}
	}

	$db->update('news_item_images', $arrUpdate, 'id = '.$objImage->id);

	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

echo '<h1>Edit image &quot;'.$objImage->title.'&quot;</h1>';

require_once('inc.news_item_image_form.php');


