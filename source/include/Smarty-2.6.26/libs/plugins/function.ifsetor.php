<?php

function smarty_function_ifsetor($params, &$smarty) {

	if ( !isset($params['or']) ) {
		$params['or'] = '';
	}

	return !empty($params['if']) ? $params['if'] : $params['or'];

}