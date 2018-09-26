<?php
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $twig = $container['Twig_Environment'];

    $message = "";
    $arrayHistoricoCafe = [];
    $arrayCargos = [];

    $arrayHistoricoCafe = $container['ServiceHistoricoCafe']->list();

    $template = ['objHistoricoCafe' => $arrayHistoricoCafe,
                 'mensagem'         => $message];

    echo $twig->render("relatorio.twig", compact('template'));