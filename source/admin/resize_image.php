<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_GET['image'], $_POST['left'], $_POST['top'], $_POST['width'], $_POST['height'], $_POST['target_width'], $_POST['target_height']) ) {

	$szImagePath = $_SERVER['DOCUMENT_ROOT'] . $_GET['image'];
	$is = getimagesize($szImagePath);

	$old_img = imagecreatefromjpeg($szImagePath);
	$new_img = imagecreatetruecolor($_POST['target_width'], $_POST['target_height']);

	imagecopyresampled($new_img, $old_img, 0, 0, $_POST['left'], $_POST['top'], $_POST['target_width'], $_POST['target_height'], $_POST['width'], $_POST['height']);

//echo '<pre>';
//print_r($is);
//exit;

//	header('Content-type: '.$is['mime']);
	imagejpeg($new_img, $szImagePath, 85);

echo '<p>Image saved to <a href="'.$_GET['image'].'">'.$_GET['image'].'</a>. Use your back button to navigate back to where you came from.</p>';

//	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

if ( !isset($_GET['target_width'], $_GET['target_height']) ) {
	echo '<form method="get" action="">';
	echo '<input type="hidden" name="image" value="'.htmlspecialchars($_GET['image']).'" />';
	echo '<p>Target width:<br /><input type="text" name="target_width" value="100" /></p>';
	echo '<p>Target height:<br /><input type="text" name="target_height" value="100" /></p>';
	echo '<p><input type="submit" value="Continue" /></p>';
	echo '</form>';
	exit;
}

?>
<form action="" method="post" onsubmit="$A(['left','top','width','height']).each(function(p){ this.elements[p].value = ''+cropper.getCropInfo()[p]; }, this);">

	<input type="hidden" name="left" value="0" />
	<input type="hidden" name="top" value="0" />
	<input type="hidden" name="width" value="0" />
	<input type="hidden" name="height" value="0" />
	<input type="hidden" name="target_width" value="<?=$_GET['target_width']?>" />
	<input type="hidden" name="target_height" value="<?=$_GET['target_height']?>" />

	<p><img id="cropme" src="<?=$_GET['image']?>" /></p>

	<p><input type="submit" value="CROP" /></p>

</form>

<script type="text/javascript" src="/admin/_resources/MooCrop.js"></script>
<script type="text/javascript">
var cropper = new MooCrop($('cropme'), {
	aspectRatio: <?=$_GET['target_width']?>/<?=$_GET['target_height']?>
});
</script>

<?php

tpl_footer();

