<?php

class PlaylistsCommentsController extends BaseController {
    private $playlistsCommentsModel;

    protected function onInit() {
        $this->playlistsCommentsModel = new PlaylistsCommentsModel();
    }

    public function create() {
        $this->authorize();
        if ($this->isPost()) {
            $author_username = $_POST['author_username'];
            $playlist_id = $_POST['playlist_id'];
            $comment = $_POST['comment'];
            if ($this->playlistsCommentsModel->create($author_username, $playlist_id, $comment)) {
                $this->addInfoMessage("Comment added.");
                $this->redirect("playlists/view/" . $playlist_id);
            } else {
                $this->addErrorMessage("Cannot add comment.");
            }
        }
    }

    public function edit($id) {
        $this->authorizeAdmin();

        $this->playlistComment = $this->playlistsCommentsModel->find("id", "i", $id);
        if (!$this->playlistComment) {
            $this->addErrorMessage("Invalid comment.");
            $this->redirect("playlists/view/" . $this->playlistComment['playlist_id']);
        }

        if ($this->isPost()) {
            $text = $_POST['text'];
            if ($this->playlistsCommentsModel->edit("text", "si", $id, $text)) {
                $this->addInfoMessage("Comment edited.");
                $this->redirect("playlists/view/" . $this->playlistComment['playlist_id']);
            } else {
                $this->addErrorMessage("Cannot edit comment.");
            }
        }
    }

    public function delete($id) {
        $this->authorizeAdmin();

        $this->playlistComment = $this->playlistsCommentsModel->find("id", "i", $id);
        if ($this->playlistsCommentsModel->delete("id", "i", $id)) {
            $this->addInfoMessage("Comment deleted.");
        } else {
            $this->addErrorMessage("Cannot delete comment #" . htmlspecialchars($id) . '.');
        }
        $this->redirect("playlists/view/" . $this->playlistComment['playlist_id']);
    }
}