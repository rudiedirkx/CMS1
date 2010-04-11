<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objMenu = AROImplementation::loadImplementationByID( $_GET['id'] );

$objItem = AROMenuItem::finder()->findOne('id = ? AND menu_implementation_id = ?', $_GET['item'], $objMenu->implementation_id)->init($objMenu);

if ( isset($_POST['title'], $_POST['link'], $_POST['code'], $_POST['title_2'], $_POST['content_1'], $_POST['parent']) ) {
	$arrUpdate = array(
		'parent_menu_item_id' => empty($_POST['parent']) ? null : (int)$_POST['parent'],
		'code' => $_POST['code'],
		'title' => $_POST['title'],
		'link' => $_POST['link'],
		'title_2' => $_POST['title_2'],
		'content_1' => $_POST['content_1'],
	);

	foreach ( array('1', '2') AS $n ) {
		$szColName = 'image_'.$n;
		if ( !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/menu_item_'.$objItem->id.'_'.$n.'.'.$szExt) ) {
					$arrUpdate[$szColName] = $szExt;
				}
			}
		}
	}

	$db->update('menu_items', $arrUpdate, 'id = '.$objItem->id);

	$objItem->unsetConfig($objMenu->special_1, $objMenu->special_2, $objMenu->special_3);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, '1');
		}
	}

	header('Location: items.php?id='.$objMenu->id);
	exit;
}

echo '<h1>Edit item &quot;'.$objItem->title.'&quot;</h1>';

echo '<p><a href="new_item.php?id='.$_GET['id'].'&parent='.$objItem->id.'">Nieuw subitem</a></p>';

include('inc.menu_item_form.php');


