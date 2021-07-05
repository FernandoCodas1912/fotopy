<div class="form-body">
    <div class="form-group">
        <label for="timesheetinput1">Descripcion</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $tipo_evento->id_tipoevento; ?>" name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control"
                value="<?php echo $tipo_evento->descripcion; ?>" placeholder="Descripcion" name="edit_descripcion"
                required="">

        </div>
    </div>

    <div class="form-group">
        <label for="timesheetinput1">Codigo</label>
        <div class="position-relative has-icon-left">
            <input type="text" id="timesheetinputs1" class="form-control"
                value="<?php echo $tipo_evento->observacion; ?>" placeholder="Observacion" name="edit_observacion"
                required="">

        </div>
    </div>


</div><!-- end div class FORM body-->