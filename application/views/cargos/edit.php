<div class="form-body">
    <div class="form-group">
        <label for="timesheetinput1">Cargo</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $cargos->id_cargo; ?>" name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $cargos->descripcion; ?>"
                placeholder="Descripcion" name="edit_descripcion" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>

</div><!-- end div class FORM body-->