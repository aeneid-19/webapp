<?php
declare(strict_types=1);
?>
<div class="container">

    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <!--<a class="navbar-brand">dev.net</a>-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Home') {
						echo ' active';
					} ?>" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'DB') {
						echo ' active';
					} ?>" href="/DB">DB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Portfolio') {
						echo ' active';
					} ?>" href="/Portfolio">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Contact') {
						echo ' active';
					} ?>" href="/Contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Impressum') {
						echo ' active';
					} ?>" href="/Impressum">Impressum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Guestbook') {
						echo ' active';
					} ?>" href="/Guestbook">Guestbook</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Speichern') {
						echo ' active';
					} ?>" href="/Speichern">Speichern</a>
                </li>
				<?php if (isset($_SESSION['login'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/Login/logout">Logout</a>
                    </li>
				<?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if ($_SESSION['activeItem'] === 'Login') {
							echo ' active';
						} ?>" href="/Access">Login</a>
                    </li>
				<?php } ?>
            </ul>
        </div>
    </nav>
</div>
<div class="container">
    <div class="col-10">
