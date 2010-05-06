
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="" enctype="multipart/form-data">

<?if ( empty($objItem) ) {?>
	<p>Type:<br /><select name="type"><?foreach ( array('story','gallery') AS $t ) {?><option value="<?=$t?>"><?=ucfirst($t)?></option><?}?></select></p>
<?}?>

	<p>Title:<br /><input type="text" name="title" size="100" value="<?=isset($objItem)?htmlspecialchars($objItem->title):''?>" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1"><?=isset($objItem)?htmlspecialchars($objItem->content_1):''?></textarea></p>

	<?if ($objNews->ni_label_for_title_2):?><p><?=$objNews->ni_label_for_title_2?>:<br /><input type="text" name="title_2" size="100" value="<?=isset($objItem)?htmlspecialchars($objItem->title_2):''?>" /></p><?endif;?>

	<?if ($objNews->ni_label_for_content_2):?><p><?=$objNews->ni_label_for_content_2?>:<br /><textarea id="content_2" name="content_2"><?=isset($objItem)?htmlspecialchars($objItem->content_2):''?></textarea></p><?endif;?>

	<?if ($objNews->use_image_1):?><p>Image 1<?if (2==(int)$objNews->use_image_1):?> (mandatory!)<?endif;?>:<?if (isset($objItem) && $objItem->image_1){?><br /><a href="<?=$objItem->image_1?>"><img src="<?=$objItem->image_1?>" style="max-width:100px; max-height:100px;" /></a> (<a href="../resize_image.php?image=<?=$objItem->image_1?>">resize</a>)<?}?><br /><input type="file" name="image_1" /></p><?endif;?>

	<?if ($objNews->use_image_2):?><p>Image 2<?if (2==(int)$objNews->use_image_2):?> (mandatory!)<?endif;?>:<?if (isset($objItem) && $objItem->image_2){?><br /><a href="<?=$objItem->image_2?>"><img src="<?=$objItem->image_2?>" style="max-width:100px; max-height:100px;" /></a> (<a href="../resize_image.php?image=<?=$objItem->image_2?>">resize</a>)<?}?><br /><input type="file" name="image_2" /></p><?endif;?>

	<?$objOwner=$objNews?><?include('../inc.custom_flags.php')?>

	<p><input type="submit" value="Save" /></p>

</form>


