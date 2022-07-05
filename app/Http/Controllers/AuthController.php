<?php

namespace App\Http\Controllers;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    //

    public function register(Request $request)
    {
        try {
            // $this->validate($request, [
            //     'email' => 'required|email',
            //     'password' => 'required'
            // ]);

            $dataRegister = $request->all();

            $dataRegister = [
                "email" => "eve.holt@reqres.in",
                "password" => "pistol"
            ];

            [$stsCode, $respBody] = $this->makeRequest('POST', 'register', $dataRegister);

            if ($stsCode == 200) {
                return response()->json([
                    'code' => 201,
                    'data' => $respBody
                ], 201);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::badRequest($e->getMessage(), $e->errors());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $message = json_decode($response->getBody()->getContents());
            return response()->json([
                'code' => 403,
                'error' => $message->error
            ], 403);
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            // $this->validate($request, [
            //     'email' => 'required|email',
            //     'password' => 'required'
            // ]);

            $dataLogin = [
                "email" => "eve.holt@reqres.in",
                "password" => "cityslicka"
            ];

            $dataLogin = $request->all();
            [$stsCode, $respBody] = $this->makeRequest('POST', 'login', $dataLogin);

            if ($stsCode == 200) {
                return response()->json([
                    'code' => 201,
                    'data' => $respBody
                ], 201);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::badRequest($e->getMessage(), $e->errors());
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $message = json_decode($response->getBody()->getContents());
            return response()->json([
                'code' => 403,
                'error' => $message->error
            ], 403);
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    public function makeRequest($method, $path, $data = [])
    {
        $baseUrl = 'https://reqres.in/api/' . $path;
        $client = new Client();
        $response = $client->request($method, $baseUrl, [
            'form_params' => $data,
        ]);
        $responseBody = json_decode($response->getBody()->getContents());
        $statusCode = $response->getStatusCode();
        return [$statusCode, $responseBody];
    }
}
