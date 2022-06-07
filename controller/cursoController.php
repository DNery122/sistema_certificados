<?php

require_once('../config/conexion.php');
require_once('../models/Curso.php');

$curso = new Curso();

switch ($_GET['op']) {

    case 'guardar_editar':

        if (empty($_POST['id'])) {
            $curso->insert_curso([
                'categoria_id'  => $_POST['categoria_id'],
                'instructor_id' => $_POST['instructor_id'],
                'nombre'        => $_POST['nombre'],
                'descripcion'   => $_POST['descripcion'],
                'fecha_inicio'  => $_POST['fecha_inicio'],
                'fecha_fin'     => $_POST['fecha_fin']
            ]);
        } else {
            $curso->update_curso([
                'id'            => $_POST['id'],
                'categoria_id'  => $_POST['categoria_id'],
                'instructor_id' => $_POST['instructor_id'],
                'nombre'        => $_POST['nombre'],
                'descripcion'   => $_POST['descripcion'],
                'fecha_inicio'  => $_POST['fecha_inicio'],
                'fecha_fin'     => $_POST['fecha_fin']
            ]);
        }

        break;

    case 'mostrar':

        $datos = $curso->get_cursoID($_POST['id']);

        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {

                $output['id'] = $row['id'];
                $output['categoria_id'] = $row['categoria_id'];
                $output['instructor_id'] = $row['instructor_id'];
                $output['nombre'] = $row['nombre'];
                $output['descripcion'] = $row['descripcion'];
                $output['fecha_inicio'] = $row['fecha_inicio'];
                $output['fecha_fin'] = $row['fecha_fin'];
                $output['fecha_registro'] = $row['fecha_registro'];
            }

            echo json_encode($output);
        }

        break;

    case 'eliminar':

        $curso->delete_curso($_POST['id']);

        break;

    case 'listar':

        $datos = $curso->get_cursos();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = strtoupper($row['nombre_categoria']);
            $sub_array[] = strtoupper($row['nombre_instructor']) . ' ' . strtoupper($row['paterno_instructor']) . ' ' . strtoupper($row['materno_instructor']);
            $sub_array[] = strtoupper($row['nombre']);
            $sub_array[] = $row['fecha_inicio'];
            $sub_array[] = $row['fecha_fin'];
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

    case 'combo':

        $datos = $curso->get_cursos();

        if (is_array($datos) == true and count($datos) <> 0) {
            $html = '<option label="Seleccione"></option>';
            foreach ($datos as $row) {
                $html .= '<option value="' . $row['id'] . '">' . strtoupper($row['nombre']) . '</option>';
            }

            echo json_encode($html);
        }

        break;

    case 'insert_curso_usuario':

        $datos = explode(',', $_POST['usuario_id']);

        foreach ($datos as $row) {
            $curso->insert_curso_usuario($_POST['curso_id'], $row);
        }

        break;
}
