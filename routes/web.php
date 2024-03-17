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
Route::get('/formas_de_pagamento', [App\Http\Controllers\FormaPagamentoController::class, 'index'])->name('formasdepagamento.index');
Route::post('/forma_de_pagamento/novo', [App\Http\Controllers\FormaPagamentoController::class, 'store'])->name('formadepagamento.store');
Route::get('/forma_de_pagamento/excluir/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'destroy'])->name('formadepagamento.excluir');