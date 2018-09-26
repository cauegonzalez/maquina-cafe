<?php

namespace CFG\Interfaces;

interface IServiceHistoricoCafe
{
    public function list();

    public function save();

    public function update();

    public function delete(int $idhistoricoCafe);

    public function verificaPermissaoEspecial($funcionarioId, $tipoCafeId);

}