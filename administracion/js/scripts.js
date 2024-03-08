/* SCRIPTS TRABAJADOS POR FERNANDO */
function mascara(valor) {
 var desabilitar = document.getElementById('envio');
 if (valor.match(/^\d{2}$/) !== null) {
  return valor + '.';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf(".") === -1) {
   document.getElementById('alertaN').innerHTML = "El precio no debe llevar letras";
   desabilitar.disabled = true;
  } else {
   document.getElementById('alertaN').innerHTML = "";
   desabilitar.disabled = false;
  }
 } else {
  document.getElementById('alertaN').innerHTML = "";
  desabilitar.disabled = false;
 }
 return cadena;
}

function vuelto_validad(pago_cliente) {
 var total_pagar = document.getElementById('pago_total').value;
 var vuelto_final = (pago_cliente.value - total_pagar)
 document.getElementById('pago_vuelto').value = vuelto_final.toFixed(2);
}

function validar_descuento(a) {
 if (a.value.length > 2) {
  a.value = a.value.slice(0, 2);
 }
}
/* SCRIPTS TRABAJADOS POR (*** Patricia ***) */
/*alert("¡Elimina este alert al cargar la pagina!")*/
function validarPagoTotal(valor) {
 if (valor.match(/^\d{2}$/) !== null) {
  return valor + '.';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf(".") === -1) {
   document.getElementById('alertaTP').innerHTML = "El total a pagar no debe llevar letras";
  } else {
   document.getElementById('alertaTP').innerHTML = "";
  }
 } else {
  document.getElementById('alertaTP').innerHTML = "";
 }
 return cadena;
}

function validarPagoCliente(valor) {
 if (valor.match(/^\d{2}$/) !== null) {
  return valor + '.';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf(".") === -1) {
   document.getElementById('alertaPC').innerHTML = "El pago del cliente no debe llevar letras";
  } else {
   document.getElementById('alertaPC').innerHTML = "";
  }
 } else {
  document.getElementById('alertaPC').innerHTML = "";
 }
 return cadena;
}

function validarPagoVuelto(valor) {
 if (valor.match(/^\d{2}$/) !== null) {
  return valor + '.';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf(".") === -1) {
   document.getElementById('alertaV').innerHTML = "El vuelto del cliente no debe llevar letras";
  } else {
   document.getElementById('alertaV').innerHTML = "";
  }
 } else {
  document.getElementById('alertaV').innerHTML = "";
 }
 return cadena;
}

/* SCRIPTS TRABAJADOS POR (*** Magali ***) */
function validarproducto_codigo(a, c) {
 var desabilitar = document.getElementById('envio');
 if (a.value.length < c) {
  document.getElementById('alertacp').innerHTML = "El codigo debe tener mas de  " + c + " digitos y menos de 10";
  desabilitar.disabled = true;
 } else {
  document.getElementById('alertacp').innerHTML = "";
  desabilitar.disabled = false;
 }
}

function validarproducto_precio(c) {
 if (c.match(/^\d{2}$/) !== null) {
  return c + '.';
 }
 if (isNaN(c.value)) {
  if (c.indexOf(".") === -1) {
   document.getElementById('alertavp').innerHTML = "El precio no debe llevar letras";
  } else {
   document.getElementById('alertavp').innerHTML = "";
  }
 } else {
  document.getElementById('alertavp').innerHTML = "";
 }
 return cadena;
}

/* SCRIPTS TRABAJADOS POR (*** Edwin Bernal ***) */
function validarNombre(a, c) {
 var desabilitar = document.getElementById('envio')
 if (a.value.length < c) {
  document.getElementById('alertanombre').innerHTML = "El nombre debe contener mas de " + c + " digitos"
  desabilitar.disabled = true;
 } else {
  document.getElementById('alertanombre').innerHTML = " ";
  desabilitar.disabled = false;
 }
}

function validarApellidos(a, c) {
 var desabilitar = document.getElementById('envio')
 if (a.value.length < c) {
    document.getElementById('alertaapelliedos').innerHTML = "El nombre debe contener mas de " + c + " digitos"
    desabilitar.disabled = true;
 } else {
    document.getElementById('alertaapelliedos').innerHTML = " ";
    desabilitar.disabled = false;
 }
}

