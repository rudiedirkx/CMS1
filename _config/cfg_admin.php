<?php

require_once('cfg_complete.php');

session_start();

define( 'SESSION_NAME', 'thiscms' );
define( 'PROJECT_ADMIN', PROJECT_LOGIC.'/admin' );

function tpl_header() {
	global $g_objAdmin;
	include(PROJECT_ADMIN.'/inc.tpl.header.php');
	if ( dirname($_SERVER['PHP_SELF']) != PROJECT_ADMIN && file_exists(dirname($_SERVER['PHP_SELF']).'/inc.tpl.header.php') ) {
		include(dirname($_SERVER['PHP_SELF']).'/inc.tpl.header.php');
	}
}

function tpl_footer() {
	global $g_objAdmin;
	include(PROJECT_ADMIN.'/inc.tpl.footer.php');
}

function tpl_notices() {
	if ( !empty($_GET['errors']) ) {
		echo '<ul class="error">';
		foreach ( $_GET['errors'] AS $msg ) {
			echo '<li>'.htmlspecialchars($msg).'</li>';
		}
		echo '</ul>';
	}
	if ( !empty($_GET['successes']) ) {
		echo '<ul class="success">';
		foreach ( $_GET['successes'] AS $msg ) {
			echo '<li>'.htmlspecialchars($msg).'</li>';
		}
		echo '</ul>';
	}
}


/**
 * User levels
 * 0 - everything
 * 1 - just the basics (no add and no snippets or views)
 * 2 - quite much (basics + edit snippets & views and add objects)
 */

class CMSUser {
	public function __construct( $user ) {
		foreach ( $user AS $k => $v ) {
			$this->$k = $v;
		}
		$this->user_type = (int)$this->user_type;
	}
	public function addLog( $f_szAction, $f_szTable, $f_iPK ) {
		return $GLOBALS['db']->insert('logs', array('action' => $f_szAction, 'table_name' => $f_szTable, 'pk_value' => $f_iPK, 'utc' => time(), 'user_id' => $this->id));
	}

	public function allowEditConfigs() {
		return in_array($this->user_type, array(0));
	}
	public function checkEditConfigsAccess() {
		if ( !$this->allowEditConfigs() ) {
			exit('Access denied');
		}
	}

	public function allowEditSnippet() {
		return in_array($this->user_type, array(0, 2));
	}
	public function checkEditSnippetAccess() {
		if ( !$this->allowEditSnippet() ) {
			exit('Access denied');
		}
	}
	public function allowAddSnippet() {
		return in_array($this->user_type, array(0));
	}
	public function checkAddSnippetAccess() {
		if ( !$this->allowAddSnippet() ) {
			exit('Access denied');
		}
	}

	public function allowEditView() {
		return in_array($this->user_type, array(0, 2));
	}
	public function checkEditViewAccess() {
		if ( !$this->allowEditView() ) {
			exit('Access denied');
		}
	}
	public function allowAddView() {
		return in_array($this->user_type, array(0));
	}
	public function checkAddViewAccess() {
		if ( !$this->allowAddView() ) {
			exit('Access denied');
		}
	}

	public function allowEditObject() {
		return in_array($this->user_type, array(0, 2));
	}
	public function checkEditObjectAccess() {
		if ( !$this->allowEditObject() ) {
			exit('Access denied');
		}
	}
	public function allowAddObject() {
		return in_array($this->user_type, array(0, 2));
	}
	public function checkAddObjectAccess() {
		if ( !$this->allowAddObject() ) {
			exit('Access denied');
		}
	}

	public function allowAddFileFolder() {
		return in_array($this->user_type, array(0, 2));
	}
	public function checkAddFileFolderAccess() {
		if ( !$this->allowAddFileFolder() ) {
			exit('Access denied');
		}
	}
}

function logincheck( $f_act = true ) {
	if ( defined('USER_ID') ) {
		return true;
	}
	if ( isset($_SESSION[SESSION_NAME]['user_id']) ) {
		if ( 0 < count($arrUser=$GLOBALS['root']->select('cms_users', "(sitename IS NULL OR sitename = '".addslashes(CMS_SITE_SUBDOMAIN)."') AND id = ".$_SESSION[SESSION_NAME]['user_id'].' AND is_enabled = \'1\'')) ) {
			$GLOBALS['g_objAdmin'] = new CMSUser($arrUser[0]);
			define('USER_ID', (int)$_SESSION['thiscms']['user_id']);
			return true;
		}
	}
	unset($_SESSION[SESSION_NAME]);
	if ( $f_act && 'login.php' != basename($_SERVER['PHP_SELF']) ) {
		header('Location: /admin/login.php');
		exit('goto login page');
	}
	return false;
}

