<?php

namespace CFG\HistoricoCafe;

use CFG\Interfaces\IConnection;
use CFG\Interfaces\IServiceHistoricoCafe;
use CFG\Interfaces\IHistoricoCafe;

class ServiceHistoricoCafe implements IServiceHistoricoCafe
{
    private $db;
    private $historicoCafe;

    public function __construct(IConnection $connection, IHistoricoCafe $historicoCafe)
    {
        $this->db = $connection->connect();
        $this->historicoCafe = $historicoCafe;
    }

    public function list()
    {
        $sql = "SELECT idhistorico_cafe as idhistoricoCafe,
                       hc.funcionario_id,
                       f.nome,
                       hc.tipo_cafe_id,
                       tc.nome as tipoCafe,
                       DATE_FORMAT(hc.data_hora, '%d/%m/%Y %H:%i:%s') as dataHora,
                       c.nome as cargo
                  FROM historico_cafe hc
            INNER JOIN funcionario f
                    ON f.idfuncionario = hc.funcionario_id
            INNER JOIN cargo c
                    ON c.idcargo = f.cargo_id
            INNER JOIN tipo_cafe tc
                    ON tc.idtipo_cafe = hc.tipo_cafe_id
              ORDER BY hc.data_hora";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($idfuncionario)
    {
        $sql = "SELECT idhistorico_cafe,
                       funcionario_id,
                       tipo_cafe_id,
                       data_hora
                  FROM historico_cafe
                 WHERE idfuncionario = :idfuncionario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idfuncionario', $idfuncionario);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function save()
    {
        $sql = "INSERT
                  INTO historico_cafe
                       (idhistorico_cafe,
                        funcionario_id,
                        tipo_cafe_id,
                        data_hora)
                VALUES (:idhistorico_cafe,
                        :funcionario_id,
                        :tipo_cafe_id,
                        :data_hora)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idhistorico_cafe', $this->historicoCafe->getIdhistoricoCafe());
        $stmt->bindValue(':funcionario_id', $this->historicoCafe->getFuncionarioId());
        $stmt->bindValue(':tipo_cafe_id', $this->historicoCafe->getTipoCafeId());
        $stmt->bindValue(':data_hora', $this->historicoCafe->getDataHora());

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function update()
    {
        $sql = "UPDATE historico_cafe
                   SET idhistorico_cafe = :idhistorico_cafe,
                       funcionario_id = :funcionario_id,
                       tipo_cafe_id = :tipo_cafe_id,
                       data_hora = :data_hora,
                 WHERE idfuncionario = :idfuncionario
                   AND idhistorico_cafe = :idhistorico_cafe";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idhistorico_cafe', $this->historicoCafe->getIdhistoricoCafe());
        $stmt->bindValue(':funcionario_id', $this->historicoCafe->getFuncionarioId());
        $stmt->bindValue(':tipo_cafe_id', $this->historicoCafe->getTipoCafeId());
        $stmt->bindValue(':data_hora', $this->historicoCafe->getDataHora());

        $return = $stmt->execute();

        return $return;
    }

    public function delete(int $idfuncionario)
    {
        $sql = "DELETE
                  FROM historico_cafe
                 WHERE idhistorico_cafe = :idhistorico_cafe";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idhistorico_cafe', $this->historicoCafe->getIdhistoricoCafe());
        $return = $stmt->execute();

        return $return;
    }

    public function verificaPermissaoEspecial($funcionarioId, $tipoCafeId)
    {
        $sql = "SELECT tc.exige_permissao_especial
                  FROM tipo_cafe tc
                 WHERE tc.idtipo_cafe = :idtipo_cafe";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idtipo_cafe', $tipoCafeId);
        $stmt->execute();
        $tipoCafe = $stmt->fetch(\PDO::FETCH_OBJ);

        if ($tipoCafe->exige_permissao_especial == 'N')
        {
            return true;
        }

        $sql = "SELECT c.permissao_especial
                  FROM funcionario f
            INNER JOIN cargo c
                    ON c.idcargo = f.cargo_id
                 WHERE f.idfuncionario = :idfuncionario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idfuncionario', $funcionarioId);
        $stmt->execute();

        $funcionario = $stmt->fetch(\PDO::FETCH_OBJ);

        // var_dump($funcionario);
        if ($funcionario->permissao_especial == 'S')
        {
            return true;
        }

        return false;
    }

}