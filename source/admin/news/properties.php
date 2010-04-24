<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {
	// Update implementation
	$db->update('implementations', array(
		'id' => $_POST['id'],
		'title' => $_POST['title']
	), "id = '".addslashes($objNews->id)."'");

	$db->update('news_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
	), 'implementation_id = '.$objNews->implementation_id);

	$objNews->setConfig('label_for_title_1', $_POST['label_for_title_1']);
	$objNews->setConfig('label_for_content_1', $_POST['label_for_content_1']);
	$objNews->setConfig('label_for_title_2', $_POST['label_for_title_2']);
	$objNews->setConfig('label_for_content_2', $_POST['label_for_content_2']);

	$objNews->setConfig('use_image_1', (string)(int)!empty($_POST['use_image_1']));
	$objNews->setConfig('use_image_2', (string)(int)!empty($_POST['use_image_2']));

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

echo '<h1>Editing &quot;'.$objNews->title.'&quot;</h1>';

?>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="items.php?id=<?=$_GET['id']?>">Items</a> | <a href="new_item.php?id=<?=$_GET['id']?>">New item</a><?if ($g_objAdmin->allowEditConfigs()) {?><?}?></p>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" maxlength="50" value="<?=$objNews->id?>" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="<?=htmlspecialchars($objNews->title)?>" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"><?=htmlspecialchars($objNews->content_1)?></textarea></p>

	<p>Title 2:<br /><input type="text" name="title_2" size="80" value="<?=htmlspecialchars($objNews->title_2)?>" /></p>

	<p>Content 2:<br /><textarea id="content_2" name="content_2" rows="12" cols="100"><?=htmlspecialchars($objNews->content_2)?></textarea></p>

	<p>Special 1: <input type="text" name="special_1" value="<?=$objNews->special_1?>" /><br />Special 2: <input type="text" name="special_2" value="<?=$objNews->special_2?>" /><br />Special 3: <input type="text" name="special_3" value="<?=$objNews->special_3?>" /></p>

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

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>

