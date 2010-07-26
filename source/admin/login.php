<?php

require_once('cfg_admin.php');

if ( logincheck(false) ) {
	if ( !empty($_GET['logout']) ) {
		unset($_SESSION[SESSION_NAME]);
	}
	header('Location: /admin/');
	exit;
}

if ( isset($_POST['username'], $_POST['password']) ) {
	if ( false !== ($iUserId=$root->select_one('cms_users', 'id', "(sitename IS NULL OR sitename = '".addslashes(CMS_SITE_SUBDOMAIN)."') AND username = '".addslashes($_POST['username'])."' AND password = '".addslashes($_POST['password'])."'")) ) {
		$_SESSION[SESSION_NAME] = array('user_id' => (int)$iUserId);
		$db->insert('logs', array('action' => 'login', 'utc' => time(), 'user_id' => $iUserId, 'extra' => $_SERVER['REMOTE_ADDR']));
		header('Location: /admin/');
	}
	else {
		header('Location: /admin/login.php?msg=Wrong+login+combo');
	}
	exit;
}

?>
<html>

<body>
<form method="post" action="/admin/login">
<fieldset>
<legend>Login<?=isset($_GET['msg'])?' - <span style="color:red;">'.$_GET['msg'].'</span>':''?></legend>
Username: <input name="username" /><br />
Password: <input type="password" name="password" /><br />
<input type="submit" value="Jack in!" />
</fieldset>
</form>

<!-- <pre><?php print_r($_SERVER); ?></pre> -->
</body>

</html>
