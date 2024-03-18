<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();
Route::get('/formas_de_pagamento/', [App\Http\Controllers\FormaPagamentoController::class, 'index'])->name('formasdepagamento.index');
Route::post('/forma_de_pagamento/novo', [App\Http\Controllers\FormaPagamentoController::class, 'store'])->name('formadepagamento.store');
Route::get('/forma_de_pagamento/editar/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'edit'])->name('formadepagamento.edit');
Route::put('/forma_de_pagamento/editar/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'update'])->name('formadepagamento.update');
Route::get('/forma_de_pagamento/excluir/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'destroy'])->name('formadepagamento.excluir');

Route::get('/grupos/', [App\Http\Controllers\GruposController::class, 'index'])->name('grupos.index');
Route::post('/grupo/novo', [App\Http\Controllers\GruposController::class, 'store'])->name('grupo.store');
Route::get('/grupo/editar/{id}', [App\Http\Controllers\GruposController::class, 'edit'])->name('grupo.edit');
Route::put('/grupo/editar/{id}', [App\Http\Controllers\GruposController::class, 'update'])->name('grupo.update');
Route::get('/grupo/excluir/{id}', [App\Http\Controllers\GruposController::class, 'destroy'])->name('grupo.excluir');

Route::get('/subgrupos/', [App\Http\Controllers\SubgruposController::class, 'index'])->name('subgrupos.index');
Route::post('/subgrupo/novo', [App\Http\Controllers\SubgruposController::class, 'store'])->name('subgrupo.store');
Route::get('/subgrupo/editar/{id}', [App\Http\Controllers\SubgruposController::class, 'edit'])->name('subgrupo.edit');
Route::put('/subgrupo/editar/{id}', [App\Http\Controllers\SubgruposController::class, 'update'])->name('subgrupo.update');
Route::get('/subgrupo/excluir/{id}', [App\Http\Controllers\SubgruposController::class, 'destroy'])->name('subgrupo.excluir');