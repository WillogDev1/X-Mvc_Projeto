<?php
namespace App\Model\Database;

class Database
{
    public static function conectaDB()
    {
        /* Chama envGloval para variáveis .env */
        require_once __DIR__ . '/../../../config-env.php';

        /* Declara variáveis .env */
        $db_host = $_ENV['DB_HOST'];
        $db_user = $_ENV['DB_USER'];
        $db_pass = $_ENV['DB_PASSWORD'];
        $db_name = $_ENV['DB_NAME'];

        /* Tenta a conexão com o banco de dados */
        try {
            /* Retorna uma nova instância da conexão PDO com os dados fornecidos */
            return new \PDO('mysql:host=' . $db_host . ';dbname=' . $db_name, $db_user, $db_pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
            /* Trata o erro */
        } catch (\PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            return null; // Retorna nulo em caso de falha na conexão
        }
    }
}