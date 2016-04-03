$(document).ready(function(){
	$.validator.addMethod('nombre', function(value, element)
	{
		return this.optional(element) || /^[a-záéíóúàèìòùäëïöüñ\s]+$/i.test(value);
	});
	$.validator.addMethod('apellido', function(value, element)
	{
		return this.optional(element) || /^[a-záéíóúàèìòùäëïöüñ\s]+$/i.test(value);
	});
	$.validator.addMethod('pass', function(value, element)
	{
		return this.optional(element) || /^[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@_0-9]+$/i.test(value);
	});
	$("#frmRegistro").validate
	({
     		rules:
		{
			nombre: {required: true, nombre: true, minlength: 2, maxlength: 30},
			apellido: {required: true, apellido: true, minlength: 2, maxlength: 30},
			pass: {required: true, pass: true, minlength: 8, maxlength: 12}
		},
		messages:
		{
			nombre: {required: 'Campo requerido', nombre: 'Formato incorrecto', minlength: 'Debe tener al menos 2 letras', maxlength: 'El máximo de caracteres son 30'},
			apellido: {required: 'Campo requerido', apellido: 'Formato incorrecto', minlength: 'Debe tener al menos 2 letras', maxlength: 'El máximo de caracteres son 30'},
			pass: {required: 'Campo requerido', pass: 'Letras y números', minlength: 'minimo 8 caracteres', maxlength: 'máximo de caracteres es de 12'}
       	}
    	});
});