<?php

class SongsController extends BaseController {
    private $songsModel;

    protected function onInit() {
        $this->title = 'Songs';
        $this->songsModel = new SongsModel();
    }

    public function index() {
        $this->songs = $this->songsModel->getAll();
    }

    public function play($id) {
        $this->song = $this->songsModel->find($id);
    }

    public  function upload() {
        if ($this->isPost()) {
            $title = $_POST['title'];
            $artist_name = $_POST['artist'];
            $genre_name = $_POST['genre'];
            $year = (int)$_POST['year'];
            $target_dir = "content/songs/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $target_file_url = "/" . $target_file;
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
            if (file_exists($target_file)) {
                $this->addErrorMessage("The file already exists.");
                $this->redirect("songs/upload");
                die();
            }
            if ($_FILES["fileToUpload"]["size"] > 50000000) {
                $this->addErrorMessage("The file is too large.");
                $this->redirect("songs/upload");
                die();
            }
            if ($fileType != "mp3" && $fileType != "opus" && $fileType != "wav" && $fileType != "weba"
                && $fileType != "oog") {
                $this->addErrorMessage("Only .mp3, .wav, .oog, .weba or .opus files are allowed");
                $this->redirect("songs/upload");
                die();
            }
            $uploadResult = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

            if (!$title) {
                $this->addErrorMessage("The title is required.");
                $this->redirect("songs/upload");
                die();
            }
            if ($this->songsModel->findByTitle($title)) {
                $this->addErrorMessage("There is already a song with this title.");
                $this->redirect("songs/upload");
                die();
            }
            if (!$_FILES["fileToUpload"]["name"]) {
                $this->addErrorMessage("The file is required.");
                $this->redirect("songs/upload");
                die();
            }

            $dbQueryResult = $this->songsModel->create($title, $artist_name, $genre_name, $year, $target_file_url);

            if ($uploadResult && $dbQueryResult) {
                $this->addInfoMessage("Song created.");
                $this->redirect("songs");
            }
            if (!$uploadResult && !$dbQueryResult) {
                $this->addErrorMessage("Cannot create song.");
                $this->redirect("songs/upload");
            }
            if (!$uploadResult && $dbQueryResult) {
                unlink($_FILES["fileToUpload"]["tmp_name"]);
                $this->addErrorMessage("Cannot upload song.");
                $this->redirect("songs/upload");
            }
            if ($uploadResult && !$dbQueryResult) {
                $this->songsModel->deleteByTitle($title);
                $this->addErrorMessage("Cannot create song.");
                $this->redirect("songs/upload");
            }
        }
    }

    public function download($id) {
        $song = $this->songsModel->find($id);
        $downloadPath = $str = substr($song["path"], 1);
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
        if ($this->isPost()) {
            $name = $_POST['name'];

            if ($this->songsModel->edit($id, $name)) {
                $this->addInfoMessage("Song edited.");
                $this->redirect("songs");
            } else {
                $this->addErrorMessage("Cannot edit song.");
            }
        }

        $this->songs = $this->songsModel->find($id);
        if (!$this->song) {
            $this->addErrorMessage("Invalid song.");
            $this->redirect("songs");
        }
    }

    public function delete($id) {
        if ($this->songsModel->delete($id)) {
            $this->addInfoMessage("Song deleted.");
        } else {
            $this->addErrorMessage("Cannot delete song #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("songs");
    }
}
