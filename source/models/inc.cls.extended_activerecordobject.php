<?php

require_once(dirname(__FILE__).'/inc.cls.myactiverecordobject.php');

class Extended_ActiveRecordObject extends MyActiveRecordObject {

	public function file_exists($file) {
		return (int)(bool)file_exists(PROJECT_PUBLIC.$file);
	}

	final public function load( $f_szId ) {
		return AROImplementation::loadImplementationByID($f_szId);
	}

	final public function parseView( $f_objView ) {
		$tpl = new SmartyTpl( $this, $this, 'views' );
		$tpl->display(PROJECT_VIEWS.'/'.$f_objView->id.'.php');
	}

	final public function fileExists( $file ) {
		return file_exists($_SERVER['DOCUMENT_ROOT'].'/'.str_replace('../', '', str_replace('\\', '/', trim($file, '\\/'))));
		return true;
	}


}


