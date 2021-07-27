<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TipoCambioController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// rutas para consultas internas del panel de adminitracion
Route::resource('v1/tipo-cambio', TipoCambioController::class);
// Ruta para la consulta publica api
Route::get('tipo-cambio/{api_key}',[TipoCambioController::class,'tipocambio'])->middleware('apiKey.validate')->name('api-tipo-cambio');
