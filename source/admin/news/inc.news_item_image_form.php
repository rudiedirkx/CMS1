
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="" enctype="multipart/form-data">
<fieldset><legend>New image</legend>

	<p>Title:<br /><input type="text" name="title" size="100" value="<?=isset($objImage)?htmlspecialchars($objImage->title):''?>" /></p>

	<p>Description:<br /><textarea id="content_1" name="content_1" cols="80" rows="9"><?=isset($objImage)?htmlspecialchars($objImage->content_1):''?></textarea></p>

	<p>Image:<br /><?if(isset($objImage)){?><a href="<?=$objImage->image?>"><img src="<?=$objImage->image?>" height="100" /></a><br /><?}?><input type="file" name="image" /></p>

	<p><input type="submit" /></p>

</fieldset>
</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {width:800, height:250});
//-->
</script>
