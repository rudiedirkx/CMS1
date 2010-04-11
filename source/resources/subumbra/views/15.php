<p>Producten:</p>
<ul>
<?foreach from=$this->getProducts() item=prod?>
<li><a href="<?$prod->relative_url?>"><?$prod->title?></a></li>
<?/foreach?>
</ul>