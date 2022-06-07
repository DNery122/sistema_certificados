<?php

require_once('../config/conexion.php');
require_once('../models/Instructor.php');

$instructor = new Instructor();

switch ($_GET['op']) {

    case 'guardar_editar':

        if (empty($_POST['id'])) {

            $instructor->insert_instructor([
                'nombre'        => $_POST['nombre'],
                'ap_paterno'    => $_POST['ap_paterno'],
                'ap_materno'    => $_POST['ap_materno'],
                'correo'        => $_POST['correo'],
                'sexo'          => $_POST['sexo'],
                'telefono'      => $_POST['telefono']
            ]);
        } else {

            $instructor->update_instructor([
                'nombre'        => $_POST['nombre'],
                'ap_paterno'    => $_POST['ap_paterno'],
                'ap_materno'    => $_POST['ap_materno'],
                'correo'        => $_POST['correo'],
                'sexo'          => $_POST['sexo'],
                'telefono'      => $_POST['telefono'],
                'id'            => $_POST['id']
            ]);
        }

        break;

    case 'mostrar':

        $datos = $instructor->get_instructorID($_POST['id']);

        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {

                $output['id'] = $row['id'];
                $output['nombre'] = $row['nombre'];
                $output['ap_paterno'] = $row['ap_paterno'];
                $output['ap_materno'] = $row['ap_materno'];
                $output['correo'] = $row['correo'];
                $output['sexo'] = $row['sexo'];
                $output['telefono'] = $row['telefono'];
                $output['fecha_registro'] = $row['fecha_registro'];
            }

            echo json_encode($output);
        }

        break;

    case 'eliminar':

        $instructor->delete_instructor($_POST['id']);

        break;

    case 'listar':

        $datos = $instructor->get_instructores();
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

    case 'combo':

        $datos = $instructor->get_instructores();

        if (is_array($datos) == true and count($datos) <> 0) {
            $html = '<option label="Seleccione"></option>';
            foreach ($datos as $row) {
                $html .= '<option value="' . $row['id'] . '">' . strtoupper($row['nombre']) . ' ' . strtoupper($row['ap_paterno']) . ' ' . strtoupper($row['ap_materno']) . '</option>';
            }

            echo json_encode($html);
        }

        break;
}
