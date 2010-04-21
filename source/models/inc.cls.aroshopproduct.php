<?php

class AROShopProduct extends Extended_ActiveRecordObject {

	protected static $_table = 'shop_products';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array(
		'images' => array( self::FROM_FUNCTION, 'getImages' )
	);

	public $_type = 'productDetails';


	public function getImages() {
		return AROShopProductImage::finder()->findMany('shop_product_id = ?', $this->id);
	}


	public function __construct($data=null) {
		parent::__construct($data);
		$this->image_1 = $this->image_1 ? '/_images/shop_product_'.$this->id.'_1.'.$this->image_1 : '';
	}


	public function init($parent) {
		$this->parent = $parent;
		$this->shop = $parent->shop;
		$this->relative_url = '/'.$this->shop->id.'/p'.$this->id.'/';
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


