<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkAddSnippetAccess();

if ( isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['content_type']) ) {
	$db->insert('snippet_implementations', array(
		'modified_time' => time(),
		'content_type' => $_POST['content_type']
	));
	$iSnippet = $db->insert_id();

	$db->insert('implementations', array(
		'type' => 'snippet',
		'id' => $_POST['id'],
		'title' => $_POST['title'],
		'implementation_id' => $iSnippet
	));

	$szViewFile = PROJECT_SNIPPETS.'/'.$iSnippet.'.php';
	file_put_contents($szViewFile, $_POST['content']);

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

tpl_header();

echo '<h1>Creating new snippet</h1>';


include 'inc.tpl.form.php';


