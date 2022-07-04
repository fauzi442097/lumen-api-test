<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;


class CrudTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testCreateSuccess()
    {
        $body = [
            'namaBarang' => 'Baju Bola',
            'harga' => 1000000,
            'stock' => 10
        ];

        $response = $this->call('POST', 'http://localhost:8080/api/v1/barang', $body);

        $this->assertEquals(200, $response['code'], 'Success Created');
    }

    public function testCreateFailed()
    {
        $body = [
            'namaBarang' => '',
            'harga' => 'ADAD',
            'stock' => 10
        ];

        $response = $this->call('POST', 'http://localhost:8080/api/v1/barang', $body);

        $this->assertEquals(400, $response['code'], 'Bad Request');
    }

    public function testUpdateSuccess()
    {
        $body = [
            'id' => "62bffefadd791189a102c892",
            'namaBarang' => 'Baju Bola',
            'harga' => 1000000,
            'stock' => 10
        ];

        $response = $this->call('put', 'http://localhost:8080/api/v1/barang', $body);

        $this->assertEquals(200, $response['code'], 'Success Updated');
    }

    public function testUpdateFailed()
    {
        $body = [
            'id' => "62bffefadd791189a102c892",
            'namaBarang' => 'Baju Ultraman',
            'harga' => 'ad',
            'stock' => 0
        ];

        $response = $this->call('put', 'http://localhost:8080/api/v1/barang', $body);

        $this->assertEquals(400, $response['code'], 'Bad Request');
    }

    public function testDeleteSuccess()
    {
        $id = "62bffefadd791189a102c892";
        $response = $this->call('delete', 'http://localhost:8080/api/v1/barang/' . $id);
        $this->assertEquals(200, $response['code'], 'Success deleted');
    }

    public function testDeleteFailed()
    {
        $id = "62bffefadd791189a102c892";
        $response = $this->call('delete', 'http://localhost:8080/api/v1/barang/' . $id);
        $this->assertEquals(404, $response['code'], 'Not Found');
    }
}
