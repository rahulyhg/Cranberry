<?php

require_once('core/header.php');

use Cranberry\Database;
use Cranberry\Page;

$pageID = $_GET['id'];

$page = Page::GetPage($pageID);

if(!empty($page) && !empty($pageID)){ ?>

<div class="columns">
	<div class="column is-4 is-offset-4 is-10-mobile is-offset-1-mobile">
		<h1 class="title has-text-centered"><?=$page->name;?></h1>

		<?=$page->bodyHTML;?>

		<p />

		<p class="is-italic is-size-6 has-text-centered">Last edit: <?=$page->lastEdit;?></p>
	</div>
</div>

<?php }
else {
	header('Location: index.php');
}

require_once('core/footer.php');

?>