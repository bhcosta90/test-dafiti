<?php

use App\Http\Controllers\Api\JuiceController;
use App\Repository\JuiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return true;
});

Route::get('/info', function () {
    return phpinfo();
});

/**
 * @OA\Info(
 *     version="1.0",
 *     title="Sample API Documentation"
 * )
 */
Route::prefix('v1')->group(function(){
    Route::get('/juice/{juice}', [JuiceController::class, 'index']);
});