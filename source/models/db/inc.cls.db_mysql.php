<?php # ?

require_once(dirname(__FILE__).'/inc.cls.db_generic.php');
require_once(dirname(__FILE__).'/inc.cls.simplearrayobject.php');

class db_mysql extends db_generic {

	protected $dbCon = null;
	public $error = '';
	public $errno = 0;
	public $num_queries = 0;
	public $queries = array();

	public function __construct( $f_szHost, $f_szUser = '', $f_szPass = '', $f_szDb = '' ) {
		if ( !($this->dbCon = mysql_connect($f_szHost, $f_szUser, $f_szPass, true)) ) {
			return $this->saveError();
		}
		if ( !mysql_select_db($f_szDb, $this->dbCon) ) {
			return $this->saveError();
		}
	}

	public function saveError() {
		if ( $this->connected() ) {
			$this->error = mysql_error($this->dbCon);
			$this->errno = mysql_errno($this->dbCon);
		}
		else {
			$this->error = mysqli_connect_error();
			$this->errno = mysqli_connect_errno();
		}
	}

	public function connected() {
		return is_resource($this->dbCon);
	}

	public function close() {
		return mysql_close($this->dbCon);
	}

	public function escape($v) {
		return mysql_real_escape_string($v, $this->dbCon);
	}

	public function insert_id() {
		return mysql_insert_id($this->dbCon);
	}

	public function affected_rows() {
		return mysql_affected_rows($this->dbCon);
	}

	public function query( $f_szSqlQuery ) {
		$r = mysql_query($f_szSqlQuery, $this->dbCon);
		$this->error = $r ? '' : mysql_error($this->dbCon);
		$this->errno = $r ? 0 : mysql_errno($this->dbCon);
		$this->num_queries++;
		return $r;
	}

	public function fetch($f_szSqlQuery, $f_szClass = 'SimpleArrayObject') {
		$szClass = class_exists($f_szClass, true) ? $f_szClass : 'SimpleArrayObject';
		$r = $this->query($f_szSqlQuery);
		if ( !is_resource($r) ) {
			return false;
		}
		$a = array();
		while ( $l = mysql_fetch_assoc($r) ) {
			$a[] = new $szClass($l);
		}
		return $a;
	}

	public function fetch_fields($f_szSqlQuery) {
		$r = $this->query($f_szSqlQuery);
		if ( !is_resource($r) ) {
			return false;
		}
		$a = array();
		while ( $l = mysql_fetch_row($r) ) {
			$a[$l[0]] = $l[1];
		}
		return $a;
	}

	public function select_one($tbl, $field, $where = '') {
		$r = $this->query('SELECT '.$field.' FROM '.$tbl.( $where ? ' WHERE '.$where : '' ).' LIMIT 1;');
		if ( !$r || 0 >= mysql_num_rows($r) ) {
			return false;
		}
		return mysql_result($r, 0);
	}

	public function count_rows($f_szSqlQuery) {
		$r = $this->query($f_szSqlQuery);
		if ( !$r ) {
			return false;
		}
		return mysql_num_rows($r);
	}

	public function select_by_field($tbl, $field, $where = '', $f_szClass = 'SimpleArrayObject') {
		$szClass = class_exists($f_szClass, true) ? $f_szClass : 'SimpleArrayObject';
		$r = $this->query('SELECT * FROM '.$tbl.( $where ? ' WHERE '.$where : '' ).';');
		if ( !is_resource($r) ) {
			return false;
		}
		$a = new SimpleArrayObject;
		while ( $l = mysql_fetch_assoc($r) ) {
			$a->set($l[$field], new $szClass($l));
		}
		return $a;
	}

} // END Class db_mysql


