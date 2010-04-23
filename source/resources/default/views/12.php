<?load id=header?>

<?$this->content_1?>

<?foreach from=$this->getImages() item=img?>
<a href="<?$img->relative_url?>" title="<?$img->title?>"><img alt="<?$img->title?>" src="<?$img->image?>" height="200" /></a>
<?/foreach?>

<?$this->content_2?>

<?load id=footer?>