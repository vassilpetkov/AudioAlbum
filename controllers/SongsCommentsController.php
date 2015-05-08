<?php

class SongsCommentsController extends BaseController {
    private $songsCommentsModel;

    protected function onInit() {
        $this->songsCommentsModel = new SongsCommentsModel();
    }

    public function create() {
        if ($this->isPost()) {
            $author_username = $_POST['author_username'];
            $song_id = $_POST['song_id'];
            $comment = $_POST['comment'];
            if ($this->songsCommentsModel->create($author_username, $song_id, $comment)) {
                $this->addInfoMessage("Comment added.");
                $this->redirect("songs/play/" . $song_id);
            } else {
                $this->addErrorMessage("Cannot add comment.");
            }
        }
    }
}