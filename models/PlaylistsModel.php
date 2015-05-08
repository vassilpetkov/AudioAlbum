<?php

class PlaylistsModel extends BaseModel {
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM playlists p LEFT JOIN users u ON p.author_id = u.Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id) {
        $statement = self::$db->prepare(
            "SELECT * FROM playlists WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function findByName($name) {
        $statement = self::$db->prepare(
            "SELECT * FROM playlists WHERE playlist_name = ?");
        $statement->bind_param("s", $name);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($name, $author_username, $song_ids) {
        $this->accountsModel = new AccountsModel();
        $author_id = $this->accountsModel->find($author_username);

        if ($name == '') {
            return false;
        }

        $playlist_statement = self::$db->prepare(
            "INSERT INTO playlists VALUES(NULL, ?, ?, NULL, NULL)");
        $playlist_statement->bind_param("si", $name, $author_id);
        $playlist_statement->execute();

        $current_playlist = $this->findByName($name);
        $current_playlist_id = $current_playlist['id'];
        $song_statement = self::$db->prepare("INSERT INTO playlists_songs VALUES(?, ?)");
        foreach ($song_ids as $song_id) {
            $song_statement->bind_param("ii", $current_playlist_id, $song_id);
            $song_statement->execute();
        }
        return $playlist_statement->affected_rows > 0;
    }

    public function edit($id, $name) {
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE playlists SET name = ? WHERE id = ?");
        $statement->bind_param("si", $name, $id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id) {
        $statement = self::$db->prepare(
            "DELETE FROM playlists WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}
