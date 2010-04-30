<?php

require_once('cfg_admin.php');

logincheck();

$objGuestbook = AROImplementation::loadImplementationByID( $_GET['id'] );
$objEntry = AROGuestbookEntry::finder()->findOne('id = ? AND guestbook_implementation_id = ?', $_GET['entry'], $objGuestbook->implementation_id);

if ( isset($_POST['name'], $_POST['email'], $_POST['website'], $_POST['subject'], $_POST['message'], $_POST['message_2'], $_POST['verified']) ) {
	unset($_POST['id'], $_POST['o'], $_POST['deleted'], $_POST['ip'], $_POST['utc'], $_POST['guestbook_implementation_id']);
	$db->update('guestbook_entries', $_POST, 'id = '.$objEntry->id);
	header('Location: entries.php?id='.$_GET['id']);
	exit;
}

tpl_header();

echo '<h1>Editing entry in guestbook: '.$objGuestbook->title.'</h1>';

?>
<form method="post" action="">

	<p><?=$objGuestbook->label_for_name?>:<br /><input type="text" name="name" value="<?=$objEntry->name?>" /></p>

	<p><?=$objGuestbook->label_for_email?>:<br /><input type="text" name="email" value="<?=$objEntry->email?>" /></p>

	<p><?=$objGuestbook->label_for_website?>:<br /><input type="text" name="website" value="<?=$objEntry->website?>" /></p>

	<p><?=$objGuestbook->label_for_subject?>:<br /><input type="text" name="subject" value="<?=$objEntry->subject?>" /></p>

	<p><?=$objGuestbook->label_for_message?>:<br /><textarea cols="60" rows="8" name="message"><?=htmlspecialchars($objEntry->message)?></textarea></p>

	<p><?=$objGuestbook->label_for_message_2?>:<br /><textarea cols="60" rows="8" name="message_2"><?=htmlspecialchars($objEntry->message_2)?></textarea></p>

	<p>Verified?<br /><label><input type="radio" name="verified" value="1"<?=$objEntry->verified?' checked="1"':''?> /> YES</label> &nbsp; <label><input type="radio" name="verified" value="0"<?=!$objEntry->verified?' checked="1"':''?> /> NO</label></p>

	<p><input type="submit" value="Save" /></p>

</form>

<?php

tpl_footer();



