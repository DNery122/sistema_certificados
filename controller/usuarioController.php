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

    case 'mostrar_usuario':

        $datos = $usuario->getusuario($_POST['user_id']);

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
}
