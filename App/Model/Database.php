<?php
namespace App\Model;
use Symfony\Component\Yaml\Yaml;
use \PDO;

class Database {
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $dbHost;
    private $dbPort;
    private $dbDriver;

    private $pdo;
    private static $_instance;

    private function __construct() {
        $config = Yaml::parse(file_get_contents(__DIR__ . '/../Config/database.yml'));
        $dbConfig = $config['database'];
        foreach ($dbConfig as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
        $this->getPDO();
    }

    public static function getInstance() {

        if(is_null(self::$_instance)) {
            self::$_instance = new Database();
        }

        return self::$_instance;
    }


    private function getPDO() {
        if (is_null($this->pdo)) {
            $dsn = $this->dbDriver . ':dbname=' . $this->dbName . ';host=' . $this->dbHost . ';port=' . $this->dbPort;
            $pdo = new PDO($dsn, $this->dbUser, $this->dbPassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
    }

    public function query($statement) {
        $request = $this->pdo->query($statement);
        $datas = $request->fetchAll(PDO::FETCH_ASSOC);
        return $datas;
    }

    public function objectQuery($statement) {
        $request = $this->pdo->query($statement);
        $collection = $request->fetchAll(PDO::FETCH_OBJ, static::className);
        return $collection;
    }
}
