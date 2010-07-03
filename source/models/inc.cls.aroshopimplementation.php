<?php

class AROShopImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'shop_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array(
		'categories' => array( self::FROM_FUNCTION, 'getCategories' ),
		'products' => array( self::FROM_FUNCTION, 'getProducts' ),
	);

	public $_type = 'shopIndex';


	public function getCategory( $f_szCatID ) {
		$cat = AROShopProductCategory::finder()->findOne('parent_category_id IS NULL AND url_id = ?', $f_szCatID);
		return $cat;
	}


	public function __construct($data=null) {
		parent::__construct($data);
		$this->root = $this;
		$this->level = 0;
		$this->saveConfigs();
	}


	public function getCategories() {
		$arrCats = AROShopProductCategory::finder()->findMany('parent_category_id IS NULL AND shop_implementation_id = ?', $this->implementation_id);
		foreach ( $arrCats AS $cat ) {
			$cat->init($this);
		}
		return $arrCats;
	}


	public function parse( &$f_pszViewType = null ) {
		if ( 0 == count($this->details) ) {
			$arrViewType = array('shopIndex');
		}
		else if ( 0 < preg_match('/^p\d+$/', $this->details[count($this->details)-1]) ) {
			$arrViewType = array('productDetails');
		}
		else {
			$arrViewType = array('productCategory', 'productCategory_'.count($this->details));
		}
		$f_pszViewType = $arrViewType[0];
		$objView = AROView::getView($arrViewType, $this->id);
		if ( !is_object($objView) ) {
			throw new NoTemplateFoundException($arrViewType);
		}
		switch ( $arrViewType[0] ) {
			case 'productDetails':
				$arrUrl = $this->details;
				$iProductID = substr(array_pop($arrUrl), 1);
				try {
					$product = AROShopProduct::finder()->byPK( $iProductID );
				} catch (Exception $ex) {
					return -2;
				}
				$parent = $this;
				foreach ( $arrUrl AS $szCatID ) {
					$parent = $parent->getCategory($szCatID)->init($parent);
					if ( !is_object($parent) ) {
						return -2;
					}
				}
				$product->init($parent);
				$product->parseView( $objView );
			break;
			case 'productCategory':
				$parent = $this;
				$arrUrl = $this->details;
				$lvl = count($arrUrl)+1;
				foreach ( $arrUrl AS $szCatID ) {
					$obj = $parent->getCategory($szCatID);
					$obj->level = $lvl--;
					if ( !is_object($obj) ) {
						return -2;
					}
					$obj->init($parent);
					$parent = $obj;
				}
				$parent->parseView( $objView );
			break;
			case 'shopIndex':
				$this->parseView( $objView );
			break;
		}
		return true;
	}


	public function getProducts() {
		$arrProducts = AROShopProduct::finder()->findMany('shop_implementation_id = ?', $this->implementation_id);
		foreach ( $arrProducts AS $prod ) {
			$prod->init($this);
		}
		return $arrProducts;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


