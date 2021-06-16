<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos del Personal del Staff</h4>
    <div class="form-group">
        <label for="timesheetinput1">Documento</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->nrodocumento; ?>" placeholder="Documento" name="edit_doc" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div><label for="timesheetinput1">Nombre y Apellido</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->nomape; ?>" placeholder="Nombre y Apellido" name="edit_nomape" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Dirección</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->direccion; ?>" placeholder="Dirección" name="edit_dir" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Ciudad</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->id_ciudad; ?>" placeholder="Ciudad" name="edit_ciu" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Telefono</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->telefono; ?>" placeholder="Telefono" name="edit_tel" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Telefono 2</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->telefono2; ?>" placeholder="Telefono 2" name="edit_tel2" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Email</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->email; ?>" placeholder="Email" name="edit_ema" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Ocupación</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->ocupacion; ?>" placeholder="Ocupación" name="edit_ocu" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <!-- <label for="timesheetinput1">Año de ingreso</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $staffs->id_staff; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $staffs->ingreso; ?>" placeholder="Año de ingreso" name="edit_ing" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div> -->
        
    </div>


</div><!-- end div class FORM body--> 