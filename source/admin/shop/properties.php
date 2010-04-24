<?php

require_once('cfg_admin.php');

logincheck();

$objShop = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['min_images_required'], $_POST['max_images_required']) ) {
	// Update implementation
	$db->update('implementations', "id = '".addslashes($_POST['id'])."', title = '".addslashes($_POST['title'])."'", "id = '".addslashes($objShop->id)."'");

	// Update menu
	$db->update('shop_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
		'label_for_title_1' => $_POST['label_for_title_1'],
		'label_for_content_1' => $_POST['label_for_content_1'],
		'label_for_title_2' => $_POST['label_for_title_2'],
		'label_for_content_2' => $_POST['label_for_content_2'],
		'min_images_required' => $_POST['min_images_required'],
		'max_images_required' => $_POST['max_images_required'],
		'use_articles' => (string)(int)(bool)!empty($_POST['use_articles']),
		'use_stock' => (string)(int)(bool)!empty($_POST['use_stock']),
	), 'implementation_id = '.$objShop->implementation_id);

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

	header('Location: properties.php?id='.$_POST['id']);
	exit;
}

echo '<h1>Editing shop: '.$objShop->title.' | Properties</h1>';

?>
<p><a href="properties.php?id=<?=$objShop->id?>">Properties</a> | <a href="categories.php?id=<?=$objShop->id?>">Categories</a> | <a href="edit.php?id=<?=$objShop->id?>">Products</a></p>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" value="<?=$objShop->id?>" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p><?=$objShop->label_for_title_1?>:<br /><input type="text" name="title" value="<?=$objShop->title?>" size="60" /></p>

	<p><?=$objShop->label_for_content_1?>:<br /><textarea cols="60" rows="12" name="content_1"><?=htmlspecialchars($objShop->content_1)?></textarea></p>

	<p<?=0===strpos($objShop->label_for_title_2, '.') ? ' style="display:none;"' : ''?>><?=$objShop->label_for_title_2?>:<br /><input type="text" name="title_2" value="<?=$objShop->title_2?>" size="60" /></p>

	<p<?=0===strpos($objShop->label_for_content_2, '.') ? ' style="display:none;"' : ''?>><?=$objShop->label_for_content_2?>:<br /><textarea cols="60" rows="12" name="content_2"><?=htmlspecialchars($objShop->content_2)?></textarea></p>

	<p>Min images:<br /><input type="text" name="min_images_required" value="<?=$objShop->min_images_required?>" size="5" /></p>

	<p>Max images:<br /><input type="text" name="max_images_required" value="<?=$objShop->max_images_required?>" size="5" /></p>

	<p><label><input type="checkbox" name="use_articles" value="1" <?=('1'==$objShop->use_articles?' checked="1"':'')?> /> Use articles (sizes)</label></p>

	<p><label><input type="checkbox" name="use_stock" value="1" <?=('1'==$objShop->use_stock?' checked="1"':'')?> /> Use stock</label></p>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('labels').style){display=display=='none'?'':'none';}">Labels</h2>
	<table id="labels" style="display:none;">
		<tr><td>Title 1</td><td>:</td><td><input type="text" name="label_for_title_1" value="<?=$objShop->label_for_title_1?>" /></td></tr>
		<tr><td>Content 1</td><td>:</td><td><input type="text" name="label_for_content_1" value="<?=$objShop->label_for_content_1?>" /></td></tr>
		<tr><td>Title 2</td><td>:</td><td><input type="text" name="label_for_title_2" value="<?=$objShop->label_for_title_2?>" /></td></tr>
		<tr><td>Content 2</td><td>:</td><td><input type="text" name="label_for_content_2" value="<?=$objShop->label_for_content_2?>" /></td></tr>
	</table>

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


