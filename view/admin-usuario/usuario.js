function init() {
  $("#usuario_form").on("submit", function (e) {
    guardar_editar(e);
  });
}

function guardar_editar(e) {
  e.preventDefault();
  var formData = new FormData($("#usuario_form")[0]);

  $.ajax({
    url: "../../controller/usuarioController.php?op=guardar_editar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#usuario_data").DataTable().ajax.reload();
      $("#modal_usuario").modal("hide");

      Swal.fire({
        title: "Correcto!",
        text: "Se Registro Correctamente",
        icon: "success",
        confirmButtonText: "Aceptar",
      });
    },
  });
}

$(document).ready(function () {
  $("#usuario_data").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5"],
    ajax: {
      url: "../../controller/usuarioController.php?op=listar_usuarios",
      type: "post",
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
  $("#sexo").select2({
    dropdownParent: $("#modal_usuario"),
  });
});

function nuevo() {
  $("#modal_titulo").html("Nuevo Registro");
  $("#usuario_form")[0].reset();
  $("#modal_usuario").modal("show");
}

function editar(id) {
  $.post(
    "../../controller/usuarioController.php?op=mostrar_usuario",
    { id: id },
    function (data) {
      data = JSON.parse(data);
      $("#id").val(data.id);
      $("#nombre").val(data.nombre);
      $("#ap_paterno").val(data.ap_paterno);
      $("#ap_materno").val(data.ap_materno);
      $("#correo").val(data.correo);
      $("#pass").val(data.pass);
      $("#sexo").val(data.sexo).trigger("change");
      $("#telefono").val(data.telefono);
    }
  );

  $("#modal_titulo").html("Editar Registro");
  $("#modal_usuario").modal("show");
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
        "../../controller/usuarioController.php?op=eliminar",
        { id: id },
        function (data) {
          $("#usuario_data").DataTable().ajax.reload();

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

init();