function validarcorreo(a) {
 var desabilitar = document.getElementById('envio');
 if (a.value.indexOf(".") > 0) {
  document.getElementById('alertacorreo').innerHTML = "";
  desabilitar.disabled = false;
 } else {
  document.getElementById('alertacorreo').innerHTML = "El correo no es admitido";
  desabilitar.disabled = true;
 }
}

function mascarardui(valor) {
 if (valor.match(/^\d{7}\d{1}$/) !== null) {
  return valor + '-';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf("-") === -1) {
   document.getElementById('alertadui').innerHTML = "El dui no completado correctamente";
  } else {
   document.getElementById('alertadui').innerHTML = "";
  }
 } else {
  document.getElementById('alertadui').innerHTML = "";
 }
 return cadena;
}

function mascaranit(valor) {
 if (valor.match(/^\d{4}$/) !== null) {
  document.getElementById('alertanit').innerHTML = "El nit no esta completo";
  return valor + '-';
 } else if (valor.match(/^\d{4}\-\d{6}$/) !== null) {
  document.getElementById('alertanit').innerHTML = "El nit no esta completo";
  return valor + '-';
 } else if (valor.match(/^\d{4}\-\d{6}\-\d{3}$/) !== null) {
  document.getElementById('alertanit').innerHTML = "El nit no esta completo";
  return valor + '-';
 } else {
  document.getElementById('alertanit').innerHTML = " ";
 }
 return cadena;
}

function mascaratelefono(valor) {
 if (valor.match(/^\d{4}$/) !== null) {
  return valor + '-';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf("-") === -1) {
   document.getElementById('alertatelefono').innerHTML = "";
  } else {
   document.getElementById('alertatelefono').innerHTML = "";
  }
 } else {
  document.getElementById('alertatelefono').innerHTML = "";
 }
 return cadena;
}

function validartelefono(a, c) {
 var desabilitar = document.getElementById('envio');
 if (a.value.length < c) {
  document.getElementById('alertatelefono').innerHTML = "El teléfono debe tener " + c + " números como mínimo";
  desabilitar.disabled = true;
 } else {
  if (!(a.value.charAt(0) == '7' || a.value.charAt(0) == '6')) {
   document.getElementById('alertatelefono').innerHTML = "El teléfono no es valido para El Salvador";
   desabilitar.disabled = true;
  } else {
   document.getElementById('alertatelefono').innerHTML = "";
   desabilitar.disabled = false;
  }
 }
}

function validarcontra(a, c) {
 var desabilitar = document.getElementById('envio');
 if (a.value.length < c) {
  document.getElementById('alertacontraseña').innerHTML = "La contraseña debe tener mas de " + c + " caracteres";
  desabilitar.disabled = true;
 } else {
  document.getElementById('alertacontraseña').innerHTML = "";
  desabilitar.disabled = false;
 }
}

function validarcontraseña2(a, c) {
 var desabilitar = document.getElementById('envio');
 var password1 = document.getElementById('usuario_pw');
 var password2 = document.getElementById('usuario_rept');
 if (password1.value !== password2.value) {
  document.getElementById('alertacontraseña2').innerHTML = "Debe coincidir con la contraseña escrita anteriormente"
  desabilitar.disabled = true;
 } else {
  document.getElementById('alertacontraseña2').innerHTML = " ";
  desabilitar.disabled = false;
 }
}
/* SCRIPTS TRABAJADOS POR (*** Daniel ***) */
function validarnombre(a, c) {
 var desabilitar = document.getElementById('envio')
 if (a.value.length < c) {
  document.getElementById('error-nombre').innerHTML = "El nombre no es admitido"
  desabilitar.disabled = true;
 } else {
  document.getElementById('error-nombre').innerHTML = " ";
  desabilitar.disabled = false;
 }
}

function validardui(valor) {
 if (valor.match(/^\d{7}\d{1}$/) !== null) {
  return valor + '-';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf("-") === -1) {
   document.getElementById('error-dui').innerHTML = "DUI incorrecto, formato: 00000000-0";
  } else {
   document.getElementById('error-dui').innerHTML = "";
  }
 } else {
  document.getElementById('error-dui').innerHTML = "";
 }
 return cadena;
}

