
<form method="post" action="">

	<p>Type:<br /><select name="type"><?foreach ( AROFormImplementation::$m_arrFieldTypes AS $f ) { echo '<option value="'.$f.'"'.( isset($objItem) && $objItem->type == $f ? ' selected="1"' : '' ).'>'.$f.'</option>'; }?></select></p>

	<p>Label 1:<br /><input type="text" name="label_1" size="80" value="<?=isset($objItem)?htmlspecialchars($objItem->label_1):''?>" /></p>

	<p>Max length: (0=no max)<br /><input type="text" name="maxlength" size="10" value="<?=isset($objItem)?$objItem->maxlength:'0'?>" /></p>

	<p>Label 2:<br /><input type="text" name="label_2" size="80" value="<?=isset($objItem)?htmlspecialchars($objItem->label_2):''?>" /></p>

	<p>Label 3:<br /><input type="text" name="label_3" size="80" value="<?=isset($objItem)?htmlspecialchars($objItem->label_3):''?>" /></p>

	<p>Options:<br /><textarea name="options" cols="60" rows="6"><?=isset($objItem)?htmlspecialchars($objItem->options):''?></textarea></p>

	<p><label><input type="checkbox" name="is_required"<?=isset($objItem)&&$objItem->is_required?' checked="1"':''?> /> Is required</label></p>

	<?$objOwner=$objForm?><?include('../inc.custom_flags.php')?>

	<p><input type="submit" /></p>

</form>
