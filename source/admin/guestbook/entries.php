<?php

require_once('cfg_admin.php');

logincheck();

$objGuestbook = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {
	

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

else if ( isset($_POST['sortorder']) ) {
	$arrOrder = explode(',', $_POST['sortorder']);
	foreach ( $arrOrder AS $o => $id ) {
		$db->update('guestbook_entries', 'o = '.(int)$o, 'guestbook_implementation_id = '.$objGuestbook->implementation_id.' AND id = '.(int)$id);
	}
	header('Location: ?id='.$_GET['id']);
	exit;
}

else if ( isset($_GET['del']) ) {
	$db->delete('guestbook_entries', 'id = '.(int)$_GET['del']);
	header('Location: ?id='.$_GET['id']);
	exit;
}

tpl_header();

echo '<h1>Editing guestbook: '.$objGuestbook->title.'</h1>';

?>
<script type="text/javascript" src="/admin/_resources/mootools_1_11.js"></script>

<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="entries.php?id=<?=$_GET['id']?>">Entries</a> | <a href="?id=<?=$_GET['id']?>&showdeleted=1">Show deleted entries</a> | <a href="?id=<?=$_GET['id']?>&sort=1">Sort</a></p>

<table id="sortable" border="2" cellpadding="3" cellspacing="0" bordercolor="white" width="700">
<thead>
<tr>
	<th>o</th>
	<th>Name</th>
	<th>E-mail</th>
	<th>Subject</th>
	<th>When</th>
	<th>Approved</th>
</tr>
</thead>
<tbody>
<?php

$arrEntries = AROGuestbookEntry::finder()->findMany(( empty($_GET['showdeleted']) ? "deleted = '0' AND " : '' ).'guestbook_implementation_id = '.$objGuestbook->implementation_id.' ORDER BY o ASC, id ASC');

foreach ( $arrEntries AS $e ) {
	echo '<tr mid="'.$e->id.'"'.( empty($_GET['sort']) ? '' : ' bgcolor="#cccccc"' ).'>';
	echo '	<td>'.$e->o.'</td>';
	echo '	<td>'.$e->name.'</td>';
	echo '	<td>'.$e->email.'</td>';
	echo '	<td>'.$e->subject.'</td>';
	echo '	<td><a href="edit_entry.php?id='.$_GET['id'].'&entry='.$e->id.'">'.date('Y-m-d H:i:s', $e->utc).'</td>';
	echo '	<td align="center">'.( $e->verified ? 'Y' : 'N' ).'</td>';
	echo '	<td><a href="?id='.$_GET['id'].'&del='.$e->id.'">x</a></td>';
	echo '</tr>';
}

?>
</tbody>
</table>
<?php

if ( empty($_GET['sort']) ) {
	exit;
}

?>
<form method="post" action="?id=<?=$_GET['id']?>" onsubmit="this.elements.sortorder.value=getOrder();">
<input type="hidden" name="sortorder" value="" />
<input type="submit" value="Save order" />
</form>
<script type="text/javascript">
function getOrder() {
	return $$('#sortable tr[mid]').map(function(tr){ return tr.attr('mid'); }).join(',');
}
new Sortables($$('tbody')[0]);
</script>


