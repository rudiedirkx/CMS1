<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

$objItem = ARONewsItem::finder()->findOne('id = ? AND news_implementation_id = ?', $_GET['item'], $objNews->implementation_id)->init($objNews);

if ( isset($_POST['title'], $_POST['content_1']) ) {
	$arrUpdate = array(
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1']
	);
	if ( isset($_POST['title_2']) ) {
		$arrUpdate['title_2'] = $_POST['title_2'];
	}
	if ( isset($_POST['content_2']) ) {
		$arrUpdate['content_2'] = $_POST['content_2'];
	}

	$goto = $_SERVER['HTTP_REFERER'];

	foreach ( array('2', '1') AS $n ) {
		$szColName = 'image_'.$n;
		if ( $objNews->{'use_'.$szColName} && !empty($_FILES[$szColName]) && 0 == $_FILES[$szColName]['error'] ) {
			$szExt = strtolower(substr(strrchr($_FILES[$szColName]['name'], '.'), 1));
			if ( in_array($szExt, array('jpg', 'jpeg', 'gif', 'png')) ) {
				$path = PROJECT_PUBLIC_RESOURCES.'/news_item_'.$objItem->id.'_'.$n.'_'.$_FILES[$szColName]['name'];
				if ( $u=move_uploaded_file($_FILES[$szColName]['tmp_name'], $path) ) {
					chmod($path, 0777);
					$arrUpdate[$szColName] = $_FILES[$szColName]['name'];
					// thumbnail
					$tw = $objNews->{'image_'.$n.'_thumb_x'};
					$th = $objNews->{'image_'.$n.'_thumb_y'};
					if ( $tw && $th ) {
						$tpath = PROJECT_PUBLIC_RESOURCES.'/thumbs/news_item_'.$objItem->id.'_'.$n.'_'.$_FILES[$szColName]['name'];
						copy($path, $tpath);
						chmod($tpath, 0777);
						$tpubpath = '/'.PROJECT_RESOURCES_FOLDER.'/thumbs/'.basename($tpath);
						$goto = '/admin/resize_image.php?label=Image+'.$n.'+(thumbnail)&tw='.$tw.'&th='.$th.'&image='.urlencode($tpubpath).'&referer=' . urlencode($goto);
					}
					// image
					$w = $objNews->{'image_'.$n.'_x'};
					$h = $objNews->{'image_'.$n.'_y'};
					if ( $w && $h ) {
						$is = getimagesize($path);
						$t = trim((string)$objNews->{'image_'.$n.'_dim_type'});
						if ( 'crop' == $t ) {
							$pubpath = '/'.PROJECT_RESOURCES_FOLDER.'/'.basename($path);
							$goto = '/admin/resize_image.php?label=Image+'.$n.'&tw='.$w.'&th='.$h.'&image='.urlencode($pubpath).'&referer=' . urlencode($goto);
						}
						else if ( 'max' == $t ) {
							if ( $w < $is[0] || $h < $is[1] ) {
								$hr = $is[0] / $w;
								$vr = $is[1] / $h;
								if ( $hr > $vr ) {
									$tw = round($is[0] / $hr);
									$th = round($is[1] / $hr);
								}
								else {
									$tw = round($is[0] / $vr);
									$th = round($is[1] / $vr);
								}
								if ( isset($g_arrGDHandlers[$is['mime']]) ) {
									$arrGDHandler = $g_arrGDHandlers[$is['mime']];
									$fn1 = $arrGDHandler[0];
									$fn2 = $arrGDHandler[1];
									if ( $old_img = $fn1($path) ) {
										$new_img = imagecreatetruecolor($tw, $th);
										var_dump(imagecopyresampled($new_img, $old_img, 0, 0, 0, 0, $tw, $th, $is[0], $is[1]));
										$fn2($new_img, $path);
									}
								}
								
							}
						}
						else if ( 'min' == $t ) {
							
						}
					}
				}
			}
		}
	}

	$db->update('news_items', $arrUpdate, 'id = '.$objItem->id);
	echo $db->error;

	$objItem->unsetConfig($objNews->special_1, $objNews->special_2, $objNews->special_3);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, $x);
		}
	}
	header('Location: '.$goto);
	exit;
}

else if ( isset($_GET['del_img']) ) {	
	$col = 'image_' . $_GET['del_img'];
	$col2 = 'use_' . $col;
	if ( in_array($_GET['del_img'], array(1, 2)) && $objItem->$col && 2 != $objNews->$col2 ) {
		$db->update('news_items', $col.' = \'\'', 'id = '.$objItem->id);
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

?>
<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="items.php?id=<?=$_GET['id']?>">Items</a> | <a href="new_item.php?id=<?=$_GET['id']?>">New item</a></p>
<?php

echo '<h1>Editing item &quot;'.$objItem->title.'&quot;</h1>';

echo '<p><a href="edit_item_images.php?id='.$_GET['id'].'&item='.$_GET['item'].'">Afbeeldingen</a></p>';

include('inc.news_item_form.php');


