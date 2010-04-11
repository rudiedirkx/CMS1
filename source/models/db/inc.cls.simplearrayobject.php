<?php

class SimpleArrayObject {

	public function set($k, $v) {
		$this->$k = $v;
	}

	public function __construct($data = null) {
		if ( null !== $data && !is_scalar($data) ) {
			foreach ( $data AS $k => $v ) {
				$this->$k = $v;
			}
		}
	}

} // END Class SimpleArrayObject


