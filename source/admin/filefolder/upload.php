<?php

require_once('cfg_admin.php');

logincheck();

$_GET['id'] = trim($_GET['id'], '/');
$dir = $_SERVER['DOCUMENT_ROOT'].'/'.$_GET['id'];

if ( isset($_FILES['file']) ) {
	$szSaveAs = '/'.$_GET['id'].'/'.$_FILES['file']['name'];
	move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$szSaveAs);
	if ( !empty($_POST['ids']) && ($ids=$db->select('image_dimension_sets', 'id = '.$_POST['ids'])) ) {
		header('Location: /admin/resize_image.php?image='.urlencode($szSaveAs).'&target_width='.$ids[0]->width.'&target_height='.$ids[0]->height.'&referer='.urlencode('/admin/filefolder/edit.php?id='.$_GET['id']));
	}
	else {
		header('Location: edit.php?id='.$_GET['id']);
	}
	exit;
}

tpl_header();

echo '<h1>Upload file to folder: <a href="edit.php?id='.$_GET['id'].'">/'.$_GET['id'].'</a></h1>';

?>
<form method="post" action="" enctype="multipart/form-data">


	<p>File:<br /><input type="file" name="file" onchange="$('choose_ids')[this.value.toLowerCase().endsWith(['jpg','jpeg','gif','png'])?'show':'hide']();" /></p>

	<p style="display:none;" id="choose_ids">Image dimension set:<br /><select name="ids"><option value="0">--</option><?php foreach ( $db->select('image_dimension_sets') AS $s ) { echo '<option value="'.$s->id.'">'.$s->name.' ('.$s->width.' * '.$s->height.')</option>'; } ?></select></p>

	<p><input type="submit" value="Upload" /></p>

</form>

<?php

tpl_footer();


