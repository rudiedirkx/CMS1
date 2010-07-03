<?php

class AROFormField extends MyActiveRecordObject {

	protected static $_table = 'form_fields';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array(
		
	);


	public function init($parent) {
		$this->parent = $parent;
		$this->root = $parent->root;
		$this->saveConfigs();
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


