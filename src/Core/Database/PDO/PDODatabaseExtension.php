<?php

namespace App\Core\Database\PDO;

use PDO;

class PDODatabaseExtension
{
    public PDO $pdo;

    private $stmt;

    public function __construct()
    {
        $this->pdo = PDODatabaseConnection::getInstance()->getConnection();
    }

    public function prepare(string $statement): static
    {
        $this->stmt = $this->pdo->prepare($statement);
        return $this;
    }

    public function bind(array $params): static
    {
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $this->stmt->bindValue(":{$param}", $value);
            }
        }
        return $this;
    }

    public function execute(): void
    {
        try {
            $this->stmt->execute();
        } catch (\PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function fetchAll(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}