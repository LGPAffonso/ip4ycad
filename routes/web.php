<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CadastroController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [CadastroController::class, "index"]);
Route::get('/cadastro', [CadastroController::class, "index"]);
Route::post('/insert', [CadastroController::class, "store"]);
Route::get('/listagem', [CadastroController::class, "listagem"]);
Route::delete('/remove/{id}', [CadastroController::class, "remove"]);
Route::get('/edit/{id}', [CadastroController::class, "edit"]);
Route::put('/update', [CadastroController::class, "update"]);
Route::get("/api", [CadastroController::class, 'api']);
