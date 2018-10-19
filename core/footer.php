		<p />
		</main>
		<footer class="footer has-text-centered is-white">
			<?php
			if(Cranberry\User::GetCurrentUser() != null){ ?>
				<form id="formLogout" action="login.php" method="post">
					<input type="hidden" name="action" value=2 />
					<a href="#" onClick="document.getElementById('formLogout').submit()">Logout</a>
				</form> <?php
			} ?>
		</footer>
	</body>
</html>