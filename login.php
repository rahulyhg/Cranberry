<?php

require_once('core/header.php');

use Cranberry\User;
use Cranberry\Session;

switch($_POST['action']){
	case 1:
		if(User::UserExists($_POST['username']) && User::GetUser($_POST['username'])->Verify($_POST['password'])){
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['username'] = $_POST['username'];

			header('Location: index.php');
		}
		else{
			header('Location: login.php?error=1');
		}
		break;
	case 2:
		Session::Destroy();
		header('Location: index.php');
		break;
}

if($_GET['error'] == 1){
	echo '<script type="text/javascript">Popups.errorLogin.Show();</script>';
}

?>

<div class="columns">
	<div class="column is-one-fifth-desktop is-offset-two-fifths-desktop is-10-mobile is-offset-1-mobile">
		<span class="has-text-centered title">Login</span>
		<form action="login.php" method="POST">
			<div class="field">
				<label class="label">Username</label>
				<div class="control">
					<input type="text" name="username" class="input" />
				</div>
			</div>

			<div class="field">
				<label class="label">Password</label>
				<div class="control">
					<input type="password" name="password" class="input" />
				</div>
			</div>

			<div class="control">
				<input type="submit" value="Login" class="button is-primary is-fullwidth" />
			</div>

			<input type="hidden" name="action" value=1 />
		</form>
	</div>
</div>

<?php

require_once('core/footer.php');

?>