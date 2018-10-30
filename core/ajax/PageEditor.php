<?php

require_once('require.php');

use Cranberry\User;
use Cranberry\Database;
use Cranberry\Markdown;

if(User::GetCurrentUser()->groupid === 0) {
	switch ($_POST['action']) {
		case 'GetList':
			$pageString = '';
			$pagesReq = [];
			$pagesUser = [];

			foreach(Database::ExecReturnAll('SELECT id FROM pages WHERE required = 1 ORDER BY id ASC', []) as $page){
				array_push($pagesReq, $page[0]);
			}

			$pages = Database::ExecReturnAll('SELECT id FROM pages WHERE required = 0 ORDER BY id ASC', []);
			for($i = 0; i < count($pages); $i++){
				$pageString .= ($i + 1 !== count($pages)) ? $pages[i][0] . ',' : $pages[i][0];
			}

			foreach(Database::ExecReturnAll('SELECT id FROM pages WHERE required = 0 ORDER BY id ASC', []) as $page) {
				array_push($pagesUser, $page[0]);
			}

			$pageString = implode(',', $pagesReq);
			$pageString .= '|';
			$pageString .= implode(',', $pagesUser);

			echo $pageString;
			break;
		case 'GetHTML':
			$markdown = new Markdown();
			echo $markdown->text($_POST['markdown']);
			break;
	}
}

?>