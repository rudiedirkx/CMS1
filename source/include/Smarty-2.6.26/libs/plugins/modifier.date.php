<?php

function smarty_modifier_date($utc, $format) {
	return date($format, $utc);
}


