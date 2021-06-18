<script type="text/javascript">
     var base_url= "<?php echo base_url(); ?>";
    
    //esto es para abrir modal ver
    $(".btn-ver").on("click", function(){
      var id= $(this).val();
      $.ajax({
        url: base_url + "Usuarios_controller/view/" + id,
        type: "POST",
        success:function(resp){
          $("#modal-ver .modal-body").html(resp);
            // alert(resp);
          }
      });
    })
  
    //esto es para abrir modal editar
    $(".btn-editar").on("click", function(){
      var id= $(this).val();
      $.ajax({
        url: base_url + "Usuarios_controller/edit/" + id,
        type: "POST",
        success:function(resp){
          $("#modal-editar .modal-body").html(resp);
           // alert(resp);
          }
      });
    })


    //esto es para abrir modal cambio clave
    $(".btn-cambio_clave").on("click", function(){
      var id= $(this).val();
      $('#edit_id_empleado').attr('disabled', true);
      $('#edit_username').attr('disabled', true);
      $.ajax({
        url: base_url + "Usuarios_controller/cambio_clave/" + id,
        type: "POST",
        success:function(resp){
          $("#modal-cambio_clave .modal-body").html(resp);
           // alert(resp);
          }
      });
    })
</script>