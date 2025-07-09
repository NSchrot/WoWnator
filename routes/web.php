<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\MountController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\QuoteController;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Game\RankingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\UserNotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('game.play');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/history', [ProfileController::class, 'history'])->name('profile.history');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/play', [GameController::class, 'show'])->name('game.play');
    Route::get('/ranking', [RankingController::class, 'show'])->name('game.ranking');
    Route::post('/play/guess/character', [GameController::class, 'guessCharacter'])->name('game.guess.character');
    Route::post('/play/guess/zone', [GameController::class, 'guessZone'])->name('game.guess.zone');
    Route::post('/play/guess/mount', [GameController::class, 'guessMount'])->name('game.guess.mount');
    Route::post('/play/guess/skill', [GameController::class, 'guessSkill'])->name('game.guess.skill');
    Route::post('/play/guess/quote', [GameController::class, 'guessQuote'])->name('game.guess.quote');
    Route::post('/notifications/mark-as-read', [UserNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/reroll', [DashboardController::class, 'rerollTarget'])->name('dashboard.reroll');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::resource('notifications', NotificationController::class)->except(['edit', 'update']);
    Route::resource('characters', CharacterController::class);
    Route::resource('mounts', MountController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('zones', ZoneController::class);
    Route::resource('quotes', QuoteController::class);
    
});

require __DIR__.'/auth.php';
