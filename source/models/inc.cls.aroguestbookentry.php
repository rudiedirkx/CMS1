<?php

class AROGuestbookEntry extends MyActiveRecordObject {

	protected static $_table = 'guestbook_entries';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array();


	public function admin() {
		return '/admin/guestbook/edit_entry.php?id='.$this->root->id.'&entry='.$this->id;
	}


	public function init($parent) {
		$this->parent = $parent;
		$this->url = '/'.$this->parent->id.'/'.$this->id;
		$this->root = $parent->root;
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


