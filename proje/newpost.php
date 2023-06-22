<?php

use Models\Post;
use Services\Auth;

require_once './bootstrap.php';
include './middleware/auth.php';


if (isset($_POST['title'], $_POST['body'])) {
    try {
        $post = new Post(
            $_POST['title'],
            $_POST['body'],
            date('Y-m-d H:i:s'),
            Auth::id()
        );
        $post->save();
        header('Location: showpost.php?id='.$post->id);
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>


<form method="post">
    <div>
        <label for="title">Tytuł</label>
        <input type="text" name="title" id="title">
    </div>
    <div>
        <label for="body">Zawartość</label>
        <textarea name="body" id="body"></textarea>
    </div>
    <div>
        <button type="submit">Stwórz</button>
    </div>
</form>
