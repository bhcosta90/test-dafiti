<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JuiceRequest;
use App\Http\Resources\JuiceResource;
use App\Repository\JuiceRepository;

class JuiceController extends Controller
{
    public function index(JuiceRequest $request, string $juice, JuiceRepository $juiceRepository)
    {
        $arrayJuice = explode(',', str_replace(', ', ',', $juice));
        $juice = $arrayJuice[0];
        unset($arrayJuice[0]);
        $filter = implode(',', array_merge($request->filter ?? [], $arrayJuice ?: []));
        return new JuiceResource($juiceRepository->filter($juice, $filter ?: null));
    }
}
