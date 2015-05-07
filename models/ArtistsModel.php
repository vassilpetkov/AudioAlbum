<?php

class ArtistsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM artists");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM artists WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function findByName($artist_name) {
        $statement = self::$db->prepare(
            "SELECT * FROM artists WHERE artist_name = ?");
        $statement->bind_param("s", $artist_name);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO artists VALUES(NULL, ?)");
        $statement->bind_param("s", $name);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE artists SET name = ? WHERE id = ?");
        $statement->bind_param("si", $name, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM artists WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
