function validarCorreo(a) {
 var desabilitar = document.getElementById('login-proceso');
 if (a.value.indexOf(".") > 0) {
  document.getElementById('alertaE').innerHTML = "";
  desabilitar.disabled = false;
 } else {
  document.getElementById('alertaE').innerHTML = "El correo no es admitido";
  desabilitar.disabled = true;
 }
}

function longitudClave(a, c) {
 var desabilitar = document.getElementById('login-proceso');
 if (a.value.length < c) {
  document.getElementById('alertaP').innerHTML = "La contraseña debe tener mas de " + c + " dígitos";
  desabilitar.disabled = true;
 } else {
  document.getElementById('alertaP').innerHTML = "";
  desabilitar.disabled = false;
 }
}