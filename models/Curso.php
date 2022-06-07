<?php
class Curso extends conectar
{

    public function insert_curso($curso)
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

    public function update_curso($curso)
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

    public function delete_curso($curso)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_curso SET estado = 0 WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_cursos()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                    tc.* , 
                    tc2.nombre AS nombre_categoria,
                    ti.nombre AS nombre_instructor,
                    ti.ap_paterno AS paterno_instructor,
                    ti.ap_materno AS materno_instructor,
                    ti.correo AS correo_instructor,
                    ti.sexo AS sexo_instructor,
                    ti.telefono AS telefono_instructor
                FROM tm_curso tc
                    INNER JOIN tm_categoria tc2 ON tc.categoria_id = tc2.id
                    INNER JOIN tm_instructor ti ON tc.instructor_id = ti.id
                WHERE tc.estado = 1
                ORDER BY tc.id DESC";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_cursoID($curso)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_curso WHERE estado = 1 AND id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_curso_usuario($curso_id, $usuario_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO td_curso_usuario
                (curso_id, usuario_id, fecha_registro,estado)
                VALUES
                (?,?,now(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso_id, PDO::PARAM_INT);
        $sql->bindValue(2, $usuario_id, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
