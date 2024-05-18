<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');


Route::get('/formas_de_pagamento/', [App\Http\Controllers\FormaPagamentoController::class, 'index'])->name('formasdepagamento.index')->middleware('auth');
Route::post('/forma_de_pagamento/novo', [App\Http\Controllers\FormaPagamentoController::class, 'store'])->name('formadepagamento.store')->middleware('auth');
Route::get('/forma_de_pagamento/editar/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'edit'])->name('formadepagamento.edit')->middleware('auth');
Route::put('/forma_de_pagamento/editar/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'update'])->name('formadepagamento.update')->middleware('auth');
Route::get('/forma_de_pagamento/excluir/{id}', [App\Http\Controllers\FormaPagamentoController::class, 'destroy'])->name('formadepagamento.excluir')->middleware('auth');


Route::get('/grupos/', [App\Http\Controllers\GruposController::class, 'index'])->name('grupos.index')->middleware('auth');

Route::post('/grupo/novo', [App\Http\Controllers\GruposController::class, 'store'])->name('grupo.store')->middleware('auth');
Route::get('/grupo/editar/{id}', [App\Http\Controllers\GruposController::class, 'edit'])->name('grupo.edit')->middleware('auth');
Route::put('/grupo/editar/{id}', [App\Http\Controllers\GruposController::class, 'update'])->name('grupo.update')->middleware('auth');
Route::get('/grupo/excluir/{id}', [App\Http\Controllers\GruposController::class, 'destroy'])->name('grupo.excluir')->middleware('auth');

Route::get('/subgrupos/', [App\Http\Controllers\SubgruposController::class, 'index'])->name('subgrupos.index')->middleware('auth');
Route::post('/subgrupo/novo', [App\Http\Controllers\SubgruposController::class, 'store'])->name('subgrupo.store')->middleware('auth');
Route::get('/subgrupo/editar/{id}', [App\Http\Controllers\SubgruposController::class, 'edit'])->name('subgrupo.edit')->middleware('auth');
Route::put('/subgrupo/editar/{id}', [App\Http\Controllers\SubgruposController::class, 'update'])->name('subgrupo.update')->middleware('auth');
Route::get('/subgrupo/excluir/{id}', [App\Http\Controllers\SubgruposController::class, 'destroy'])->name('subgrupo.excluir')->middleware('auth');


Route::get('/lancamentos/{tipo}', [App\Http\Controllers\LancamentoController::class, 'index'])->name('lancamentos.index')->middleware('auth');
Route::post('/lancamentos/{tipo}', [App\Http\Controllers\LancamentoController::class, 'index'])->name('lancamentos.filtros')->middleware('auth');
Route::post('/lancamento/novo', [App\Http\Controllers\LancamentoController::class, 'store'])->name('lancamento.store')->middleware('auth');
Route::get('/lancamento/editar/{id}', [App\Http\Controllers\LancamentoController::class, 'edit'])->name('lancamento.edit')->middleware('auth');
Route::put('/lancamento/editar/{id}', [App\Http\Controllers\LancamentoController::class, 'update'])->name('lancamento.update')->middleware('auth');
Route::get('/lancamento/excluir/{id}', [App\Http\Controllers\LancamentoController::class, 'destroy'])->name('lancamento.excluir')->middleware('auth');
Route::get('/lancamento/gerar/{id}', [App\Http\Controllers\LancamentoController::class, 'gerar'])->name('lancamento.gerar')->middleware('auth');
Route::get('/lancamento/baixar/{id}/{pago}', [App\Http\Controllers\LancamentoController::class, 'baixar'])->name('lancamento.baixar')->middleware('auth');
Route::get('/lancamentos/relatorio/agrupado/{tipo}', [App\Http\Controllers\LancamentoController::class, 'grupo'])->name('lancamentos.grupo')->middleware('auth');

Route::get('/lancamentos/saida/rapida', [App\Http\Controllers\LancamentoController::class, 'rapida'])->name('lancamentos.rapida')->middleware('auth');

Route::get('/itemLancamento/excluir/{id}', [App\Http\Controllers\ItemLancamentoController::class, 'destroy'])->name('itemLancamento.excluir')->middleware('auth');
Route::put('/itemLancamento/editar/{id}', [App\Http\Controllers\ItemLancamentoController::class, 'update'])->name('itemLancamento.update')->middleware('auth');
Route::get('/itemLancamento/add/{id}', [App\Http\Controllers\ItemLancamentoController::class, 'adicionar'])->name('itemLancamento.add')->middleware('auth');