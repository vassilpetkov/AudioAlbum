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
}