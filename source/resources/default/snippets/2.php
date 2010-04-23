<html>

<head>
<title>SumUmbra|<?$this->title?></title>
<link rel="shortcut icon" href="/images/favicon.ico" /> 
<link rel="stylesheet" type="text/css" href="/style.css" />
</head>

<body>

<div id="menu">
<ul>
<?assign mi=$this->load('menu')?><?assign mi=$mi->getMenuItems()?>
<?foreach from=$mi item=item?>
	<li><?if '-' == $item->title?><br /><?else?><a<?if $server.REQUEST_URI|startswith:$item->link?> class="current"<?/if?> href="<?$item->link?>"<?if $item->important?> style="color:red;"<?/if?>><?$item->title?></a><?/if?></li>
<?/foreach?>
</ul>
</div>

<h1><?$this->title?><?if in_array(strtolower(get_class($this)), array('aroguestbookimplementation'))?> - <?$this->root->getEntries()|@count?> berichten<?/if?></h1>
<?if 'index'==$this->id?><h1>Meerveldhoven</h1><?/if?>
