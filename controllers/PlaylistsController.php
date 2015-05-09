<?php

class PlaylistsController extends BaseController {

    protected function onInit() {
        $this->title = 'Playlists';
        $this->playlistsModel = new PlaylistsModel();
    }

    public function index() {
        $this->playlists = $this->playlistsModel->fetchAll();
    }

    public function create() {
        $this->songsModel = new SongsModel();
        $this->songs = $this->songsModel->fetchAll();

        if ($this->isPost()) {
            $name = $_POST['name'];
            $author_username = $_POST['author_username'];
            $song_ids = $_POST['song_ids'];
            if ($this->playlistsModel->create($name, $author_username, $song_ids)) {
                $this->addInfoMessage("Playlist created.");
                $this->redirect("playlists");
            } else {
                $this->addErrorMessage("Cannot create playlist.");
            }
        }
    }

    public function edit($id) {
        if ($this->isPost()) {
            $name = $_POST['name'];
            if ($this->playlistsModel->edit($id, $name)) {
                $this->addInfoMessage("Playlist edited.");
                $this->redirect("playlists");
            } else {
                $this->addErrorMessage("Cannot edit playlist.");
            }
        }

        $this->playlists = $this->playlistsModel->find("id", "i", $id);
        if (!$this->playlist) {
            $this->addErrorMessage("Invalid playlist.");
            $this->redirect("playlists");
        }
    }

    public function delete($id) {
        if ($this->playlistsModel->delete("id", "i", $id)) {
            $this->addInfoMessage("Playlist deleted.");
        } else {
            $this->addErrorMessage("Cannot delete playlist #" . htmlspecialchars($id) . '.');
            $this->addErrorMessage("Maybe it is in use.");
        }
        $this->redirect("playlists");
    }

    public function view($id) {
        $this->playlist = $this->playlistsModel->FetchPlaylist($id);

        $this->playlistsCommentsModel = new PlaylistsCommentsModel();
        $this->comments = $this->playlistsCommentsModel->fetchAllForPlaylist($id);
    }

    public function vote() {
        if ($this->isPost()) {
            $score = $_POST['score'];
            $playlist_id = $_POST['playlist_id'];

            if ($this->playlistsModel->vote($playlist_id, $score)) {
                $this->addInfoMessage("Vote successful.");
                $this->redirect("playlists");
            } else {
                $this->addErrorMessage("Vote unsuccessful.");
            }
        }
    }
}
