<?php

/*
// DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Création de la connexion PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Exécution d'une requête
    $stmt = $pdo->query('SELECT * FROM nom_de_table');

    // Récupération des résultats
    while ($row = $stmt->fetch()) {
        echo $row['colonne1'] . "\n"; // Remplacez 'colonne1' par le nom d'une colonne de votre table
    }
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
*/

require 'vendor/autoload.php';
use Dotenv\Dotenv;
use \PDO;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
define("DOMAIN",$_ENV['domain_url']);

class MonPDO {
    
    protected static $host; // Adresse du serveur
    protected static $db; // Nom de la base de données
    protected static $user; // Nom d'utilisateur
    protected static $pass; // Mot de passe
    protected static $charset; // Jeu de caractères*/

    public static function init() {
        self::$host = $_ENV['MYSQL_HOST'];
        self::$db = $_ENV['MYSQL_DB'];
        self::$user = $_ENV['MYSQL_USER'];
        self::$pass = $_ENV['MYSQL_PW'];
        self::$charset = "UTF8";
    }

    public static function getPDO(){
        try {
            $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$db.";charset=".self::$charset,self::$user,self::$pass);
        } catch (\PDOException $e){
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;
    }
}

MonPDO::init();
?>