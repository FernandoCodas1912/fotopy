 <script type="text/javascript">
     var base_url = "<?php echo base_url(); ?>";

     $(document).on("click", ".btn-check", function() {
       cliente = $(this).val();
       infocliente = cliente.split("*");
       $("#id_cliente").val(infocliente[0]);
       $("#razonsocial_cliente").val(infocliente[1]);
       $("#modal-buscar-cliente").modal("hide");
     });

     $(document).on("click", ".btn-agregar", function() {
       data = $(this).val();
       if (data != '') {
         infoproducto = data.split("*");
         html = "<tr>";
         html += "<td><input type='hidden' name='idproductos[]' value='" + infoproducto[0] + "'>" + infoproducto[0] + "</td>"; //id
         html += "<td>" + infoproducto[1] + "</td>"; //descripcion
         html += "<td><input type='text' name='cantidades[]'  id='cant' value='1' required pattern='[0-9]{1,5}' title='Solo numeros positivos' class='col-xs-3 cant'></td>"
         html += "<td><input type='hidden' pattern='[0-9]{1,5}'  name='precios[]' required value='" + infoproducto[2] + "'>" + infoproducto[2] + "</td>"; //precio
         html += "<td><input type='hidden' name='importes[]' value='" + infoproducto[2] + "'><p>" + infoproducto[2] + "</p></td>"; //totales
         html += "<td><button type='button' id='btn-eliminar' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>"; //btn-eliminar
         html += "</tr>";
         $("#tbventas tbody").append(html);
         sumar();
         $("#btn-agregar").val(null);
         $("#modal-buscar-productos").modal("hide");
       } else {
         alert("Debe seleccionar un producto");
       };
     });
     //para eliminar productos de la vista
     $(document).on("click", ".btn-remove-producto", function() {
       $(this).closest("tr").remove();
       sumar();
     });

     $(document).on("keyup", "#tbventas input.cant", function() {
       cantidad = $(this).val();
       //Inicia validacion
       if (isNaN(cantidad)) {
         alert('Cantidad debe ser Entero Positivo. Error Capa 8!');
         document.getElementById('cant').focus();
         return false;
       } else if ((cantidad <= 0) || (cantidad == '')) {
         alert('No se puede agregar cero o negativo. Error Capa 8!');
         document.getElementById('cant').focus();
         return false;
       }
       precio = $(this).closest("tr").find("td:eq(3)").text();
       total = cantidad * precio;
       $(this).closest("tr").find("td:eq(4)").children("p").text(total);
       $(this).closest("tr").find("td:eq(4)").children("input").val(total);
       sumar();
     });

     function sumar() {
       total = 0;
       $("#tbventas tbody tr").each(function() {
         total = total + Number($(this).find("td:eq(4)").text());
       });
       $("input[name=totales]").val(total);
     }


     //esto es para abrir modal vista impresion
     $(".btn-generar-print").on("click", function() {
       var base_url = "<?php echo base_url(); ?>";
       var id = $(this).val();
       //alert(id);
       $.ajax({
         url: base_url + "Presupuestos_controller/imprimir/" + id,
         type: "POST",
         success: function(resp) {
           $("#modal-print .modal-body").html(resp);
           // alert(resp);
         }
       });
     });
     //esto es lo que imprime en el navegador
     $(document).on("click", ".btn-print", function() {
       $("#modal-print .modal-body").print();
     });

 </script>