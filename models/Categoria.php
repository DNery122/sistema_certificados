<?php
class Categoria extends conectar
{

    public function insert_categoria($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_categoria (nombre,fecha_registro,estado) VALUES (?,now(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $categoria['nombre'], PDO::PARAM_STR);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_categoria($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_categoria SET nombre = ? WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $categoria['nombre'], PDO::PARAM_STR);
        $sql->bindValue(2, $categoria['id'], PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_categoria($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_categoria SET estado = 0 WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $categoria, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_categorias()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_categoria WHERE estado = 1 ORDER BY id DESC";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_categoriaID($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_categoria WHERE estado = 1 AND id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $categoria, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
