<?php

namespace App\Interfaces;

interface BarangInterface
{
    public function getAll();
    public function getById($id);
    public function update($data);
    public function delete($id);
    public function create($data);
}
