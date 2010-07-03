
<form method="post" action="">

	<p>ID<br /><input type="text" name="id" size="20" maxlength="50" value="<?=!empty($objSnippet) ? $objSnippet->id : ''?>" /></p>

	<p>Title<br /><input type="text" name="title" size="80" value="<?=!empty($objSnippet) ? $objSnippet->title : ''?>" /></p>

	<p>Content<br /><textarea name="content" rows="21" cols="100" wrap="off"><?=!empty($objSnippet) ? htmlspecialchars(file_get_contents($szSnippetFile)) : ''?></textarea></p>

	<p>Content-type<br /><input type="text" name="content_type" size="30" value="<?=!empty($objSnippet) ? $objSnippet->content_type : ''?>" /></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">document.forms[0].elements[0].focus();</script>
