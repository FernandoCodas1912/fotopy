 <script type="text/javascript">
   $(document).ready(function() {
    var base_url= "<?php echo base_url();?>";

     $(document).on("click", ".btn-check", function(){
      cliente = $(this).val();
      infocliente = cliente.split("*");
      $("#id_cliente").val(infocliente[0]);
      $("#razonsocial_cliente").val(infocliente[1]);
      $("#modal-buscar-cliente").modal("hide");
    });

     $(document).on("click", ".btn-agregar", function(){
      data = $(this).val();
      if (data !='') {
        infoproducto = data.split("*");
        html = "<tr>";
                html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[0]+"</td>"; //id
                html += "<td>"+infoproducto[1]+"</td>"; //descripcion
                html += "<td><input type='text' name='cantidades[]'  id='cant' value='1' required pattern='[0-9]{1,5}' title='Solo numeros positivos' class='col-xs-3 cant'></td>"
                html += "<td><input type='hidden' pattern='[0-9]{1,5}'  name='precios[]' required value='"+infoproducto[2]+"'>"+infoproducto[2]+"</td>";//precio
                html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[2]+"'><p>"+infoproducto[2]+"</p></td>";//totales
                html += "<td><button type='button' id='btn-eliminar' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>"; //btn-eliminar
                html +="</tr>";
                $("#tbventas tbody").append(html);
                sumar();
                $("#btn-agregar").val(null);
                $("#modal-buscar-productos").modal("hide");
              }else{
                alert("Debe seleccionar un producto");
              };  
        });
        //para eliminar productos de la vista
        $(document).on("click", ".btn-remove-producto", function(){
          $(this).closest("tr").remove();
          sumar();
        });
        
        $(document).on("keyup", "#tbventas input.cant", function(){
         cantidad=$(this).val();
          //Inicia validacion
              if (isNaN(cantidad)) {
                  alert('Cantidad debe ser Entero Positivo. Error Capa 8!');
                  document.getElementById('cant').focus();
                  return false;
              }else if ((cantidad <= 0) || (cantidad == '')) {
                alert('No se puede agregar cero o negativo. Error Capa 8!');
                document.getElementById('cant').focus();
                return false;
              }
         precio=$(this).closest("tr").find("td:eq(3)").text();
         total= cantidad*precio;
         $(this).closest("tr").find("td:eq(4)").children("p").text(total);
         $(this).closest("tr").find("td:eq(4)").children("input").val(total);
         sumar();
       });
        
        function sumar(){
          total=0;
          $ ("#tbventas tbody tr").each(function(){
            total=total+Number($(this).find("td:eq(4)").text());
          });
          $("input[name=totales]").val(total);      
        }


         //esto es para abrir modal vista impresion
        $(".btn-generar-print").on("click", function(){
             var base_url= "<?php echo base_url();?>";
          var id= $(this).val();
          //alert(id);
          $.ajax({
            url: base_url + "Ventas_controller/imprimir/" + id,
            type: "POST",
            success:function(resp){
              $("#modal-print .modal-body").html(resp);
               // alert(resp);
              }
            });
        });
        //esto es lo que imprime en el navegador
          $(document).on("click", ".btn-print", function(){
            $("#modal-print .modal-body").print();
          });

});

//tipo comprobante, carga series
$("#id_tipocomprobante").on("change", function() {
    option = $(this).val();
    // alert("eligio" + option);
    if (option != "") {
      infocomprobante = option.split("*");
      $('#tipo_comprobante').val(infocomprobante[0]);
      //$('#iva').val(infocomprobante[2]);
      $('#serie_comprobante_venta').val(infocomprobante[2]);
      $("#nro_op").val(generarnumero(infocomprobante[1]));

    } else {
      $('#tipo_comprobante').val(null);
      // $('#iva').val(null);
      $('#serie_comprobante_venta').val(null);
      $("#nro_op").val(null);
    }
    sumar();
  })
  //genera nros de comprobantes
  function generarnumero(NroComprobante) {
    if (NroComprobante > 999999 && NroComprobante <= 9999999) {
      return Number(NroComprobante) + 1;
    }
    if (NroComprobante > 99999 && NroComprobante <= 999999) {
      return "0" + (Number(NroComprobante) + 1);
    }
    if (NroComprobante > 9999 && NroComprobante <= 99999) {
      return "00" + (Number(NroComprobante) + 1);
    }
    if (NroComprobante > 999 && NroComprobante <= 9999) {
      return "000" + (Number(numero) + 1);
    }
    if (NroComprobante > 99 && NroComprobante <= 999) {
      return "0000" + (Number(NroComprobante) + 1);
    }
    if (NroComprobante > 9 && NroComprobante < 99) {
      return "00000" + (Number(NroComprobante) + 1);
    }
    if (NroComprobante <= 9) {
      return "000000" + (Number(NroComprobante) + 1);
    }
  }
      </script>