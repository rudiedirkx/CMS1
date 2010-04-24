<?php

require_once('cfg_admin.php');

logincheck();

$objMenu = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['title'], $_POST['link'], $_POST['code'], $_POST['title_2'], $_POST['content_1'], $_POST['parent']) ) {
	header('Location: items.php?id='.$objMenu->id);
	$db->insert('menu_items', array(
		'menu_implementation_id' => $objMenu->implementation_id,
		'parent_menu_item_id' => empty($_POST['parent']) ? null : (int)$_POST['parent'],
		'code' => $_POST['code'],
		'title' => $_POST['title'],
		'link' => $_POST['link'],
		'title_2' => $_POST['title_2'],
		'content_1' => $_POST['content_1'],
		'o' => (int)$db->select_one('menu_items', 'MAX(o)', 'menu_implementation_id = '.$objMenu->implementation_id) + 1,
	));
	echo $db->error;
	$iMenuItem = $db->insert_id();

	$objItem = $objMenu->getMenuItem($iMenuItem);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, $x);
		}
	}

	foreach ( array('1', '2') AS $n ) {
		$szColName = 'image_'.$n;
		if ( !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/menu_item_'.$iMenuItem.'_'.$n.'.'.$szExt) ) {
					$db->update('menu_items', array($szColName => $szExt), 'id = '.$iMenuItem);
				}
			}
		}
	}

	exit;
}

tpl_header();

echo '<h1>New item in &quot;'.$objMenu->title.'&quot;</h1>';

include('inc.menu_item_form.php');


