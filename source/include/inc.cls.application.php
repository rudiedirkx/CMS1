<?php

class Application {

	public function __construct( $f_szSiteName = '' ) {
		
	}

	public $m_bConfigsFetched = false;
	public $m_arrConfigs = array();
	public function getConfig( $f_szKey, $f_szAlternative = null ) {
		if ( !$this->m_bConfigsFetched ) {
			$this->saveConfigs();
		}
		return property_exists($this, $f_szKey) ? $this->$f_szKey : null;
	}
	public function saveConfigs() {
		$this->fill($GLOBALS['db']->select_fields('custom_configs', 'config_key,config_value', 'table_name = \'\' AND object_id = 0'));
		$this->m_bConfigsFetched = true;
	}
	public function setConfig( $k, $v ) {
		if ( null === $v ) {
			return $this->unsetConfig($k);
		}
		$this->$k = $v;
		return $GLOBALS['db']->replace_into('custom_configs', array(
			'config_key' => $k,
			'config_value' => $v,
			'table_name' => '',
			'object_id' => 0
		));
	}
	public function unsetConfig( $k ) {
		$pk = $this->getStaticChildValue('pk');
		$args = func_get_args();
		$keys = array_map('addslashes', $args);
		return $GLOBALS['db']->delete('custom_configs', "table_name = \'\' AND object_id = 0 AND config_key IN ('".implode("', '", $keys)."')");
	}

	public function fill($data) {
		foreach ( $data AS $k => $v ) {
			$this->$k = $v;
		}
	}


}

class PageNotFoundException extends Exception {}

class NoTemplateFoundException extends Exception {
	public $m_arrViewTypes = array();
	public function __construct( Array $f_arrViewTypes ) {
		$this->m_arrViewTypes = $f_arrViewTypes;
	}
}

class TemplateErrorException extends Exception {}


