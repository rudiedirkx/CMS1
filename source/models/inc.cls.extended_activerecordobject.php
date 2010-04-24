<?php

require_once(dirname(__FILE__).'/inc.cls.myactiverecordobject.php');

class Extended_ActiveRecordObject extends MyActiveRecordObject {


	public function getChildObjectByID( $id ) {
		throw new PageNotFoundException;
	}


	final public function parseView( $f_objView ) {
		$tpl = new SmartyTpl( $this, $this, 'views' );
		$tpl->display(PROJECT_VIEWS.'/'.$f_objView->id.'.php');
	}



	final public function load( $f_szId ) {
		try {
			return AROImplementation::loadImplementationByID($f_szId);
		}
		catch ( PageNotFoundException $ex ) {
			throw new TemplateErrorException;
		}
	}


	final public function fileExists( $file ) {
		return file_exists(PROJECT_PUBLIC.str_replace('../', '', str_replace('\\', '/', trim($file, '\\/'))));
	}
	public function file_exists( $file ) {
		return $this->fileExists($file);
	}


}


