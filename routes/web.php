<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Game\GameController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/play', [GameController::class, 'show'])->name('game.play');
    Route::post('/play/guess/character', [GameController::class, 'guessCharacter'])->name('game.guess.character');
    Route::post('/play/guess/zone', [GameController::class, 'guessZone'])->name('game.guess.zone');
    Route::post('/play/guess/mount', [GameController::class, 'guessMount'])->name('game.guess.mount');
    Route::post('/play/guess/skill', [GameController::class, 'guessSkill'])->name('game.guess.skill');
    Route::post('/play/guess/quote', [GameController::class, 'guessQuote'])->name('game.guess.quote');
});


Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('characters', CharacterController::class);
});

require __DIR__.'/auth.php';
