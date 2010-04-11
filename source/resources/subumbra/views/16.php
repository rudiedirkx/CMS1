<html>

<ul>
<?foreach from=$this->getMenuItems() item=mi?>
<li><?if '-' != $mi->title?><a href="<?$mi->link?>"><?$mi->title?></a><?else?>&nbsp;<?/if?></li>
<?/foreach?>
</ul>

</html>