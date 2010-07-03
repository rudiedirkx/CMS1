<?php

require_once('cfg_admin.php');

logincheck();

$objForm = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['send_to_email'], $_POST['send_from_email'], $_POST['send_from_name']) ) {
	// Update implementation
	$db->update('implementations', array(
		'id' => $_POST['id'],
		'title' => $_POST['title']
	), "id = '".addslashes($objForm->id)."'");

	// Update form
	$db->update('form_implementations', array(
		'content_1' => $_POST['content_1'],
		'send_to_mail' => $_POST['send_to_mail'],
		'send_from_mail' => $_POST['send_from_mail'],
		'send_from_name' => $_POST['send_from_name']
	), 'implementation_id = '.$objForm->implementation_id);

	foreach ( array('special_1','special_2','special_3') AS $name ) {
		$objForm->setConfig($name, empty($_POST[$name]) ? null : $_POST[$name]);
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

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>Editing form: '.$objForm->title.'</h1>';

?>
<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="fields.php?id=<?=$_GET['id']?>">Fields</a> | <a href="add_field.php?id=<?=$_GET['id']?>">Add field</a> | <a href="fields.php?id=<?=$_GET['id']?>&sort=1">Sort</a></p>

<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" maxlength="50" value="<?=htmlspecialchars($objForm->id)?>" style="border:solid 1px black;border-width:0 0 1px;" /></p> 

	<p>Title:<br /><input type="text" name="title" size="80" value="<?=htmlspecialchars($objForm->title)?>" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"><?=htmlspecialchars($objForm->content_1)?></textarea></p>

	<p>Send to [e-mail]:<br /><input type="text" name="send_to_email" size="80" value="<?=htmlspecialchars($objForm->send_to_email)?>" /></p>

	<p>Send from [e-mail]:<br /><input type="text" name="send_from_email" size="80" value="<?=htmlspecialchars($objForm->send_from_email)?>" /></p>

	<p>Send from [name]:<br /><input type="text" name="send_from_name" size="80" value="<?=htmlspecialchars($objForm->send_from_name)?>" /></p>

	<p>Special 1: <input type="text" name="special_1" value="<?=$objForm->special_1?>" /><br />Special 2: <input type="text" name="special_2" value="<?=$objForm->special_2?>" /><br />Special 3: <input type="text" name="special_3" value="<?=$objForm->special_3?>" /></p>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('specviews').style){display=display=='none'?'':'none';}">Specific views</h2>
	<p id="specviews" style="display:none;"><?php

$arrViewTypes = ImplementationType::getViewTypes(basename(dirname(__FILE__)));

foreach ( $arrViewTypes AS $type ) {
	$arrViews = $db->fetch("SELECT *, (SELECT COUNT(1) FROM specific_view_selections WHERE object_id = '".$_GET['id']."' AND view_type = '".addslashes($type)."' AND view_id = views.id) AS selected FROM views WHERE CONCAT(',',type,',') LIKE '%,".addslashes($type).",%'");
	echo $type.': <select name="specviewtype['.$type.']"><option value="0">--</option>';
	foreach ( $arrViews AS $v ) {
		echo '<option value="'.$v->id.'"'.( $v->selected ? ' selected="1"' : '' ).'>'.htmlspecialchars($v->title).'</option>';
	}
	echo '</select><br />';
}

	?></p>

	<p><input type="submit" value="Save" /></p>

</form>

<?php

tpl_footer();



