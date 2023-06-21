<?php

use Services\Auth;
require_once './bootstrap.php';
include './middleware/guest.php';

if (isset($_POST['username'], $_POST['password'])) {
    try {
        if (Auth::attempt($_POST['username'], $_POST['password'])) {
            header('Location: index.php');
            exit();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<form method="post">
    <div>
        <label for="username">Nazwa użytkownika</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div>
        <label for="password">Hasło</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Zaloguj się</button>
    <a href="register.php">Zarejestruj się</a>
</form>


