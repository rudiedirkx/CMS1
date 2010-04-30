<?php

require_once('cfg_admin.php');

logincheck();

if ( isset($_GET['save_views_order']) ) {
	foreach ( explode(',', $_GET['save_views_order']) AS $o => $vid ) {
		$db->update('views', 'o = '.($o+1), 'id = '.$vid);
	}
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

?>
<div class="floating-tables">
<table border="1">
<tr><th class="hd" colspan="3">Objects</th></tr>
<tr><th>ID</th><th>Title</th><th>Type</th></tr>
<?php

$arrImplementations = AROImplementation::finder()->findMany("type <> 'snippet' AND id NOT LIKE '%/%' ORDER BY id ASC");

foreach ( $arrImplementations AS $imp ) {
	$objType = $imp->imp_type;
	echo '<tr>';
	echo '<td><a href="./'.$imp->type.'/edit.php?id='.$imp->id.'">'.$imp->id.'</a></td>';
	echo '<td>'.$imp->title.'</td>';
	echo '<td>'.$objType->name.'</td>';
	echo '</tr>';
}
if ( $g_objAdmin->allowAddObject() ) {
	echo '<tr><td align="center" colspan="3"><form onsubmit="document.location=\'./\'+this._type.value+\'/add.php\';return false;">New <select name="_type">'.implode('', array_map(create_function('$type', 'return \'<option value="\'.$type->type.\'">\'.$type->name.\'</option>\';'), $root->select('implementation_types', 'enabled = 1'))).'</select> <input type="submit" value="&gt;" /></form></td></tr>';
}

?>
</table>


<?php if ( 1 || $g_objAdmin->allowEditView() ) { ?>
<form method="post" action="./_view/edit.php" id="delview">
<input type="hidden" name="delete" value="1" />
<input type="hidden" name="id" value="" />
<table border="1"><thead>
<tr><th class="hd" colspan="3">Views</th></tr>
<tr><th>?</th><th>Title</th><th>Type</th><!--<th></th>--></tr></thead>
<tbody id="tb_views">
<?php

$arrViews = AROView::finder()->findMany('1 ORDER BY o ASC');

foreach ( $arrViews AS $view ) {
	echo '<tr vid="'.$view->id.'">';
	echo '<td>'.$view->o.'</td>';
	echo '<td><a'.( $g_objAdmin->allowEditView() ? ' href="./_view/edit.php?id='.$view->id.'"' : '' ).'>'.$view->title.'</td>';
	echo '<td>'.str_replace(',', '<br />', $view->type).'</td>';
//	echo '<td><a href="#" onclick="with($(\'delview\')){elements[\'id\'].value='.$view->id.';submit();}return false;">x</a></td>';
	echo '</tr>'."\n";
}

?>
</tbody>
<?php if ( $g_objAdmin->allowAddView() ) { ?>
<tfoot><tr><td align="center" colspan="3"><a href="#" onclick="document.location='?save_views_order='+getViewsOrder();return false;" style="font-size:11px;float:right;">(saveorder)</a><a href="./_view/add.php">New view</a></td></tr></tfoot>
<?php } ?>
</table>
</form>
<script type="text/javascript">
function getViewsOrder() {
        return $$('#tb_views tr[vid]').map(function(tr){ return tr.attr('vid'); }).join(',');
}
new Sortables($('tb_views'), {
	ghost: false,
	onStart: function(tr){ console.log(arguments); tr.css('background-color', 'green'); },
	onComplete: function(tr){ tr.css('background-color', ''); }
});
</script>
<?php } ?>


<?php if ( 1 || $g_objAdmin->allowEditSnippet() ) { ?>
<table border="1">
<tr><th class="hd" colspan="2">Snippets</th></tr>
<tr><th>Title</th><th>Type</th></tr>
<?php

$arrSnippets = AROImplementation::finder()->findMany("type = 'snippet' ORDER BY title ASC");

foreach ( $arrSnippets AS $snippet ) {
	echo '<tr>';
	echo '<td><a'.( $g_objAdmin->allowEditSnippet() ? ' href="snippet/edit.php?id='.$snippet->id.'"' : '' ).'>'.$snippet->id.'</a></td>';
	echo '<td>'.$snippet->loadImplementation(array())->content_type.'</td>';
	echo '</tr>'."\n";
}

?>
<?php if ( $g_objAdmin->allowAddSnippet() ) { ?>
<tr><td align="center" colspan="2"><a href="snippet/add.php">New snippet</a></td></tr>
<?php } ?>
</table>
<?php } ?>



<table border="1">
<tr><th class="hd" colspan="1">File folders</th></tr>
<?php

$arrFolders = glob($_SERVER['DOCUMENT_ROOT'].'/*');
foreach ( $arrFolders AS $f ) {
	if ( is_dir($f) && !in_array(basename($f), array('admin', '_images')) ) {
		echo '<tr>';
		echo '<td><a href="filefolder/edit.php?id='.basename($f).'">'.basename($f).'</a></td>';
		echo '</tr>'."\n";
	}
}

?>
<?php if ( $g_objAdmin->allowAddFileFolder() ) { ?>
<tr><td align="center" colspan="1"><a href="filefolder/add.php">New folder</a></td></tr>
</table>
<?php } ?>
</div>

</body>

</html>


