<?php

require_once('core/header.php');

use Cranberry\Database;
use Cranberry\User;

if(User::GetCurrentUser()->groupid === 0){ ?>

	<div class="columns">
		<div class="column is-one-fifth is-full-mobile">
			page list
		</div>

		<div class="column is-three-fifths is-full-mobile">
			<div class="columns">
				<div class="column is-half is-full-mobile">
					md
				</div>

				<div class="column is-half is-full-mobile">
					html
				</div>
			</div>
		</div>

		<div class="column is-one-fifth is-full-mobile">
			page edit meta
		</div>
	</div>

<?php }
else {
	header('Location: index.php');
}

require_once('core/footer.php');

?>