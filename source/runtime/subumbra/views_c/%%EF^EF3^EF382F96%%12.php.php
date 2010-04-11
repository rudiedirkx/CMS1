<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/12.php', 1, false),)), $this); ?>
<?php echo smarty_function_load(array('id' => 'header'), $this);?>


<?php echo $this->_tpl_vars['this']->content_1; ?>


<?php $_from = $this->_tpl_vars['this']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['img']):
?>
<a href="<?php echo $this->_tpl_vars['img']->relative_url; ?>
" title="<?php echo $this->_tpl_vars['img']->title; ?>
"><img alt="<?php echo $this->_tpl_vars['img']->title; ?>
" src="<?php echo $this->_tpl_vars['img']->image; ?>
" height="200" /></a>
<?php endforeach; endif; unset($_from); ?>

<?php echo $this->_tpl_vars['this']->content_2; ?>


<?php echo smarty_function_load(array('id' => 'footer'), $this);?>