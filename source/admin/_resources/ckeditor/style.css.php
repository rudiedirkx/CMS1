<?php

require_once('cfg_admin.php');

header('Content-type: text/css');

echo (string)$application->getConfig('wysiwyg_css')."\n";


