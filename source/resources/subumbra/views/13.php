<?load id=header?>

<ul>
<?foreach from=$this->root->getNewsItems() item=item?>
<li><a href="<?$item->relative_url?>"><?$item->title?></a></li>
<?/foreach?>
</ul>

<?load id=footer?>