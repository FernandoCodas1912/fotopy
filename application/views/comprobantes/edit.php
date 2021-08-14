<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos del Comprobante</h4>
    <div class="form-group">

    <div class="form-group">
        <label for="timesheetinput1">Comprobante</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $comprobantes->id_comprobante; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $comprobantes->descripcion; ?>" placeholder="Descripcion" name="edit_descripcion" readonly required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>

           <div class="form-group">
        <label for="timesheetinput1">Serie del Comprobante</label>
        <div class="position-relative has-icon-left">
            <input type="text" id="timesheetinput1" class="form-control"  value="<?php echo $comprobantes->serie_comprobante; ?>"  placeholder="Serie  del Comprobante" name="edit_serie_comprobante" required="">
            <div class="form-control-position">
                <i class="icon-android-cart"></i>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="timesheetinput1">Ult. Nro. del Comprobante</label>
        <div class="position-relative has-icon-left">
            <input type="text" id="timesheetinput1" class="form-control"  value="<?php echo $comprobantes->ultimo_nro; ?>"   placeholder="Ult. Nro. del Comprobante" name="edit_ultimo_nro" required="">
            <div class="form-control-position">
                <i class="icon-android-cart"></i>
            </div>
        </div>
    </div>



</div><!-- end div class FORM body--> 