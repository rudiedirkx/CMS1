<?load id=header?>

<?$this->content_1?>

<div class="newsitems">
<?foreach from=$this->root->getNewsItems() item=item?>
<div class="newsitem"<?if $item->align_right?> style="text-align:right;"<?/if?>>
<h2><a href="<?$item->relative_url?>"><?$item->title?></a> <span class="date"><?$item->created|date:'d-m-Y H:i'?></span></h2>
<?$item->content_1?>
<?if 'story' == $item->type?><?$item->content_2?><?else?><p><b>Gallerij:</b> <?foreach from=$item->getImages() item=img?><a href="<?$img->image?>"><img src="<?$img->image?>" width="100" /></a> <?/foreach?></p><?/if?>
<p class="links"><a href="<?$item->relative_url?>">Lees alles</a></p>
</div>
<?/foreach?>
</div>

<?load id=footer?>