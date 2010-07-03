<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {
	// Update implementation
	$db->update('implementations', array(
		'id' => $_POST['id'],
		'title' => $_POST['title']
	), "id = '".addslashes($objNews->id)."'");

	$objNews->setConfig('ni_label_for_title_1', $_POST['ni_label_for_title_1']);
	$objNews->setConfig('ni_label_for_content_1', $_POST['ni_label_for_content_1']);
	$objNews->setConfig('ni_label_for_title_2', $_POST['ni_label_for_title_2']);
	$objNews->setConfig('ni_label_for_content_2', $_POST['ni_label_for_content_2']);

	$db->update('news_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
	), 'implementation_id = '.$objNews->implementation_id);

	$objNews->setConfig('use_image_1', ($img1 = max(0, min(2, (int)$_POST['use_image_1']))));
	$objNews->unsetConfig('image_1_x');
	$objNews->unsetConfig('image_1_y');
	if ( $img1 && 0 < (int)$_POST['image_1_x'] && 0 < (int)$_POST['image_1_y'] ) {
		$objNews->setConfig('image_1_x', (int)$_POST['image_1_x']);
		$objNews->setConfig('image_1_y', (int)$_POST['image_1_y']);
	}

	$objNews->setConfig('use_image_2', ($img2 = max(0, min(2, (int)$_POST['use_image_2']))));
	$objNews->unsetConfig('image_2_x');
	$objNews->unsetConfig('image_2_y');
	if ( $img2 && 0 < (int)$_POST['image_2_x'] && 0 < (int)$_POST['image_2_y'] ) {
		$objNews->setConfig('image_2_x', (int)$_POST['image_2_x']);
		$objNews->setConfig('image_2_y', (int)$_POST['image_2_y']);
	}

	foreach ( array('special_1','special_2','special_3') AS $name ) {
		$objNews->setConfig($name, empty($_POST[$name]) ? null : $_POST[$name]);
	}

	foreach ( $_POST['specviewtype'] AS $vt => $v ) {
		$db->delete('specific_view_selections', "object_id = '".$_GET['id']."' AND view_type = '".$vt."'");
		if ( $v ) {
			$db->insert('specific_view_selections', array(
				'object_id' => $_GET['id'],
				'view_type' => $vt,
				'view_id' => $v,
			));
		}
	}

	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

else if ( isset($_GET['disable']) ) {
	$f = $_GET['disable'];
	$db->update('news_implementations', 'label_for_'.$f.' = CONCAT(\'.\', label_for_'.$f.')', 'implementation_id = '.$objNews->implementation_id);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

echo '<h1>Editing &quot;'.$objNews->title.'&quot;</h1>';

?>
<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="items.php?id=<?=$_GET['id']?>">Items</a> | <a href="new_item.php?id=<?=$_GET['id']?>">New item</a><?if ($g_objAdmin->allowEditConfigs()) {?><?}?></p>

<?php include('inc.properties_form.php'); ?>


