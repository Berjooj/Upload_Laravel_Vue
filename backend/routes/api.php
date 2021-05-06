<?php

use Illuminate\Http\Request;
use App\Http\Controllers\{
    ArquivoController
};

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

Route::fallback(function () {
    return response()->json(['mensagem' => 'Opa, nada encontrado!', 'status' => 404]);
});

Route::prefix('/upload')->group(
    function () {
        Route::post('', [ArquivoController::class, 'uploadArquivo'])->middleware(['cors']);
    }
);

