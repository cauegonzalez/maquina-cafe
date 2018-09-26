<?php

use CFG\Database\Connection;
use CFG\Funcionario\ServiceFuncionario;
use CFG\Funcionario\Funcionario;
use CFG\HistoricoCafe\ServiceHistoricoCafe;
use CFG\HistoricoCafe\HistoricoCafe;
use CFG\Cargo\ServiceCargo;
use CFG\Cargo\Cargo;

$container['connection'] = function ($c) {
    return new Connection($c['dsn'], $c['user'], $c['password']);
};

$container['funcionario'] = function () {
    return new Funcionario;
};

$container['historicoCafe'] = function () {
    return new HistoricoCafe;
};

$container['cargo'] = function () {
    return new Cargo;
};

$container['ServiceFuncionario'] = function ($c) {
    return new ServiceFuncionario($c['connection'], $c['funcionario']);
};

$container['ServiceHistoricoCafe'] = function ($c) {
    return new ServiceHistoricoCafe($c['connection'], $c['historicoCafe']);
};

$container['ServiceCargo'] = function ($c) {
    return new ServiceCargo($c['connection'], $c['cargo']);
};

$container['Twig_Environment'] = function(){
    $loader = new Twig_Loader_Filesystem('./templates/');
    $twig = new Twig_Environment($loader, [
        'debug' => true
    ]);
    return $twig;
};