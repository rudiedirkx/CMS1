<?php

function smarty_compiler_assign($tag_attrs, &$compiler) {
	$_params = $compiler->_parse_attrs($tag_attrs);

	$szAssignations = '';
	foreach ( $_params AS $var => $value ) {
		if ( '"[[' == substr($value, 0, 3) && ']]"' == substr($value, -3) ) {
			$value = 'array('.substr($value, 3, -3).')';
		}
		$szAssignations .= '$this->assign(\''.$var.'\', '.$value.');';
	}

	return $szAssignations;
}


