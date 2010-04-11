<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/9.php', 1, false),array('modifier', 'date', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/9.php', 8, false),)), $this); ?>
<?php echo smarty_function_load(array('id' => 'header'), $this);?>


<?php echo $this->_tpl_vars['this']->content_1; ?>


<div class="newsitems">
<?php $_from = $this->_tpl_vars['this']->root->getNewsItems(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['item']):
?>
<div class="newsitem"<?php if ($this->_tpl_vars['item']->align_right): ?> style="text-align:right;"<?php endif; ?>>
<h2><a href="<?php echo $this->_tpl_vars['item']->relative_url; ?>
"><?php echo $this->_tpl_vars['item']->title; ?>
</a> <span class="date"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']->created)) ? $this->_run_mod_handler('date', true, $_tmp, 'd-m-Y H:i') : smarty_modifier_date($_tmp, 'd-m-Y H:i')); ?>
</span></h2>
<?php echo $this->_tpl_vars['item']->content_1; ?>

<?php if ('story' == $this->_tpl_vars['item']->type): ?><?php echo $this->_tpl_vars['item']->content_2; ?>
<?php else: ?><p><b>Gallerij:</b> <?php $_from = $this->_tpl_vars['item']->getImages(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['img']):
?><a href="<?php echo $this->_tpl_vars['img']->image; ?>
"><img src="<?php echo $this->_tpl_vars['img']->image; ?>
" width="100" /></a> <?php endforeach; endif; unset($_from); ?></p><?php endif; ?>
<p class="links"><a href="<?php echo $this->_tpl_vars['item']->relative_url; ?>
">Lees alles</a></p>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>

<?php echo smarty_function_load(array('id' => 'footer'), $this);?>