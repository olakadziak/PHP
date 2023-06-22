<?php
require_once __DIR__.'/bootstrap.php';
include __DIR__.'/middleware/auth.php';

\Services\Auth::logout();

header('Location: login.php');
exit();
