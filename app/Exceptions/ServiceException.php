<?php

namespace App\Exceptions;

use Exception;
use App\Helper\ApiResponse;

class ServiceException extends Exception
{
    public function report()
    {
    }

    public function render($request)
    {
        return ApiResponse::badRequest('Bad Request', $this->getMessage());
    }
}
