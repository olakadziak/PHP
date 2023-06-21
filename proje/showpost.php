<?php
include __DIR__.'/bootstrap.php';

use Models\Post;

$id = $_GET['id'] ?? null;

$post = $id ? Post::get($id) : Post::first();
?>

<h1>Post</h1>
<br>
<?= $post->render() ?>
<br>

<?= $post->prev()?->getLink('previous') ?>  <?= $post->next()?->getLink('next') ?>

<br><br>
<a href="index.php">Powrót do strony głównej</a>


<?= $post->user_id === $_SESSION['id'] ? '<br><br><a href="deletepost.php?id='.$post->id.'">Usuń</a>' : '' ?>
