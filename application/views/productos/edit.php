<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos del Producto</h4>
    <div class="form-group">
        <label for="timesheetinput1">Nombre del Producto</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $productos->id_prod; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $productos->descripcion; ?>" placeholder="Descripcion Producto" name="edit_descripcion_producto" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput5">Servicio</label>
                <select id="projectinput5" name="edit_id_servicio" value="<?php echo $productos->id_serv; ?>" class="form-control" required="">
                    <option value="none" selected="" disabled="">Seleccione</option>
                    <?php foreach($servicios as $servicio):?>
                    <?php 
                    if ($servicios->id_serv==$servicio->id_serv){
                        $selected="selected";
                      } else {
                        $selected="";
                      }
                    ?>
                      <option value="<?php echo $servicio->id_serv;?>"<?php echo $selected;?> > <?php echo $servicio->descripcion; ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
      </div>

      <!-- <div class="col-md-6">
        <div class="form-group">
            <label for="timesheetinput1">Stock</label>
            <div class="position-relative has-icon-left">
                <input type="number" min="0" id="timesheetinput1" class="form-control" value="<?php echo $servicios->stock; ?>" placeholder="Stock Inicial" name="edit_stock" required="" value="0">
                <div class="form-control-position">
                    <i class="icon-slack"></i>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="timesheetinput1">Precio Compra</label>
            <div class="input-group">
                <span class="input-group-addon">Gs.</span>
                <input type="number" min="0" class="form-control" placeholder="Precio de compra" value="<?php echo $productos->precio_compra; ?>" aria-label="Ingrese precio en Gs." name="edit_precio_compra">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="timesheetinput1">Precio Venta</label>
            <div class="input-group">
                <span class="input-group-addon">Gs.</span>
                <input type="number" min="0" class="form-control" placeholder="Precio de Venta" value="<?php echo $productos->precio_venta; ?>" aria-label="Ingrese precio en Gs." name="edit_precio_venta">
            </div>
        </div>
    </div>
</div>
</div><!-- end div class FORM body--> 