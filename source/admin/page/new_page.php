<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

logincheck();

$objPage = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['title'], $_POST['id']) ) {
	$db->insert('page_implementations', array(
		'content_1' => $_POST['title'],
		'title_2' => '',
		'content_2' => '',
		'parent_page_id' => $objPage->implementation_id,
		'o' => (int)$db->select_one('page_implementations', 'MAX(o)', 'parent_page_id = '.$objPage->implementation_id) + 1
	));
	$iPage = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'page',
		'id' => $objPage->id.'/'.$_POST['id'],
		'title' => $_POST['title'],
		'implementation_id' => $iPage
	));

	$g_objAdmin->addLog('insert', 'page_implementations', $iPage);

	header('Location: properties.php?id='.$objPage->id.'/'.$_POST['id']);
	exit;
}

echo '<h1>New page in page: '.$objPage->title.'</h1>';

?>
<form method="post" action="">

	<p>URL:<br />/<?=$objPage->id?>/<input type="text" name="id" value="" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p>Title:<br /><input type="text" name="title" /></p>

	<p><input type="submit" value="Save" /></p>

</form>


