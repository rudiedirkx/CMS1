<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'readfile', '/SERVER/www/websites/CMS1/source/resources/subumbra/snippets/3.php', 1, false),)), $this); ?>
<?php echo smarty_function_readfile(array('file' => '/images/favicon.ico'), $this);?>