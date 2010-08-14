<?php

function Dwoo_Plugin_load(Dwoo $dwoo, $objectname)
{
	return $GLOBALS['application']->load($objectname)->parse();
}


