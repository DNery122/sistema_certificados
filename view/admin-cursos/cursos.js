function init() {
  $("#cursos_form").on("submit", function (e) {
    guardar_editar(e);
  });
}

function guardar_editar(e) {
  e.preventDefault();
  var formData = new FormData($("#cursos_form")[0]);

  $.ajax({
    url: "../../controller/cursoController.php?op=guardar_editar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#cursos_data").DataTable().ajax.reload();
      $("#modal_curso").modal("hide");

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
  $("#cursos_data").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5"],
    ajax: {
      url: "../../controller/cursoController.php?op=listar",
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

  $("#categoria_id").select2({
    dropdownParent: $("#modal_curso"),
  });

  combo_categoria();

  $("#instructor_id").select2({
    dropdownParent: $("#modal_curso"),
  });

  combo_instructor();
});

function nuevo() {
  $("#modal_titulo").html("Nuevo Registro");
  $("#cursos_form")[0].reset();
  combo_categoria();
  combo_instructor();
  $("#modal_curso").modal("show");
}

function editar(id) {
  $.post(
    "../../controller/cursoController.php?op=mostrar",
    { id: id },
    function (data) {
      data = JSON.parse(data);
      $("#id").val(data.id);
      $("#categoria_id").val(data.categoria_id).trigger("change");
      $("#instructor_id").val(data.instructor_id).trigger("change");
      $("#nombre").val(data.nombre);
      $("#descripcion").val(data.descripcion);
      $("#fecha_inicio").val(data.fecha_inicio);
      $("#fecha_fin").val(data.fecha_fin);
    }
  );

  $("#modal_titulo").html("Editar Registro");
  $("#modal_curso").modal("show");
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
        "../../controller/cursoController.php?op=eliminar",
        { id: id },
        function (data) {
          $("#cursos_data").DataTable().ajax.reload();

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

function combo_categoria() {
  $.post("../../controller/categoriaController.php?op=combo", function (data) {
    data = JSON.parse(data);
    $("#categoria_id").html(data);
  });
}

function combo_instructor() {
  $.post("../../controller/instructorController.php?op=combo", function (data) {
    data = JSON.parse(data);
    $("#instructor_id").html(data);
  });
}

init();
