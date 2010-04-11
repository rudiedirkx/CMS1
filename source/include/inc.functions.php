<?php

function ifsetor( &$value, $alternative = '' ) {
	return isset($value) ? $value : $alternative;
}


