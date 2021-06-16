<div class="form-body">
    <div class="form-group">
        <div class="form-group">
            <label for="projectinput5">Empleado</label>
            <select disabled id="edit_id_empleado" name="edit_id_empleado" class="form-control" required>

                <option value="" selected="" disabled="">Seleccione</option>
                <?php foreach ($empleados as $empleado):?>
                <?php
                    if ($usuarios->id_empleado == $empleado->id_empleado) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    ?>
                <option value="<?php echo $empleado->id_empleado; ?>" <?php echo $selected; ?>>
                    <?php echo $empleado->nomape; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Username/Login</label>
                <div class="position-relative has-icon-left">
                    <input type="hidden" id="timesheetinput1" class="form-control" placeholder="Nombre de usuario"
                        name="id_usuario" value="<?php echo $usuarios->id_usuario; ?>" required="">
                    <input type="text" id="edit_username" class="form-control" placeholder="Nombre de usuario"
                        name="edit_username" readonly value="<?php echo $usuarios->username; ?>" required="">
                    <div class="form-control-position">
                        <i class="icon-slack"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Clave Anterior</label>
                <div class="position-relative has-icon-left">
                    <input name="clave_anterior" type="password" id="timesheetinput1" class="form-control" placeholder="clave" name="clave"
                        required="">
                    <div class="form-control-position">
                        <i class="icon-lock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Clave Nueva</label>
                <div class="position-relative has-icon-left">
                    <input name="clave_nueva" type="password" id="timesheetinput1" class="form-control" placeholder="clave" name="clave"
                        required="">
                    <div class="form-control-position">
                        <i class="icon-lock"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Repetir Clave Nueva</label>
                <div class="position-relative has-icon-left">
                    <input type="password" id="timesheetinput1" class="form-control" placeholder="Repetir clave"
                        name="repetirclave_nueva" required="">
                    <div class="form-control-position">
                        <i class="icon-lock"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

</div><!-- end div class FORM body-->