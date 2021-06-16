<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos del Tipo de Cobro</h4>
    <div class="form-group">
        <label for="timesheetinput1">Codigo</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $tipocobros->id_tipocobro; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $tipocobros->descripcion; ?>" placeholder="Descripción Tipo de Cobro" name="edit_descripcion" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>



</div><!-- end div class FORM body--> 