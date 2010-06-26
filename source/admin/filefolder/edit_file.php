<?php

require_once('cfg_admin.php');

logincheck();

$_GET['id'] = trim($_GET['id'], '/');
$dir = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'];

$szPreAmp = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'].'/';
if ( !file_exists($szPreAmp.$_GET['file']) ) {
	exit('Invalid file!');
}

if ( isset($_GET['id'], $_GET['file'], $_POST['filename']) ) {
	rename($szPreAmp.$_GET['file'], $szPreAmp.$_POST['filename']);
	if ( !empty($_FILES['newfile']) && empty($_FILES['newfile']['error']) ) {
		move_uploaded_file($_FILES['newfile']['tmp_name'], $szPreAmp.$_POST['filename']);
	}
	header('Location: edit.php?id='.$_GET['id']);
	exit;
}

tpl_header();

echo '<h1>Change: <a href="edit.php?id='.$_GET['id'].'">/'.$_GET['id'].'</a> / &quot;'.$_GET['file'].'&quot;</h1>';

?>
<form action="" method="post" enctype="multipart/form-data">

	<p>Filename:<br /><input type="text" name="filename" size="80" value="<?=$_GET['file']?>" /></p>

	<p>Upload replacement:<br /><input type="file" name="newfile" /></p>

	<p><input type="submit" value="Save" /></p>

<?if( ($img=getImageSize($dir.'/'.$_GET['file'])) ):?>
	<p>Dimensions: <a href="/admin/resize_image.php?image=<?=urlencode('/'.$_GET['id'].'/'.$_GET['file'])?>"><?=$img[0]?> * <?=$img[1]?></a></p>

	<p><img src="/<?=$_GET['id']?>/<?=$_GET['file']?>" /></p>
<?endif;?>

</form>

<?php

tpl_footer();


