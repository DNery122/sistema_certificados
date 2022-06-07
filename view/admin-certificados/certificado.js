var id = $("#user_idx").val();

function init() {}

$(document).ready(function () {
  $("#curso_id").on("change", function () {
    $("#curso_id option:selected").each(function () {
      $("#certificado_data").DataTable({
        aProcessing: true,
        aServerSide: true,
        dom: "Bfrtip",
        buttons: ["copyHtml5", "excelHtml5", "csvHtml5"],
        ajax: {
          url: "../../controller/usuarioController.php?op=listar_usuarios_curso",
          type: "post",
          data: { id: $(this).val() },
        },
        bDestroy: true,
        responsive: true,
        bInfo: true,
        iDisplayLength: 15,
        aaSorting: [],
        // order: [[0, "desc"]],
        language: {
          sProcessing: "Procesando...",
          sLengthMenu: "Mostrar _MENU_ registros",
          sZeroRecords: "No se encontraron resultados",
          sEmptyTable: "Ningún dato disponible en esta tabla",
          sInfo:
            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          sInfoEmpty:
            "Mostrando registros del 0 al 0 de un total de 0 registros",
          sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
          sInfoPostFix: "",
          sSearch: "Buscar:",
          sUrl: "",
          sInfoThousands: ",",
          sLoadingRecords: "Cargando...",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
          oAria: {
            sSortAscending:
              ": Activar para ordenar la columna de manera ascendente",
            sSortDescending:
              ": Activar para ordenar la columna de manera descendente",
          },
        },
      });
    });
  });

  $("#curso_id").select2();
  combo_curso();
});

function combo_curso() {
  $.post("../../controller/cursoController.php?op=combo", function (data) {
    data = JSON.parse(data);
    $("#curso_id").html(data);
  });
}

function certificado(id) {
  window.open("../certificado/index.php?id=" + id, "_blank");
}

function eliminar(id) {
  Swal.fire({
    title: "Eliminar!",
    text: "Desea Eliminar el Registro?",
    icon: "error",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.value) {
      $.post(
        "../../controller/usuarioController.php?op=eliminar_curso_usuario",
        { id: id },
        function (data) {
          $("#certificado_data").DataTable().ajax.reload();

          Swal.fire({
            title: "Correcto!",
            text: "Se Elimino Correctamente",
            icon: "success",
            confirmButtonText: "Aceptar",
          });
        }
      );
    }
  });
}

function nuevo() {
  if ($("#curso_id").val() == "") {
    Swal.fire({
      title: "Error!",
      text: "Seleccionar Curso",
      icon: "error",
      confirmButtonText: "Aceptar",
    });
  } else {
    listar_usuario($("#curso_id").val());
    $("#modal_certificado").modal("show");
  }
}

function listar_usuario(curso_id) {
  $("#usuario_data").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5"],
    ajax: {
      url: "../../controller/usuarioController.php?op=listar_usuarios_modal",
      type: "post",
      data: { curso_id: curso_id },
    },
    bDestroy: true,
    responsive: true,
    bInfo: true,
    iDisplayLength: 15,
    aaSorting: [],
    // order: [[0, "desc"]],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
}

function registrar_usuarios() {
  table = $("#usuario_data").DataTable();
  var usuario_id = [];

  table.rows().every(function (rowIdx, tableLoop, rowLoop) {
    cell1 = table.cell({ row: rowIdx, column: 0 }).node();
    if ($("input", cell1).prop("checked") == true) {
      id = $("input", cell1).val();
      usuario_id.push([id]);
    }
  });
  if (usuario_id == 0) {
    Swal.fire({
      title: "Error!",
      text: "Seleccionar Usuarios",
      icon: "error",
      confirmButtonText: "Aceptar",
    });
  } else {
    const formData = new FormData($("#form_detalle")[0]);
    formData.append("curso_id", $("#curso_id").val());
    formData.append("usuario_id", usuario_id);

    $.ajax({
      url: "../../controller/cursoController.php?op=insert_curso_usuario",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        $("#certificado_data").DataTable().ajax.reload();
        $("#modal_certificado").modal("hide");

        Swal.fire({
          title: "Correcto!",
          text: "Se Registro Correctamente",
          icon: "success",
          confirmButtonText: "Aceptar",
        });
      },
    });
  }
}

init();
