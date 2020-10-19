<?php

    class Database {

        private $driver = '__database_driver__';
        private $host = '__host__';
        private $user = '__username__';
        private $pass = '__password__';
        private $name = '__database__';
        private $char = '__database_char__';

        private $dbh;
        private $stmt;

        public function __construct() {

            $dsn = $this->driver . ':host=' . $this->host . ';dbname=' . $this->name . ';charset=' . $this->char;
            $options = array(
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true
            );

            try {

                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);

            } catch(PDOException $e) {
                $error = "Database connection error: " . $e->getCode();
                die($error);
            }

        }
        // Return associative array or other data type based on given fetchMode
        public function querySingle(string $sql, $fetchMode = NULL) {
            if(is_null($fetchMode)) return $this->dbh->query($sql)->fetch(); 

            return $this->dbh->query($sql)->fetch($fetchMode);
            
        }
        // Return object based on given class
        public function queryObject(string $sql, string $class) {
            return $this->dbh->query($sql)->fetchObject($class);
        }
        // Return associative array, or other data type based on fetchMode, or object based on given class
        public function queryAll(string $sql, $fetchMode = NULL, string $class = '') {
            if(is_null($fetchMode)) return $this->dbh->query($sql)->fetchAll();

            if(empty($class)) return $this->dbh->query($sql)->fetchAll($fetchMode);

            return $this->dbh->query($sql)->fetchAll($fetchMode, $class);
        }

        public function prepare(string $sql) {
            $this->stmt = $this->dbh->prepare($sql);
        }

        public function execute($data = NULL) {
            return $this->stmt->execute($data);
        }
        // Return associative array or other data type based on given fetchMode
        public function single($fetchMode = NULL) {
            return is_null($fetchMode) ? $this->stmt->fetch() : $this->stmt->fetch($fetchMode); 
        }
        // Return object based on given class
        public function object(string $class) {
            return $this->stmt->fetchObject($class);
        }
        // Return associative array, or other data type based on fetchMode, or object based on given class
        public function all($fetchMode = NULL, string $class = '') {
            if(is_null($fetchMode)) return $this->stmt->fetchAll();

            return empty($class) ? $this->stmt->fetchAll($fetchMode) : $this->stmt->fetchAll($fetchMode, $class); 
        }
        // Based on value type assign PDO PARAM
        public function bind(string $param, $value, $type = NULL) {

            switch($value) {

                case is_string($value):
                case is_float($value):
                case is_double($value):
                    $type = PDO::PARAM_STR;
                    echo "String<br>";
                    break;
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    echo "Int<br>";
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                default:
                    $type = PDO::PARAM_LOB;

            }
            $this->stmt->bindValue($param, $value, $type);

        }

        public function lastId() {
            return $this->dbh->lastInsertId();
        }

        public function rowCount() {
            return $this->stmt->rowCount();
        }

    }