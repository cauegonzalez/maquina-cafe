<?php
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $twig           = $container['Twig_Environment'];

    $funcionario    = $container['funcionario'];

    $funcionario->setNome($_POST['nome'])
                ->setCargoId($_POST['idcargo']);

    if (isset($_POST['idfuncionario']) && $_POST['idfuncionario'] != '')
    {
        $insertedId = $_POST['idfuncionario'];
        $funcionario->setId($_POST['idfuncionario']);
        $container['ServiceFuncionario']->update();
    }
    else
    {
        $insertedId = $container['ServiceFuncionario']->save();
    }

    $objFuncionario = $container['ServiceFuncionario']->find($insertedId);

    $template = ['objFuncionario'     => $objFuncionario,
                 'ordem'            => 'asc'];

    $render = 'perfil.twig';

    echo $twig->render($render, compact('template'));