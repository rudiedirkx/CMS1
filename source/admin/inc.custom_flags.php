
<p id="custom_flags">Custom flags<br /><?foreach ( array('special_1','special_2','special_3') AS $name ): if ( $objOwner->$name ):?><style>#custom_flags{display:block;}</style><? if ( is_int(strpos($objOwner->$name, '=')) ) { ?><?$t_name=str_replace('=','',$objOwner->$name)?><?=$t_name?>: <input name="cflags[<?=$t_name?>]"<?=isset($objItem)?' value="'.$objItem->{$t_name}.'"':''?> /><? } else if ( is_int(strpos($objOwner->$name, ':')) && is_int(strpos($objOwner->$name, '|')) ) { $x=explode(':', $objOwner->$name); $t_name=$x[0]; ?><?=$t_name?>: <select name="cflags[<?=$t_name?>]"><?foreach (explode('|', $x[1]) AS $value){?><option value="<?=$value?>"<?=isset($objItem)&&$objItem->{$t_name}===$value?' selected':''?>><?=$value?></option><?}?></select><? } else { $t_name=$objOwner->$name; ?><label for="cf_<?=$name?>"><input id="cf_<?=$name?>" type="checkbox" name="cflags[<?=$objOwner->$name?>]" value="1"<?=isset($objItem)&&$objItem->{$t_name}?' checked':''?> /> <?=$t_name?></label><? } ?><br /><?endif; endforeach;?></p>
