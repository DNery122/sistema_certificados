function init() {
  $("#categorias_form").on("submit", function (e) {
    guardar_editar(e);
  });
}

function guardar_editar(e) {
  e.preventDefault();

  var formData = new FormData($("#categorias_form")[0]);

  $.ajax({
    url: "../../controller/categoriaController.php?op=guardar_editar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#categorias_data").DataTable().ajax.reload();
      $("#modal_categorias").modal("hide");

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
  $("#categorias_data").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5"],
    ajax: {
      url: "../../controller/categoriaController.php?op=listar",
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
});

function nuevo() {
  $("#modal_titulo").html("Nuevo Registro");
  $("#categorias_form")[0].reset();
  $("#modal_categorias").modal("show");
}

function editar(id) {
  $.post(
    "../../controller/categoriaController.php?op=mostrar",
    { id: id },
    function (data) {
      data = JSON.parse(data);
      $("#id").val(data.id);
      $("#nombre").val(data.nombre);
    }
  );

  $("#modal_titulo").html("Editar Registro");
  $("#modal_categorias").modal("show");
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
        "../../controller/categoriaController.php?op=eliminar",
        { id: id },
        function (data) {
          $("#categorias_data").DataTable().ajax.reload();

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
