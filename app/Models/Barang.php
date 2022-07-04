<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Barang extends Eloquent
{
    //
    protected $collection = 'barang';

    public $timestamps = false;

    /**
     * @OA\Parameter(
     *  name="id",
     *  in="path",
     *  description="Id of data barang",
     *  required=true,
     *  @OA\Schema(type="string")
     * )
     */

    protected $fillable = [
        'nama_barang', 'harga', 'stock'
    ];
}
