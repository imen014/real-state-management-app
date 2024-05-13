<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImmoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\RestrictAccessToOwner;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\Favourites;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PlanierVisite;
use App\Http\Controllers\AnswerController;
use  App\Http\Controllers\ConversationController;


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

Route::get('/index', [ImmoController::class, 'index'])->name('index');
Route::get('/immo/create', [ImmoController::class, 'create'])
    ->name('create_immo')
    ->middleware('auth', 'role:Property owner');

Route::post('/immo/create', [ImmoController::class, 'store'])
    ->name('save_immo')
    ->middleware('auth', 'role:Property owner');



Route::get('/immo/{id}/show', [ImmoController::class, 'show'])
    ->name('show_immo');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');
Route::get('/back', [AuthenticatedSessionController::class, 'back_function'])->name('back')->middleware('auth');

Route::middleware(['restrictAccessToOwner'])->group(function () {
    Route::get('/immo/{id}/edit', [ImmoController::class, 'edit'])->name('edit_immo');
    Route::put('/immo/{id}/update', [ImmoController::class, 'update'])->name('update_immo');
    Route::get('/immo/{id}/delete', [ImmoController::class, 'destroy'])->name('destroy_immo');    // Ajoutez d'autres routes nécessitant la vérification du propriétaire ici
});

Route::post('/immo/{id}/like',[ReactionController::class, 'like'])->middleware('auth', 'role:Home seeker')->name('immo.like');
Route::post('/immo/{id}/dislike',[ReactionController::class, 'dislike'])->middleware('auth', 'role:Home seeker')->name('immo.dislike');
Route::post('/immo/{id}/heart',[ReactionController::class, 'heart'])->middleware('auth', 'role:Home seeker')->name('immo.heart');


Route::get('/actual_reaction', [ReactionController::class, 'actual_reaction'])->name('actual_reaction');
Route::get('/favourites/get', [Favourites::class, 'favoris'])->name('favourites');

Route::post('/add_favourite', [Favourites::class, 'store'])->middleware('auth')->name('add_favourite');
Route::get('favourite/{id}/delete', [Favourites::class, 'destroy'])->middleware('auth')->name('delete_favourite');

Route::get('message/create', [MessageController::class, 'create'])->middleware('auth')->name('create_message');
Route::post('message/create', [MessageController::class, 'store'])->middleware('auth')->name('save_message');
Route::get('messages/get', [MessageController::class, 'index'])->middleware('auth')->name('get_message');

/************conversations path**************/
Route::get('conversations/{id}/get', [ConversationController::class, 'show'])->middleware('auth')->name('show_conversation');
Route::get('conversations/{id}/delete', [ConversationController::class, 'destroy'])->middleware('auth')->name('delete_conversation');

Route::get('answer/create', [AnswerController::class, 'create'])->middleware('auth')->name('create_answer');
Route::post('answer/create', [AnswerController::class, 'store'])->middleware('auth')->name('save_answer');

Route::get('messages/get_my_messages', [MessageController::class, 'get_my_messages'])->middleware('auth')->name('own_messages');

Route::get('message/{id}/delete', [MessageController::class, 'destroy'])->middleware('auth')->name('delete_message');
Route::get('visite/ask', [PlanierVisite::class, 'create'])->middleware('auth')->name('ask_visite');
Route::post('visite/ask', [PlanierVisite::class, 'store'])->middleware('auth')->name('store_ask_visite');
Route::get('visites/all', [PlanierVisite::class, 'index'])->middleware('auth')->name('get_all_visites');
Route::get('visites/{id}/delete', [PlanierVisite::class, 'destroy'])->middleware('auth')->name('delete_visite');
Route::get('visites/{id}/detail', [PlanierVisite::class, 'show'])->middleware('auth')->name('show_visite');
Route::get('visites/{id}/edit', [PlanierVisite::class, 'edit'])->middleware('auth')->name('edit_visite');
Route::put('visites/{id}/edit', [PlanierVisite::class, 'update'])->middleware('auth')->name('update_visite');
