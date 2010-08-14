<?php

require_once(PROJECT_INCLUDE.'/inc.cls.mydwoo.php');

class DwooTpl extends MyDwoo {

	public function __construct() {
		parent::__construct();

		$compiler = new Dwoo_Compiler;
		$compiler->setDelimiters('<?', '?>');
		// add preprocessor
		// add custom plugins, functions, blocks, etc
		$this->setCompiler($compiler);

		$this->setCompileDir(PROJECT_RUNTIME.'/'.$type.'_c');

		$this->assign( 'this', $page );
		$this->assign( 'context', $context );
		
	}

}