function validarnit(valor) {
 if (valor.match(/^\d{4}$/) !== null) {
  document.getElementById('error-nit').innerHTML = "NIT incorrecto, formato: 000-000000-000-0";
  return valor + '-';
 } else if (valor.match(/^\d{4}\-\d{6}$/) !== null) {
  document.getElementById('error-nit').innerHTML = "NIT incorrecto, formato: 000-000000-000-0";
  return valor + '-';
 } else if (valor.match(/^\d{4}\-\d{6}\-\d{3}$/) !== null) {
  document.getElementById('error-nit').innerHTML = "NIT incorrecto, formato: 000-000000-000-0";
  return valor + '-';
 } else {
  document.getElementById('error-nit').innerHTML = " ";
 }
 return cadena;
}

function validartelf(valor) {
 if (valor.match(/^\d{4}$/) !== null) {
  return valor + '-';
 }
 if (isNaN(valor.value)) {
  if (valor.indexOf("-") === -1) {
   document.getElementById('error-telefono').innerHTML = "";
  } else {
   document.getElementById('error-telefono').innerHTML = "";
  }{

 } else   document.getElementById('error-telefono').innerHTML = "";
 }
 return cadena;
}
/* SCRIPTS TRABAJADOS POR (*** Diego ***) */
function validar_categoria_producto_crear() {
 var categoria = document.getElementById("categoria_producto_crear").value;
 if (categoria == "") {
  document.getElementById("error_categoria_producto_crear").innerHTML = "La categoría está vacía";
  categoria.disabled = true;
 } else {
  document.getElementById("error_categoria_producto_crear").innerHTML = "";
  categoria.disabled = false;
 }
}

function validar_nombre_producto_crear() {
 var nombre = document.getElementById("nombre_producto_crear").value;
 if (nombre == "" || nombre.length < 3) {
  document.getElementById("error_nombre_producto_crear").innerHTML = "El nombre está vacío o no es válido";
  nombre.disabled = true;
 } else {
  document.getElementById("error_nombre_producto_crear").innerHTML = "";
  nombre.disabled = false;
 }
}

function validar_descripcion_producto_crear() {
 var descripcion = document.getElementById("descripcion_producto_crear").value;
 if (descripcion == "" || descripcion.length < 3) {
  document.getElementById("error_descripcion_producto_crear").innerHTML = "La descripción está vacía o no es válida";
  descripcion.disabled = true;
 } else {
  document.getElementById("error_descripcion_producto_crear").innerHTML = "";
  descripcion.disabled = false;
 }
}

function validar_codigo_producto_crear() {
 var codigo = document.getElementById("codigo_producto_crear").value;
 if (codigo == "" || codigo.length < 3) {
  document.getElementById("error_codigo_producto_crear").innerHTML = "El código está vacío o no es válido";
  codigo.disabled = true;
 } else {
  document.getElementById("error_codigo_producto_crear").innerHTML = "";
  codigo.disabled = false;
 }
}

function validar_precio_producto_crear() {
 var precio = document.getElementById("precio_producto_crear").value;
 if (precio == NaN || precio < 0 || precio == 0) {
  document.getElementById("error_precio_producto_crear").innerHTML = "El precio está vacío o no es válido";
  precio.disabled = true;
 } else {
  document.getElementById("error_precio_producto_crear").innerHTML = "";
  precio.disabled = false;
 }
}

function validar_fecha_fabricacion_producto_crear() {
 var fecha = document.getElementById("fecha_fabricacion_producto_crear").value;
 var limite = document.getElementById("fecha_fabricacion_producto_crear").max = new Date();
 if (fecha == "" || fecha > limite) {
  document.getElementById("error_fecha_fabricacion_producto_crear").innerHTML = "La fecha está vacía o no es válida";
  fecha.disabled = true;
 } else {
  document.getElementById("error_fecha_fabricacion_producto_crear").innerHTML = "";
  fecha.disabled = false;
 }
}

function validar_fecha_expiracion_producto_crear() {
 var fecha = document.getElementById("fecha_expiracion_producto_crear").value;
 var limite = document.getElementById("fecha_expiracion_producto_crear").min;
 if (fecha == "" || fecha < limite.value) {
  document.getElementById("error_fecha_expiracion_producto_crear").innerHTML = "La fecha está vacía o no es válida";
  fecha.disabled = true;
 } else {
  document.getElementById("error_fecha_expiracion_producto_crear").innerHTML = "";
  fecha.disabled = false;
 }
}