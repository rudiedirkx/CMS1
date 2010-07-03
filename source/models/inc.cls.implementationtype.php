<?php

class ImplementationType {


	static public function getViewTypes( $f_szImpType ) {
		return explode(',', $GLOBALS['root']->select_one('implementation_types', 'view_types', "name = '".addslashes($f_szImpType)."'"));
	}


}


