<?php
// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('formaPagamento', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Formas de pagamento', route('formasdepagamento.index'));
});

Breadcrumbs::for('formaPagamento.editar', function (BreadcrumbTrail $trail, $name) {
    $trail->parent('formaPagamento');
    $trail->push('Editar: ' . $name, route('formadepagamento.edit',$name));
});

Breadcrumbs::for('lancamentos', function (BreadcrumbTrail $trail, $name) {
    $trail->parent('home');
    $trail->push('Lançamentos: ' . $name, route('lancamentos.index',$name));
});

Breadcrumbs::for('lancamentos.editar', function (BreadcrumbTrail $trail, $name, $nameLanc) {
    $trail->parent('lancamentos',$nameLanc);
    $trail->push('Editar: ' . $name, route('lancamento.edit',$name));
});

Breadcrumbs::for('saidaRapida', function (BreadcrumbTrail $trail,$nameLanc) {
    $trail->parent('lancamentos',$nameLanc);
    $trail->push('Saída Rapída', route('lancamentos.rapida'));
});
