<?php

require_once(dirname(__FILE__).'/inc.cls.activerecordobject.php');

class AROImplementation extends ActiveRecordObject {

	protected static $_table = 'implementations';
	protected static $_columns = array(
		'type',
		'implementation_id',
		'title',
	);
	protected static $_pk = 'id';
	protected static $_relations = array(
		'imp_type' => array( self::FROM_FUNCTION, 'getImpType' ),
	);


	public function getImpType() {
		return reset($GLOBALS['root']->select('implementation_types', "type = '".addslashes($this->type)."'"));
//		return AROImplementationType::finder()->findOne('type = ?', $this->type);
	}


	static public function loadImplementationByID( $f_szID, $f_arrDetails = array() ) {
		$objImpLoader = AROImplementation::finder()->byPK($f_szID);
		$objImplementation = $objImpLoader->loadImplementation( $f_arrDetails );
		$objImplementation->id = $objImpLoader->id;
		$objImplementation->title = $objImpLoader->title;
		return $objImplementation;
	}


	/**
	 * This method also (indirectly) loads a view and parses it?
	 */
	public function loadImplementation( $f_arrDetails ) {
		$szClass = 'aro'.$this->type.'implementation';
		$objFinder = call_user_func_array(array($szClass, 'finder'), array());
		$objImplementation = $objFinder->findOne('implementation_id = ?', $this->implementation_id);
		$objImplementation->details = $f_arrDetails;
		return $objImplementation;
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


