<?php

function smarty_function_load($params, &$smarty) {

	if ( !isset($params['id']) ) {
		return '';
	}

	return $GLOBALS['page']->load($params['id'])->parse($type, $smarty->_tpl_vars);

}