<ul>
<?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['item']):
?>
<li><?php echo $this->_tpl_vars['item']; ?>

<?php endforeach; endif; unset($_from); ?>
</ul>