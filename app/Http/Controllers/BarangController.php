<?php

namespace App\Http\Controllers;


use App\Helper\ApiResponse;
use App\Services\BarangService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    protected $service;

    public function __construct(BarangService $service)
    {
        $this->service = $service;
    }

    /**
     * @OA\Get(
     *     path="/barang",
     *     tags={"Barang"},
     *     summary="Get all data barang",
     *     description="Get all data barang in database",
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
     *                          "_id": "62bfd45c1ac213e12405b513",
     *                          "namaBarang": "Meja",
     *                          "harga": "500000",
     *                          "stock": "1",
     *                      }, {
     *                          "_id": "62bfd45c1ac213e12405b500",
     *                          "namaBarang": "Kulkas",
     *                          "harga": "3000000",
     *                          "stock": "5"
     *                      }},
     *                      @OA\Items(
     *                          @OA\Property(property="_id", description="Id Barang", example="62bfd45c1ac213e12405b513", type="string"),
     *                          @OA\Property(property="namaBarang", description="Nama Barang", example="Meja", type="string", maxLength=100 ),
     *                          @OA\Property(property="harga", description="Harga Barang", example="500000", type="number"),
     *                          @OA\Property(property="stock", description="Stock Barang", example="1", type="number", minLength=1)
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
            $dataBarang = $this->service->getAll();
            return ApiResponse::success('Success', $dataBarang);
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/barang/{id}",
     *     tags={"Barang"},
     *     summary="Find data barang",
     *     description="Find data barang in database by Id",
     *     @OA\Parameter(ref="#/components/parameters/id"),
     *     @OA\Response(response=200, description="success",
     *         @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code", example="200"),
     *                  @OA\Property(property="message", example="Success"),
     *                  @OA\Property(property="data", type="object",
     *                      @OA\Property(property="namaBarang",description="Nama Barang",example="Meja",type="string",maxLength=100),
     *                      @OA\Property(property="harga",description="Harga Barang",example="500000",type="number"),
     *                      @OA\Property(property="stock",description="Stock Barang",example="1",type="number",minLength=1),
     *                      @OA\Property(property="_id",description="Id Barang",example="62bfd45c1ac213e12405b513",type="string")
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
    public function show($id)
    {
        try {
            $dataBarang = $this->service->getById($id);
            return ApiResponse::success('Success', $dataBarang);
        } catch (\App\Exceptions\ServiceException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }


    /**
     * @OA\Post(
     *     path="/barang",
     *     tags={"Barang"},
     *     summary="Create new data barang",
     *     description="Create new todolist to database",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(mediaType="application/json",
     *              @OA\Schema(required={"namaBarang", "harga", "stock"},
     *                  @OA\Property(property="namaBarang", description="Nama Barang", example="Meja", type="string", maxLength=100),
     *                  @OA\Property(property="harga", description="Harga Barang", example="10000", type="number"),
     *                  @OA\Property(property="stock", description="Stock Barang", example="1", type="number", minLength=1)
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="code",example="200"),
     *                  @OA\Property(property="message",example="Success Created"),
     *                  @OA\Property(type="object",property="data",
     *                      @OA\Property(property="namaBarang",description="Nama Barang",example="Meja",type="string",maxLength=100),
     *                      @OA\Property(property="harga",description="Harga Barang",example="500000",type="number"),
     *                      @OA\Property(property="stock",description="Stock Barang",example="1",type="number",minLength=1),
     *                      @OA\Property(property="_id",description="Id Barang",example="62bfd45c1ac213e12405b513",type="string")
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
     *                      @OA\Property(property="namaBarang", type="array",
     *                          @OA\Items(type="string", example="The nama barang field is required."),
     *                      ),
     *                      @OA\Property(property="harga", type="array",
     *                          @OA\Items(type="string", example="The harga field is required."),
     *                      ),
     *                      @OA\Property(property="stock", type="array",
     *                          @OA\Items(type="string", example="The stock field is required."),
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
            $dataBarang = $request->all();

            $this->validate($request, [
                'namaBarang' => 'required|max:100',
                'harga' => 'required|numeric',
                'stock' => 'required|integer|min:1'
            ]);

            $dataBarang = $this->service->create($dataBarang);
            return ApiResponse::success('Success Created', $dataBarang);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::badRequest($e->getMessage(), $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }


    /**
     * @OA\Delete(
     *     path="/barang/{id}",
     *     tags={"Barang"},
     *     summary="Delete existing data barang",
     *     description="Delete existing data barang in database by Id",
     *     @OA\Parameter(ref="#/components/parameters/id"),
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
    public function delete($id)
    {
        try {
            $this->service->delete($id);
            return ApiResponse::success('Success deleted');
        } catch (\App\Exceptions\ServiceException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }

    /**
     * @OA\Put(
     *     path="/barang",
     *     tags={"Barang"},
     *     summary="Update existing data barang",
     *     description="Update existing data barang to database",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  required={"id", "namaBarang", "harga", "stock"},
     *                  @OA\Property(property="id",description="Id Barang",example="62bfd45c1ac213e12405b513",type="string",),
     *                  @OA\Property(property="namaBarang",description="Nama Barang",example="Komputer",type="string",maxLength=100,),
     *                  @OA\Property(property="harga",description="Harga Barang",example="10000",type="number"),
     *                  @OA\Property(property="stock",description="Stock Barang",example="1",type="number",minLength=1)
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
     *                      @OA\Property(property="namaBarang",description="Nama Barang",example="Komputer",type="string",maxLength=100),
     *                      @OA\Property(property="harga",description="Harga Barang",example="10000",type="number"),
     *                      @OA\Property(property="stock",description="Stock Barang",example="1",type="number",minLength=1),
     *                      @OA\Property(property="_id",description="Id Barang",example="62bfd45c1ac213e12405b513",type="string")
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
     *                      @OA\Property(property="id", type="array",
     *                          @OA\Items(type="string", example="The id field is required."),
     *                      ),
     *                      @OA\Property(property="namaBarang", type="array",
     *                          @OA\Items(type="string", example="The nama barang field is required."),
     *                      ),
     *                      @OA\Property(property="harga", type="array",
     *                          @OA\Items(type="string", example="The harga field is required."),
     *                      ),
     *                      @OA\Property(property="stock", type="array",
     *                          @OA\Items(type="string", example="The stock field is required."),
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
                'id' => 'required',
                'namaBarang' => 'required|max:100',
                'harga' => 'required|numeric',
                'stock' => 'required|integer|min:1'
            ]);

            $this->service->getById($request->id);

            $dataBarang = $request->all();
            $this->service->update($dataBarang);
            return ApiResponse::success('Success updated', $dataBarang);
        } catch (\App\Exceptions\ServiceException $e) {
            return ApiResponse::notFound($e->getMessage());
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::badRequest($e->getMessage(), $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::internalServerError($e->getMessage());
        }
    }
}
