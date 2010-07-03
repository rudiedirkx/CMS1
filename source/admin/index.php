<?php

require_once('cfg_admin.php');

logincheck();

tpl_header();

?>

<p>Hier zal dan nog wel iets van een handig overzicht komen..?</p>

<?php

if ( $g_objAdmin->allowAddObject() ) {
	echo '<form onsubmit="document.location=\'./\'+this._type.value+\'/add.php\';return false;"><p>New <select name="_type">'.implode('', array_map(create_function('$type', 'return \'<option value="\'.$type->type.\'">\'.$type->name.\'</option>\';'), $root->select('implementation_types', 'enabled = 1'))).'</select> <input type="submit" value="&gt;" /></p></form>';
}

tpl_footer();



