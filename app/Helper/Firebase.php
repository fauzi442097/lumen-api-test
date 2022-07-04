<?php

namespace App\Helper;

class Firebase
{

    public $database;
    public $ref;

    public function __construct($model)
    {
        $this->database = app('firebase.database');
        $this->ref = $model;
    }

    public function reference()
    {
        return $this->database->getReference($this->ref);
    }

    public function getAll()
    {
        return $this->reference()->getValue();
    }

    public function create($data)
    {
        $operation = $this->reference()->push($data);
        $value = $operation->getValue();
        $key = $operation->getKey();

        $value['key'] = $key;
        return $value;
    }

    public function update($data, $key)
    {
        $table = $this->ref . '/' . $key;
        $this->database->getReference($table)->update($data);
    }

    public function getByKey($key)
    {
        return $this->reference()->getChild($key)->getValue();
    }

    public function delete($key)
    {
        $table = $this->ref . '/' . $key;
        $this->database->getReference($table)->remove();
    }

    public function generateKey()
    {
        return $this->reference()->push()->getKey();
    }
}
