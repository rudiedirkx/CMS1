<?php

require_once('cfg_admin.php');

logincheck();

$szReferer = isset($_POST['referer']) ? $_POST['referer'] : ( isset($_GET['referer']) ? $_GET['referer'] : ( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/admin/' ) );

if ( isset($_POST['image'], $_POST['left'], $_POST['top'], $_POST['width'], $_POST['height'], $_POST['tw'], $_POST['th']) ) {

	$szImagePath = $_SERVER['DOCUMENT_ROOT'] . $_POST['image'];
	$is = getimagesize($szImagePath);

	if ( !isset($g_arrGDHandlers[$is['mime']]) ) {
		exit('Invalid image type.');
	}
	$arrGDHandler = $g_arrGDHandlers[$is['mime']];
	$fn1 = $arrGDHandler[0];
	$fn2 = $arrGDHandler[1];

	if ( !($old_img = $fn1($szImagePath)) ) {
		exit('Could not open image. Wrong type?');
	}
	$new_img = imagecreatetruecolor($_POST['tw'], $_POST['th']);

	imagecopyresampled($new_img, $old_img, 0, 0, $_POST['left'], $_POST['top'], $_POST['tw'], $_POST['th'], $_POST['width'], $_POST['height']);

//echo '<pre>';
//print_r($is);
//exit;

//	header('Content-type: '.$is['mime']);
	$fn2($new_img, $szImagePath);

//echo '<p>Image saved to <a href="'.$_POST['image'].'">'.$_POST['image'].'</a>. <a href="'.$szReferer.'">Go back</a>.</p>';

	header('Location: '.$szReferer);
	exit;
}

tpl_header();

if ( !isset($_GET['tw'], $_GET['th']) ) {
	echo '<form method="get" action="">';
	echo '<input type="hidden" name="referer" value="'.htmlspecialchars($szReferer).'" />';
	echo '<input type="hidden" name="image" value="'.htmlspecialchars($_GET['image']).'" />';
	echo '<p>Target width:<br /><input type="text" id="tw" name="tw" value="100" /></p>';
	echo '<p>Target height:<br /><input type="text" id="th" name="th" value="100" /></p>';
	echo '<p>Choose predefined dimensions:<br /><select onchange="var x=this.value.split(\',\');$(\'tw\').value=x[0];$(\'th\').value=x[1];"><option value="0,0">--</option>';
	foreach ( $db->select('image_dimension_sets') AS $s ) { echo '<option value="'.$s->width.','.$s->height.'">'.$s->name.' ('.$s->width.' * '.$s->height.')</option>'; }
	echo '</select></p>';
	echo '<p><input type="submit" value="Continue" /></p>';
	echo '</form>';
	exit;
}

?>
<h1><?=isset($_GET['label'])?$_GET['label'].': ':'';?><?=basename($_GET['image'])?></h1>

<form action="?" method="post" onsubmit="var c=cropper.getCropInfo();$A(['left','top','width','height']).each(function(p){ this.elements[p].value = ''+c[p]; }, this);">

	<input type="hidden" name="image" value="<?=$_GET['image']?>" />
	<input type="hidden" name="referer" value="<?=htmlspecialchars($szReferer)?>" />

	<input type="hidden" name="left" value="0" />
	<input type="hidden" name="top" value="0" />
	<input type="hidden" name="width" value="0" />
	<input type="hidden" name="height" value="0" />
	<input type="hidden" name="tw" value="<?=$_GET['tw']?>" />
	<input type="hidden" name="th" value="<?=$_GET['th']?>" />

	<p><img id="cropme" src="<?=$_GET['image']?>?rnd=<?=rand(0, 999999)?>" /></p>

	<p><input type="submit" value="CROP" /></p>

</form>

<script type="text/javascript" src="/admin/_resources/MooCrop.js"></script>
<script type="text/javascript">
$(window).addEvent('load', function() {
	window.cropper = new MooCrop($('cropme'), {
		aspectRatio: <?=$_GET['tw']?>/<?=$_GET['th']?>
	});
});
</script>

<?php

tpl_footer();

