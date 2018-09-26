<?php

namespace CFG\Cargo;

use CFG\Interfaces\ICargo;

/**
 *
 */
class Cargo implements ICargo
{
    private $idcargo;
    private $nome;
    private $permissaoEspecial;

    /**
     * @return mixed
     */
    public function getIdcargo()
    {
        return $this->idcargo;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setIdcargo($idcargo)
    {
        $this->idcargo = $idcargo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPermissaoEspecial()
    {
        return $this->permissaoEspecial;
    }

    /**
     * @param mixed $permissaoEspecial
     *
     * @return self
     */
    public function setPermissaoEspecial($permissaoEspecial)
    {
        $this->permissaoEspecial = $permissaoEspecial;

        return $this;
    }

}