<?php

class AROMenuItem extends MyActiveRecordObject {

	protected static $_table = 'menu_items';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array();


	public function getMenuItem( $id ) {
		return AROMenuItem::finder()->findMany('menu_implementation_id = ? AND parent_menu_item_id = ? AND id = ?', $this->implementation_id, $this->id, $id)->init($this);
	}


	public function getMenuItemByCode( $f_szCode ) {
		return AROMenuItem::finder()->findMany('menu_implementation_id = ? AND parent_menu_item_id = ? AND code = ?', $this->implementation_id, $this->id, $f_szCode)->init($this);
	}


	public function getMenuItems( $f_szOrderBy = 'o ASC' ) {
		$arrMenuItems = AROMenuItem::finder()->findMany('menu_implementation_id = ? AND parent_menu_item_id = ? ORDER BY '.$f_szOrderBy.', id ASC', $this->menu_implementation_id, $this->id);
		foreach ( $arrMenuItems AS $i => $prod ) {
			$prod->sequenceIndex = $i;
			$prod->init($this);
		}
		if ( 0 < count($arrMenuItems) ) {
			$arrMenuItems[0]->sequenceStart = true;
			$arrMenuItems[count($arrMenuItems)-1]->sequenceEnd = true;
		}
		return $arrMenuItems;
	}


	public function init($parent) {
		$this->saveConfigs();
		$this->parent = $parent;
		$this->relative_url = $this->link;
		$this->image_1 = $this->image_1 ? '/'.PROJECT_RESOURCES_FOLDER.'/menu_item_'.$this->id.'_1.'.$this->image_1 : '';
		$this->image_2 = $this->image_2 ? '/'.PROJECT_RESOURCES_FOLDER.'/menu_item_'.$this->id.'_2.'.$this->image_2 : '';
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


