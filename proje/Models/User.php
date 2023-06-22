<?php
namespace Models;

use PDO;

class User implements Model
{
    public ?int $id;
    public string $username;
    public string $password;

    public function __construct(string $username, string $password, int $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    public static function create(string $username, string $password): void
    {
        $user = new self($username, $password);
        $user->save();
    }

    public static function find(string $username, string $password): User
    {
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = db()->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'password' => $password
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new self(
            $row['username'],
            $row['password'],
            $row['id']
        );
    }

    public static function get($id): User
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = db()->prepare($sql);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return new self(
            $row['username'],
            $row['password'],
            $row['id']
        );
    }

    public function save(): void
    {
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = db()->prepare($sql);
        $stmt->execute([
            'username' => $this->username,
            'password' => $this->password
        ]);

        $this->id = db()->lastInsertId();
    }
}