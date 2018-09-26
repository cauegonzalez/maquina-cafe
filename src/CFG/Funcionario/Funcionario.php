<?php

namespace CFG\Funcionario;

use CFG\Interfaces\IFuncionario;

/**
 *
 */
class Funcionario implements IFuncionario
{
    private $id;
    private $nome;
    private $cargoId;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

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
    public function getCargoId()
    {
        return $this->cargoId;
    }

    /**
     * @param mixed $cargoId
     *
     * @return self
     */
    public function setCargoId($cargoId)
    {
        $this->cargoId = $cargoId;

        return $this;
    }

}