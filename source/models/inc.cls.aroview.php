<?php

require_once(dirname(__FILE__).'/inc.cls.activerecordobject.php');

class AROView extends ActiveRecordObject {

	protected static $_table = 'views';
	protected static $_columns = array(
		'type',
		'title',
	);
	protected static $_pk = 'id';
	protected static $_relations = array(
		
	);


	static public function getView( $f_mvType, $f_szObjectID ) {
		$arrViewTypes = !is_array($f_mvType) || 1 > count($f_mvType) ? array((string)$f_mvType) : $f_mvType;
		foreach ( $arrViewTypes AS $szViewType ) {
			if ( false !== ($iViewId=self::$__db->select_one('specific_view_selections', 'view_id', "object_id = '".$f_szObjectID."' AND view_type = '".$szViewType."'")) ) {
				return AROView::finder()->byPK($iViewId);
			}
			if ( $objView=AROView::finder()->findFirst("CONCAT(',',type,',') LIKE ? ORDER BY o ASC", '%,'.$szViewType.',%') ) {
				return $objView;
			}
		}
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


