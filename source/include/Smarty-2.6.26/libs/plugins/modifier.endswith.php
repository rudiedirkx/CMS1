<?php

function smarty_modifier_endswith( $haystack, $needle ) {
	return 0 === strpos(strrev($haystack), strrev($needle));
}


