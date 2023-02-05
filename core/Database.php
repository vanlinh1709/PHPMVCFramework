<?php

namespace app\core;

class Database
{
    public \PDO $pdo;//khai bao
    public function __construct(array $config)
    {
        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];
        //connect database
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations() {
        $this->createMigrationsTable();
        //xac dinh duoc nhung file nao la can apply
        $this->getAppliedMigrations();
        $files = scandir('C:\xampp\htdocs\PHPMVCFramework\migrations');
        echo '<pre>';
        var_dump($files);
        echo '</pre>';
        exit();
    }
    protected function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }
    public function  appliedMigrations() {
      //return nhung file migrations da duoc up len database
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
}