<?php

namespace CFG\Interfaces;

interface IHistoricoCafe
{
    public function getIdhistoricoCafe();
    public function setIdhistoricoCafe($idhistoricoCafe);
    public function getFuncionarioId();
    public function setFuncionarioId($funcionarioId);
    public function getTipoCafeId();
    public function setTipoCafeId($tipoCafeId);
    public function getDataHora();
    public function setDataHora($dataHora);
}