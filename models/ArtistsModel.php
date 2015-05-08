<?php

class ArtistsModel extends BaseModel {
    public function fetchAll() {
        return parent::fetchAll("artists") ;
    }

    public function find($column, $types, $value) {
        return parent::find("artists", $column, $types, $value);
    }

    public function create($types, $value) {
        return parent::create("artists", $types, $value);
    }

    public function delete($column, $types, $value) {
        return parent::delete("artists", $column, $types, $value);
    }
}
