<?php

class Usuario extends conectar
{

    public function login()
    {
        $conectar = parent::conexion();
        parent::set_names();

        if (isset($_POST['enviar'])) {

            $correo = $_POST['correo'];
            $pass = $_POST['pass'];

            if (empty($correo) and empty($pass)) {
                header('Location:' . conectar::ruta() . 'index.php?m=2');
                exit();
            } else {
                $sql = "SELECT * FROM tm_usuario WHERE correo=? and pass=? and estado=1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->bindValue(2, $pass);
                $stmt->execute();
                $resultado = $stmt->fetch();
                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION['id'] = $resultado['id'];
                    $_SESSION['nombre'] = $resultado['nombre'];
                    $_SESSION['ap_paterno'] = $resultado['ap_paterno'];
                    $_SESSION['ap_materno'] = $resultado['ap_materno'];
                    $_SESSION['correo'] = $resultado['correo'];
                    $_SESSION['rol_id'] = $resultado['rol_id'];
                    header('Location:' . conectar::ruta() . 'view/UserHome');
                    exit();
                } else {
                    header('Location:' . conectar::ruta() . 'index.php?m=1');
                    exit();
                }
            }
        }
    }

    public function getCursosUsuario($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
                    tcu.id,
                    tc.id AS id_curso,
                    tc.nombre AS nombre_curso,
                    tc.descripcion AS descripcion_curso,
                    tc.fecha_inicio AS fecha_inicio_curso,
                    tc.fecha_fin AS fecha_fin_curso,
                    tu.id AS id_usuario,
                    tu.nombre AS nombre_usuario,
                    tu.ap_paterno AS paterno_usuario,
                    tu.ap_materno AS materno_usuario,
                    ti.id AS id_instructor,
                    ti.nombre AS nombre_instructor,
                    ti.ap_paterno AS paterno_instructor,
                    ti.ap_materno AS materno_instructor 
                FROM td_curso_usuario tcu
                    inner join tm_curso tc on tcu.curso_id = tc.id 
                    inner join tm_usuario tu on tcu.usuario_id = tu.id
                    inner join tm_instructor ti on tc.instructor_id = ti.id
                WHERE tcu.usuario_id = ?
                    AND tcu.estado = 1";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function getCursoID($curso)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
                    tcu.id,
                    tc.id AS id_curso,
                    tc.nombre AS nombre_curso,
                    tc.descripcion AS descripcion_curso,
                    tc.fecha_inicio AS fecha_inicio_curso,
                    tc.fecha_fin AS fecha_fin_curso,
                    tu.id AS id_usuario,
                    tu.nombre AS nombre_usuario,
                    tu.ap_paterno AS paterno_usuario,
                    tu.ap_materno AS materno_usuario,
                    ti.id AS id_instructor,
                    ti.nombre AS nombre_instructor,
                    ti.ap_paterno AS paterno_instructor,
                    ti.ap_materno AS materno_instructor 
                FROM td_curso_usuario tcu
                    inner join tm_curso tc on tcu.curso_id = tc.id 
                    inner join tm_usuario tu on tcu.usuario_id = tu.id
                    inner join tm_instructor ti on tc.instructor_id = ti.id
                WHERE tcu.id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function getTotalCursosUsuario($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) AS total_cursos FROM td_curso_usuario tcu WHERE tcu.usuario_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function getCursosUsuarioLimit($user, $limit)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
                    tcu.id,
                    tc.id AS id_curso,
                    tc.nombre AS nombre_curso,
                    tc.descripcion AS descripcion_curso,
                    tc.fecha_inicio AS fecha_inicio_curso,
                    tc.fecha_fin AS fecha_fin_curso,
                    tu.id AS id_usuario,
                    tu.nombre AS nombre_usuario,
                    tu.ap_paterno AS paterno_usuario,
                    tu.ap_materno AS materno_usuario,
                    ti.id AS id_instructor,
                    ti.nombre AS nombre_instructor,
                    ti.ap_paterno AS paterno_instructor,
                    ti.ap_materno AS materno_instructor 
                FROM td_curso_usuario tcu
                    inner join tm_curso tc on tcu.curso_id = tc.id 
                    inner join tm_usuario tu on tcu.usuario_id = tu.id
                    inner join tm_instructor ti on tc.instructor_id = ti.id
                WHERE tcu.usuario_id = ? 
                    AND tcu.estado = 1
                LIMIT ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user);
        $sql->bindValue(2, $limit, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function getusuario($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario WHERE estado = 1 AND id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function getUsuarios()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario WHERE estado = 1 ORDER BY id DESC";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function updateUsuario($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    nombre = ?,
                    ap_paterno = ?,
                    ap_materno = ?,
                    pass = ?,
                    sexo = ?,
                    telefono = ?
                WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user['nombre'], PDO::PARAM_STR);
        $sql->bindValue(2, $user['paterno'], PDO::PARAM_STR);
        $sql->bindValue(3, $user['materno'], PDO::PARAM_STR);
        $sql->bindValue(4, $user['pass'], PDO::PARAM_STR);
        $sql->bindValue(5, $user['sexo'], PDO::PARAM_STR);
        $sql->bindValue(6, $user['telefono'], PDO::PARAM_STR);
        $sql->bindValue(7, $user['id'], PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_usuario_admin($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario SET estado = 0 WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function insert_usuario_admin($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_usuario
                (nombre,ap_paterno,ap_materno,correo,pass,sexo,telefono,rol_id,fecha_registro,estado)
                VALUES
                (?,?,?,?,?,?,?,1,now(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user['nombre'], PDO::PARAM_STR);
        $sql->bindValue(2, $user['ap_paterno'], PDO::PARAM_STR);
        $sql->bindValue(3, $user['ap_materno'], PDO::PARAM_STR);
        $sql->bindValue(4, $user['correo'], PDO::PARAM_STR);
        $sql->bindValue(5, $user['pass'], PDO::PARAM_STR);
        $sql->bindValue(6, $user['sexo'], PDO::PARAM_STR);
        $sql->bindValue(7, $user['telefono'], PDO::PARAM_STR);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_usuario_admin($user)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    nombre = ?,
                    ap_paterno = ?,
                    ap_materno = ?,
                    correo = ?,
                    pass = ?,
                    sexo = ?,
                    telefono = ?
                WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user['nombre'], PDO::PARAM_STR);
        $sql->bindValue(2, $user['ap_paterno'], PDO::PARAM_STR);
        $sql->bindValue(3, $user['ap_materno'], PDO::PARAM_STR);
        $sql->bindValue(4, $user['correo'], PDO::PARAM_STR);
        $sql->bindValue(5, $user['pass'], PDO::PARAM_STR);
        $sql->bindValue(6, $user['sexo'], PDO::PARAM_STR);
        $sql->bindValue(7, $user['telefono'], PDO::PARAM_STR);
        $sql->bindValue(8, $user['id'], PDO::PARAM_STR);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_usuarios_curso($curso)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
                    tcu.id,
                    tc.id AS id_curso,
                    tc.nombre AS nombre_curso,
                    tc.descripcion AS descripcion_curso,
                    tc.fecha_inicio AS fecha_inicio_curso,
                    tc.fecha_fin AS fecha_fin_curso,
                    tu.id AS id_usuario,
                    tu.nombre AS nombre_usuario,
                    tu.ap_paterno AS paterno_usuario,
                    tu.ap_materno AS materno_usuario,
                    ti.id AS id_instructor,
                    ti.nombre AS nombre_instructor,
                    ti.ap_paterno AS paterno_instructor,
                    ti.ap_materno AS materno_instructor 
                FROM td_curso_usuario tcu
                    inner join tm_curso tc on tcu.curso_id = tc.id 
                    inner join tm_usuario tu on tcu.usuario_id = tu.id
                    inner join tm_instructor ti on tc.instructor_id = ti.id
                WHERE tc.id = ?
                    AND tcu.estado = 1";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_curso_usuario($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE td_curso_usuario SET estado = 0 WHERE id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function getUsuarios_modal($curso_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * 
                FROM tm_usuario 
                WHERE estado = 1 
                AND rol_id = 1
                AND id NOT IN (
                    SELECT usuario_id
                    FROM td_curso_usuario
                    WHERE curso_id = ?
                )
                ORDER BY id DESC";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curso_id, PDO::PARAM_INT);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
