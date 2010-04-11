<p>Categorieen:</p>
<ul>
<?php $_from = $this->_tpl_vars['this']->getCategories(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['cat']):
?>
<li><a href="<?php echo $this->_tpl_vars['cat']->relative_url; ?>
"><?php echo $this->_tpl_vars['cat']->title; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>