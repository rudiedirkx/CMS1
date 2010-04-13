
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<form method="post" action="" enctype="multipart/form-data">

	<?$iParent=isset($objItem)?(int)$objItem->parent_menu_item_id:(isset($_GET['parent'])?(int)$_GET['parent']:0)?>
	<p>Parent menu item:<br /><select name="parent"><option value="">None: new item</option><?=getMenuItems($objMenu->getMenuItems())?></select></p>

	<p>Code:<br /><input type="text" name="code" size="20" value="<?=isset($objItem)?htmlspecialchars($objItem->code):''?>" /></p>

	<p>Title:<br /><input type="text" name="title" size="60" value="<?=isset($objItem)?htmlspecialchars($objItem->title):''?>" /></p>

	<p>Link:<br /><input type="text" name="link" size="60" value="<?=isset($objItem)?htmlspecialchars($objItem->link):''?>" /></p>

	<p>Sub title:<br /><input type="text" name="title_2" size="60" value="<?=isset($objItem)?htmlspecialchars($objItem->title_2):''?>" /></p>

	<p>Description:<br /><textarea id="content_1" cols="60" rows="8" name="content_1"><?=isset($objItem)?htmlspecialchars($objItem->content_1):''?></textarea></p>

	<p>Image 1:<br /><?if (isset($objItem) && $objItem->image_1){?><a href="<?=$objItem->image_1?>"><img src="<?=$objItem->image_1?>" height="80" /></a><br /><?}?><input type="file" name="image_1" /></p>

	<p>Image 2:<br /><?if (isset($objItem) && $objItem->image_2){?><a href="<?=$objItem->image_2?>"><img src="<?=$objItem->image_2?>" height="80" /></a><br /><?}?><input type="file" name="image_2" /></p>

	<?$objOwner=$objMenu?><?include('../inc.custom_flags.php')?>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>

<?php

function getMenuItems( $f_arrItems, $f_iLevel = 1 ) {
	$szHtml = '';
	foreach ( $f_arrItems AS $item ) {
		if ( !isset($GLOBALS['objItem']) || $GLOBALS['objItem']->id != $item->id ) {
			$szHtml .= '<option value="'.$item->id.'"'.( (string)$GLOBALS['iParent'] === $item->id ? ' selected="1"' : '' ).'>'.str_repeat('&gt;&gt; ', $f_iLevel).$item->title.'</option>';
			if ( 0 < count($c = $item->getMenuItems()) ) {
				$szHtml .= getMenuItems($c, $f_iLevel+1);
			}
		}
	}
	return $szHtml;
}


