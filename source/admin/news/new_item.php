<?php

require_once('cfg_admin.php');

logincheck();

$objNews = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['type'], $_POST['title'], $_POST['content_1']) ) {
	$arrInsert = array(
		'news_implementation_id' => $objNews->implementation_id,
		'type' => $_POST['type'],
		'title' => $_POST['title'],
		'content_1' => $_POST['content_1'],
		'title_2' => '',
		'content_2' => '',
		'created' => time()
	);
	if ( isset($_POST['title_2']) ) {
		$arrInsert['title_2'] = $_POST['title_2'];
	}
	if ( isset($_POST['content_2']) ) {
		$arrInsert['content_2'] = $_POST['content_2'];
	}
	$db->insert('news_items', $arrInsert);
	echo $db->error;
	$iNewsItem = $db->insert_id();

	$objItem = $objNews->getNewsItem($iNewsItem);
	if ( isset($_POST['cflags']) ) {
		foreach ( $_POST['cflags'] AS $flag => $x ) {
			$objItem->setConfig($flag, $x);
		}
	}

	$goto = '/admin/news/edit_item.php?id='.$objNews->id.'&item='.$iNewsItem;
	$arrUpdate = array();

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

	if ( $arrUpdate ) {
		$db->update('news_items', $arrUpdate, 'id = '.$iNewsItem);
	}

	header('Location: '.$goto);
	exit;
}

tpl_header();

echo '<h1>Adding item to: &quot;'.$objNews->title.'&quot;</h1>';

//echo '<pre>'.print_r($objNews, true).'</pre>';

?>
<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="items.php?id=<?=$_GET['id']?>">Items</a> | <a href="new_item.php?id=<?=$_GET['id']?>">New item</a></p>
<?php

include('inc.news_item_form.php'); ?>
