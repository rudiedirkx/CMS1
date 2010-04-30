<?php

class ARONewsImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'news_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array(
		
	);

	public $META_TYPE = 'newsIndex';


	public function admin() {
		return '/admin/news/edit_item_image.php?id='.$this->id;
	}


	public function __construct($data=null) {
		parent::__construct($data);
		$this->root = $this;
		$this->saveConfigs();
	}


	public function getNewsItem( $id ) {
		return ARONewsItem::finder()->byPK( $id, 'news_implementation_id = '.$this->implementation_id );
	}


	public function parse( &$f_pszViewType = null ) {
		if ( 0 < preg_match('#^(\d+)(?:\/[^\/]+)?\/(\d+)#', implode('/', $this->details), $parrMatches) ) {
			$szViewType = 'newsItemImage';
			$item = $this->getNewsItem($parrMatches[1])->init($this);
			$object = $item->getImage( $parrMatches[2] )->init($item);
		}
		else if ( 0 < preg_match('#^(\d+)#', implode('/', $this->details), $parrMatches) ) {
			$szViewType = 'newsItem';
			$object = $this->getNewsItem($parrMatches[1])->init($this);
		}
		else {
			$szViewType = 'newsIndex';
			$object = $this;
		}
		$f_pszViewType = $szViewType;
		$objView = AROView::getView($szViewType, $this->id);
		if ( !is_object($objView) ) {
			throw new NoTemplateFoundException(array($szViewType));
		}
		$object->parseView($objView);
		return true;
	}


	public $_items = null;
	public function getNewsItems( $f_iLimit = 0, $f_szOrderBy = 'created DESC' ) {
		if ( null === $this->_items ) {
			$arrItems = ARONewsItem::finder()->findMany('news_implementation_id = '.$this->implementation_id.' ORDER BY '.$f_szOrderBy);
			foreach ( $arrItems AS $item ) {
				$item->init($this);
			}
			$this->_items = $arrItems;
		}
		return $this->_items;
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


