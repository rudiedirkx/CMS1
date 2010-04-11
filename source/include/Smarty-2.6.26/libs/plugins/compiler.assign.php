<?php

function smarty_compiler_assign($tag_attrs, &$compiler) {
	$_params = $compiler->_parse_attrs($tag_attrs, true);
//print_r($_params);
//exit;
	$szAssignations = '';
	foreach ( $_params AS $param ) {
		list($var, $value) = $param;
		if ( '"[[' == substr($value, 0, 3) && ']]"' == substr($value, -3) ) {
			$value = 'array('.substr($value, 3, -3).')';
		}
		$szAssignations .= '$this->assign(\''.$var.'\', '.$value.');'."\n";
	}
//exit($szAssignations);
	return $szAssignations;
}


