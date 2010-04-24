<?php

require_once('cfg_admin.php');

logincheck();

$objForm = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['label_1'], $_POST['label_2'], $_POST['label_3'], $_POST['options'], $_POST['type']) ) {
	$db->insert('form_fields', array(
		'form_implementation_id' => $objForm->implementation_id,
		'type' => $_POST['type'],
		'label_1' => $_POST['label_1'],
		'maxlength' => $_POST['maxlength'],
		'label_2' => $_POST['label_2'],
		'label_3' => $_POST['label_3'],
		'options' => $_POST['options'],
		'is_required' => (int)!empty($_POST['is_required']),
		'o' => (int)$db->select_one('form_fields', 'MAX(o)', 'form_implementation_id = '.$objForm->implementation_id) + 1,
	));
	echo $db->error;

	$objItem = $objForm->getField($db->insert_id());
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, $x);
		}
	}

	header('Location: fields.php?id='.$_GET['id']);
	exit;
}

tpl_header();

echo '<h1>Add field to form: '.$objForm->title.'</h1>';

?>
<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="fields.php?id=<?=$_GET['id']?>">Fields</a> | <a href="add_field.php?id=<?=$_GET['id']?>">Add field</a> | <a href="fields.php?id=<?=$_GET['id']?>&sort=1">Sort</a></p>

<?php

require_once('inc.field_form.php');



