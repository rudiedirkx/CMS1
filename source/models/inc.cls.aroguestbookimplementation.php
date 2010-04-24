<?php

require_once(dirname(__FILE__).'/inc.cls.extended_activerecordobject.php');

class AROGuestbookImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'guestbook_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array(
		
	);

	public static $m_arrFields = array('name', 'email', 'website', 'subject', 'message', 'message_2');
	public $_type = 'guestbook';
	public $errors = array();


	public function admin() {
		return '/admin/guestbook/edit.php?id='.$this->id;
	}


	public function __construct($data=null) {
		parent::__construct($data);
		$this->guestbook = $this;
		$this->root = $this;
	}


	public function getEntry( $f_iEntryId ) {
		$objEntry = AROGuestbookEntry::finder()->findOne('id = ? AND guestbook_implementation_id = ?', $f_iEntryId, $this->implementation_id)->init($this);
		return $objEntry;
	}


	public function getForm() {
		$arrShow = self::$m_arrFields;
		$szHtml = '<div class="guestbook form gb-form '.$this->id.'"><form method="post" action="/'.$this->id.'/submit">';
		foreach ( $arrShow AS $szField ) {
			if ( 'message' === $szField || '1' === $this->{'use_'.$szField} ) {
				$szHtml .= '<div class="field '.$szField.( isset($this->errors[$szField]) ? ' error': '' ).'"><span class="label">'.$this->{'label_for_'.$szField}.'</span><span class="value">'.( 0 === strpos($szField, 'message') ? '<textarea name="gb_'.$szField.'" class="field">'.( isset($_POST['gb_'.$szField]) ? $_POST['gb_'.$szField] : '' ).'</textarea>' : '<input type="text" name="gb_'.$szField.'" class="field" value="'.( isset($_POST['gb_'.$szField]) ? $_POST['gb_'.$szField] : '' ).'" maxlength="60" />' ).'</span>'.( false && isset($this->errors[$szField]) ? '<span class="error">'.$this->errors[$szField].'</span>' : '' ).'</div>';
			}
		}
		$szHtml .= '<div class="field submit"><span class="field"><input type="submit" class="submit" value="'.$this->label_for_submit_button.'" /></span></div>';
		$szHtml .= '</form></div>';
		return $szHtml;
	}


	public $_entries = null;
	public function getEntries( $f_iLimit = 0, $f_szOrder = 'o ASC' ) {
		if ( null === $this->_entries ) {
			$es = AROGuestbookEntry::finder()->findMany('deleted = \'0\' AND '.( $this->must_verify ? 'verified = \'1\' AND ' : '' ).'guestbook_implementation_id = ? ORDER BY '.$f_szOrder.', id ASC'.( 0 < $f_iLimit ? ' LIMIT '.$f_iLimit : '' ), $this->implementation_id);
			if ( 0 < count($es) ) {
				$es[0]->sequenceStart = true;
				$es[count($es)-1]->sequenceEnd = true;
			}
			foreach ( $es AS $e ) {
				$e->init($this);
			}
			$this->_entries = $es;
		}
		return $this->_entries;
	}


	public function parse( &$f_pszViewType = null ) {
		if ( 0 == count($this->details) || ( 1 == count($this->details) && 'submit' == $this->details[0] ) ) {
			$szViewType = 'guestbook';
		}
		else {
			$szViewType = 'guestbookEntry';
		}
		$f_pszViewType = $szViewType;
		$objView = AROView::getView($szViewType, $this->id);
		if ( !is_object($objView) ) {
			throw new NoTemplateFoundException(array($szViewType));
		}
		$this->guestbook = $this;
		switch ( $szViewType ) {
			case 'guestbook':
				if ( 0 < count($this->details) && 'submit' == $this->details[0] && 'POST' == $_SERVER['REQUEST_METHOD'] ) {
					$arrShow = self::$m_arrFields;
					$arrErrors = $arrInsert = array();
					foreach ( $arrShow AS $szField ) {
						if ( 'message' === $szField || '1' === $this->{'use_'.$szField} ) {
							if ( ( 'message' == $szField || '1' === $this->{'mandatory_'.$szField} ) && ( empty($_POST['gb_'.$szField]) || ( 'email' == $szField && $this->check_email_regexp && !preg_match('/^[a-z0-9\-_.]{2,}@[a-z0-9\-_.]{2,}\.[a-z]{2,10}$/i', $_POST['gb_'.$szField]) ) ) ) {
								$arrErrors[$szField] = 'Invalid value';
							}
							else {
								$arrInsert[$szField] = isset($_POST['gb_'.$szField]) ? $_POST['gb_'.$szField] : '';
							}
						}
					}
					if ( 0 == count($arrErrors) ) {
						// Insert!
						$arrInsert['guestbook_implementation_id'] = $this->implementation_id;
						$arrInsert['utc'] = time();
						$arrInsert['ip'] = $_SERVER['REMOTE_ADDR'];
						$arrInsert['o'] = (int)$this->getDbObject()->select_one('guestbook_entries', 'MAX(o)', 'guestbook_implementation_id = '.$this->implementation_id)+1;
						$this->getDbObject()->insert('guestbook_entries', $arrInsert);
						header('Location: '.$this->return_url);
						exit;
					}
					$this->errors = $arrErrors;
				}
				$this->parseView( $objView );
			break;
			case 'guestbookEntry':
				$entry = $this->getEntry($this->details[0]);
				$entry->parseView( $objView );
			break;
		}
		return true;
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


