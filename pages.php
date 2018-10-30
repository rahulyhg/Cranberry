<?php

require_once('core/header.php');

use Cranberry\Database;
use Cranberry\User;

if(User::GetCurrentUser()->groupid === 0){ ?>

	<div class="columns">
		<div id="pageList" class="column is-one-fifth is-full-mobile">
			<div id="pageListRequired">

			</div>

			<div id="pageListUser" class="box">
				No pages to show.
			</div>
		</div>

		<div class="column is-three-fifths is-full-mobile">
			<div class="columns">
				<div class="column is-half is-full-mobile">
					<textarea id="editorMD" class="textarea" style="resize: none;" rows="25"></textarea>
				</div>

				<div id="editorHTML" class="column is-half is-full-mobile">
					Select a page to edit.
				</div>
			</div>
		</div>

		<div id="editorMeta" class="column is-one-fifth is-full-mobile">
			page edit meta
		</div>
	</div>

	<script type="text/javascript" src="core/scripts/ajax/PageEditor.js"></script>

<?php }
else {
	header('Location: index.php');
}

require_once('core/footer.php');

?>