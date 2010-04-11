<p>Categorieen:</p>
<ul>
<?foreach from=$this->getCategories() item=cat?>
<li><a href="<?$cat->relative_url?>"><?$cat->title?></a></li>
<?/foreach?>
</ul>