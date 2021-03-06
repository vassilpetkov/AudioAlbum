<?php
abstract class BaseModel
{
    protected static $db;

    public function __construct()
    {
        if (self::$db == null) {
            self::$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if (self::$db->connect_errno) {
                die('Cannot connect to database');
            }
            self::$db->set_charset("utf8");
        }
    }

    public function fetchAll($table)
    {
        $statement = self::$db->query(
            "SELECT * FROM " . $table);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($table, $column, $types, $value)
    {
        $statement = self::$db->prepare(
            "SELECT * FROM " . $table . " WHERE " . $column . " = ?");
        $statement->bind_param($types, $value);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($table, $types, $value) {
        if ($value == '') {
            return false;
        }
        if (!$value) {
            return false;
        }

        $statement = self::$db->prepare(
            "INSERT INTO " . $table . " VALUES(NULL, ?)");
        $statement->bind_param($types, $value);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($table, $column, $types, $id, $value) {
        if ($value == '') {
            return false;
        }
        if (!$value) {
            return false;
        }

        $statement = self::$db->prepare(
            "UPDATE " . $table . " SET " . $column . " = ? WHERE id = ?");
        $statement->bind_param($types, $value, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($table, $column, $types, $value) {
        //TODO: Fix issues with deleting songs and playlists
        $statement = self::$db->prepare(
            "DELETE FROM " . $table . " WHERE " . $column . " = ?");
        $statement->bind_param($types, $value);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function vote($table , $item, $score) {
        $ratingScore = $item["rating_score"];
        $ratingVotes = $item["rating_votes"] + 1;
        if ($score != 0) {
            $ratingScore = $ratingScore + $score;
        }

        $statement = self::$db->prepare(
            "UPDATE " . $table . " SET rating_votes = ?, rating_score = ? WHERE id = ?");
        $statement->bind_param("iii", $ratingVotes, $ratingScore, $item["id"]);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}