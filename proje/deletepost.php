<?php
include __DIR__.'/bootstrap.php';
use Models\Post;

$post = $_GET['id'] ? Post::get($_GET['id']) : null;
if ($post?->user_id === $_SESSION['id']) {
    $post->delete();
}
header('Location: index.php');
exit();

