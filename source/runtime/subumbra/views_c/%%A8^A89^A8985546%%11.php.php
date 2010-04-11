<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'print_r', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/11.php', 2, false),)), $this); ?>
<?php $this->assign('mis', $this->_tpl_vars['this']->load('menu')->getMenuItems());
 ?>
<pre><?php echo print_r($this->_tpl_vars['mis']); ?>