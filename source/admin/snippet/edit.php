<?php

require_once('cfg_admin.php');

logincheck();
$g_objAdmin->checkEditSnippetAccess();

$objSnippet = AROImplementation::loadImplementationByID( $_GET['id'] );
$szSnippetFile = PROJECT_SNIPPETS.'/'.$objSnippet->implementation_id.'.php';

if ( isset($_POST['id'], $_POST['title'], $_POST['content'], $_POST['content_type']) ) {
	// Update implementation
	$db->update('implementations', "id = '".addslashes($_POST['id'])."', title = '".addslashes($_POST['title'])."'", "id = '".addslashes($objSnippet->id)."'");

	// Update snippet
	$db->update('snippet_implementations', 'modified_time = '.time().', content_type = \''.addslashes($_POST['content_type']).'\'', 'implementation_id = '.$objSnippet->implementation_id);

	// Update content
	file_put_contents($szSnippetFile, $_POST['content']);

	header('Location: edit.php?id='.$objSnippet->id);
	exit;
}

tpl_header();

echo '<h1>Editing snippet: '.$objSnippet->title.'</h1>';


include 'inc.tpl.form.php';


