<?php

class AROShopProductCategory extends Extended_ActiveRecordObject {

	protected static $_table = 'shop_product_categories';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array(
		'categories' => array( self::FROM_FUNCTION, 'getCategories' ),
		'products' => array( self::FROM_FUNCTION, 'getProducts' ),
	);

	public $_type = 'productCategory';


	public function getCategory( $f_szCatID ) {
		$cat = AROShopProductCategory::finder()->findFirst('parent_category_id = ? AND url_id = ?', $this->id, $f_szCatID);
		return $cat;
	}


	public function getProducts() {
		$arrProducts = AROShopProduct::finder()->findMany('id IN (SELECT shop_product_id FROM shop_products_in_categories WHERE shop_category_id = ?)', $this->id);
		foreach ( $arrProducts AS $prod ) {
			$prod->init($this);
		}
		return $arrProducts;
	}


	public function getCategories() {
		$arrCats = AROShopProductCategory::finder()->findMany('parent_category_id = ?', $this->id);
		foreach ( $arrCats AS $cat ) {
			$cat->init($this);
		}
		return $arrCats;
	}


	public function init($parent) {
		$this->parent = $parent;
		$this->level = $parent->level+1;
		$this->root = $parent->root;
		$this->image_1 = $this->image_1 ? '/_images/product_category_'.$this->id.'_1.'.$this->image_1 : '';
		$this->image_2 = $this->image_2 ? '/_images/product_category_'.$this->id.'_2.'.$this->image_2 : '';
		$a = array();
		$o = $this;
		while ( 0 < $o->level ) {
			$a[] = $o->url_id;
			$o = $o->parent;
		}
		$this->relative_url = '/'.$this->root->id.'/'.implode('/', array_reverse($a)).'/';
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


