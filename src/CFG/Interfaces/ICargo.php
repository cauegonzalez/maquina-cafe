<?php

namespace CFG\Interfaces;

interface ICargo
{
    public function getIdcargo();
    public function setIdcargo($idcargo);
    public function getNome();
    public function setNome($nome);
    public function getPermissaoEspecial();
    public function setPermissaoEspecial($permissaoEspecial);
}