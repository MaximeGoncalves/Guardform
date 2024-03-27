<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect()->route('dashboard');
});

Route::get('/recap/{guard}', function (\App\Models\Guard $guard) {
    return Inertia::render('Recap', [
        'guard' => $guard->load(['forms' => function ($q) {
            $q->with([
                'garde',
                'caVsav1',
                'caVsav2',
                'caVsav3',
                'caVtu',
                'caVsr',
                'condVsav1',
                'condVsav2',
                'condVsav3',
                'condVtu',
                'condVsr',
                'eqVsav1',
                'eqVsav2',
                'eqVsav3',
                'eqVtu',
                'eqVsr',
                'caFptl',
                'condFptl',
                'ce1Fptl',
                'ce2Fptl',
                'eq1Fptl',
                'eq2Fptl',
                'vli',
                'epa',
                'secu',
                'cuisine',
                'officier',
                'adjudant',
                'planton',
            ]);
        }])
    ]);
})->name('recap');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/stats', [\App\Http\Controllers\StatsController::class, 'index'])->name('stats.index');
    Route::put('/forms/{form}/agents', \App\Http\Controllers\AddAgentToFormController::class)->name('forms.agents.add');
    Route::put('/forms/{form}/agents/delete', \App\Http\Controllers\RemoveAgentFromFormController::class)->name('forms.agents.delete');
    Route::resource('/guards', \App\Http\Controllers\GuardController::class);
    Route::resource('/agents', \App\Http\Controllers\AgentController::class);
    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('/forms', \App\Http\Controllers\FormController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
