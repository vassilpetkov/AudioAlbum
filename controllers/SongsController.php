<?php

class SongsController extends BaseController {
    private $songsModel;

    protected function onInit() {
        $this->title = 'Songs';
        $this->songsModel = new SongsModel();
    }

    public function index() {
        $this->songs = $this->songsModel->fetchAll();
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $title = $_POST['title'];
            $artist_name = $_POST['artist'];
            $genre_name = $_POST['genre'];
            $year = (int)$_POST['year'];
            $target_file = "content/songs/" . basename($_FILES["fileToUpload"]["name"]);
            $target_file_url = "/" . $target_file;

            if (!$title) {
                $this->addErrorMessage("The title is required.");
                $this->redirect("songs/create");
                die();
            }
            if ($this->songsModel->find("title", "s", $title)) {
                $this->addErrorMessage("There is already a song with this title.");
                $this->redirect("songs/create");
                die();
            }
            if (!$_FILES["fileToUpload"]["name"]) {
                $this->addErrorMessage("The file is required.");
                $this->redirect("songs/create");
                die();
            }

            $uploadResult = $this->upload($target_file);
            $dbQueryResult = $this->songsModel->create($title, $artist_name, $genre_name, $year, $target_file_url);

            if ($uploadResult && $dbQueryResult) {
                $this->addInfoMessage("Song created.");
                $this->redirect("songs");
            }
            else {
                unlink($_FILES["fileToUpload"]["name"]);
                $this->songsModel->delete("title", "s", $title);
                $this->addErrorMessage("Cannot create song.");
                $this->redirect("songs/create");
            }
        }
    }

    public function download($id) {
        $song = $this->songsModel->find("s.id", "i", $id);
        $downloadPath = substr($song["path"], 1);
        var_dump($song);
        if (file_exists($downloadPath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($downloadPath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($downloadPath));
            if (readfile($downloadPath)) {
                $this->addInfoMessage("Song downloaded.");
            }
            else {
                $this->addErrorMessage("Cannot download song.");
            }
        }
        else {
            $this->addErrorMessage("Song not found.");
        }
        $this->redirect("songs");
    }

    public function edit($id) {
        $this->authorizeAdmin();

        $this->song = $this->songsModel->find("s.id", "i", $id);
        if (!$this->song) {
            $this->addErrorMessage("Invalid song.");
            $this->redirect("songs");
        }

        if ($this->isPost()) {
            $title = $_POST['title'];
            $artist_name = $_POST['artist'];
            $genre_name = $_POST['genre'];
            $year = (int)$_POST['year'];

            if ($this->songsModel->find("title", "s", $title)) {
                $this->addErrorMessage("There is already a song with this title.");
                $this->redirect("songs/edit" . $this->song["id"]);
                die();
            }

            if (!$_FILES["fileToUpload"]["name"]) {
                if ($this->songsModel->edit($id, $title, $artist_name, $genre_name, $year, $this->song["path"])) {
                    $this->addInfoMessage("Song edited.");
                    $this->redirect("songs");
                } else {
                    $this->addErrorMessage("Cannot edit song.");
                }
            }
            else {
                $target_file = "content/songs/" . basename($_FILES["fileToUpload"]["name"]);
                $target_file_url = "/" . $target_file;
                $this->upload($target_file);
                if ($this->songsModel->edit($id, $title, $artist_name, $genre_name, $year, $target_file_url)) {
                    $this->addInfoMessage("Song edited.");
                    $this->redirect("songs");
                } else {
                    $this->addErrorMessage("Cannot edit song.");
                }
            }
        }
    }

    public function delete($id) {
        $this->authorizeAdmin();

        if ($this->songsModel->delete("id", "i", $id)) {
            $this->addInfoMessage("Song deleted.");
        } else {
            $this->addErrorMessage("Cannot delete song #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("songs");
    }

    public function play($id) {
        $this->song = $this->songsModel->find("s.id", "i", $id);
        $this->songsCommentsModel = new SongsCommentsModel();
        $this->comments = $this->songsCommentsModel->fetchAllForSong($id);
    }

    public function vote() {
        $this->authorize();
        if ($this->isPost()) {
            $score = $_POST['score'];
            $song_id = $_POST['song_id'];

            if ($this->songsModel->vote($song_id, $score)) {
                $this->addInfoMessage("Vote successful.");
                $this->redirect("songs");
            } else {
                $this->addErrorMessage("Vote unsuccessful.");
            }
        }
    }

    public function filter() {
        $song = $_POST['song'];
        $playlist = $_POST['playlist'];
        $genre = $_POST['genre'];
        if (!$_POST['song'] && !$_POST['playlist'] && !$_POST['genre']) {
            $this->addErrorMessage("No filter values detected.");
            die();
        }
        $this->songs = $this->songsModel->FetchFilteredSongs($song, $playlist, $genre);
    }

    private function upload($target_file)
    {
        $this->authorize();
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if (file_exists($target_file)) {
            $this->addErrorMessage("The file already exists.");
            $this->redirect("songs/create");
            die();
        }
        if ($_FILES["fileToUpload"]["size"] > 50000000) {
            $this->addErrorMessage("The file is too large.");
            $this->redirect("songs/create");
            die();
        }
        if ($fileType != "mp3" && $fileType != "opus" && $fileType != "wav" && $fileType != "weba"
            && $fileType != "oog"
        ) {
            $this->addErrorMessage("Only .mp3, .wav, .oog, .weba or .opus files are allowed");
            $this->redirect("songs/create");
            die();
        }
        $uploadResult = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        return $uploadResult;
    }
}
