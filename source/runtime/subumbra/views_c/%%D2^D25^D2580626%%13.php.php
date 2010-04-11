<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/13.php', 1, false),)), $this); ?>
<?php echo smarty_function_load(array('id' => 'header'), $this);?>


<ul>
<?php $_from = $this->_tpl_vars['this']->root->getNewsItems(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['item']):
?>
<li><a href="<?php echo $this->_tpl_vars['item']->relative_url; ?>
"><?php echo $this->_tpl_vars['item']->title; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>

<?php echo smarty_function_load(array('id' => 'footer'), $this);?>