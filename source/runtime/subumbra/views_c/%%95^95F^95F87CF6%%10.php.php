<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/10.php', 1, false),)), $this); ?>
<?php echo smarty_function_load(array('id' => 'header'), $this);?>


<?php echo $this->_tpl_vars['this']->getForm(); ?>


<?php echo smarty_function_load(array('id' => 'footer'), $this);?>