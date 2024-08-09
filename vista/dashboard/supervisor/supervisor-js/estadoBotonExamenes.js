function cambiarEstado(btn) {
  var nuevoEstado;
  if (btn.classList.contains("btn-success")) {
      btn.classList.remove("btn-success");
      btn.classList.add("btn-danger");
      btn.textContent = "Inactivo";
      nuevoEstado = "inactivo";
  } else {
      btn.classList.remove("btn-danger");
      btn.classList.add("btn-success");
      btn.textContent = "Activo";
      nuevoEstado = "activo";
  }
  // Agregar depuración
  //console.log("Nuevo estado:", nuevoEstado);

  // Envía una solicitud AJAX al servidor para actualizar el estado en la base de datos
  var id = btn.getAttribute("data-id"); 
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../../controlador/controlador-supervisor/controlador-js/estadoExamen.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.responseText); 
          if (nuevoEstado === 'inactivo') {
              Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Examen ha sido desactivado",
                  showConfirmButton: false,
                  timer: 1500,
              });
          } else if (nuevoEstado === 'activo') {
              Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Examen ha sido activado",
                  showConfirmButton: false,
                  timer: 1500,
              });
          }
      }
  };
  xhr.send("id=" + id + "&estado=" + nuevoEstado);
}