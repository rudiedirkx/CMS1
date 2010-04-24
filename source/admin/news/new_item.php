<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['type'], $_POST['title'], $_POST['title_2'], $_POST['content_1'], $_POST['content_2']) ) {
	$db->insert('news_items', array(
		'news_implementation_id' => $objNews->implementation_id,
		'type' => $_POST['type'],
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
		'created' => time()
	));
	echo $db->error;
	$iNewsItem = $db->insert_id();

	$objItem = $objNews->getNewsItem($iNewsItem);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, $x);
		}
	}
	foreach ( array('1', '2') AS $n ) {
		$szColName = 'image_'.$n;
		if ( $objNews->{'use_'.$szColName} && !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/news_item_'.$objItem->id.'_'.$n.'.'.$szExt) ) {
					$db->update('news_items', array($szColName => $szExt), 'id = '.$iNewsItem);
				}
			}
		}
	}

	header('Location: edit_item.php?id='.$objNews->id.'&item='.$iNewsItem);
	exit;
}

tpl_header();

echo '<h1>New message in news collection: '.$objNews->title.'</h1>';

include('inc.news_item_form.php'); ?>
