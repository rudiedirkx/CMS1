
<style>
td.dimensions, td.thumb-dimensions { text-align:center; }
input.dimension { width:50px; text-align:center; }
</style>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" maxlength="50" value="<?=!isset($objNews) ? '' : $objNews->id?>" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="<?=!isset($objNews) ? '' : htmlspecialchars($objNews->title)?>" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"><?=!isset($objNews) ? '' : htmlspecialchars($objNews->content_1)?></textarea></p>

	<p>Title 2:<br /><input type="text" name="title_2" size="80" value="<?=!isset($objNews) ? '' : htmlspecialchars($objNews->title_2)?>" /></p>

	<p>Content 2:<br /><textarea id="content_2" name="content_2" rows="12" cols="100"><?=!isset($objNews) ? '' : htmlspecialchars($objNews->content_2)?></textarea></p>

<?if (isset($objNews)):?>
	<br />
	<table border="1">
	<tr>
		<td></td>
		<th colspan="5">Image</th>
		<th>Thumbnail</th>
	</tr>
	<tr>
		<th></th>
		<th>Not allowed</th>
		<th>Optional</th>
		<th>Mandatory</th>
		<th>Dimension type</th>
		<th>Use dimensions</th>
		<th>Force dimensions</th>
	</tr>
<? $arrDimensionTypes = array('max' => 'Max dimensions', 'min' => 'Min dimensions', 'crop' => 'Crop to dimensions'); ?>
	<tr>
		<th>Image 1</th>
		<td align="center"><input type="radio" name="use_image_1" value="0"<?if (!isset($objNews) || !$objNews->use_image_1):?> checked="1"<?endif;?> /></td>
		<td align="center"><input type="radio" name="use_image_1" value="1"<?if (isset($objNews) && $objNews->use_image_1):?> checked="1"<?endif;?> /></td>
		<td align="center"><input type="radio" name="use_image_1" value="2"<?if (isset($objNews) && 2 == (int)$objNews->use_image_1):?> checked="1"<?endif;?> /></td>
		<td><select name="image_1_dim_type"><? foreach ( $arrDimensionTypes AS $k => $v ) { ?><option<?=$objNews->image_1_dim_type==$k?' selected':''?> value="<?=$k?>"><?=$v?></option><? } ?></select></td>
		<td class="dimensions"><input type="text" class="dimension" name="image_1_x" value="<?=isset($objNews)&&$objNews->image_1_x?$objNews->image_1_x:'0'?>" /> <sup>x</sup> <input type="text" class="dimension" name="image_1_y" value="<?=isset($objNews)&&$objNews->image_1_y?$objNews->image_1_y:'0'?>" /></td>
		<td class="thumb-dimensions"><input type="text" class="dimension" name="image_1_thumb_x" value="<?=isset($objNews)&&$objNews->image_1_thumb_x?$objNews->image_1_thumb_x:'0'?>" /> <sup>x</sup> <input type="text" class="dimension" name="image_1_thumb_y" value="<?=isset($objNews)&&$objNews->image_1_thumb_y?$objNews->image_1_thumb_y:'0'?>" /></td>
	</tr>
	<tr>
		<th>Image 2</th>
		<td align="center"><input type="radio" name="use_image_2" value="0"<?if (!isset($objNews) || !$objNews->use_image_2):?> checked="1"<?endif;?> /></td>
		<td align="center"><input type="radio" name="use_image_2" value="1"<?if (isset($objNews) && $objNews->use_image_2):?> checked="1"<?endif;?> /></td>
		<td align="center"><input type="radio" name="use_image_2" value="2"<?if (isset($objNews) && 2 == (int)$objNews->use_image_2):?> checked="1"<?endif;?> /></td>
		<td><select name="image_2_dim_type"><? foreach ( $arrDimensionTypes AS $k => $v ) { ?><option<?=$objNews->image_2_dim_type==$k?' selected':''?> value="<?=$k?>"><?=$v?></option><? } ?></select></td>
		<td class="dimensions"><input type="text" class="dimension" name="image_2_x" value="<?=isset($objNews)&&$objNews->image_2_x?$objNews->image_2_x:'0'?>" /> <sup>x</sup> <input type="text" class="dimension" name="image_2_y" value="<?=isset($objNews)&&$objNews->image_2_y?$objNews->image_2_y:'0'?>" /></td>
		<td class="thumb-dimensions"><input type="text" class="dimension" name="image_2_thumb_x" value="<?=isset($objNews)&&$objNews->image_2_thumb_x?$objNews->image_2_thumb_x:'0'?>" /> <sup>x</sup> <input type="text" class="dimension" name="image_2_thumb_y" value="<?=isset($objNews)&&$objNews->image_2_thumb_y?$objNews->image_2_thumb_y:'0'?>" /></td>
	</tr>
	<tr>
		<th>Content images</th>
		<td colspan="3" align="center">Min = <input type="text" class="dimension" name="min_ct_images" value="<?=(int)$objNews->min_ct_images?>" />; Max = <input type="text" class="dimension" name="max_ct_images" value="<?=(int)$objNews->max_ct_images?>" /></td>
		<td><select name="ct_images_dim_type"><? foreach ( $arrDimensionTypes AS $k => $v ) { ?><option<?=$objNews->ct_images_dim_type==$k?' selected':''?> value="<?=$k?>"><?=$v?></option><? } ?></select></td>
		<td class="dimensions"><input type="text" class="dimension" name="ct_images_x" value="<?=isset($objNews)&&$objNews->ct_images_x?$objNews->ct_images_x:'0'?>" /> <sup>x</sup> <input type="text" class="dimension" name="ct_images_y" value="<?=isset($objNews)&&$objNews->ct_images_y?$objNews->ct_images_y:'0'?>" /></td>
		<td class="thumb-dimensions"><input type="text" class="dimension" name="ct_images_thumb_x" value="<?=isset($objNews)&&$objNews->ct_images_thumb_x?$objNews->ct_images_thumb_x:'0'?>" /> <sup>x</sup> <input type="text" class="dimension" name="ct_images_thumb_y" value="<?=isset($objNews)&&$objNews->ct_images_thumb_y?$objNews->ct_images_thumb_y:'0'?>" /></td>
	</tr>
	</table>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('specials').style){display=display=='none'?'':'none';}">Specials</h2>
	<p id="specials" style="display:none;">Special 1: <input type="text" name="special_1" value="<?=!isset($objNews) ? '' : $objNews->special_1?>" /><br />Special 2: <input type="text" name="special_2" value="<?=!isset($objNews) ? '' : $objNews->special_2?>" /><br />Special 3: <input type="text" name="special_3" value="<?=!isset($objNews) ? '' : $objNews->special_3?>" /></p>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('labels').style){display=display=='none'?'':'none';}">Labels</h2>
	<p id="labels" style="display:none;">Title 1: <input type="text" name="ni_label_for_title_1" value="<?=!isset($objNews) ? '' : $objNews->ni_label_for_title_1?>" /><br />Content 1: <input type="text" name="ni_label_for_content_1" value="<?=!isset($objNews) ? '' : $objNews->ni_label_for_content_1?>" /><br />Title 2: <input type="text" name="ni_label_for_title_2" value="<?=!isset($objNews) ? '' : $objNews->ni_label_for_title_2?>" /><br />Content 2: <input type="text" name="ni_label_for_content_2" value="<?=!isset($objNews) ? '' : $objNews->ni_label_for_content_2?>" /></p>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('specviews').style){display=display=='none'?'':'none';}">Specific views</h2>
	<p id="specviews" style="display:none;"><?php

$arrViewTypes = ImplementationType::getViewTypes(basename(dirname(__FILE__)));
foreach ( $arrViewTypes AS $type ) {
	$arrViews = $db->fetch("SELECT *, ".( !isset($objNews) ? '0' : "(SELECT COUNT(1) FROM specific_view_selections WHERE object_id = '".$_GET['id']."' AND view_type = '".addslashes($type)."' AND view_id = views.id)" )." AS selected FROM views WHERE CONCAT(',',type,',') LIKE '%,".addslashes($type).",%'");
	echo $type.': <select name="specviewtype['.$type.']"><option value="0">--</option>';
	foreach ( $arrViews AS $v ) {
		echo '<option value="'.$v->id.'"'.( $v->selected ? ' selected="1"' : '' ).'>'.htmlspecialchars($v->title).'</option>';
	}
	echo '</select><br />';
}

	?></p>
<?endif;?>

	<p><input type="submit" value="Save" /></p>

</form>
