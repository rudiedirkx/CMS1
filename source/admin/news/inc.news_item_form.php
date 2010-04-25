
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="" enctype="multipart/form-data">

<?if ( empty($objItem) ) {?>
	<p>Type:<br /><select name="type"><?foreach ( array('story','gallery') AS $t ) {?><option value="<?=$t?>"><?=ucfirst($t)?></option><?}?></select></p>
<?}?>

	<p><?=$objNews->ni_label_for_title_1?>:<br /><input type="text" name="title" size="100" value="<?=isset($objItem)?htmlspecialchars($objItem->title):''?>" /></p>

	<p><?=$objNews->ni_label_for_title_2?>:<br /><input type="text" name="title_2" size="100" value="<?=isset($objItem)?htmlspecialchars($objItem->title_2):''?>" /></p>

	<p><?=$objNews->ni_label_for_content_1?>:<br /><textarea id="content_1" name="content_1"><?=isset($objItem)?htmlspecialchars($objItem->content_1):''?></textarea></p>

	<p><?=$objNews->ni_label_for_content_2?>:<br /><textarea id="content_2" name="content_2"><?=isset($objItem)?htmlspecialchars($objItem->content_2):''?></textarea></p>

	<p><?if (isset($objItem) && $objItem->image_1){?><a href="<?=$objItem->image_1?>"><img src="<?=$objItem->image_1?>" width="50" height="50" /></a><br /><?}?><?=$objNews->ni_label_for_image_1?>:<br /><input type="file" name="image_1" /></p>

	<p><?if (isset($objItem) && $objItem->image_2){?><a href="<?=$objItem->image_2?>"><img src="<?=$objItem->image_2?>" width="50" height="50" /></a><br /><?}?><?=$objNews->ni_label_for_image_2?>:<br /><input type="file" name="image_2" /></p>

	<?$objOwner=$objNews?><?include('../inc.custom_flags.php')?>

	<p><input type="submit" value="Save" /></p>

</form>


