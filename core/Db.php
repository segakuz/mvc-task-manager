<?php

class Db
{
    private $dbh;

    public function __construct()
    {
        try
        {
            $this->dbh = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
        }
        catch (PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    private function getDbh()
    {
        return $this->dbh;
    }

    public function execute($query, array $params=null)
    {
        $pdo = $this->getDbh();
        if (is_null($params))
        {
            $stmt = $pdo->query($query);
            return $stmt->fetchAll();
        }
        $stmt = $pdo->prepare($query);
        return $stmt->execute($params);

    }

    public function getAll($query, array $params=null, $fetchStyle = PDO::FETCH_ASSOC)
    {
        $pdo = $this->getDbh();
        if (is_null($params))
        {
            $stmt = $pdo->query($query);
            return $stmt->fetchAll($fetchStyle);
        }
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll($fetchStyle);
    }

    public function getOne($query, array $params=null)
    {
        $pdo = $this->getDbh();
        if (is_null($params))
        {
            $stmt = $pdo->query($query);
            $result = $stmt->fetch(PDO::FETCH_NUM);
            return $result[0];
        }
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_NUM);
        return $result[0];
    }
}