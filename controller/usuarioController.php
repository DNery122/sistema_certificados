<?php

require_once('../config/conexion.php');
require_once('../models/Usuario.php');

$usuario = new Usuario();

switch ($_GET['op']) {

    case 'listar_cursos':

        $datos = $usuario->getCursosUsuario($_POST['user_id']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['nombre_curso'];
            $sub_array[] = $row['fecha_inicio_curso'];
            $sub_array[] = $row['fecha_fin_curso'];
            $sub_array[] = $row['nombre_instructor'] . ' ' . $row['paterno_instructor'];
            $sub_array[] = '<button type="button" onClick="certificado(' . $row['id'] . ');" id="' . $row['id'] . '" class="btn btn-outline-primary btn-icon"> <div><i class="fa fa-id-card-o"></i></div></button>';
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);

        break;

    case 'mostrar_curso_detalle':

        $datos = $usuario->getCursoID($_POST['curso_id']);

        if (is_array($datos) == true and count($datos) <> 0) {

            foreach ($datos as $row) {

                $output['id'] = $row['id'];
                $output['id_curso'] = $row['id_curso'];
                $output['nombre_curso'] = $row['nombre_curso'];
                $output['descripcion_curso'] = $row['descripcion_curso'];
                $output['fecha_inicio_curso'] = $row['fecha_inicio_curso'];
                $output['fecha_fin_curso'] = $row['fecha_fin_curso'];
                $output['id_usuario'] = $row['id_usuario'];
                $output['nombre_usuario'] = $row['nombre_usuario'];
                $output['paterno_usuario'] = $row['paterno_usuario'];
                $output['materno_usuario'] = $row['materno_usuario'];
                $output['id_instructor'] = $row['id_instructor'];
                $output['nombre_instructor'] = $row['nombre_instructor'];
                $output['paterno_instructor'] = $row['paterno_instructor'];
                $output['materno_instructor'] = $row['materno_instructor'];
            }

            echo json_encode($output);
        }

        break;

    case 'total_cursos_usuario':

        $datos = $usuario->getTotalCursosUsuario($_POST['user_id']);

        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output['total_cursos'] = $row['total_cursos'];
            }
            echo json_encode($output);
        }
        break;

    case 'listar_cursos_limit':

        $datos = $usuario->getCursosUsuarioLimit($_POST['user_id'], $_POST['limit']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row['nombre_curso'];
            $sub_array[] = $row['fecha_inicio_curso'];
            $sub_array[] = $row['fecha_fin_curso'];
            $sub_array[] = $row['nombre_instructor'] . ' ' . $row['paterno_instructor'];
            $sub_array[] = '<button type="button" onClick="certificado(' . $row['id'] . ');" id="' . $row['id'] . '" class="btn btn-outline-primary btn-icon"> <div><i class="fa fa-id-card-o"></i></div></button>';
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);

        break;

    case 'listar_usuarios':

        $datos = $usuario->getUsuarios();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = strtoupper($row['nombre']);
            $sub_array[] = strtoupper($row['ap_paterno']);
            $sub_array[] = strtoupper($row['ap_materno']);
            $sub_array[] = strtoupper($row['correo']);
            $sub_array[] = $row['sexo'];
            $sub_array[] = $row['telefono'];
            $sub_array[] = '<button type="button" onClick="editar(' . $row['id'] . ');" id="' . $row['id'] . '" class="btn btn-outline-warning btn-icon"> <div><i class="fa fa-edit"></i></div></button>
                            <button type="button" onClick="eliminar(' . $row['id'] . ');" id="' . $row['id'] . '" class="btn btn-outline-danger btn-icon"> <div><i class="fa fa-close"></i></div></button>';
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);
        break;

    case 'mostrar_usuario':

        $datos = $usuario->getusuario($_POST['id']);

        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {

                $output['id'] = $row['id'];
                $output['nombre'] = $row['nombre'];
                $output['ap_paterno'] = $row['ap_paterno'];
                $output['ap_materno'] = $row['ap_materno'];
                $output['correo'] = $row['correo'];
                $output['pass'] = $row['pass'];
                $output['sexo'] = $row['sexo'];
                $output['telefono'] = $row['telefono'];
            }

            echo json_encode($output);
        }

        break;

    case 'actualizar_usuario':

        $usuario->updateUsuario($_POST['usuario']);

        break;

    case 'guardar_editar':

        if (empty($_POST['id'])) {
            $usuario->insert_usuario_admin([
                'nombre'        => $_POST['nombre'],
                'ap_paterno'    => $_POST['ap_paterno'],
                'ap_materno'    => $_POST['ap_materno'],
                'correo'        => $_POST['correo'],
                'pass'          => $_POST['pass'],
                'sexo'          => $_POST['sexo'],
                'telefono'      => $_POST['telefono']
            ]);
        } else {
            $usuario->update_usuario_admin([
                'nombre'        => $_POST['nombre'],
                'ap_paterno'    => $_POST['ap_paterno'],
                'ap_materno'    => $_POST['ap_materno'],
                'correo'        => $_POST['correo'],
                'pass'          => $_POST['pass'],
                'sexo'          => $_POST['sexo'],
                'telefono'      => $_POST['telefono'],
                'id'            => $_POST['id']
            ]);
        }
        break;

    case 'eliminar':

        $usuario->delete_usuario_admin($_POST['id']);

        break;

    case 'listar_usuarios_curso':

        $datos = $usuario->get_usuarios_curso($_POST['id']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = strtoupper($row['nombre_curso']);
            $sub_array[] = strtoupper($row['nombre_usuario']) . ' ' . strtoupper($row['paterno_usuario']) . ' ' . strtoupper($row['materno_usuario']);
            $sub_array[] = $row['fecha_inicio_curso'];
            $sub_array[] = $row['fecha_fin_curso'];
            $sub_array[] = strtoupper($row['nombre_instructor']) . ' ' . strtoupper($row['paterno_instructor']);
            $sub_array[] = '<button type="button" onClick="certificado(' . $row['id'] . ');" id="' . $row['id'] . '" class="btn btn-outline-primary btn-icon"> <div><i class="fa fa-id-card-o"></i></div></button>
                            <button type="button" onClick="eliminar(' . $row['id'] . ');" id="' . $row['id'] . '" class="btn btn-outline-danger btn-icon"> <div><i class="fa fa-close"></i></div></button>';
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);

        break;

    case 'eliminar_curso_usuario':

        $usuario->delete_curso_usuario($_POST['id']);

        break;

    case 'listar_usuarios_modal':

        $datos = $usuario->getUsuarios_modal($_POST['curso_id']);
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = '<input type="checkbox" name="usuario_check[]" value="' . $row['id'] . '">';
            $sub_array[] = strtoupper($row['nombre']);
            $sub_array[] = strtoupper($row['ap_paterno']);
            $sub_array[] = strtoupper($row['ap_materno']);
            $sub_array[] = strtoupper($row['correo']);
            $data[] = $sub_array;
        }

        $result = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($result);

        break;
}
