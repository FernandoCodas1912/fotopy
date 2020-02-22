<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos de la Categoria</h4>
    <div class="form-group">
        <label for="timesheetinput1">Codigo</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $categorias->id_categoria; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $categorias->descripcion; ?>" placeholder="Descripcion" name="edit_descripcion" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>


</div><!-- end div class FORM body--> 