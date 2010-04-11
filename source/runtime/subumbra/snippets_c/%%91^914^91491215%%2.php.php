<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'startswith', '/SERVER/www/websites/CMS1/source/resources/subumbra/snippets/2.php', 15, false),array('modifier', 'count', '/SERVER/www/websites/CMS1/source/resources/subumbra/snippets/2.php', 20, false),)), $this); ?>
<html>

<head>
<title>SumUmbra|<?php echo $this->_tpl_vars['this']->title; ?>
</title>
<link rel="shortcut icon" href="/images/favicon.ico" /> 
<link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>

<div id="menu">
<ul>
<?php $this->assign('mi', $this->_tpl_vars['this']->load('menu')); ?><?php $this->assign('mi', $this->_tpl_vars['mi']->getMenuItems()); ?>
<?php $_from = $this->_tpl_vars['mi']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['item']):
?>
	<li><?php if ('-' == $this->_tpl_vars['item']->title): ?><br /><?php else: ?><a<?php if (((is_array($_tmp=$this->_tpl_vars['server']['REQUEST_URI'])) ? $this->_run_mod_handler('startswith', true, $_tmp, $this->_tpl_vars['item']->link) : smarty_modifier_startswith($_tmp, $this->_tpl_vars['item']->link))): ?> class="current"<?php endif; ?> href="<?php echo $this->_tpl_vars['item']->link; ?>
"<?php if ($this->_tpl_vars['item']->important): ?> style="color:red;"<?php endif; ?>><?php echo $this->_tpl_vars['item']->title; ?>
</a><?php endif; ?></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>

<h1><?php echo $this->_tpl_vars['this']->title; ?>
<?php if (in_array ( strtolower ( get_class ( $this->_tpl_vars['this'] ) ) , array ( 'aroguestbookimplementation' ) )): ?> - <?php echo count($this->_tpl_vars['this']->root->getEntries()); ?>
 berichten<?php endif; ?></h1>
<?php if ('index' == $this->_tpl_vars['this']->id): ?><h1>Meerveldhoven</h1><?php endif; ?>