<?php

namespace CFG\HistoricoCafe;

use CFG\Interfaces\IHistoricoCafe;

/**
 *
 */
class HistoricoCafe implements IHistoricoCafe
{
    private $idhistoricoCafe;
    private $funcionarioId;
    private $tipoCafeId;
    private $dataHora;

    /**
     * @return mixed
     */
    public function getIdhistoricoCafe()
    {
        return $this->idhistoricoCafe;
    }

    /**
     * @param mixed $idhistoricoCafe
     *
     * @return self
     */
    public function setIdhistoricoCafe($idhistoricoCafe)
    {
        $this->idhistoricoCafe = $idhistoricoCafe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFuncionarioId()
    {
        return $this->funcionarioId;
    }

    /**
     * @param mixed $funcionarioId
     *
     * @return self
     */
    public function setFuncionarioId($funcionarioId)
    {
        $this->funcionarioId = $funcionarioId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoCafeId()
    {
        return $this->tipoCafeId;
    }

    /**
     * @param mixed $tipoCafeId
     *
     * @return self
     */
    public function setTipoCafeId($tipoCafeId)
    {
        $this->tipoCafeId = $tipoCafeId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * @param mixed $dataHora
     *
     * @return self
     */
    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;

        return $this;
    }
}