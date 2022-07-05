<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JuiceRequest;
use App\Http\Resources\JuiceResource;
use App\Repository\JuiceRepository;

class JuiceController extends Controller
{
    /**
     * @OA\Info(version="1.0",title="Documentação da API de Sucos")
     * @OA\Get(
     *      path="/api/v1/juice/{juice}",
     *      operationId="index",
     *      tags={"Juice"},
     *      summary="Get list of juices",
     *      description="Returns list of juices",
     *      @OA\Parameter(
     *          description="Parameter with some examples
     *                       (Classic, Forest Berry, Freezie, Greenie, Vegan Delite, Just Desserts)",
     *          in="path",
     *          name="juice",
     *          required=true,
     *          @OA\Schema(type="string"),
     *          @OA\Examples(example="string", value="Classic,+chocolate,-pineapple", summary="An string value."),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found"
     *      ),
     *  )
     */
    public function index(JuiceRequest $request, string $juice, JuiceRepository $juiceRepository)
    {
        $arrayJuice = explode(',', str_replace(', ', ',', $juice));
        $juice = $arrayJuice[0];
        unset($arrayJuice[0]);
        $filter = implode(',', array_merge($request->filter ?? [], $arrayJuice ?: []));
        return new JuiceResource($juiceRepository->filter($juice, $filter ?: null));
    }
}
