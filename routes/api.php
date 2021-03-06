<?php

use App\Http\Controllers\Api\MovieController;
    use App\Http\Controllers\Api\ProductController;
    use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UsersController;
use \App\Http\Controllers\Api\AuthController;

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


Route::post("auth/login", [ AuthController::class, "login" ])->name("auth.login");
Route::post("auth/logout", [ AuthController::class, "logout" ])->name("auth.logout");
Route::post("auth/refresh", [ AuthController::class, "refresh" ])->name("auth.refresh");

Route::middleware(["apiJWT", "ACL Permissões"])->group(function(){

    # Grupo de Rotas de Usuários
    Route::prefix("user/")->name("user.")->group(function (){

        Route::get("index", [ UsersController::class, "index" ])
            ->name("index")
            ->setWheres([
                "label"        =>"Lista de ",
                "group"        =>"Usuários",
                "roles_ids"    =>"3",
            ]);

        Route::post("store", [ UsersController::class, "store" ])
            ->name("store")
            ->setWheres([
                "label"        =>"Cadastrar ",
                "group"        =>"Usuários",
                "roles_ids"    =>"3",
            ]);

    });

    // Grupo de Rotas do Controller "Products"
    Route::prefix('product/')->name('product.')->group(function (){

        Route::get('{name?}/{query_filter?}', [ ProductController::class, "index" ])
            ->name('index')
            ->setWheres([
                "label"        =>"Busca de ",
                "group"        =>"Produtos",
                "roles_ids"    =>"all",
            ]);
    });

});
