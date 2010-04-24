<?php

require_once(dirname(__FILE__).'/inc.cls.extended_activerecordobject.php');

class AROSnippetImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'snippet_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array();

	public $_type = 'snippet';


	public function parse( &$f_pszViewType = null, $f_arrContext = array() ) {
		$page = $GLOBALS['page'];
		$szSnippetPath = PROJECT_SNIPPETS.'/'.$this->implementation_id.'.php';
		$bOutput = false;
		if ( $page === $this ) {
			$bOutput = true;
			header('Content-Type: '.$this->content_type);
			header('Last-Modified: '.gmdate('D, d M Y H:i:s', $this->modified_time).' GMT', true);
			/*$bValidCache = isset($_SERVER['HTTP_IF_NONE_MATCH']) && md5_file($szSnippetPath) == $_SERVER['HTTP_IF_NONE_MATCH'];
			header('Cache-Control: max-age=3600');
			header('Etag: '.md5_file($szSnippetPath));
			header('Expires: '.gmdate('D, d M Y H:i:s', strtotime('+7 days', $this->modified_time)).' GMT');*/
		}
		$tpl = new SmartyTpl( $page, $this, 'snippets' );
		if ( is_array($f_arrContext) ) {
			foreach ( $f_arrContext AS $k => $v ) {
				$tpl->assign( $k, $v );
			}
		}
		$szOutput = $tpl->fetch($szSnippetPath);
		if ( !$bOutput ) {
			return $szOutput;
		}
		echo $szOutput;
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


