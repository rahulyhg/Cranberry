<?php

require_once('core/header.php');

use Cranberry\User;
use Cranberry\Util;

$dispUser = Util::Sanitize($_GET['user']);

if($dispUser == null && User::GetCurrentUser() !== null){
	$user = User::GetCurrentUser();
}
else {
	$user = User::GetUser($dispUser);
}

?>

<div class="columns">
	<div class="column is-4 is-offset-4 is-10-mobile is-offset-1-mobile">

		<?php
		if($user !== null) { ?>

			<h1 class="title has-text-centered"><?=$user->username;?></h1>
			<p class="is-italic has-text-centered"><?=$user->GetGroup();?></p>

			<div class="box">
				<?=Util::Sanitize($user->extra['bio']);?>
			</div>

			<p class="has-text-centered">Joined: <?=$user->extra['joined'];?></p>

			<?php
			if($user->username === User::GetCurrentUser()->username) { ?>
				<p class="has-text-centered"><a href="profile.php">Edit Profile</a></p>
			<?php
			} ?>

		<?php
		}
		else { ?>

			<h1 class="title has-text-centered">User does not exist.</h1>

		<?php
		} ?>

	</div>
</div>

<?php

require_once('core/footer.php');

?>
