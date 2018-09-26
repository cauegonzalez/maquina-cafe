<?php

namespace CFG\Funcionario;

use CFG\Interfaces\IConnection;
use CFG\Interfaces\IServiceFuncionario;
use CFG\Interfaces\IFuncionario;

class ServiceFuncionario implements IServiceFuncionario
{
    private $db;
    private $funcionario;

    public function __construct(IConnection $connection, IFuncionario $funcionario)
    {
        $this->db = $connection->connect();
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->funcionario = $funcionario;
    }

    public function list()
    {
        $sql = "SELECT f.idfuncionario,
                       f.nome,
                       f.cargo_id as cargoId,
                       c.nome as cargo
                  FROM funcionario f
            INNER JOIN cargo c
                    ON c.idcargo = f.cargo_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($idfuncionario)
    {
        $sql = "SELECT f.idfuncionario,
                       f.nome,
                       f.cargo_id as cargoId,
                       c.nome as cargo
                  FROM funcionario f
            INNER JOIN cargo c
                    ON c.idcargo = f.cargo_id
                 WHERE idfuncionario = :idfuncionario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idfuncionario', $idfuncionario);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function save()
    {
        try
        {
            $sql = "INSERT
                      INTO funcionario
                           (nome,
                            cargo_id)
                    VALUES (:nome,
                            :cargo_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $this->funcionario->getNome());
            $stmt->bindValue(':cargo_id', $this->funcionario->getCargoId());

            $stmt->execute();
        }
        catch (PDOException $e)
        {
            throw new Exception("Error Processing Request. ".$e->getMessage(), 1);
        }

        return $this->db->lastInsertId();
    }

    public function update()
    {
        $sql = "UPDATE funcionario
                   SET nome = :nome,
                       cargo_id = :cargo_id
                 WHERE idfuncionario = :idfuncionario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idfuncionario', $this->funcionario->getId());
        $stmt->bindValue(':nome', $this->funcionario->getNome());
        $stmt->bindValue(':cargo_id', $this->funcionario->getCargoId());

        $return = $stmt->execute();

        return $return;
    }

    public function delete(int $idfuncionario)
    {
        $sql = "DELETE
                  FROM funcionario
                 WHERE idfuncionario = :idfuncionario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idfuncionario', $idfuncionario);
        $return = $stmt->execute();

        return $return;
    }
}