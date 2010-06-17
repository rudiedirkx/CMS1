<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1']) ) {
	$db->insert('news_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2']
	));
	$iNewsId = $db->insert_id();

	// Update implementation
	$db->insert('implementations', array(
		'id' => $_POST['id'],
		'type' => 'news',
		'implementation_id' => $iNewsId,
		'title' => $_POST['title']
	));

	$objNews = AROImplementation::loadImplementationByID( $_POST['id'] );
	$objNews->setConfig('ni_label_for_title_1', 'Title');
	$objNews->setConfig('ni_label_for_content_1', 'Content');
	$objNews->setConfig('ni_label_for_title_2', 'Title 2');
	$objNews->setConfig('ni_label_for_content_2', 'Content 2');

	$objNews->setConfig('use_image_1', ($img1 = max(0, min(2, (int)$_POST['use_image_1']))));
	if ( $img1 && 0 < (int)$_POST['image_1_x'] && 0 < (int)$_POST['image_1_y'] ) {
		$objNews->setConfig('image_1_x', (int)$_POST['image_1_x']);
		$objNews->setConfig('image_1_y', (int)$_POST['image_1_y']);
	}

	$objNews->setConfig('use_image_2', ($img2 = max(0, min(2, (int)$_POST['use_image_2']))));
	if ( $img2 && 0 < (int)$_POST['image_2_x'] && 0 < (int)$_POST['image_2_y'] ) {
		$objNews->setConfig('image_2_x', (int)$_POST['image_2_x']);
		$objNews->setConfig('image_2_y', (int)$_POST['image_2_y']);
	}

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>New news collection</h1>';

include('inc.properties_form.php');


