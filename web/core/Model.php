<?php

class Model
{
    /**
     * @var object
     */
    protected $conn;

    /**
     * Inicializa conexion
     */
    public function __construct()
    {
        global $MODEL;

        $this->conn = new mysqli(
            $MODEL->HOST,
            $MODEL->USER,
            $MODEL->PASSWORD,
            $MODEL->DB_NAME
        );
        if ($this->conn->connect_error) {
            echo "ERROR: Connection failed" . $this->conn->connect_error;
        }
    }

    /**
     * Finaliza conexion
     */
    public function __destruct()
    {
        $this->conn->close();
    }

    public static function getInstance($modelName)
    {
        //if file exist?
        $m = null;
        $className = $modelName . "Model";
        require_once("Models/" . $className . ".php");
        if (class_exists($className)) {
            //echo "LOAD Model";

            $m = new $className();
        } else {
            // new View("404", "Controlador no trobat")->render();
            //echo "Controlador no trobat";
        }
        return $m;
    }
}
