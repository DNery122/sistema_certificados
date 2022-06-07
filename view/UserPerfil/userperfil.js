var user_id = $("#user_idx").val();
$(document).ready(function () {
  $.post(
    "../../controller/usuarioController.php?op=mostrar_usuario",
    { id: user_id },
    function (data) {
      data = JSON.parse(data);
      $("#nombre").val(data.nombre);
      $("#paterno").val(data.ap_paterno);
      $("#materno").val(data.ap_materno);
      $("#correo").val(data.correo);
      $("#password").val(data.pass);
      $("#sexo").val(data.sexo).trigger("change");
      $("#telefono").val(data.telefono);
    }
  );
});

$(document).on("click", "#btn_actualizar", function () {
  $.post("../../controller/usuarioController.php?op=actualizar_usuario", {
    usuario: {
      id: user_id,
      nombre: $("#nombre").val(),
      paterno: $("#paterno").val(),
      materno: $("#materno").val(),
      pass: $("#password").val(),
      sexo: $("#sexo").val(),
      telefono: $("#telefono").val(),
    },
  }).done(function () {
    Swal.fire({
      title: "Correcto!",
      text: "Se actualizo correctamente",
      icon: "success",
      confirmButtonText: "Aceptar",
    });
  });
});
