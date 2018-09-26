<?php

namespace CFG\Cargo;

use CFG\Interfaces\IConnection;
use CFG\Interfaces\IServiceCargo;
use CFG\Interfaces\ICargo;

class ServiceCargo implements IServiceCargo
{
    private $db;
    private $cargo;

    public function __construct(IConnection $connection, ICargo $cargo)
    {
        $this->db = $connection->connect();
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->cargo = $cargo;
    }

    public function list()
    {
        $sql = "SELECT c.idcargo,
                       c.nome,
                       c.permissao_especial
                  FROM cargo c";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public function find($idcargo)
    {
        $sql = "SELECT c.idcargo,
                       c.nome,
                       c.permissao_especial
                  FROM cargo c
                 WHERE idcargo = :idcargo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idcargo', $idcargo);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_OBJ);
    }

    public function save()
    {
        try
        {
            $sql = "INSERT
                      INTO cargo
                           (nome,
                            permissao_especial)
                    VALUES (:nome,
                            :permissao_especial)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $this->cargo->getNome());
            $stmt->bindValue(':permissao_especial', $this->cargo->getPermissaoEspecial());

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
        $sql = "UPDATE cargo
                   SET nome = :nome,
                       permissao_especial = :permissao_especial
                 WHERE idcargo = :idcargo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idcargo', $this->cargo->getId());
        $stmt->bindValue(':nome', $this->cargo->getNome());
        $stmt->bindValue(':permissao_especial', $this->cargo->getCargoId());

        $return = $stmt->execute();

        return $return;
    }

    public function delete(int $idcargo)
    {
        $sql = "DELETE
                  FROM cargo
                 WHERE idcargo = :idcargo";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':idcargo', $idcargo);
        $return = $stmt->execute();

        return $return;
    }
}