<?php

namespace Models;
use PDO;

class Post implements Model
{
    public ?int $id;
    public string $title;
    public string $content;
    public $created_at;
    public int $user_id;

    public function __construct($title, $content, $created_at, $user_id, $id = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
        $this->user_id = $user_id;
    }

    public function render(): string
    {
        $html = '<div class="post">';
        $html .= '<h2>'.$this->title.'</h2>';
        $html .= '<p>'.$this->content.'</p>';
        $html .= '<p>'.$this->created_at.'</p>';
        $html .= '<p>Author: '.$this->author()->username.'</p>';
        $html .= '</div>';
        return $html;
    }

    public function save(): void
    {
        $sql = "INSERT INTO posts (title, content, created_at, user_id) VALUES (:title, :content, :created_at, :user_id)";
        $stmt = db()->prepare($sql);
        $stmt->execute([
            'title' => $this->title,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'user_id' => $this->user_id
        ]);

        $this->id = db()->lastInsertId();
    }

    public static function get($id): ?Post
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = db()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Post(
            $row['title'],
            $row['content'],
            $row['created_at'],
            $row['user_id'],
            $row['id'],
        );
    }

    public static function first(): ?Post
    {
        $sql = "SELECT * FROM posts ORDER BY id ASC LIMIT 1";
        $stmt = db()->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }
        return new Post(
            $row['title'],
            $row['content'],
            $row['created_at'],
            $row['user_id'],
            $row['id'],
        );
    }

    public function delete(): void
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = db()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
    }


    public function next(): ?Post
    {
        $sql = "SELECT * FROM posts WHERE id > :id ORDER BY id ASC LIMIT 1";
        $stmt = db()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Post(
                $row['title'],
                $row['content'],
                $row['created_at'],
                $row['user_id'],
                $row['id']
            );
        }
        return null;
    }

    public function prev(): ?Post
    {
        $sql = "SELECT * FROM posts WHERE id < :id ORDER BY id DESC LIMIT 1";
        $stmt = db()->prepare($sql);
        $stmt->execute(['id' => $this->id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Post(
                $row['title'],
                $row['content'],
                $row['created_at'],
                $row['user_id'],
                $row['id']
            );
        }
        return null;
    }

    protected function author(): User
    {
        return User::get($this->user_id);
    }

    public function getLink($text = null): string
    {
        return '<a href="showpost.php?id='.$this->id.'">'.$text ?? $this->title.'</a>';
    }
}

