<?php

require_once('core/require.php');

use Cranberry\User;

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cranberry</title>

		<link rel="stylesheet" href="assets/css/bulma.css">

		<script type="text/javascript" src="core/scripts/NavbarBurger.js"></script>
		<script type="text/javascript" src="core/scripts/Popup.js"></script>
	</head>
	<body>
		<main>
			<nav class="navbar" role="navigation" aria-label="main navigation">
				<div class="navbar-brand">
					<a class="navbar-item is-size-5" href="index.php">
						Cranberry
					</a>

					<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarItems">
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
						<span aria-hidden="true"></span>
					</a>
				</div>

				<div id="navbarItems" class="navbar-menu">
					<div class="navbar-end">
						<a class="navbar-item" href="index.php">
							Home
						</a>

						<a class="navbar-item" href="about.php">
							About
						</a>

						<?php
						if(User::GetCurrentUser()->groupid === 0){ ?>
							<a class="navbar-item" href="admin.php">
								Admin
							</a> <?php
						} ?>

						<?php
						if(User::GetCurrentUser() == null){ ?>
							<a class="navbar-item" href="login.php">
								Login
							</a> <?php
						}
						else{ ?>
							<a class="navbar-item" href="user.php">
								<?=User::GetCurrentUser()->username;?>
							</a> <?php
						} ?>
					</div>
				</div>
			</nav>