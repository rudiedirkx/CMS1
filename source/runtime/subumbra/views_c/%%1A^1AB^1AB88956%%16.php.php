<html>

<ul>
<?php $_from = $this->_tpl_vars['this']->getMenuItems(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['mi']):
?>
<li><?php if ('-' != $this->_tpl_vars['mi']->title): ?><a href="<?php echo $this->_tpl_vars['mi']->link; ?>
"><?php echo $this->_tpl_vars['mi']->title; ?>
</a><?php else: ?>&nbsp;<?php endif; ?></li>
<?php endforeach; endif; unset($_from); ?>
</ul>

</html>