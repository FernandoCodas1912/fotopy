<div class="form-body">
    <div class="form-group">
        <label for="timesheetinput1">Codigo</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $categorias->id_categoria; ?>" name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $categorias->descripcion; ?>"
                placeholder="Descripcion" name="edit_descripcion" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="projectinput5">Categoria para </label>
        <select id="projectinput5" name="edit_tipo" class="form-control" required="">
            <?php
                    if ($categorias->tipo == '1') {
                        echo ' <option selected value="1">Eventos</option>';
                        echo ' <option value="2">Servicios</option>';
                        echo ' <option value="3">Productos</option>';
                    } elseif ($categorias->tipo == '2') {
                        echo ' <option  value="1">Eventos</option>';
                        echo ' <option selected value="2">Servicios</option>';
                        echo ' <option value="3">Productos</option>';
                    } elseif ($categorias->tipo == '3') {
                        echo ' <option  value="1">Eventos</option>';
                        echo ' <option value="2">Servicios</option>';
                        echo ' <option selected value="3">Productos</option>';
                    }
                    ?>

        </select>
    </div>



</div><!-- end div class FORM body-->