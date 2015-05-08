<?php

class GenresModel extends BaseModel {
    public function fetchAll() {
        return parent::fetchAll("genres") ;
    }

    public function find($column, $types, $value) {
        return parent::find("genres", $column, $types, $value);
    }

    public function create($types, $value) {
        return parent::create("genres", $types, $value);
    }

    public function edit($types, $id, $value) {
        return parent::edit("genres", $types, $id, $value);
    }

    public function delete($column, $types, $value) {
        return parent::delete("genres", $column, $types, $value);
    }
}
