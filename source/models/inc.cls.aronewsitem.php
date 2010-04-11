<?php

class ARONewsItem extends Extended_ActiveRecordObject {

	protected static $_table = 'news_items';
	protected static $_columns = array();
	protected static $_pk = 'id';
	protected static $_relations = array(
		
	);


	public function admin() {
		return '/admin/news/edit_item.php?id='.$this->root->id.'&item='.$this->id;
	}


	public function getImage( $id ) {
		return ARONewsItemImage::finder()->byPK( $id, 'news_item_id = '.$this->id );
	}


	public $_images = null;
	public function getImages( $f_szLimit = 0, $f_szOrderBy = 'o ASC' ) {
		if ( null === $this->_images ) {
			$imgs = ARONewsItemImage::finder()->findMany('news_item_id = ?'.( $f_szLimit ? ' LIMIT '.$f_szLimit : '' ).' ORDER BY '.$f_szOrderBy, $this->id);
			foreach ( $imgs AS $img ) {
				$img->init($this);
			}
			$this->_images = $imgs;
		}
		return $this->_images;
	}



	public function init($parent) {
		$this->parent = $parent;
		$this->root = $parent->root;
		$this->relative_url = '/'.$this->root->id.'/'.$this->id.'/'.self::urlEscape($this->title);
		$this->image_1 = $this->image_1 ? '/'.PROJECT_RESOURCES_FOLDER.'/news_item_'.$this->id.'_1.'.$this->image_1 : '';
		$this->image_2 = $this->image_2 ? '/'.PROJECT_RESOURCES_FOLDER.'/news_item_'.$this->id.'_2.'.$this->image_2 : '';
		$this->saveConfigs();
		return $this;
	}




	static public function finder( $class = __CLASS__ ) {
		return parent::finder($class);
	}


}


