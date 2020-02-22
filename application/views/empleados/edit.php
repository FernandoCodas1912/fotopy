<div class="form-body">
    <h4 class="form-section"><i class="icon-ios-albums"></i> Datos del Empleado</h4>
    <div class="form-group">
        <label for="timesheetinput1">Nombre y Apellido</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->nomape; ?>" placeholder="Nombre y Apellido" name="edit_nomape" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Documento</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->nrodocumento; ?>" placeholder="Documento" name="edit_doc" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Cargo</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->cargo; ?>" placeholder="Cargo" name="edit_car" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Telefono</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->telefono; ?>" placeholder="Telefono" name="edit_tel" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Email</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->email; ?>" placeholder="Email" name="edit_ema" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <label for="timesheetinput1">Salario</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->salario; ?>" placeholder="Salario" name="edit_sal" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
        <!-- <label for="timesheetinput1">Ciudad</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $empleados->id_empleado; ?>"name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $empleados->id_ciudad; ?>" placeholder="Ciudad" name="edit_ciu" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>-->
    </div>


</div><!-- end div class FORM body--> 