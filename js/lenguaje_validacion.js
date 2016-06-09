$(document).ready(function(){
  $.extend(jQuery.validator.messages, {
        required: "Este campo es requerido.",
        remote: "Por favor, corrija este campo.",
        email: "Por favor ingrese un E-mail válido.",
        url: "Por favor ingrese una  URL válida.",
        date: "Por favor ingrese una fecha válida. (YYYY/MM/DD)",
        dateISO: "Por favor ingrese una  fecha (ISO) válida.",
        number: "Por favor ingrese un numero válido.",
        digits: "Por favor ingrese solo dígitos.",
        creditcard: "Por favor ingrese un  numero de tarjeta de credito válido.",
        equalTo: "Ingresa el mismo valor.",
        accept: "Por favor ingrese un  valor con una extension valida.",
        maxlength: $.validator.format("Por favor ingrese no más de {0} caracteres."),
        minlength: $.validator.format("Por favor ingrese al ménos {0} caracteres."),
        rangelength: $.validator.format("Por favor ingrese un valor entre {0} y {1} caracteres."),
        range: $.validator.format("Por favor ingrese un  entre {0} y {1}."),
        max: $.validator.format("Por favor ingrese un valor menor o igual a {0}."),
        min: $.validator.format("Por favor ingrese un valor mayor o igual a {0}.")
    });
});
