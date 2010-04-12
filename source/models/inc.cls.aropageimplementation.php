<?php

require_once(dirname(__FILE__).'/inc.cls.extended_activerecordobject.php');

class AROPageImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'page_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array(
		
	);


	public function admin() {
		return '/admin/page/edit.php?id='.$this->id;
	}


	public function init($parent = null) {
		$this->parent = $parent;
		$this->root = $parent && $parent->root ? $parent->root : $parent;

		$this->relative_url = '/' . $this->id;
		$this->id = end(explode('/', $this->id));

		return $this;
	}


	public function getPage( $f_id ) {
		$p = AROImplementation::loadImplementationByID( $this->id.'/'.$f_id );
		$p->init($this);
		return $p;
	}


	public function getPages( $f_szOrderBy = 'o ASC' ) {
		$ps = $this->getDbObject()->fetch('SELECT * FROM page_implementations p, implementations i WHERE i.type = \'page\' AND i.implementation_id = p.implementation_id AND p.parent_page_id = '.$this->implementation_id.' ORDER BY '.$f_szOrderBy, get_class($this));
		foreach ( $ps AS $p ) {
			$p->init($this);
		}
		return $ps;
	}


	public function parse( &$f_pszViewType = null ) {
		$szViewType = 'page';
		$f_pszViewType = $szViewType;
		$objView = AROView::getView($szViewType, $this->id);
		if ( !is_object($objView) ) {
			return false;
		}
		$this->init();
		$o = $this;
		$o->root = $this;
		foreach ( $this->details AS $id ) {
			$o = $o->getPage($id);
		}
		$GLOBALS['page'] = $o;
		$o->parseView( $objView );
		return true;
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


