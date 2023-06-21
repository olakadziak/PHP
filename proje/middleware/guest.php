<?php

use Services\Auth;

if (Auth::check()) {
    header('Location: index.php');
    exit();
}