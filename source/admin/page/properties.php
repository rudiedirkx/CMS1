<?php

require_once('cfg_admin.php');

logincheck();

$objPage = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {

	//exit(print_r($_POST, true));

	// Update implementation
	$db->update('implementations', array(
		'id' => strtolower(strtr($_POST['id'], array(' ' => '-'))),
		'title' => $_POST['title']
	), "id = '".$objPage->id."'");

	// Update page
	$db->update('page_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
	), 'implementation_id = '.$objPage->implementation_id);

	$g_objAdmin->addLog('update', 'page_implementations', $objPage->implementation_id);

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

	header('Location: ?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>Editing web page: '.$objPage->title.'</h1>';

?>
<p><a href="properties.php?id=<?=$objPage->id?>">Properties</a> | <a href="pages.php?id=<?=$objPage->id?>">Child pages</a></p>

<form method="post" action="">

	<p class="ft-id">URL:<br />/<input type="text" name="id" maxlength="50" value="<?=$objPage->id?>" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p class="ft-title">Title:<br /><input type="text" name="title" size="80" value="<?=htmlspecialchars($objPage->title)?>" /></p>

	<p class="ft-content">Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"><?=htmlspecialchars($objPage->content_1)?></textarea></p>

	<p class="ft-title">Title 2:<br /><input type="text" name="title_2" size="80" value="<?=htmlspecialchars($objPage->title_2)?>" /></p>

	<p class="ft-content">Content 2:<br /><textarea id="content_2" name="content_2" rows="12" cols="100"><?=htmlspecialchars($objPage->content_2)?></textarea></p>

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


