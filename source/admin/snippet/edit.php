<?php

require_once('cfg_admin.php');
require_once('cfg_complete.php');

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

echo '<h1>Editing snippet: '.$objSnippet->title.'</h1>';

?>
<form method="post" action="">

	<p>ID</p>
	<p><input type="text" name="id" size="20" value="<?=$objSnippet->id?>" /></p>

	<p>Title</p>
	<p><input type="text" name="title" size="80" value="<?=$objSnippet->title?>" /></p>

	<p>Content</p>
	<p><textarea name="content" rows="21" cols="100" wrap="off"><?=htmlspecialchars(file_get_contents($szSnippetFile))?></textarea></p>

	<p>Content-type</p>
	<p><input type="text" name="content_type" size="30" value="<?=$objSnippet->content_type?>" /></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>

