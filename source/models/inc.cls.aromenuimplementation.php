<?php

require_once(dirname(__FILE__).'/inc.cls.extended_activerecordobject.php');

class AROMenuImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'menu_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array(
		
	);

	public $META_TYPE = 'menu';


	public function admin() {
		return '/admin/menu/edit.php?id='.$this->id;
	}


	public function __construct($data=null) {
		parent::__construct($data);
		$this->saveConfigs();
	}


	public function parse( &$f_pszViewType = null ) {
		$szViewType = 'menu';
		$f_pszViewType = $szViewType;
		$objView = AROView::getView($szViewType, $this->id);
		if ( !is_object($objView) ) {
			throw new NoTemplateFoundException(array($szViewType));
		}
		$this->parseView($objView);
		return true;
	}


	public function getMenuItem( $id ) {
		return AROMenuItem::finder()->findMany('menu_implementation_id = ? AND parent_menu_item_id IS NULL AND id = ?', $this->implementation_id, $id)->init($this);
	}


	public function getMenuItemByCode( $f_szCode ) {
		return AROMenuItem::finder()->findMany('menu_implementation_id = ? AND parent_menu_item_id IS NULL AND code = ?', $this->implementation_id, $f_szCode)->init($this);
	}


	public function getMenuItems( $f_szOrderBy = 'o ASC' ) {
		$arrMenuItems = AROMenuItem::finder()->findMany('menu_implementation_id = ? AND parent_menu_item_id IS NULL ORDER BY '.$f_szOrderBy.', id ASC', $this->implementation_id);
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



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


