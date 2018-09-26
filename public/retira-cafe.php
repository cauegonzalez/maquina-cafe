<?php
    ob_start();
    require_once '../vendor/autoload.php';
    require_once 'config.php';
    require_once 'service.php';

    $historicoCafe    = $container['historicoCafe'];
    $objResposta = new stdClass();

    if (isset($_GET['idfuncionario']) && isset($_GET['tipoCafe']))
    {
        if ($container['ServiceHistoricoCafe']->verificaPermissaoEspecial($_GET['idfuncionario'], $_GET['tipoCafe']))
        {
            $datetime = (new \DateTime())->format('Y-m-d H:i:s');

            $historicoCafe->setFuncionarioId($_GET['idfuncionario'])
                          ->setTipoCafeId($_GET['tipoCafe'])
                          ->setDataHora($datetime);
            $container['ServiceHistoricoCafe']->save();
            $objResposta->permissaoNegada = false;
            $objResposta->msg = "Retirada de café realizada com sucesso";
        }
        else
        {
            $objResposta->permissaoNegada = true;
            $objResposta->msg = "Este usuário não possui permissão para retirar este tipo de café.";
        }
    }
    $objResposta->trace = ob_get_contents();
    ob_end_clean();

    echo json_encode($objResposta);