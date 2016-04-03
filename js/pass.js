$(document).ready(function(){
	
	$.validator.addMethod('pass', function(value, element)
	{
		return this.optional(element) || /^[a-zA-ZÁáÀàÉéÈèÍíÌìÓóÒòÚúÙùÑñüÜ@_0-9]+$/i.test(value);
	});
	$("#frmUsuario").validate
	({
     		rules:
		{
			
			pass: {required: true, pass: true, minlength: 8, maxlength: 12}
		},
		messages:
		{
	
			pass: {required: 'Campo requerido', pass: 'Letras, números y @ _', minlength: 'Minimo 8 caracteres', maxlength: 'máximo de caracteres es de 12'}
       	}
    	});
});