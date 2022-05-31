<?php

session_start();

class conectar
{
    protected $dbh;

    protected function conexion()
    {
        try {
            $conectar = $this->dbh = new PDO('mysql:host=localhost;port=3307;dbname=diplomas', 'root', 'admin');
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD! " . $e->getMessage() . '<br/>';
            die();
        }
    }

    // Para impedir tener problemas con las tildes o ñ
    public function set_names()
    {
        return $this->dbh->query('SET NAMES "utf8"');
    }

    public static function ruta()
    {
        return "http://localhost/cursos/Certificados/";
    }
}
