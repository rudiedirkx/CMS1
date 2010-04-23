<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/default/views/4.php', 1, false),)), $this); ?>
<?php echo smarty_function_load(array('id' => 'header'), $this);?>


<?php if ($this->_tpl_vars['this']->fileExists("images/page-".($this->_tpl_vars['this']->id).".jpg")): ?><img src="/images/page-<?php echo $this->_tpl_vars['this']->id; ?>
.jpg" align="right" /><?php endif; ?>

<?php echo $this->_tpl_vars['this']->content_1; ?>


<?php if ($this->_tpl_vars['this']->image): ?>
<p><a href="<?php echo $this->_tpl_vars['this']->image; ?>
" alt="<?php echo $this->_tpl_vars['this']->title; ?>
" title="<?php echo $this->_tpl_vars['this']->title; ?>
"><img src="<?php echo $this->_tpl_vars['this']->image; ?>
" /></a></p>
<?php $this->assign('prev', $this->_tpl_vars['this']->getPrevImage());
$this->assign('next', $this->_tpl_vars['this']->getNextImage());
 ?><p><a<?php if ($this->_tpl_vars['prev']): ?> href="<?php echo $this->_tpl_vars['prev']->relative_url; ?>
"<?php endif; ?>>Prev</a> | <a<?php if ($this->_tpl_vars['next']): ?> href="<?php echo $this->_tpl_vars['next']->relative_url; ?>
"<?php endif; ?>>Next</a></p>
<?php endif; ?>

<?php echo smarty_function_load(array('id' => 'footer'), $this);?>