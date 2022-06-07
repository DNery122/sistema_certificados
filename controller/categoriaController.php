<?php

require_once('../config/conexion.php');
require_once('../models/Categoria.php');

$categoria = new Categoria();

switch ($_GET['op']) {

    case 'guardar_editar':

        if (empty($_POST['id'])) {

            $categoria->insert_categoria(['nombre' => $_POST['nombre']]);
        } else {

            $categoria->update_categoria([
                'id'     => $_POST['id'],
                'nombre' => $_POST['nombre']
            ]);
        }

        break;

    case 'mostrar':

        $datos = $categoria->get_categoriaID($_POST['id']);

        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {

                $output['id'] = $row['id'];
                $output['nombre'] = $row['nombre'];
                $output['fecha_registro'] = $row['fecha_registro'];
            }

            echo json_encode($output);
        }

        break;

    case 'eliminar':

        $categoria->delete_categoria($_POST['id']);

        break;

    case 'listar':

        $datos = $categoria->get_categorias();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = strtoupper($row['nombre']);
            $sub_array[] = $row['fecha_registro'];
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

        $datos = $categoria->get_categorias();

        if (is_array($datos) == true and count($datos) <> 0) {
            $html = '<option label="Seleccione"></option>';
            foreach ($datos as $row) {
                $html .= '<option value="' . $row['id'] . '">' . strtoupper($row['nombre']) . '</option>';
            }

            echo json_encode($html);
        }

        break;
}
