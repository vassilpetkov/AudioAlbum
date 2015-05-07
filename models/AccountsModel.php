<?php

class AccountsModel extends BaseModel{
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM users");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($username) {
        $statement = self::$db->prepare(
            "SELECT * FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function register($username, $password) {
        if ($username == '') {
            return false;
        }
        if ($password == '') {
            return false;
        }
        if ($this->find($username)) {
            return false;
        }

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $statement = self::$db->prepare(
            "INSERT INTO users VALUES(NULL, ?, ?, 0)");
        $statement->bind_param("ss", $username, $hash_pass);
        $statement->execute();
        return true;
    }

    public function login($username, $password) {
        if ($username == '') {
            return false;
        }
        if ($password == '') {
            return false;
        }

        $user = $this->find($username);
        if (!password_verify($password, $user['pass_hash'])) {
            return false;
        }
        return true;
    }

    public function changeUsername($username) {
        if ($username == '') {
            return false;
        }
        if ($this->find($username)) {
            return false;
        }

        $user = $this->find($_SESSION['username']);
        $userId = $user['id'];

        $statement = self::$db->prepare(
            "UPDATE users SET username = ? WHERE id = ?");
        $statement->bind_param("si", $username, $userId);
        $statement->execute();
        return true;
    }

    public function changePassword($oldPassword, $password) {
        if ($password == '') {
            return false;
        }
        $user = $this->find($_SESSION['username']);
        if (!password_verify($oldPassword, $user['pass_hash'])) {
            return false;
        }
        $userId = $user['id'];
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $statement = self::$db->prepare(
            "UPDATE users SET pass_hash = ? WHERE id = ?");
        $statement->bind_param("si", $hash_pass, $userId);
        $statement->execute();
        return true;
    }
}