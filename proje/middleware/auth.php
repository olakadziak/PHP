<?php

use Services\Auth;

if (! Auth::check()) {
    header('Location: login.php');
    exit();
}