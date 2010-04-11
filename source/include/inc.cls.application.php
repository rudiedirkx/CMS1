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
		return $this->$f_szKey;
	}
	public function saveConfigs() {
		$this->fill($GLOBALS['db']->select_fields('custom_configs', 'config_key,config_value', 'table_name IS NULL AND object_id IS NULL'));
		$this->m_bConfigsFetched = true;
	}

	public function fill($data) {
		foreach ( $data AS $k => $v ) {
			$this->$k = $v;
		}
	}


}


