<?php

require_once('cfg_admin.php');

logincheck();

$objGuestbook = AROImplementation::loadImplementationByID( $_GET['id'] );

if ( isset($_POST['id'], $_POST['title'], $_POST['content_1'], $_POST['title_2'], $_POST['content_2']) ) {
	// Update implementation
	$db->update('implementations', array(
		'id' => addslashes($_POST['id']),
		'title' => addslashes($_POST['title'])
	), "id = '".addslashes($objGuestbook->id)."'");

	// Update guestbook
	$db->update('guestbook_implementations', array(
		'content_1' => $_POST['content_1'],
		'title_2' => $_POST['title_2'],
		'content_2' => $_POST['content_2'],
		'must_verify' => (string)(int)!empty($_POST['must_verify']),
		'use_name' => (string)(int)!empty($_POST['use_name']),
		'use_email' => (string)(int)!empty($_POST['use_email']),
		'use_website' => (string)(int)!empty($_POST['use_website']),
		'use_subject' => (string)(int)!empty($_POST['use_subject']),
		'use_message_2' => (string)(int)!empty($_POST['use_message_2']),
		'mandatory_name' => (string)(int)!empty($_POST['mandatory_name']),
		'mandatory_email' => (string)(int)!empty($_POST['mandatory_email']),
		'mandatory_website' => (string)(int)!empty($_POST['mandatory_website']),
		'mandatory_subject' => (string)(int)!empty($_POST['mandatory_subject']),
		'mandatory_message_2' => (string)(int)!empty($_POST['mandatory_message_2']),
		'label_for_message' => $_POST['label_for_message'],
		'label_for_name' => $_POST['label_for_name'],
		'label_for_email' => $_POST['label_for_email'],
		'label_for_website' => $_POST['label_for_website'],
		'label_for_subject' => $_POST['label_for_subject'],
		'label_for_message_2' => $_POST['label_for_message_2'],
		'return_url' => $_POST['return_url'],
	), 'implementation_id = '.$objGuestbook->implementation_id);

	foreach ( $_POST['specviewtype'] AS $vt => $v ) {
		$db->delete('specific_view_selections', "object_id = '".$_GET['id']."' AND view_type = '".$vt."'");
		if ( $v ) {
			$db->insert('specific_view_selections', array(
				'object_id' => $_GET['id'],
				'view_type' => $vt,
				'view_id' => $v,
			));
		}
	}

	header('Location: edit.php?id='.$_POST['id']);
	exit;
}

else if ( isset($_GET['disable']) ) {
	$f = $_GET['disable'];
	$db->update('page_implementations', 'label_for_'.$f.' = CONCAT(\'.\', label_for_'.$f.')', 'implementation_id = '.$objPage->implementation_id);
	header('Location: '.$_SERVER['HTTP_REFERER']);
	exit;
}

tpl_header();

echo '<h1>Editing guestbook: '.$objGuestbook->title.'</h1>';

?>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>

<p><a href="properties.php?id=<?=$_GET['id']?>">Properties</a> | <a href="entries.php?id=<?=$_GET['id']?>">Entries</a></p>

<form method="post" action="">

	<p>URL:<br />/<input type="text" name="id" maxlength="50" value="<?=$objGuestbook->id?>" style="border:solid 1px black;border-width:0 0 1px;" /></p>

	<p>Title:<br /><input type="text" name="title" size="80" value="<?=$objGuestbook->title?>" /></p>

	<p>Content:<br /><textarea id="content_1" name="content_1" rows="12" cols="100"><?=htmlspecialchars($objGuestbook->content_1)?></textarea></p>

	<p>Title 2:<br /><input type="text" name="title_2" size="80" value="<?=$objGuestbook->title_2?>" /></p>

	<p>Content 2:<br /><textarea id="content_2" name="content_2" rows="12" cols="100"><?=htmlspecialchars($objGuestbook->content_2)?></textarea></p>

	<p>Return to URL:<br /><input type="text" name="return_url" size="40" value="<?=$objGuestbook->return_url?>" /></p>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('fields').style){display=display=='none'?'':'none';}">Fields</h2>
	<table id="fields" style="display:none;">
		<tr><th>Field</th><th>Use</th><th>Label</th><th>Mandatory</th></tr>
		<?php foreach ( array('name', 'email', 'website', 'subject', 'message', 'message_2') AS $f ) { ?>
		<tr><td><?=$f?></td><td align="center"><input name="use_<?=$f?>" type="checkbox"<?=$objGuestbook->{'use_'.$f} || 'message' == $f ? ' checked="1"'.( 'message' == $f ? ' disabled="1"' : '' ) : ''?> /></td><td><input type="text" name="label_for_<?=$f?>" value="<?=$objGuestbook->{'label_for_'.$f}?>" /></td><td align="center"><input name="mandatory_<?=$f?>" type="checkbox"<?=$objGuestbook->{'mandatory_'.$f} || 'message' == $f ? ' checked="1"'.( 'message' == $f ? ' disabled="1"' : '' ) : ''?> /></td></tr>
		<?php } ?>
	</table>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('options').style){display=display=='none'?'':'none';}">Options</h2>
	<p id="options" style="display:none;">
		<label><input type="checkbox" name="must_verify" value="1"<?=$objGuestbook->must_verify?' checked="1"':''?> /> Must approve new entries</label><br />
		<label><input type="checkbox" name="check_email_regexp" value="1"<?=$objGuestbook->check_email_regexp?' checked="1"':''?> /> Check e-mail field with regexp</label><br />
	</p>

	<h2 style="cursor:pointer;" onclick="with(document.getElementById('specviews').style){display=display=='none'?'':'none';}">Specific views</h2>
	<p id="specviews" style="display:none;"><?php

$arrViewTypes = ImplementationType::getViewTypes(basename(dirname(__FILE__)));

foreach ( $arrViewTypes AS $type ) {
	$arrViews = $db->fetch("SELECT *, (SELECT COUNT(1) FROM specific_view_selections WHERE object_id = '".$_GET['id']."' AND view_type = '".addslashes($type)."' AND view_id = views.id) AS selected FROM views WHERE CONCAT(',',type,',') LIKE '%,".addslashes($type).",%'");
	echo $type.': <select name="specviewtype['.$type.']"><option value="0">--</option>';
	foreach ( $arrViews AS $v ) {
		echo '<option value="'.$v->id.'"'.( $v->selected ? ' selected="1"' : '' ).'>'.htmlspecialchars($v->title).'</option>';
	}
	echo '</select><br />';
}

	?></p>

	<p><input type="submit" value="Save" /></p>

</form>

<script type="text/javascript">
<!--//
document.forms[0].elements[0].focus();
CKEDITOR.replace('content_1', {});
if(document.getElementById('content_2')){CKEDITOR.replace('content_2', {});}
//-->
</script>

