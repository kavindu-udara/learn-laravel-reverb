<?php

use App\Events\Chat\ExampleTwo;
use App\Events\Example;
use App\Events\OrderDelivered;
use App\Events\OrderDispatched;
use App\Events\TestEvent;
use App\Http\Controllers\ProfileController;
use App\Models\Message;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/broadcast', function () {
    // broadcast(new TestEvent(User::find(1), Message::find(1)));
    // broadcast(new ExampleTwo());
    // broadcast(new OrderDispatched(User::find(1), Order::find(1)));

    // broadcast(new OrderDelivered(User::find(1)))
    sleep(3);
    broadcast(new OrderDispatched(Order::find(1)));
    sleep(3);
    broadcast(new OrderDelivered(Order::find(1)));

});

Route::get('/orders/{order}', function (Order $order){
    return view('order', [
        'order' => $order
    ]);
});

Route::get('/room/{room}', function (Room $room){
    return view('room', [
        'room' => $room
    ]);
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
})->middleware('auth')->name('room');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
