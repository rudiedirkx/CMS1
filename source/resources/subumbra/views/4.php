<?load id=header?>

<?if $this->fileExists("images/page-`$this->id`.jpg")?><img src="/images/page-<?$this->id?>.jpg" align="right" /><?/if?>

<?$this->content_1?>

<?if $this->image?>
<p><a href="<?$this->image?>" alt="<?$this->title?>" title="<?$this->title?>"><img src="<?$this->image?>" /></a></p>
<?assign prev=$this->getPrevImage() next=$this->getNextImage()?><p><a<?if $prev?> href="<?$prev->relative_url?>"<?/if?>>Prev</a> | <a<?if $next?> href="<?$next->relative_url?>"<?/if?>>Next</a></p>
<?/if?>

<?load id=footer?>