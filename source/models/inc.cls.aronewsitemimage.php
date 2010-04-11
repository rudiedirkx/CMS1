<?php

class ARONewsItemImage extends Extended_ActiveRecordObject {

	protected static $_table = 'news_item_images';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array(
		
	);


	public function admin() {
		return '/admin/news/edit_item_image.php?id='.$this->root->id.'&item='.$this->parent->id.'&image='.$this->id;
	}



	public function getPrevImage( $f_szOrderField = 'o' ) {
		return ($obj=$this->findFirst('news_item_id = ? AND '.$f_szOrderField.' < ? ORDER BY '.$f_szOrderField.' DESC', $this->news_item_id, $this->$f_szOrderField)) ? $obj->init($this->parent) : null;
	}


	public function getNextImage( $f_szOrderField = 'o' ) {
		return ($obj=$this->findFirst('news_item_id = ? AND '.$f_szOrderField.' > ? ORDER BY '.$f_szOrderField.' ASC', $this->news_item_id, $this->$f_szOrderField)) ? $obj->init($this->parent) : null;
	}



	public function init($parent) {
		$this->saveConfigs();
		$this->parent = $parent;
		$this->root = $parent->root;
		$this->relative_url = $this->parent->relative_url.'/'.$this->id.'/'.self::urlEscape($this->title);
		$this->image = '/'.PROJECT_RESOURCES_FOLDER.'/news_item_'.$this->parent->id.'_image_'.$this->id.'.'.$this->image;
		$this->saveConfigs();
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


