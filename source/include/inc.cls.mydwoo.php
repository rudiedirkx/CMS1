<?php

require_once(PROJECT_DWOO.'/dwooAutoload.php');

class MyDwoo extends Dwoo {

	public $compiler;

	public $data;

	public function __construct() {
		parent::__construct();

		$this->data = new Dwoo_Data;
	}

	public function assign( $name, $value ) {
		return $this->data->assign( $name, $value );
	}

	public function fetch( $tpl ) {
		return $this->get( new Dwoo_Template_File($tpl) );
	}

	public function display( $tpl ) {
		return $this->output( new Dwoo_Template_File($tpl) );
	}


	public function testTemplate( Dwoo_ITemplate $template ) {
		$this->template = $template;
		return $template->getCompiledTemplate($this, $this->getCompiler());
	}

	public function setCompiler( Dwoo_ICompiler $compiler ) {
		$this->compiler = $compiler;
	}

	public function getCompiler() {
		return $this->compiler ? $this->compiler : new Dwoo_Compiler;
	}

}


