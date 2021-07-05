<div class="form-body">
    <div class="form-group">
        <label for="timesheetinput1">Descripcion</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $caja->id_caja; ?>" name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $caja->descripcion; ?>"
                placeholder="Descripcion" name="edit_descripcion" required="">

        </div>
    </div>

</div><!-- end div class FORM body-->