<?php

require_once(dirname(__FILE__).'/inc.cls.extended_activerecordobject.php');

class AROFormImplementation extends Extended_ActiveRecordObject {

	protected static $_table = 'form_implementations';
	protected static $_columns = array();
	protected static $_pk = 'implementation_id';
	protected static $_relations = array();

	public static $m_arrFieldTypes = array('label', 'textbox', 'email', 'textarea', 'checkbox', 'checkboxes', 'radiobuttons', 'select', 'specialtextbox');
	public $_type = 'form';


	public function admin() {
		return '/admin/form/edit.php?id='.$this->id;
	}


	public function getForm() {
		$arrFields = $this->getFields();
		$szHtml = '<div class="feedback form fb-form '.$this->id.'"><form method="post" action="/'.$this->id.'/submit">';
		foreach ( $arrFields AS $field ) {
			$szHtml .= '<div class="field field_'.$field->type.' field_'.$field->id.( isset($this->errors[$field->id]) ? ' field_error': '' ).'"><span class="label">'.$field->label_1.'</span>'.( $field->label_2 ? '<span class="label_2">'.$field->label_2.'</span>' : '' );
			switch ( $field->type ) {
				case 'textbox':
				case 'specialtextbox':
				case 'email':
					$szHtml .= '<span class="value">';
					$szHtml .= '<input type="text" name="field_'.$field->id.'" value="'.$field->options.'" />';
					$szHtml .= '</span>';
				break;
				case 'textarea':
					$szHtml .= '<span class="value">';
					$szHtml .= '<textarea name="field_'.$field->id.'">'.htmlspecialchars($field->options).'</textarea>';
					$szHtml .= '</span>';
				break;
				case 'checkbox':
					$szHtml .= '<span class="value">';
					$szHtml .= '<input type="checkbox" class="checkbox" value="1" name="field_'.$field->id.'" />';
					$szHtml .= '</span>';
				break;
				case 'checkboxes':
					$szHtml .= '<span class="value">';
					foreach ( explode("\n", $field->options) AS $i => $option ) {
						$o = explode(':', $option, 2);
						if ( 1 == count($o) || !$o[0] ) {
							$k = $v = $option;
						}
						else {
							list($k, $v) = $o;
						}
						$szHtml .= '<label class="option" for="field_'.$field->id.'_'.$i.'"><input id="field_'.$field->id.'_'.$i.'" type="checkbox" class="checkbox" name="field_'.$field->id.'[]" value="'.$k.'" /> '.$v.'</label>';
					}
					$szHtml .= '</span>';
				break;
			}
			$szHtml .= '<span class="label_3">'.$field->label_3.'</span>';
			$szHtml .= '</div>';
		}
		$szHtml .= '<div class="field submit"><span class="field"><input type="submit" class="submit" value="SUBMIT" /></span></div>';
		$szHtml .= '</form></div>';
		return $szHtml;
	}


	public function getField($id) {
		return AROFormField::finder()->findOne('form_implementation_id = ? AND id = ?', $this->implementation_id, $id);
	}


	public function getFields() {
		return AROFormField::finder()->findMany('form_implementation_id = ? ORDER BY o ASC', $this->implementation_id);
	}


	public function parse( &$f_pszViewType = null ) {
		$szViewType = 'form';
		$f_pszViewType = $szViewType;
		$objView = AROView::getView($szViewType, $this->id);
		if ( !is_object($objView) ) {
			throw new NoTemplateFoundException(array($szViewType));
		}
		$this->parseView($objView);
		return true;
	}



	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


