<?php
class Categoria extends conectar
{

    public function insert_categoria($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_curso
                (categoria_id,instructor_id,nombre,descripcion,fecha_inicio,fecha_fin,fecha_registro,estado)
                VALUES
                (?,?,?,?,?,?,now(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso['categoria_id'], PDO::PARAM_INT);
        $sql->bindValue(2, $curso['instructor_id'], PDO::PARAM_INT);
        $sql->bindValue(3, $curso['nombre'], PDO::PARAM_STR);
        $sql->bindValue(4, $curso['descripcion'], PDO::PARAM_STR);
        $sql->bindValue(5, $curso['fecha_inicio'], PDO::PARAM_STR);
        $sql->bindValue(6, $curso['fecha_fin'], PDO::PARAM_STR);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_categoria($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_curso
                SET
                    categoria_id = ?,
                    instructor_id = ?,
                    nombre = ?,
                    descripcion = ?,
                    fecha_inicio = ?,
                    fecha_fin = ?
                WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso['categoria_id'], PDO::PARAM_INT);
        $sql->bindValue(2, $curso['instructor_id'], PDO::PARAM_INT);
        $sql->bindValue(3, $curso['nombre'], PDO::PARAM_STR);
        $sql->bindValue(4, $curso['descripcion'], PDO::PARAM_STR);
        $sql->bindValue(5, $curso['fecha_inicio'], PDO::PARAM_STR);
        $sql->bindValue(6, $curso['fecha_fin'], PDO::PARAM_STR);
        $sql->bindValue(7, $curso['id'], PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_categoria($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_curso SET estado = 0 WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_categorias()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_categoria WHERE estado = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_categoriaID($categoria)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_curso WHERE estado = 1 AND id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $categoria, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}