<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/', [ApiController::class, 'index'])->name('index');
    Route::get('/results', [ApiController::class, 'results'])->name('results');
    Route::get('/watch/{videoId}/{searchKeyword?}', [ApiController::class, 'watch'])->name('watch');
    Route::get('/history', [ApiController::class, 'history'])->name('history');
    Route::get('/mostliked', [ApiController::class, 'mostliked'])->name('mostliked');
    Route::get('/edit', [ApiController::class, 'history'])->name('editUser');
    Route::delete('/history/{videoId}', [ApiController::class, 'destroy'])->name('delete');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
?>