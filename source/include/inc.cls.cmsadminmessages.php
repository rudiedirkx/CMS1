<?php

define('MESSAGE_TYPE_ERROR', 'error');
define('MESSAGE_TYPE_WARNING', 'warning');
define('MESSAGE_TYPE_NOTICE', 'notice');
define('MESSAGE_TYPE_SUCCESS', 'success');

class CmsAdminMessage {

	public $message = '';
	public $type = 0;

	public function __construct( $msg, $type = MESSAGE_TYPE_NOTICE ) {
		$this->message = $msg;
		$this->type = $type;
	}

	public static function add( $msg ) {
		if ( !isset($_SESSION[SESSION_NAME]['messages']) ) {
			$_SESSION[SESSION_NAME]['messages'] = array();
		}
		if ( !is_a($msg, __CLASS__) ) {
			$msg = new NoticeMessage((string)$msg);
		}
		$_SESSION[SESSION_NAME]['messages'][] = $msg;
	}

	public function __tostring() {
		return $this->message;
	}

}

class ErrorMessage {
	public function __construct( $msg ) {
		parent::__construct($msg, MESSAGE_TYPE_ERROR);
	}
}

class WarningMessage {
	public function __construct( $msg ) {
		parent::__construct($msg, MESSAGE_TYPE_WARNING);
	}
}

class NoticeMessage {
	public function __construct( $msg ) {
		parent::__construct($msg, MESSAGE_TYPE_ERROR);
	}
}

class SuccessMessage {
	public function __construct( $msg ) {
		parent::__construct($msg, MESSAGE_TYPE_SUCCESS);
	}
}
