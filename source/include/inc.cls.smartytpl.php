<?php

require_once(PROJECT_SMARTY.'/libs/Smarty.class.php');

class SmartyTpl extends Smarty {

	public function __construct( $page, $context, $type ) {
		parent::__construct();
		$this->security = true;
		$this->security_settings['INCLUDE_ANY'] = true;
		$this->security_settings['ALLOW_SUPER_GLOBALS'] = true;
		$this->security_settings['MODIFIER_FUNCS'] = array('count', 'strtolower', 'strtoupper', 'var_dump', 'print_r');
		$this->security_settings['IF_FUNCS'][] = 'strtolower';
		$this->security_settings['IF_FUNCS'][] = 'strtoupper';
		$this->security_settings['IF_FUNCS'][] = 'get_class';
		$this->security_settings['IF_FUNCS'][] = 'strpos';
		$this->compile_dir = PROJECT_RUNTIME.'/'.$type.'_c';
		$this->left_delimiter = '<'.'?';
		$this->right_delimiter = '?'.'>';
		$this->assign( 'this', $page );
		$this->assign( 'context', $context );
		
	}

}


