<?php

require_once('cfg_admin.php');

function explore( $dir ) {
	$html = '';
	if ( 0 < count($content = glob($dir.'/*')) ) {
		$html .= '<ul>';
		foreach ( $content AS $f ) {
			if ( '_' != substr(basename($f), 0, 1) ) {
				$file = substr($f, strlen(PROJECT_PUBLIC));
				if ( !is_dir($f) ) {
					$html .= '<li><a href="'.$file.'">'.basename($file).'</a></li>';
				}
				else {
					$html .= '<li>'.basename($file).explore($f).'</li>';
				}
			}
		}
		$html .= '</ul>';
	}
	return $html;
}

echo '<html><body style="background:white none no-repeat center center;">';

echo explore(PROJECT_PUBLIC);

?>
<script type="text/javascript">
var INSTANCE_NAME = '<?php echo $_GET['CKEditor']; ?>', FUNC_NUM = <?php echo (int)$_GET['CKEditorFuncNum']; ?>;
var as = document.getElementsByTagName('A'), i = as.length;
while ( i-- ) {
	as[i].onmouseover = function() {
		document.body.style.backgroundImage = 'url('+this.getAttribute('href')+')';
	}
	as[i].onmouseout = function() {
		document.body.style.backgroundImage = '';
	}
	as[i].onclick = function() {
//		window.opener.CKEDITOR.instances[INSTANCE_NAME];
		window.opener.CKEDITOR.tools.callFunction(FUNC_NUM, this.getAttribute('href'));
		window.close();
		return false;
	}
}
console.log(opener);
</script>

</body></html>
