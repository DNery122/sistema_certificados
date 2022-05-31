const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

const image = new Image();
image.src = "../../public/certificado.png";

$(document).ready(function () {
  var id = getUrlParameter("id");

  $.post(
    "../../controller/usuarioController.php?op=mostrar_curso_detalle",
    { curso_id: id },
    function (data) {
      data = JSON.parse(data);
      //   console.log(data);

      $("#descripcion_curso").html(data.descripcion_curso);

      ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";
      var x = canvas.width / 2;

      ctx.font = "40px Arial";
      ctx.fillText(
        data.nombre_usuario +
          " " +
          data.paterno_usuario +
          " " +
          data.materno_usuario,
        x,
        300
      );

      ctx.font = "30px Arial";
      ctx.fillText(data.nombre_curso, x, 380);

      ctx.font = "18px Arial";
      ctx.fillText(
        data.nombre_instructor +
          " " +
          data.paterno_instructor +
          " " +
          data.materno_instructor,
        x,
        450
      );

      ctx.font = "15px Arial";
      ctx.fillText(
        "DEL: " + data.fecha_inicio_curso + ". AL: " + data.fecha_fin_curso,
        x,
        510
      );
    }
  );

  // console.log(id);
});

$(document).on("click", "#btnPNG", function () {
  let lblpng = document.createElement("a");
  lblpng.download = "Certificado.png";
  lblpng.href = canvas.toDataURL();
  lblpng.click();
});

$(document).on("click", "#btnPDF", function () {
  var imgData = canvas.toDataURL("image/png");
  var doc = new jsPDF("l", "mm");
  doc.addImage(imgData, "PNG", 30, 15);
  doc.save("certificado.pdf");
});

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};
