<html>

<head>
<style type="text/css">
body { font-family:Arial; font-size:14px; }
a { font-size:15px; color:#800; }
h1 a, h2 a, h3 a { font-size:inherit; }
form{padding:0;margin:0;}
th.hd{font-size:20px;}
th,td{padding:4px;}
.floating-tables table { font-family:Arial;float:left;margin-right:10px; }
.floating-tables { clear:both; }
.floating-tables form { clear:none; overflow:visible; }
.userinfo { padding-bottom:7px; }
ul.error, ul.success { padding:2px 4px 2px 30px; background-color:#faa; border:solid 1px red; border-width:2px 5px; color:red; }
ul.success { background-color:#afa; border-color:green; color:green; }
ul.error li, ul.success li { padding:2px 0; }
p.ft-id { }
p.ft-title { }
p.ft-content { }
</style>
<script type="text/javascript" src="/admin/_resources/mootools_1_11.js"></script>
<script type="text/javascript" src="/admin/_resources/javascripts.js"></script>
<script type="text/javascript" src="/admin/_resources/ckeditor/ckeditor.js"></script>
</head>

<body>

<div class="userinfo">[<a href="/admin/">Home</a>] | Ingelogd als: <?=$g_objAdmin->name?> (<?=$g_objAdmin->username?>) (<?=$g_objAdmin->user_type?>) | <a href="/admin/login.php?logout=1">uitloggen</a> | <a href="/admin/logs.php">logs</a> | <a href="/admin/routes.php">routes</a> | (<a href="/admin/editor.php">editor setup</a>)</div>
