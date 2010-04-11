<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objForm = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['sortorder']) ) {
	$arrOrder = explode(',', $_POST['sortorder']);
	foreach ( $arrOrder AS $o => $id ) {
		var_dump($db->update('form_fields', 'o = '.(int)$o, 'id = '.(int)$id));
	}
	header('Location: ?id='.$_GET['id']);
	exit;
}

echo '<h1>Fields in form: '.$objForm->title.'</h1>';

?>
<script type="text/javascript" src="/admin/_resources/mootools_1_11.js"></script>

<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="fields.php?id=<?=$_GET['id']?>">Fields</a> | <a href="add_field.php?id=<?=$_GET['id']?>">Add field</a> | <a href="fields.php?id=<?=$_GET['id']?>&sort=1">Sort</a></p>

<table id="sortable" border="1" bordercolor="white">
<thead><tr><th>o</th><th>Label 1</th><th>Type</th><th>Required</th><th>Label 2</th><th>Label 3</th></tr></thead><tbody>
<?php

$arrFields = $objForm->getFields();
foreach ( $arrFields AS $field ) {
	echo '<tr mid="'.$field->id.'"'.( empty($_GET['sort']) ? '' : ' bgcolor="#cccccc"' ).'>';
	echo '<td>'.$field->o.'</td>';
	echo '<td>'.$field->label_1.'</td>';
	echo '<td><a href="edit_field.php?id='.$_GET['id'].'&field='.$field->id.'">'.$field->type.'</td>';
	echo '<td align="center">'.( $field->is_required ? 'Y' : 'N' ).'</td>';
	echo '<td>'.$field->label_2.'</td>';
	echo '<td>'.$field->label_3.'</td>';
	echo '</tr>';
}
echo '</tbody></table>';

if ( empty($_GET['sort']) ) {
	echo '<fieldset><legend>PREVIEW</legend>'.$objForm->getForm().'</fieldset>';
	exit;
}

?>

<form method="post" action="" onsubmit="this.elements.sortorder.value=getOrder();">
<input type="hidden" name="sortorder" value="" />
<input type="submit" value="Save order" />
</form>
<script type="text/javascript">
function getOrder() {
	return $$('#sortable tr[mid]').map(function(tr){ return tr.attr('mid'); }).join(',');
}
new Sortables($$('tbody')[0]);
</script>
