<?php
class Instructor extends conectar
{

    public function insert_instructor($instructor)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_instructor
                (nombre,ap_paterno,ap_materno,correo,sexo,telefono,fecha_registro,estado)
                VALUES
                (?,?,?,?,?,?,now(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $instructor['nombre'], PDO::PARAM_STR);
        $sql->bindValue(2, $instructor['ap_paterno'], PDO::PARAM_STR);
        $sql->bindValue(3, $instructor['ap_materno'], PDO::PARAM_STR);
        $sql->bindValue(4, $instructor['correo'], PDO::PARAM_STR);
        $sql->bindValue(5, $instructor['sexo'], PDO::PARAM_STR);
        $sql->bindValue(6, $instructor['telefono'], PDO::PARAM_STR);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_instructor($instructor)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_instructor
                SET
                    nombre = ?,
                    ap_paterno = ?,
                    ap_materno = ?,
                    correo = ?,
                    sexo = ?,
                    telefono = ?
                WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $instructor['nombre'], PDO::PARAM_STR);
        $sql->bindValue(2, $instructor['ap_paterno'], PDO::PARAM_STR);
        $sql->bindValue(3, $instructor['ap_materno'], PDO::PARAM_STR);
        $sql->bindValue(4, $instructor['correo'], PDO::PARAM_STR);
        $sql->bindValue(5, $instructor['sexo'], PDO::PARAM_STR);
        $sql->bindValue(6, $instructor['telefono'], PDO::PARAM_STR);
        $sql->bindValue(7, $instructor['id'], PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_instructor($instructor)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_instructor SET estado = 0 WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $instructor, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_instructores()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_instructor WHERE estado = 1 ORDER BY id DESC";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_instructorID($instructor)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_instructor WHERE estado = 1 AND id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $instructor, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
