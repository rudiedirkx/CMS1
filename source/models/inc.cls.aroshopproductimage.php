<?php

class AROShopProductImage extends MyActiveRecordObject {

	protected static $_table = 'shop_product_images';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array();

	public $_type = 'productImage';


	public function __construct($data=null) {
		parent::__construct($data);
		$this->image = $this->image ? '/_images/shop_product_'.$this->shop_product_id.'_image_'.$this->id.'.'.$this->image : '';
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


