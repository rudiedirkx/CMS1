<?php

require_once('cfg_admin.php');

logincheck();

$objForm = AROImplementation::loadImplementationByID( $_GET['id'] );

$objItem = $objForm->getField($_GET['field'])->init($objForm);

if ( isset($_POST['label_1'], $_POST['label_2'], $_POST['label_3'], $_POST['options'], $_POST['type']) ) {
	$arrUpdate = array(
		'type' => $_POST['type'],
		'label_1' => $_POST['label_1'],
		'maxlength' => $_POST['maxlength'],
		'label_2' => $_POST['label_2'],
		'label_3' => $_POST['label_3'],
		'options' => $_POST['options'],
		'is_required' => (int)!empty($_POST['is_required']),
	);

	$db->update('form_fields', $arrUpdate, 'id = '.$objItem->id);
	echo $db->error;

	$objItem->unsetConfig($objForm->special_1, $objForm->special_2, $objForm->special_3);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, $x);
		}
	}

	header('Location: fields.php?id='.$objForm->id);
	exit;
}

tpl_header();

echo '<h1>Editing field &quot;'.$objItem->label_1.'&quot;</h1>';

include('inc.field_form.php');



tpl_footer();



