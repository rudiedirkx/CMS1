<p>Producten:</p>
<ul>
<?php $_from = $this->_tpl_vars['this']->getProducts(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['prod']):
?>
<li><a href="<?php echo $this->_tpl_vars['prod']->relative_url; ?>
"><?php echo $this->_tpl_vars['prod']->title; ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>