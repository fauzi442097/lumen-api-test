<?php

namespace App\Http\Controllers;

use App\Helper\ApiResponse;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public $service;
    public function __construct(UserService $user)
    {
        $this->service = $user;
    }

    /**
     * @OA\Get(
     *     path="/users",
     *     tags={"User"},
     *     summary="Get all users",
     *     description="Get all users in realtime database",
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *               @OA\Schema(
     *                  @OA\Property(property="code", example="200"),
     *                  @OA\Property(property="message", example="Success"),
     *                  @OA\Property(property="data", type="array",
     *                      example={{
     *                          "key": "-N61YMhcGqkNze0_tYh6",
     *                          "name": "User Test3",
     *                          "address": "Surabaya",
     *                          "email": "usertest3@gmail.com",
     *                          "phoneNo": "08986162100",
     *                      }, {
     *                          "key": "-N61YK8mgZg2xuOmKSyR",
     *                          "name": "User Test2",
     *                          "address": "Jakarta",
     *                          "email": "usertest2@gmail.com",
     *                          "phoneNo": "08986162400"
     *                      }},
     *                      @OA\Items(
     *                          @OA\Property(property="key", description="Key ", example="-N61YMhcGqkNze0_tYh6", type="string"),
     *                          @OA\Property(property="name", description="name user", example="User Test3", type="string", minLength=3 ),
     *                          @OA\Property(property="address", description="address user", example="Surabaya", type="string"),
     *                          @OA\Property(property="email", description="email user", example="usertest3@gmail.com", type="string"),
     *                          @OA\Property(property="phoneNo", description="Phone no", example="08986162100", type="number", minLength=8)
     *                      ),
     *                  )
     *              )
     *          )
     *     ),
     * )
     *
     */
    public function index()
    {
        try {
            $users = $this->service->getAll();
            return ApiResponse::success('Success', $users);
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @OA\Parameter(
     *  name="key",
     *  in="path",
     *  description="Key of data user",
     *  required=true,
     *  @OA\Schema(type="string")
     * )
     */

    /**
     * @OA\Get(
     *     path="/users/{key}",
     *     tags={"User"},
     *     summary="Find user by key",
     *     description="Find data user in database by Key",
     *     @OA\Parameter(ref="#/components/parameters/key"),
     *     @OA\Response(response=200, description="success",
     *         @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code", example="200"),
     *                  @OA\Property(property="message", example="Success"),
     *                  @OA\Property(property="data", type="object",
     *                      @OA\Property(property="key", description="Key ", example="-N61YMhcGqkNze0_tYh6", type="string"),
     *                      @OA\Property(property="name", description="name user", example="User Test3", type="string", minLength=3 ),
     *                      @OA\Property(property="address", description="address user", example="Surabaya", type="string"),
     *                      @OA\Property(property="email", description="email user", example="usertest3@gmail.com", type="string"),
     *                      @OA\Property(property="phoneNo", description="Phone no", example="08986162100", type="number", minLength=8)
     *                  )
     *              )
     *          )
     *     ),
     *     @OA\Response(response=404,description="Response Not Found",
     *         @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/NotFoundResponse"))
     *     ),
     * )
     *
     * @param int $id
     */
    public function show($key)
    {
        try {
            $users = $this->service->getByKey($key);
            return ApiResponse::success('Success', $users);
        } catch (\App\Exceptions\ServiceException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/users",
     *     tags={"User"},
     *     summary="Create new user",
     *     description="Create new data user to database",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(required={"name", "address", "email", "phoneNo"},
     *                  @OA\Property(property="name", description="Nama user", example="User Test3", type="string", minLength=3),
     *                  @OA\Property(property="address", description="address user", example="Surabaya", type="string"),
     *                  @OA\Property(property="email", description="email user", example="usertest3@gmail.com", type="string"),
     *                  @OA\Property(property="phoneNo", description="phone no user", example="08986162100", type="number", minLength=1)
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code",example="200", type="number"),
     *                  @OA\Property(property="message",example="Success Created", type="string"),
     *                  @OA\Property(type="object",property="data",
     *                  @OA\Property(property="name", description="Nama user", example="User Test3", type="string", minLength=3),
     *                  @OA\Property(property="address", description="address user", example="Surabaya", type="string"),
     *                  @OA\Property(property="email", description="email user", example="usertest3@gmail.com", type="string"),
     *                  @OA\Property(property="phoneNo", description="phone no user", example="08986162100", type="number", minLength=1),
     *                  @OA\Property(property="key", description="key of user", example="-N61YMhcGqkNze0_tYh6", type="string")
     *                  ),
     *              )
     *          )
     *     ),
     *      @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code",example="400", type="number"),
     *                  @OA\Property(property="message",example="The given data was invalid.", type="string"),
     *                  @OA\Property(type="object",property="errors",
     *                      @OA\Property(property="name", type="array",
     *                          @OA\Items(type="string", example="The name field is required."),
     *                      ),
     *                      @OA\Property(property="address", type="array",
     *                          @OA\Items(type="string", example="The address field is required."),
     *                      ),
     *                      @OA\Property(property="email", type="array",
     *                          @OA\Items(type="string", example="The email field is required."),
     *                      ),
     *                      @OA\Property(property="phoneNo", type="array",
     *                          @OA\Items(type="string", example="The phoneNo field is required.")
     *                      )
     *                  )
     *              )
     *          )
     *     ),
     * )
     *
     *
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|min:2',
                'address' => 'required',
                'email' => 'required|email',
                'phoneNo' => 'required|digits_between:8,14'
            ]);

            $user = $request->all();
            $userCreated = $this->service->create($user);
            return ApiResponse::success('Success Created', $userCreated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::badRequest($e->getMessage(), $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/user/{key}",
     *     tags={"User"},
     *     summary="Delete existing user",
     *     description="Delete existing data user in database by Key",
     *     @OA\Parameter(ref="#/components/parameters/key"),
     *     @OA\Response(
     *         response=200,
     *         description="Response Success Deleted",
     *         @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code",example="200"),
     *                  @OA\Property(property="message",example="Success deleted"),
     *              )
     *          )
     *     ),
     *     @OA\Response(response=404,description="Response Not Found",
     *         @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/NotFoundResponse"))
     *     ),
     * )
     *
     * @param int $id
     */
    public function delete($key)
    {
        try {
            $this->service->delete($key);
            return ApiResponse::success('Success Deleted');
        } catch (\App\Exceptions\ServiceException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @OA\Put(
     *     path="/user",
     *     tags={"User"},
     *     summary="Update existing data user",
     *     description="Update existing data user to database",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"id", "namaBarang", "harga", "stock"},
     *                  @OA\Property(property="key", description="Key user", example="-N61UK0CJzWAmoiBULVU", type="string"),
     *                  @OA\Property(property="name", description="Nama user", example="User Test1", type="string", minLength=3),
     *                  @OA\Property(property="address", description="address user", example="Bandung", type="string"),
     *                  @OA\Property(property="email", description="email user", example="usertest3@gmail.com", type="string"),
     *                  @OA\Property(property="phoneNo", description="phone no user", example="08986162100", type="number", minLength=1)
     *              )
     *          )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code",example="200"),
     *                  @OA\Property(property="message",example="Success Updated"),
     *                  @OA\Property(type="object",property="data",
     *                  @OA\Property(property="key", description="Key user", example="-N61UK0CJzWAmoiBULVU", type="string"),
     *                  @OA\Property(property="name", description="Nama user", example="User Test1", type="string", minLength=3),
     *                  @OA\Property(property="address", description="address user", example="Bandung", type="string"),
     *                  @OA\Property(property="email", description="email user", example="usertest3@gmail.com", type="string"),
     *                  @OA\Property(property="phoneNo", description="phone no user", example="08986162100", type="number", minLength=1)
     *                  ),
     *              )
     *          )
     *     ),
     *     @OA\Response(response=404,description="Response Not Found",
     *         @OA\MediaType(mediaType="application/json", @OA\Schema(ref="#/components/schemas/NotFoundResponse"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code",example="400", type="number"),
     *                  @OA\Property(property="message",example="The given data was invalid.", type="string"),
     *                  @OA\Property(type="object",property="errors",
     *                      @OA\Property(property="name", type="array",
     *                          @OA\Items(type="string", example="The name field is required."),
     *                      ),
     *                      @OA\Property(property="address", type="array",
     *                          @OA\Items(type="string", example="The address field is required."),
     *                      ),
     *                      @OA\Property(property="email", type="array",
     *                          @OA\Items(type="string", example="The email field is required."),
     *                      ),
     *                      @OA\Property(property="phoneNo", type="array",
     *                          @OA\Items(type="string", example="The phoneNo field is required.")
     *                      )
     *                  )
     *              )
     *          )
     *     ),
     * )
     *
     * @param int $id
     */
    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'key' => 'required',
                'name' => 'required|min:2',
                'address' => 'required',
                'email' => 'required|email',
                'phoneNo' => 'required|digits_between:8,14'
            ]);

            $user = $request->all();
            $userCreated = $this->service->update($user, $user['key']);
            return ApiResponse::success('Success Updated', $userCreated);
        } catch (\App\Exceptions\ServiceException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::badRequest($e->getMessage(), $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }
}
