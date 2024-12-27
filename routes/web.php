<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuizController;
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
Route::get('/', function () {
    return redirect()->route('login'); // Redirect to login page
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::middleware(['auth'])->group(function () {
    
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [QuizController::class, 'dashboard'])->name('dashboard');
    Route::get('/quiz/start/{category}', [QuizController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/question', [QuizController::class, 'question'])->name('quiz.question');
    Route::post('/quiz/answer', [QuizController::class, 'submitAnswer'])->name('quiz.answer');
    Route::get('/quiz/complete', [QuizController::class, 'complete'])->name('quiz.complete');
    Route::post('/quiz/{category}/next', [QuizController::class, 'nextQuestion'])->name('quiz.next');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
});

