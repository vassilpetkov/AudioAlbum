<?php

class SongsModel extends BaseModel {
    public function fetchAll() {
        $statement = self::$db->query(
            "SELECT s.id, title, year, path, rating_votes, rating_score, artist_name, genre_name FROM songs s LEFT JOIN artists a ON s.artist_id = a.Id LEFT JOIN genres g ON s.genre_id = g.Id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchFilteredSongs($song, $playlist, $genre) {
        $query = "SELECT s.id AS id, title, playlist_name, artist_name, genre_name, year, s.rating_score, s.rating_votes
                FROM songs s
                LEFT JOIN playlists_songs ps ON ps.song_id = s.Id
                LEFT JOIN playlists p ON ps.playlist_id = p.Id
                LEFT JOIN artists a ON s.artist_id = a.Id
                LEFT JOIN genres g ON s.genre_id = g.Id
                WHERE ";
        if ($song) {
            $song = '"%' . $song . '%"';
            $query = $query .'title LIKE ' . $song;
        }
        if ($song && $playlist || $song && $genre) {
            $query = $query." AND ";
        }
        if ($playlist) {
            $playlist = '"%' . $playlist . '%"';
            $query = $query."playlist_name LIKE " . $playlist;
        }
        if ($playlist && $genre) {
            $query = $query." AND ";
        }
        if ($genre) {
            $genre = '"%' . $genre . '%"';
            $query = $query."genre_name LIKE " . $genre;
        }
        var_dump($query);
        $statement = self::$db->query($query);
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function find($column, $types, $value) {
        $statement = self::$db->prepare(
            "SELECT s.id AS id, title, artist_name, genre_name, year, path, rating_votes, rating_score
                FROM songs s
                LEFT JOIN artists a ON s.artist_id = a.Id
                LEFT JOIN genres g ON s.genre_id = g.Id
                WHERE ". $column . " = ?");
        $statement->bind_param($types, $value);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function create($title, $artist_name = null, $genre_name = null, $year = null, $target_file) {
        if ($title == '') {
            return false;
        }

        $artist_id = null;
        $genre_id = null;
        if($artist_name) {
            $artist_id = $this->getArtistId($artist_name);
        }
        if($genre_name) {
            $genre_id = $this->getGenreId($genre_name);
        }

        $statement = self::$db->prepare(
            "INSERT INTO songs VALUES(NULL, ?, ?, ?, ?, ?, NULL, NULL)");
        $statement->bind_param("siiis", $title, $artist_id, $genre_id, $year, $target_file);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function edit($id, $title, $artist_name = null, $genre_name = null, $year = null, $target_file) {
        if ($title == '') {
            return false;
        }

        $artist_id = null;
        $genre_id = null;
        if($artist_name) {
            $artist_id = $this->getArtistId($artist_name);
        }
        if($genre_name) {
            $genre_id = $this->getGenreId($genre_name);
        }

        $statement = self::$db->prepare(
            "UPDATE songs SET title = ?, artist_id = ?, genre_id = ?, year = ?, path = ? WHERE id = ?");
        $statement->bind_param("siiisi", $title, $artist_id, $genre_id, $year, $target_file, $id);
        $statement->execute();
        return $statement->affected_rows > 0;
    }

    public function delete($column, $types, $value) {
        return parent::delete("songs", $column, $types, $value);
    }

    public function vote($id, $score) {
        $song = $this->find("s.id", "i", $id);
        return parent::vote("songs", $song, $score);
    }

    private function getArtistId($artist_name)
    {
        $this->artistsModel = new ArtistsModel();
        $artist = $this->artistsModel->find("artist_name", "s", $artist_name);
        if ($artist) {
            $artist_id = $artist['id'];
            return $artist_id;
        } else {
            $this->artistsModel->create("s", $artist_name);
            $artist = $this->artistsModel->find("artist_name", "s", $artist_name);
            $artist_id = $artist['id'];
            return $artist_id;
        }
    }

    private function getGenreId($genre_name)
    {
        $this->genresModel = new GenresModel();
        $genre = $this->genresModel->find("genre_name", "s", $genre_name);
        if ($genre) {
            $genre_id = $genre['id'];
            return $genre_id;
        } else {
            $this->genresModel->create("s", $genre_name);
            $genre = $this->genresModel->find("genre_name", "s", $genre_name);
            $genre_id = $genre['id'];
            return $genre_id;
        }
    }
}
