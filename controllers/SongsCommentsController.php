<?php

class SongsCommentsController extends BaseController {
    private $songsCommentsModel;

    protected function onInit() {
        $this->songsCommentsModel = new SongsCommentsModel();
    }

    public function create() {
        $this->authorize();
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

    public function edit($id) {
        $this->authorizeAdmin();

        $this->songComment = $this->songsCommentsModel->find("id", "i", $id);
        if (!$this->songComment) {
            $this->addErrorMessage("Invalid comment.");
            $this->redirect("songs/play/" . $this->songComment['song_id']);
        }

        if ($this->isPost()) {
            $text = $_POST['text'];
            if ($this->songsCommentsModel->edit("text", "si", $id, $text)) {
                $this->addInfoMessage("Comment edited.");
                $this->redirect("songs/play/" . $this->songComment['song_id']);
            } else {
                $this->addErrorMessage("Cannot edit comment.");
            }
        }
    }

    public function delete($id) {
        $this->authorizeAdmin();

        $this->songComment = $this->songsCommentsModel->find("id", "i", $id);
        if ($this->songsCommentsModel->delete("id", "i", $id)) {
            $this->addInfoMessage("Comment deleted.");
        } else {
            $this->addErrorMessage("Cannot delete comment #" . htmlspecialchars($id) . '.');
        }
        $this->redirect("songs/play/" . $this->songComment['song_id']);
    }
}