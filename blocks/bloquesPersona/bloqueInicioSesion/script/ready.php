
$("#bloqueIndex").validationEngine({
promptPosition : "centerRight",
scroll: false,
autoHidePrompt: true,
autoHideDelay: 2000
});

$("#tablaReporte").dataTable({
	"class": "dataTable display",
	"sPaginationType": "full_numbers",
	
});

$('#<?php echo $this->campoSeguro('fecha'); ?>').datepicker();

$('#<?php echo $this->campoSeguro('fecha2'); ?>').datepicker({

});

$('#<?php echo $this->campoSeguro('cedulaPersona')?>').change(
	function(){
		alert('hola');
	}
);



