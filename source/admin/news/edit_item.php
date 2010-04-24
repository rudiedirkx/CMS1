<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

$objItem = ARONewsItem::finder()->findOne('id = ? AND news_implementation_id = ?', $_GET['item'], $objNews->implementation_id)->init($objNews);

// TODO: UPDATE ITEM
if ( isset($_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {
	$arrUpdate = array(
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
	);

	foreach ( array('1', '2') AS $n ) {
		$szColName = 'image_'.$n;
		if ( $objNews->{'use_'.$szColName} && !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/news_item_'.$objItem->id.'_'.$n.'.'.$szExt) ) {
					$arrUpdate[$szColName] = $szExt;
				}
			}
		}
	}

	$db->update('news_items', $arrUpdate, 'id = '.$objItem->id);
	echo $db->error;

	$objItem->unsetConfig($objNews->special_1, $objNews->special_2, $objNews->special_3);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, '1');
		}
	}

	header('Location: items.php?id='.$objNews->id);
	exit;
}

tpl_header();

echo '<h1>Editing item &quot;'.$objItem->title.'&quot;</h1>';

echo '<p><a href="edit_item_images.php?id='.$_GET['id'].'&item='.$_GET['item'].'">Afbeeldingen</a></p>';

include('inc.news_item_form.php');


