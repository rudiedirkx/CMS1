<html>

<head>
<meta http-equiv="Content-Language" content="nl"> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"> 
<title>Homepage Mozaiek</title> 
<style type="text/css">
body, table { font-family:Arial; font-size:13px; color:#FFFF00; }
a { color:white; }
a:hover { color:red; font-weight:bold; }
#wrapper { }
div.gb-form { width:160px; margin:0 auto; }
div.gb-form span.label, div.gb-form span.value { display:block; }
div.gb-form input, div.gb-form textarea { width:160px; }
div.gb-form div.submit { padding-top:10px; }
div.gb-form input.submit { display:block; width:110px; margin:0 auto; }
div.gb-form div.error input, div.gb-form div.error textarea { color:white; background-color:red; }
td#content-1 p { padding:0 5px; }
td#content-1 p.nulpad { padding:0; margin:0; }
</style> 
</head> 

<body class="p9-<?$this->id?> p0-<?$this->root->id?>">

<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%"><tr><td valign="middle" align="center">

<div id="wrapper">
<table border="0" cellpadding="0" cellspacing="0" width="1177" height="616">
	<tr>
		<td valign="middle" bgcolor="#990000" colspan="2" bordercolor="#990000"><h1 style="color:white;margin:0;" align="center"><?$this->title?></h1></td>
		<td valign="top" bgcolor="#990000"><?assign fe=$this->file_exists('/images/boven_'.$this->id.'.jpg')?><img border="0" src="/images/<?if $fe?>boven_<?$this->id?>.jpg<?else?>boven_index.jpg<?/if?>" width="556" height="162"></td>
		<td valign="top" bgcolor="#990000"><?if 'index' != $this->id?><img border="0" src="/images/achtergrond161.jpg" width="255" height="161"><?else?>&nbsp;<?/if?></td>
		<td height="162"></td>
	</tr>
<?assign mis=$this->load('hoofdmenu')->getMenuItems()?>
	<tr>

<!-- menu -->
<td valign="top" bgcolor="#990000" align="center" style="border-right-style: solid; border-right-width: 1px" bordercolor="#990000">
	<table border="0" cellpadding="0" cellspacing="0" height="100%" align="center">
	<?foreach from=$mis key=k item=mi?>
		<tr><td valign="middle" align="center"><h5 style="margin:0;"><?if 1 or $mi->relative_url != $this->relative_url?><a href="<?$mi->link?>"><?$mi->title?></a><?else?><?$mi->title?><?/if?></h5></td></tr>
	<?/foreach?>
	</table>
</td> 
