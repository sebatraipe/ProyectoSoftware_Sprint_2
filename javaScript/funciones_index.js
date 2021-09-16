
/* Solicita confirmacion de eliminacion --> */ 
 function solicitarConfirmacion(id){
        let respuesta = confirm("¿Esta seguro que desea eliminar a este usuario?");
        if (respuesta == true){
          window.location.href = "eliminar.php?id="+id;
          return true;
        }
        else{
            return false;
        }
}
/* Carga los datos del usuario seleccionado al modal de edicion */
function cargarDatosModal(id, nombre, apellido, username, password, email, rol){
        document.getElementById("inputId").value = id;
        document.getElementById("inputNombre").value = nombre;
        document.getElementById("inputApellido").value = apellido;
        document.getElementById("inputUsername").value = username;
        document.getElementById("inputPassword").value = password;
        document.getElementById("inputEmail").value = email;
        document.getElementById("select").value = rol;
}

 function limpiar(){
        document.getElementById("inputId").value = "";
        document.getElementById("inputNombre").value = "";
        document.getElementById("inputApellido").value = "";
        document.getElementById("inputUsername").value = "";
        document.getElementById("inputPassword").value = "";
        document.getElementById("inputEmail").value = "";
}