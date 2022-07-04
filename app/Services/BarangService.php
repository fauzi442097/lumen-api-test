<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Interfaces\BarangInterface;

class BarangService
{

    protected $barangRepository;

    public function __construct(BarangInterface $barang)
    {
        $this->barangRepository = $barang;
    }

    public function getAll()
    {
        return $this->barangRepository->getAll();
    }

    public function getById($id)
    {
        $data = $this->barangRepository->getById($id);
        if (is_null($data)) {
            throw new ServiceException('Data Not Found', 404);
        }

        return $data;
    }

    public function update($dataBarang)
    {
        $this->barangRepository->update($dataBarang);
    }

    public function delete($id)
    {
        $data = $this->getById($id);
        $this->barangRepository->delete($data->id);
    }

    public function create($dataBarang)
    {
        return $this->barangRepository->create($dataBarang);
    }
}
