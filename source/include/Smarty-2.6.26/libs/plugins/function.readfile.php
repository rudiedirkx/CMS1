<?php

function smarty_function_readfile($params, &$smarty) {

	if ( isset($params['file']) ) {
		if ( isset($params['content_type']) ) {
//exit($params['content_type']);
//			header('Content-type: '.$params['content_type'], true);
		}
		$file = $_SERVER['DOCUMENT_ROOT'].'/'.trim(str_replace('..', '', $params['file']), '/');
		readfile($file);
	}

	return '';

}