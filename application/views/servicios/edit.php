<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos del Producto/Servicio</h4>
    <div class="form-group">
        <label for="timesheetinput1">Codigo</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $servicios->id_producto; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $servicios->codigobarra; ?>" placeholder="Codigo de Barra" name="edit_codigobarra" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="timesheetinput1">Nombre del Producto o Servicio</label>
        <div class="position-relative has-icon-left">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $servicios->descripcion; ?>" placeholder="Descripcion completa del Producto" name="edit_descripcion" required="">
            <div class="form-control-position">
                <i class="icon-android-cart"></i>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput5">Categoria</label>
                <select id="projectinput5" name="edit_id_categoria" value="<?php echo $servicios->id_categoria; ?>" class="form-control" required="">
                    <option value="none" selected="" disabled="">Seleccione</option>
                    <?php foreach($categorias as $categoria):?>
                    <?php 
                    if ($servicios->id_categoria==$categoria->id_categoria){
                        $selected="selected";
                      } else {
                        $selected="";
                      }
                    ?>
                      <option value="<?php echo $categoria->id_categoria;?>"<?php echo $selected;?> > <?php echo $categoria->descripcion; ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
      </div>

      <div class="col-md-6">
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
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="timesheetinput1">Precio Compra</label>
            <div class="input-group">
                <span class="input-group-addon">Gs.</span>
                <input type="number" min="0" class="form-control" placeholder="Precio de compra" value="<?php echo $servicios->precio_compra; ?>" aria-label="Ingrese precio en Gs." name="edit_precio_compra">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="timesheetinput1">Precio Venta</label>
            <div class="input-group">
                <span class="input-group-addon">Gs.</span>
                <input type="number" min="0" class="form-control" placeholder="Precio de Venta" value="<?php echo $servicios->precio_venta; ?>" aria-label="Ingrese precio en Gs." name="edit_precio_venta">
            </div>
        </div>
    </div>
</div>
</div><!-- end div class FORM body--> 