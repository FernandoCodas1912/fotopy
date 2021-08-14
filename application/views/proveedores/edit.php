<div class="form-body">
    <div class="form-group">
        <label for="timesheetinput1">Nombre o Razon Social</label>
        <div class="position-relative has-icon-left">
            <input type="text" id="timesheetinput1" class="form-control"
                value="<?php echo $proveedores->razonsocial  ?>" placeholder="Nombre de cliente" name="edit_razonsocial"
                required="">
            <input type="hidden" id="timesheetinput1" class="form-control"
                value="<?php echo $proveedores->id_proveedor  ?>" placeholder="Nombre de cliente" name="edit_id"
                required="">
            <div class="form-control-position">
                <i class="icon-user"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Nro. Documento</label>
                <div class="position-relative has-icon-left">
                    <input type="text" id="timesheetinput1" class="form-control"
                        value="<?php echo $proveedores->nrodocumento  ?>" placeholder="Nro. de Documento"
                        name="edit_nrodocumento" required>
                    <div class="form-control-position">
                        <i class="icon-slack"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Telefono</label>
                <div class="position-relative has-icon-left">
                    <input type="text" id="timesheetinput1" class="form-control"
                        value="<?php echo $proveedores->telefono  ?>" placeholder="Nro de Telefono"
                        name="edit_telefono">
                    <div class="form-control-position">
                        <i class="icon-phone"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="timesheetinput1">Email</label>
        <div class="position-relative has-icon-left">
            <input type="email" id="timesheetinput1" class="form-control" value="<?php echo $proveedores->email  ?>"
                placeholder="Email" name="edit_email">
            <div class="form-control-position">
                <i class="icon-mail"></i>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Departamento</label>
                <select id="mod_departamento" name="edit_id_departamento" class="form-control" required="">
                    <?php foreach ($departamentos as $departamento) : ?>
                    <?php
            if ($departamento->id_departamento == $proveedores->id_departamento) {
              $selected = 'selected';
            } else {
              $selected = '';
            }
            ?>
                    <option value="<?php echo $departamento->id_departamento; ?>" <?php echo $selected; ?>>
                        <?php echo $departamento->descripcion; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-group">
                    <label for="projectinput5">Ciudad</label>
                    <select id="id_ciudad" name="edit_id_ciudad" class="form-control ciudad" required="">
                        <option value="<?php echo $proveedores->id_ciudad ?>"><?php echo $proveedores->ciudad ?>
                        </option>
                    </select>
                </div>
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="timesheetinput1">Direccion</label>
        <div class="position-relative has-icon-left">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $proveedores->direccion  ?>"
                placeholder="Direccion" name="edit_direccion">
            <div class="form-control-position">
                <i class="icon-home"></i>
            </div>
        </div>
    </div>

</div><!-- end div class FORM body-->