<?php
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $twig = $container['Twig_Environment'];

    $message = "";
    $arrayFuncionario = [];
    $arrayCargos = [];

    $render = "tabela.twig";
    if (!isset($_GET['pagina']) || ((isset($_GET['pagina']) && $_GET['pagina'] == 'tabela')))
    {
        $arrayFuncionario = $container['ServiceFuncionario']->list();
    }
    else
    {
        if (isset($_GET['id']))
        {
            $arrayFuncionario = $container['ServiceFuncionario']->find($_GET['id']);
        }

        if ($_GET['pagina'] == 'form')
        {
            $render = 'form.twig';
            $arrayCargos = $container['ServiceCargo']->list();
        }
        else if ($_GET['pagina'] == 'perfil')
        {
            $render = 'perfil.twig';
        }
        else if ($_GET['pagina'] == 'delete')
        {
            if (isset($_GET['id']))
            {
                $apagou = $container['ServiceFuncionario']->delete($_GET['id']);
            }
            if ($apagou)
            {
                $message = "Registro excluído com sucesso!";
            }
            $arrayFuncionario = $container['ServiceFuncionario']->list();
        }
    }

    $template = ['objFuncionario' => $arrayFuncionario,
                 'cargos'         => $arrayCargos,
                 'mensagem'       => $message];

    echo $twig->render($render, compact('template'));