<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Models\MailerLiteApiKey;
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
Route::get('/validate-api-key', function () {
    return view('validate-api-key');
})->name('validate-api-key-form');

Route::post('/validate-api-key', [App\Http\Controllers\SubscriberController::class, 'validateApiKey'])->name('validate-api-key');





Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
Route::get('/subscribers/create', [SubscriberController::class, 'create'])->name('subscribers.create');



Route::post('/subscribers', [SubscriberController::class, 'store'])->name('subscribers.store');

Route::get('/subscribers/{id}/edit/', [SubscriberController::class, 'edit'])->name('subscribers.edit');

Route::post('/subscribers/edit/{id}', [SubscriberController::class, 'update'])->name('subscribers.update');
;


Route::delete('/subscribers/{id}', [SubscriberController::class, 'delete'])->name('subscribers.delete');
