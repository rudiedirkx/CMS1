<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

$objItem = $objNews->getNewsItem($_GET['item'])->init($objNews);

if ( isset($_POST['content_1'], $_FILES['image']) && empty($_FILES['image']['error']) ) {
	if ( empty($_POST['title']) ) {
		$_POST['title'] = basename($_FILES['image']['name']);
	}
	$db->insert('news_item_images', array(
		'news_item_id' => $objItem->id,
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1'],
		'o' => (int)$db->select_one('news_item_images', 'MAX(o)', 'news_item_id = '.$objItem->id) + 1,
	));
	echo $db->error;
	$iImage = $db->insert_id();

	$szColName = 'image';
	$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
	if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'bmp', 'png')) ) {
		if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], PROJECT_PUBLIC_RESOURCES.'/news_item_'.$objItem->id.'_image_'.$iImage.'.'.$szExt) ) {
			$db->update('news_item_images', array($szColName => $szExt), 'id = '.$iImage);
		}
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

else if ( isset($_GET['delete']) ) {
	$db->delete('news_item_images', 'id = '.(int)$_GET['delete'].' AND news_item_id = '.(int)$_GET['item']);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

echo '<h1>Gallery for &quot;<a href="./edit_item.php?id='.$_GET['id'].'&item='.$_GET['item'].'">'.$objItem->title.'</a>&quot;</h1>';

echo '<table border="1">';
echo '<tr><th></th><th>o</th><th>Title</th></tr>';
foreach ( $objItem->getImages() AS $img ) {
	echo '<tr>';
	echo '<td><a href="'.$img->image.'"><img src="'.$img->image.'" height="50" width="50" /></a></td>';
	echo '<td>'.$img->o.'</td>';
	echo '<td><a href="edit_item_image.php?id='.$_GET['id'].'&item='.$_GET['item'].'&image='.$img->id.'">'.$img->title.'</a></td>';
	echo '<td><a href="?id='.$_GET['id'].'&item='.$_GET['item'].'&delete='.$img->id.'">x</a></td>';
	echo '</tr>';
}
echo '</table>';

?>

<br />

<?php

require_once('inc.news_item_image_form.php');



