<script type="text/javascript">
     var base_url= "<?php echo base_url(); ?>";
    
    //esto es para abrir modal ver
    $(".btn-ver").on("click", function(){
      var id= $(this).val();
      //alert(id);
      $.ajax({
        url: base_url + "Empleados_controller/view/" + id,
        type: "POST",
        success:function(resp){
          $("#modal-ver .modal-body").html(resp);
            //alert(resp);
          }
      });
    })
  
    //esto es para abrir modal editar
    $(".btn-editar").on("click", function(){
      var id= $(this).val();
     // alert(id);
      $.ajax({
        url: base_url + "Empleados_controller/edit/" + id,
        type: "POST",
        success:function(resp){
          $("#modal-editar .modal-body").html(resp);
           // alert(resp);
          }
      });
    })
</script>