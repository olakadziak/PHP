<?php
require_once __DIR__.'/bootstrap.php';
include __DIR__.'/middleware/auth.php';

?>


<h1>Home</h1>
<p>Hello, <?php echo $_SESSION['username']; ?></p>
<a href="logout.php">Wyloguj się</a>
<br>
<button type="button" onclick="location.href='newpost.php'">Nowy post</button>
<br>
<button type="button" onclick="location.href='showpost.php'">Wszystkie posty</button>