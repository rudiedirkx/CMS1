<?php

function smarty_modifier_startswith($haystack, $needle) {
	return 0 === strpos($haystack, $needle);
}


