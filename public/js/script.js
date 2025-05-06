// Script básico para validación de formularios
function validateForm() {
    var nombre = document.getElementById("nombre").value;
    if (nombre == "") {
        alert("El campo Nombre no puede estar vacío.");
        return false;
    }
    return true;
}
