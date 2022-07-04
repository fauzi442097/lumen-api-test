<?php

namespace App\Repositories;

use App\Interfaces\BarangInterface;
use App\Models\Barang;

class BarangRepository implements BarangInterface
{
    protected $model;

    public function __construct(Barang $barang)
    {
        $this->model = $barang;
    }

    public function getAll()
    {
        return $this->model::all();
    }

    public function getById($id)
    {
        return $this->model::find($id);
    }

    public function update($data)
    {
        $model = $this->getById($data['id']);
        $model->nama_barang = $data['namaBarang'];
        $model->harga = $data['harga'];
        $model->stock = $data['stock'];
        $model->save();
    }

    public function delete($id)
    {
        $this->model::destroy($id);
    }

    public function create($data)
    {
        $model = $this->model;
        $model->nama_barang = $data['namaBarang'];
        $model->harga = $data['harga'];
        $model->stock = $data['stock'];
        $model->save();
        return $model;
    }
}
