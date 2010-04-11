<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/11.php', 7, false),)), $this); ?>
<?php echo $this->_tpl_vars['page']->content_1; ?>


<p>Which title: <?php echo $this->_tpl_vars['this']->title; ?>
</p>

<fieldset>
<?php $this->assign('list', array('abc', 'xyz', '123')); ?>
<?php echo smarty_function_load(array('id' => 'tsnip'), $this);?>

</fieldset>