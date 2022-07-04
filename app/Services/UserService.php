<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Helper\Firebase;

class UserService
{
    protected $firebase;

    public function __construct()
    {
        $this->firebase = new Firebase('users');
    }

    public function getAll()
    {
        $users = $this->firebase->getAll();
        if (is_null($users)) {
            return [];
        } else {
            $usersFormatted = [];
            foreach ($users as $key => $value) {
                $usersFormatted[] = [
                    'key' => $key,
                    'name' => $value['name'],
                    'address' => $value['address'],
                    'email' => $value['email'],
                    'phoneNo' => $value['phoneNo'],
                ];
            }
            return array_reverse(array_values($usersFormatted));
        }
    }

    public function create($user)
    {
        return $this->firebase->create($user);
    }

    public function getByKey($key)
    {
        $user = $this->firebase->getByKey($key);
        if (is_null($user)) throw new ServiceException("Data not found");

        $user['key'] = $key;

        return $user;
    }

    public function update($data, $key)
    {
        $user = $this->firebase->getByKey($key);
        if (is_null($user)) throw new ServiceException("Data not found");

        $this->firebase->update($data, $key);
    }

    public function delete($key)
    {
        $user = $this->firebase->getByKey($key);
        if (is_null($user)) throw new ServiceException("Data not found");

        $this->firebase->delete($key);
    }
}
