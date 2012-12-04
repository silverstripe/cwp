<?php

class NewsCategory extends DataObject {
	static $has_many = array(
		'NewsItems' => 'NewsPage'
	);

	static $db = array(
		'Title' => 'Varchar(255)'
	);

	public function getLink() {
		$newsHolder = NewsHolder::get_one('NewsHolder');
		if ($newsHolder) {
			return $newsHolder->Link() . '?category=' . $this->ID;
		}
	}
}