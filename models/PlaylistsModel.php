<?php

class PlaylistsModel extends BaseModel {
    public function fetchAll() {
            $statement = self::$db->query(
                "SELECT p.id, playlist_name, username, rating_votes, rating_score FROM playlists p LEFT JOIN users u ON p.author_id = u.Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchPlaylist($value) {
        $statement = self::$db->query(
            "SELECT p.id, s.id AS song_id, playlist_name, title, artist_name, genre_name, year
FROM playlists p
LEFT JOIN playlists_songs ps ON ps.playlist_id = p.Id
LEFT JOIN songs s ON ps.song_id = s.Id
LEFT JOIN artists a ON s.artist_id = a.Id
LEFT JOIN genres g ON s.genre_id = g.Id
WHERE p.id = ".$value);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }


    public function find($column, $types, $value) {
        return parent::find("playlists", $column, $types, $value);
    }

    public function create($name, $author_username, $song_ids) {
        $this->accountsModel = new AccountsModel();
        $author_id = $this->accountsModel->find("username", "s", $author_username);

        if ($name == '') {
            return false;
        }

        $playlist_statement = self::$db->prepare(
            "INSERT INTO playlists VALUES(NULL, ?, ?, NULL, NULL)");
        $playlist_statement->bind_param("si", $name, $author_id);
        $playlist_statement->execute();

        $current_playlist = $this->find("playlist_name", "s", $name);
        $current_playlist_id = $current_playlist['id'];
        $song_statement = self::$db->prepare("INSERT INTO playlists_songs VALUES(?, ?)");
        foreach ($song_ids as $song_id) {
            $song_statement->bind_param("ii", $current_playlist_id, $song_id);
            $song_statement->execute();
        }
        return $playlist_statement->affected_rows > 0;
    }

    public function delete($column, $types, $value) {
        return parent::delete("playlists", $column, $types, $value);
    }
}
