<?php

use App\Events\Chat\ExampleTwo;
use App\Events\Example;
use App\Events\TestEvent;
use App\Http\Controllers\ProfileController;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/broadcast', function () {
    broadcast(new TestEvent(User::find(1), Message::find(1)));
    // broadcast(new ExampleTwo());
});

// Route::get('/test-broadcast', function () {
//     \Log::info('Broadcast test initiated');
//     // broadcast(new Example);
//     // $event = new Example;
//     event(new Example);
//     \Log::info('Broadcast test completed');
// });

// Route::get('/test-broadcast', function () {
//     \Log::info('Broadcast test initiated');
//     event(new \App\Events\Example());
//     \Log::info('Broadcast test completed');
// });

Route::get('/test-broadcast', function () {
    \Log::info('Broadcast test initiated');
    event(new \App\Events\TestEvent());
    \Log::info('Broadcast test completed');
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
