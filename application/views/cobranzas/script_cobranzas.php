<script type="text/javascript">
	var base_url = "<?php echo base_url(); ?>";

	$(document).ready(function() {
		$(document).on("click", ".btn-check", function() {
			cliente = $(this).val();
			infocliente = cliente.split("*");
			$("#id_cliente").val(infocliente[0]);
			$("#razonsocial_cliente").val(infocliente[1]);
			$("#modal-buscar-cliente").modal("hide");
			getVentaDetalle(infocliente[0]);
		});
	});

	// obtener ventas del cliente
	function getVentaDetalle(id_cliente) {
		$.ajax({
			url: base_url + 'Cobranzas_controller/clienteVentas',
			type: 'POST',
			data: {
				id_cliente
			},
			dataType: 'json',
			success: function(response) {
				res = response; //guardamos resultado para poder preg.
				console.log(res);
				$("#finalizar_venta").css("display", "none");
				if (res.status == "success") {
					const ventas = res.ventas;
					var options = '<option value="" selected="" disabled="">Seleccione</option>';
					ventas.forEach(venta => {
						options += `<option value="${venta.id_venta}">${venta.seriecomprobante}-${venta.nrocomprobante} | ${venta.total}</option>`
					});
					$("#ventas").empty().html(options)

				} else {
					Swal.fire({
						icon: 'error',
						title: 'No se encontraron ventas pendientes de cobrar para este cliente.',
					});
				};

			}
		});
	}

	// obtener detalle de venta seleccionada
	$(document).on('change', "#ventas", function() {
		$("#datos-cobranza").hide();
		$("#id_formapago").val($("#id_formapago option:first").val());
		$("#monto_entregado").val('').trigger('keyup');
		const id_venta = $(this).find(':selected').val();
		$.ajax({
			url: base_url + 'Cobranzas_controller/detallesVenta',
			type: 'POST',
			data: {
				id_venta
			},
			dataType: 'json',
			success: function(response) {
				const res = response; //guardamos resultado para poder preg.
				$("#finalizar_venta").css("display", "none");
				if (res.status == "success") {
					$("#datos-cobranza").fadeIn();
					const detalles = res.detalles;
					var tableRow = '';
					var totales = 0;
					detalles.forEach(detalle => {
						const subtotal = detalle.precio * detalle.cantidad;
						totales += subtotal;

						tableRow += "<tr>";
						tableRow += "<td>" + detalle.codigobarra + "</td>";
						tableRow += "<td>" + detalle.producto + "</td>";
						tableRow +="<td>"+ detalle.cantidad +"</td>"
						tableRow += "<td>" + detalle.precio + "</td>";
						tableRow += "<td>" + subtotal + "</td>";
						tableRow += "</tr>";
					});
					$("#tbcobranzas tbody").empty().append(tableRow);
					$("div.totales").text(totales)
					$("input.totales").val(totales)
					
				} else {
					Swal.fire({
						icon: 'error',
						title: 'No se encontraron detalles para esta venta.',
					});
				};

			}
		});
	});

	
	
	$(document).on('change, keyup', '#monto_entregado', function(){
		const este = $(this).val();
		var titulo = "Valor"
		
		if(este != ''){
			const totales = $("input.totales").val();
			const vuelto = este - totales;
			titulo = "Vuelto"
			if(vuelto < 0){
				titulo = "Pendiente"
				$("#vuelto-amnt").removeClass('bg-primary').addClass('bg-danger');
			}else {
				$("#vuelto-amnt").removeClass('bg-danger').addClass('bg-success');
			}
			$("#vuelto-amnt").text(vuelto);
		}else{
			$("#vuelto-amnt").removeClass('bg-danger').removeClass('bg-success').addClass('bg-primary').text(0);
			$("#vuelto-ttl").text(titulo);
		}
	});


	// Restricts input for each element in the set of matched elements to the given inputFilter.
	(function($) {
		$.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		};
	}(jQuery));

	$(".onlyNumbers").inputFilter(function(value) {
		// return /^-?\d*$/.test(value);
		return /^\+?\d*$/.test(value);
	});
</script>