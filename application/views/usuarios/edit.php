<div class="form-body">

    <div class="form-group">
        <label for="projectinput5">Empleado</label>
        <select id="projectinput5" name="edit_id_empleado" class="form-control" required>

            <option value="" selected="" disabled="">Seleccione</option>
            <?php foreach ($empleados as $empleado) : ?>
            <?php
                if ($empleado->estado != 3) {;
                    if ($usuarios->id_empleado == $empleado->id_empleado) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                ?>
            <option value="<?php echo $empleado->id_empleado; ?>" <?php echo $selected; ?>>
                <?php echo $empleado->nomape; ?></option>
            <?php }
            endforeach; ?>
        </select>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Username/Login</label>
                <div class="position-relative has-icon-left">
                    <input type="hidden" id="timesheetinput1" class="form-control" placeholder="Nombre de usuario"
                        name="edit_id_usuario" value="<?php echo $usuarios->id_usuario; ?>" required="">
                    <input type="text" id="timesheetinput1" class="form-control" placeholder="Nombre de usuario"
                        name="edit_username" value="<?php echo $usuarios->username; ?>" required="">
                    <div class="form-control-position">
                        <i class="icon-slack"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput5">Perfil</label>
                <select id="projectinput5" name="edit_id_perfil" class="form-control" required="">

                    <option value="" selected="" disabled="">Seleccione</option>
                    <?php foreach ($perfiles as $perfil) : ?>
                    <?php
                        if ($perfil->estado != 3) {;
                            if ($usuarios->id_perfil_usuario == $perfil->id_usuario_perfil) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                        ?>

                    <option value="<?php echo $perfil->id_usuario_perfil; ?>" <?php echo $selected; ?>>
                        <?php echo $perfil->descripcion; ?></option>
                    <?php }
                    endforeach; ?>
                </select>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="projectinput5">Caja Asignada</label>
            <select id="projectinput5" name="edit_id_caja" class="form-control">
                <option value="" selected="">Seleccione</option>
                <?php foreach ($cajas as $caja) : ?>
                <?php
                    if ($usuarios->id_caja == $caja->id_caja) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    ?>

                <option value="<?php echo $caja->id_caja; ?>" <?php echo $selected; ?>>
                    <?php echo $caja->descripcion; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>



</div><!-- end div class FORM body-->