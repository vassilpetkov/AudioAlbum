<?php

class HomeController extends BaseController {
    protected function onInit() {
        $this->title = 'Welcome';
    }
    public function index() {
        $this->playlistsModel = new PlaylistsModel();
        $this->playlists = $this->playlistsModel->fetchHighestRated();
    }
}
