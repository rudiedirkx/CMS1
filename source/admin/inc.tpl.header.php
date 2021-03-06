<html>

<head>
<style type="text/css">
body { font-family:Arial; font-size:14px; padding-bottom:20px; }
a { font-size:15px; color:#800; }
h1 a, h2 a, h3 a { font-size:inherit; }
form{padding:0;margin:0;}
th.hd{font-size:20px;}
th,td{padding:3px;}
.floating-tables table { font-family:Arial;float:left;margin-right:10px; }
.floating-tables { clear:both; }
.floating-tables form { clear:none; overflow:visible; }
.userinfo { padding-bottom:10px; }
ul.error, ul.success { padding:2px 4px 2px 30px; background-color:#faa; border:solid 1px red; border-width:2px 5px; color:red; }
ul.success { background-color:#afa; border-color:green; color:green; }
ul.error li, ul.success li { padding:2px 0; }
p.ft-id { }
p.ft-title { }
p.ft-content { }
div#cols { clear:both; }
div#leftcol { float:left; width:140px; background-color:#ddd; padding:0 10px 10px; margin-right:10px; }
div#leftcol td { padding:0; }
div#leftcol th { padding-top:12px; }
div#leftcol td a { padding:3px; display:block; }
div#leftcol td a:hover { background-color:#eee; }
div#rightcol { margin-left:180px; margin-right:10px; }
#custom_flags { display:none; }
img.item-image-preview { max-width:150px; max-height:100px; border:0; }
#messages > div { /**/display:none;/**/ margin:2px 0; border:solid 2px #000; color:#000; padding:3px 8px; font-weight:bold; }
#messages div.successes { border-color:green; background-color:#afa; }
#messages div.notices { border-color:blue; background-color:lightblue; }
#messages div.warnings { border-color:#ff8c00; background-color:gold; }
#messages div.errors { border-color:#c00; background-color:#faa; }
#messages div div { padding:2px 0; }
</style>
<script type="text/javascript" src="/admin/_resources/mootools_1_11.js"></script>
<script type="text/javascript" src="/admin/_resources/javascripts.js"></script>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>
</head>

<body>

<div class="userinfo">[<a href="/admin/">Home</a>] | Ingelogd als: <?=$g_objAdmin->name?> (<?=$g_objAdmin->username?>) (<?=$g_objAdmin->user_type?>) | <a href="/admin/login.php?logout=1">uitloggen</a> | <a href="/admin/logs.php">logs</a> | <a href="/admin/routes.php">routes</a> | (<a href="/admin/editor.php">editor setup</a>)</div>

<div id="cols">

	<div id="leftcol">
		<table border="0" width="100%" cellspacing="0">
<?php

echo '<tr><th>Pages</th></tr>';
$arrImplementations = AROImplementation::finder()->findMany("type <> 'snippet' AND id NOT LIKE '%/%' ORDER BY id ASC");
foreach ( $arrImplementations AS $imp ) { echo '<tr><td><a href="/admin/'.$imp->type.'/edit.php?id='.$imp->id.'">'.$imp->id.'</a></td></tr>'; }

echo '<tr><th>(<a href="/admin/_view/sort.php">&gt;</a>) Templates (<a href="/admin/_view/add.php">+</a>)</th></tr>';
$arrViews = AROView::finder()->findMany('1 ORDER BY o ASC');
foreach ( $arrViews AS $view ) { echo '<tr><td><a'.( $g_objAdmin->allowEditView() ? ' href="/admin/_view/edit.php?id='.$view->id.'"' : '' ).'>'.$view->title.'</a></td></tr>'; }

echo '<tr><th>Snippets (<a href="/admin/snippet/add.php">+</a>)</th></tr>';
$arrSnippets = AROImplementation::finder()->findMany("type = 'snippet' ORDER BY title ASC");
foreach ( $arrSnippets AS $snippet ) { echo '<tr><td><a'.( $g_objAdmin->allowEditSnippet() ? ' href="/admin/snippet/edit.php?id='.$snippet->id.'"' : '' ).'>'.$snippet->id.'</a></td></tr>'; }

echo '<tr><th>File folders (<a href="/admin/filefolder/add.php">+</a>)</th></tr>';
foreach ( $g_arrFileFolders AS $f ) { echo '<tr><td><a href="/admin/filefolder/edit.php?id='.basename($f).'">'.basename($f).'</a></td></tr>'; }

?>
		</table>
	</div>

	<div id="rightcol">

		<div id="messages">
			<div class="successes"><div>This is not a success</div></div>
			<div class="notices"><div>This is not a notice</div></div>
			<div class="warnings"><div>This is not a warning</div></div>
			<div class="errors"><div>This is not an error</div></div>
		</div>
