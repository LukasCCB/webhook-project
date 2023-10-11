<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::match(['get', 'post', 'put', 'delete', 'patch'], 'webhook/{unique_url}', [WebhookController::class, 'store']);
Route::get('webhook/{unique_url}/{webhookId?}', [WebhookController::class, 'show'])->name('webhook.show');
Route::delete('webhook/{unique_url}/delete', [WebhookController::class, 'delete'])->name('webhook.delete');
