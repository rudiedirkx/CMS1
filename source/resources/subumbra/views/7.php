<?load id=header?>

<p>Custom formulier, zelf gemaakt in HTML (deze is met TABLE):</p>
<form action="/gastenboek/submit" method="post">
<table border="0" cellpadding="2" cellspacing="0"> 
  <tr> 
    <td colspan="2"><?$this->content_1?></td>
    <td><IMG SRC="http://subumbra.nl/images/SUlogo-zw-plat-klein.gif" ALT="logo" ID="INHOUD_PLAATJE1" width="100" height="100"></img></td> 
  </tr>
<tr<?if isset($this->errors.name)?> class="error"<?/if?>> 
    <td>Uw naam:</td> 
    <td><input type="text" name="gb_name" size="30" value="<?$smarty.post.gb_name?>" /></td> 
    <td>Wij houden niet van anonieme inzenders</td> 
  </tr><tr<?if isset($this->errors.email)?> class="error"<?/if?>> 
    <td>e-mail adres:</td> 
    <td><input type="text" name="gb_email" size="30" value="<?$smarty.post.gb_email?>" /></td> 
    <td>Wij willen graag reageren als dat zinvol is</td> 
  </tr><tr<?if isset($this->errors.website)?> class="error"<?/if?>> 
    <td>Uw homepage:</td> 
    <td><input type="text" name="gb_website" value="<?ifsetor if=$smarty.post.gb_website' or="http://"?>" size="30"></td> 
    <td>Kunt u ook een beetje reclame maken voor uzelf of uw eigen vereniging
  </tr><tr<?if isset($this->errors.message)?> class="error"<?/if?>> 
    <td colspan="3">Uw boodschap:<br> 
    <textarea name="gb_message" rows="6" COLS="90"><?$smarty.post.gb_message?></textarea> 
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
<div class="gbform"><?$this->getForm()?></div>

<hr />

<p>Er staan <?$this->getEntries()|@count?> berichten in het gastenboek:</p>

<hr />

<div class="entries">
<?foreach from=$this->getEntries(0, 'utc DESC') item=entry?>
<?assign ws=$entry->website?><?if $ws and !$ws|startswith:'http://'?><?assign ws="http://$ws"?><?/if?>
<div class="entry">
<div class="name">Door: <span class="name"><a<?if $ws?> href="<?$ws?>"<?/if?>><?$entry->name?></a></span>, op <?$entry->utc|date:'d-m-Y \o\m H:i'?></div>
<div class="message"><?$entry->message?></div>
</div>
<?/foreach?>
</div>