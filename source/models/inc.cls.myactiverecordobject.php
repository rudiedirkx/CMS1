<?php

class MyActiveRecordObject extends ActiveRecordObject {

	static public function urlEscape( $f_szUrlPart ) {
		return preg_replace('/_{2,}/', '_', preg_replace('/[^a-z0-9,\.\-_\'\?\!\(\)]/i', '_', $f_szUrlPart));
	}


	public function admin() {
		return '/admin/';
	}
	public function goToAdmin() {
		header('Location: '.$this->admin());
		exit;
	}


	public $m_bConfigsFetched = false;
	public function getConfig( $f_szKey, $f_szAlternative = null ) {
		if ( !$this->m_bConfigsFetched ) {
			$this->saveConfigs();
		}
		return $this->$f_szKey;
	}
	public function setConfig( $k, $v ) {
		if ( null === $v ) {
			return $this->unsetConfig($k);
		}
		$this->$k = $v;
		$pk = $this->getStaticChildValue('pk');
		return $GLOBALS['db']->replace_into('custom_configs', array(
			'config_key' => $k,
			'config_value' => $v,
			'table_name' => $this->getStaticChildValue('table'),
			'object_id' => $this->$pk
		));
	}
	public function unsetConfig( $k ) {
		$pk = $this->getStaticChildValue('pk');
		$args = func_get_args();
		$keys = array_map('addslashes', $args);
		return $GLOBALS['db']->delete('custom_configs', "table_name = '".addslashes($this->getStaticChildValue('table'))."' AND object_id = '".(int)$this->$pk."' AND config_key IN ('".implode("', '", $keys)."')");
	}
	public function saveConfigs() {
		$pk = $this->getStaticChildValue('pk');
		$this->fill($GLOBALS['db']->select_fields('custom_configs', 'config_key,config_value', "table_name = '".addslashes($this->getStaticChildValue('table'))."' AND object_id = ".(int)$this->$pk));
		$this->m_bConfigsFetched = true;
	}



}


