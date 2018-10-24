<?php

require_once('core/header.php');

use Cranberry\User;
use Cranberry\Database;

if($_POST['action'] === 'update' && User::GetCurrentUser() !== null){
	Database::Execute('UPDATE users SET bio = ? WHERE username = ?', [$_POST['bio'], User::GetCurrentUser()->username]);

	if(!empty($_POST['email']) && $_POST['email'] !== User::GetCurrentUser()->email) {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			Database::Execute('UPDATE users SET email = ? WHERE username = ?', [$_POST['email'], User::GetCurrentUser()->username]);
		}
		else {
			header('Location: profile.php?error=1');
		}
	}

	if(!empty($_POST['newpass'])){
		if(User::GetCurrentUser()->Verify($_POST['oldpass'])){
			Database::Execute('UPDATE users SET password = ? WHERE username = ?', [password_hash($_POST['newpass'], PASSWORD_DEFAULT), User::GetCurrentUser()->username]);

			$_SESSION['password'] = $_POST['newpass'];

			header('Location: profile.php?error=-1');
		}
		else{
			header('Location: profile.php?error=2');
		}
	}
}

/*
 * GET errors:
 * 1 - invalid email
 * 2 - new password wrong old password
 * -1 - account successfully changed
 */

switch($_GET['error']){
	case 1:
		echo "<script type=\"text/javascript\">Popups.errorInvalidEmail.Show();</script>";
		break;
	case 2:
		echo "<script type=\"text/javascript\">Popups.errorNewPasswordWrongOld.Show();</script>";
		break;
	case '':
		echo "<script type=\"text/javascript\">Popups.successProfileChanged.Show();</script>";
}

?>

<div class="columns">
	<div class="column is-4 is-offset-4 is-10-mobile is-offset-1-mobile">

		<?php
		if(User::GetCurrentUser() !== null) { ?>

			<h1 class="title has-text-centered">Editing Profile</h1>

			<form action="profile.php" method="post" id="formProfileEdit" onsubmit="return false;">
				<div class="box">
					<p class="subtitle has-text-centered">Profile - <?=User::GetCurrentUser()->username;?></p>

					<div class="field">
						<label class="label">About Me</label>

						<div class="control">
							<textarea class="textarea" name="bio"><?=User::GetCurrentUser()->extra['bio'];?></textarea>
						</div>
					</div>
				</div>

				<div class="box">
					<p class="subtitle has-text-centered">Account</p>

					<div class="field">
						<label class="label">Email</label>

						<div class="control">
							<input class="input" type="text" name="email" value="<?=User::GetCurrentUser()->email;?>" />
						</div>
					</div>

					<div class="field">
						<label class="label">Password</label>

						<div class="control">
							<input class="input" type="password" name="oldpass" placeholder="Current password" />
						</div>

						<div class="control">
							<input class="input" type="password" name="newpass" id="newpass" placeholder="New password" />
						</div>

						<div class="control">
							<input class="input" type="password" name="newpass2" id="newpass2" placeholder="New password (again)" />
						</div>
					</div>
				</div>

				<!-- Verify that the new passwords are matching and not mistyped -->
				<script type="text/javascript">
					function VerifyNewPasswords() {
						var form = document.getElementById("formProfileEdit");
						var np1 = document.getElementById("newpass");
						var np2 = document.getElementById("newpass2");

						if(np1.value === np2.value){
							form.submit();
						}
						else{
							Popups.errorNewPasswordMismatch.Show();

							return false;
						}
					}
				</script>

				<div class="has-text-centered">
					<button class="button is-primary" type="submit" onclick="VerifyNewPasswords();">Save</button>
				</div>

				<input type="hidden" name="action" value="update" />
			</form>

		<?php }
		else { ?>

			<h1 class="title has-text-centered">Please log in first.</h1>

		<?php } ?>

	</div>
</div>

<?php

require_once('core/footer.php');

?>