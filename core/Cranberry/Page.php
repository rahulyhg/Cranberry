<?php

namespace Cranberry;

class Page{
	public $name;
	public $bodyMarkdown;
	public $bodyHTML;
	public $id;
	public $lastEdit;
	public $isInNav;
	public $navOrder;

	public function __construct($id, $name, $bodyMarkdown = null, $bodyHTML = null, $lastEdit = null, $isInNav = 1, $navOrder = 0) {
		$this->id = $id;
		$this->name = $name;
		$this->bodyMarkdown = $bodyMarkdown;
		$this->bodyHTML = $bodyHTML;
		$this->lastEdit = $lastEdit === null ? date('Y-m-d H:i:s') : $lastEdit;
		$this->isInNav = $isInNav;
		$this->navOrder = $navOrder;
	}

	public function Write(){
		Database::ExecOnly('UPDATE pages SET id = ?, pagename = ?, bodyMD = ?, bodyHTML = ?, lastedit = NOW(), isinnav = ?, navorder = ?', [$this->id, $this->name, $this->bodyMarkdown, $this->bodyHTML, $this->isInNav, $this->navOrder]);
	}

	public function Publish(){
		$markdownConverter = new Markdown();

		$this->bodyHTML = $markdownConverter->text($this->bodyMarkdown);
	}

	public function ToString(){
		//TODO: This method for ajax interfacing
	}

	public static function GetPage($id){
		$pageDB = Database::ExecReturn('SELECT id, pagename, bodyMD, bodyHTML, lastedit FROM pages WHERE id = ?', [$id]);

		if(!empty($pageDB)) {
			return new Page($pageDB['id'], $pageDB['pagename'], $pageDB['bodyMD'], $pageDB['bodyHTML'], $pageDB['lastedit']);
		}
		else{
			return null;
		}
	}

	public static function GetNavPages(){
		$navPagesDB = Database::ExecReturnAll('SELECT id, pagename FROM pages WHERE isinnav = 1 ORDER BY navorder ASC', []);
		$navPages = [];

		foreach ($navPagesDB as $navPageDB){
			array_push($navPages, ['page.php?id=' . $navPageDB[0], $navPageDB[1]]);
		}

		return $navPages;
	}
}

?>