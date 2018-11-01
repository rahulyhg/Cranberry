<?php

require_once('core/header.php');

use Cranberry\Database;
use Cranberry\User;

if(User::GetCurrentUser()->groupid === 0){ ?>

	<div class="columns">
		<div id="pages" class="column is-one-fifth is-full-mobile">
			<p class="subtitle has-text-centered">Pages</p>
			<div id="pageList">

			</div>
		</div>

		<div class="column is-three-fifths is-full-mobile">
			<p id="pageTitle" class="subtitle has-text-centered">Select a page to edit.</p>
			<div class="columns">
				<div class="column is-half is-full-mobile">
					<textarea id="editorMD" class="textarea" style="resize: none;" rows="24" disabled></textarea>
				</div>

				<div id="editorHTML" class="column is-half is-full-mobile">

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