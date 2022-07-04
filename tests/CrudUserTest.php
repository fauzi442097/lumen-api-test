<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CrudUserTest extends TestCase
{
    public function testCreateSuccess()
    {
        $body = [
            'name' => 'User Tes',
            'address' => 'Malang',
            'email' => 'usertest@gmail.com',
            'phoneNo' => "0871917276182"
        ];

        $response = $this->call('POST', 'http://localhost:8000/api/v1/users', $body);

        $this->assertEquals(200, $response['code'], 'Success Created');
    }

    public function testCreateFailed()
    {
        $body = [
            'name' => 'User Tes',
            'address' => 'Malang',
            'email' => 'usertestgmail.com',
            'phoneNo' => "0871917276182a"
        ];

        $response = $this->call('POST', 'http://localhost:8000/api/v1/users', $body);

        $this->assertEquals(400, $response['code'], 'Bad Request');
    }

    public function testUpdateSuccess()
    {
        $body = [
            'key' => "-N61hWH14cWRU2n4ZdET",
            'name' => 'User Tes Edit',
            'address' => 'Malangbong',
            'email' => 'usertest@gmail.com',
            'phoneNo' => "0871917276182"
        ];

        $response = $this->call('put', 'http://localhost:8080/api/v1/users', $body);

        $this->assertEquals(200, $response['code'], 'Success Updated');
    }

    public function testUpdateFailed()
    {
        $body = [
            'key' => "-N61hWH14cWRU2n4ZdETaFA",
            'name' => 'User Tes Edit',
            'address' => 'Malangbong',
            'email' => 'usertest@gmail.com',
            'phoneNo' => "0871917276182"
        ];

        $response = $this->call('put', 'http://localhost:8080/api/v1/users', $body);

        $this->assertEquals(404, $response['code'], 'Not Found');
    }

    public function testDeleteSuccess()
    {
        $id = "-N61hWH14cWRU2n4ZdET";
        $response = $this->call('delete', 'http://localhost:8080/api/v1/users/' . $id);
        $this->assertEquals(200, $response['code'], 'Success deleted');
    }

    public function testDeleteFailed()
    {
        $id = "-N61hWH14cWRU2n4ZdETaFA";
        $response = $this->call('delete', 'http://localhost:8080/api/v1/users/' . $id);
        $this->assertEquals(404, $response['code'], 'Success deleted');
    }
}
