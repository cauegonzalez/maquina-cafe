<?php

namespace CFG\Interfaces;

interface IFuncionario
{
    public function getId();
    public function setId($id);
    public function getNome();
    public function setNome($nome);
    public function getCargoId();
    public function setCargoId($cargoId);
}