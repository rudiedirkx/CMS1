<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'load', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/7.php', 1, false),array('function', 'ifsetor', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/7.php', 20, false),array('modifier', 'count', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/7.php', 41, false),array('modifier', 'startswith', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/7.php', 47, false),array('modifier', 'date', '/SERVER/www/websites/CMS1/source/resources/subumbra/views/7.php', 49, false),)), $this); ?>
<?php echo smarty_function_load(array('id' => 'header'), $this);?>


<p>Custom formulier, zelf gemaakt in HTML (deze is met TABLE):</p>
<form action="/gastenboek/submit" method="post">
<table border="0" cellpadding="2" cellspacing="0"> 
  <tr> 
    <td colspan="2"><?php echo $this->_tpl_vars['this']->content_1; ?>
</td>
    <td><IMG SRC="http://subumbra.nl/images/SUlogo-zw-plat-klein.gif" ALT="logo" ID="INHOUD_PLAATJE1" width="100" height="100"></img></td> 
  </tr>
<tr<?php if (isset ( $this->_tpl_vars['this']->errors['name'] )): ?> class="error"<?php endif; ?>> 
    <td>Uw naam:</td> 
    <td><input type="text" name="gb_name" size="30" value="<?php echo $_POST['gb_name']; ?>
" /></td> 
    <td>Wij houden niet van anonieme inzenders</td> 
  </tr><tr<?php if (isset ( $this->_tpl_vars['this']->errors['email'] )): ?> class="error"<?php endif; ?>> 
    <td>e-mail adres:</td> 
    <td><input type="text" name="gb_email" size="30" value="<?php echo $_POST['gb_email']; ?>
" /></td> 
    <td>Wij willen graag reageren als dat zinvol is</td> 
  </tr><tr<?php if (isset ( $this->_tpl_vars['this']->errors['website'] )): ?> class="error"<?php endif; ?>> 
    <td>Uw homepage:</td> 
    <td><input type="text" name="gb_website" value="<?php echo smarty_function_ifsetor(array('if' => $_POST['gb_website'],'or' => "http://"), $this);?>
" size="30"></td> 
    <td>Kunt u ook een beetje reclame maken voor uzelf of uw eigen vereniging
  </tr><tr<?php if (isset ( $this->_tpl_vars['this']->errors['message'] )): ?> class="error"<?php endif; ?>> 
    <td colspan="3">Uw boodschap:<br> 
    <textarea name="gb_message" rows="6" COLS="90"><?php echo $_POST['gb_message']; ?>
</textarea> 
    </td> 
  </tr><tr> 
 
<td> 
<input type="submit" value="VERSTUUR"></input> 
</td><td> 
<input type="reset" value="Wissen"></input> 
</td> 
</tr> 
</table> 
</form>
<p>Of het standaard formulier, automatisch aangeleverd incl foutmeldingen erin (zonder TABLE, heel CSS pimpable):</p>
<div class="gbform"><?php echo $this->_tpl_vars['this']->getForm(); ?>
</div>

<hr />

<p>Er staan <?php echo count($this->_tpl_vars['this']->getEntries()); ?>
 berichten in het gastenboek:</p>

<hr />

<div class="entries">
<?php $_from = $this->_tpl_vars['this']->getEntries(0,'utc DESC'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
	foreach ($_from as $this->_tpl_vars['entry']):
?>
<?php $this->assign('ws', $this->_tpl_vars['entry']->website);
 ?><?php if ($this->_tpl_vars['ws'] && ! ((is_array($_tmp=$this->_tpl_vars['ws'])) ? $this->_run_mod_handler('startswith', true, $_tmp, 'http://') : smarty_modifier_startswith($_tmp, 'http://'))): ?><?php $this->assign('ws', "http://$this->_tpl_vars['ws']");
 ?><?php endif; ?>
<div class="entry">
<div class="name">Door: <span class="name"><a<?php if ($this->_tpl_vars['ws']): ?> href="<?php echo $this->_tpl_vars['ws']; ?>
"<?php endif; ?>><?php echo $this->_tpl_vars['entry']->name; ?>
</a></span>, op <?php echo ((is_array($_tmp=$this->_tpl_vars['entry']->utc)) ? $this->_run_mod_handler('date', true, $_tmp, 'd-m-Y \o\m H:i') : smarty_modifier_date($_tmp, 'd-m-Y \o\m H:i')); ?>
</div>
<div class="message"><?php echo $this->_tpl_vars['entry']->message; ?>
</div>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>