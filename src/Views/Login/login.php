<?php
declare(strict_types=1);

/** @var string $errormsg */
if ($errormsg) {
	echo '<b style="color: red">' . $errormsg . '</b>';
}
?>

<form action="/Access/login" method="post">
    <div class="form-group">
        <div class="input-group mb-3 mt-3">
            <div class="input-group-prepend">
                <label for="username" class="input-group-text">Username</label>
            </div>
            <input type="text" class="form-control" id="username" value="" placeholder="Username" name="username">
        </div>
        <div class="input-group mb-3 mt-3">
            <div class="input-group-prepend">
                <label for="password" class="input-group-text">Password</label>
            </div>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        </div>
    </div>
    <button type="submit" name="logindata" class="btn btn-primary mb-2" href="/Login/login">Login</button>

</form>