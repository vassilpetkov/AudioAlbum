<?php

class AccountsModel extends BaseModel{
    public function fetchAll() {
        return parent::fetchAll("accounts") ;
    }

    public function find($column, $types, $value) {
        return parent::find("users", $column, $types, $value);
    }

    public function register($username, $password) {
        if ($username == '') {
            return false;
        }
        if ($password == '') {
            return false;
        }
        if ($this->find("username", "s", $username)) {
            return false;
        }

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $statement = self::$db->prepare(
            "INSERT INTO users VALUES(NULL, ?, ?, 0)");
        $statement->bind_param("ss", $username, $hash_pass);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function login($username, $password) {
        if ($username == '') {
            return false;
        }
        if ($password == '') {
            return false;
        }

        $user = $this->find("username", "s", $username);
        if ($user['is_admin']) {
            $_SESSION['isAdmin'] = $user['is_admin'];
        }
        if (!password_verify($password, $user['pass_hash'])) {
            return false;
        }
        return true;
    }

    public function changeUsername($username) {
        if ($username == '') {
            return false;
        }
        if ($this->find("username", "s", $username)) {
            return false;
        }

        $user = $this->find("username", "s", $_SESSION['username']);
        $userId = $user['id'];

        $statement = self::$db->prepare(
            "UPDATE users SET username = ? WHERE id = ?");
        $statement->bind_param("si", $username, $userId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function changePassword($oldPassword, $password) {
        if ($password == '') {
            return false;
        }
        $user = $this->find("username", "s", $_SESSION['username']);
        if (!password_verify($oldPassword, $user['pass_hash'])) {
            return false;
        }

        $userId = $user['id'];
        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $statement = self::$db->prepare(
            "UPDATE users SET pass_hash = ? WHERE id = ?");
        $statement->bind_param("si", $hash_pass, $userId);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}