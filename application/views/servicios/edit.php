<div class="form-body">

    <div class="row">

        <div class="col-md-12">
            <div class="form-group">
                <label for="timesheetinput1">Codigo</label>
                <input type="text" min="0" value="<?php echo $servicios->codigobarra; ?>" class="form-control"
                    placeholder="Codigo de Barra u otro codigo" aria-label="Ingrese Codigo Alfanumerico" required
                    name="edit_codigobarra">

            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="timesheetinput1">Nombre del Servicio</label>
        <div class="position-relative has-icon-left">
            <input type="hidden" value="<?php echo $servicios->id_producto; ?>" name="edit_id" required="">
            <input type="text" id="timesheetinput1" class="form-control" value="<?php echo $servicios->descripcion; ?>"
                placeholder="Descripcion Servicio" name="edit_descripcion_producto" required="">
            <div class="form-control-position">
                <i class="icon-ios-barcode"></i>

            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput5">Categoria</label>
                <select id="projectinput5" name="edit_id_categoria" class="form-control" required="">

                    <?php foreach ($categorias as $categoria):?>
                    <?php
                    if ($categoria->id_categoria == $servicios->id_categoria) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    ?>
                    <option <?php echo $selected; ?> value="<?php echo $categoria->id_categoria; ?>" <?php echo $selected; ?>>
                        <?php echo $categoria->descripcion; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="projectinput5">Impuesto</label>
                <select id="projectinput5" name="edit_impuesto" class="form-control" required="">
                    <?php
                    if ($servicios->impuesto == '5') {
                        echo ' <option selected value="5">Iva 5%</option>';
                        echo ' <option value="10">Iva 10%</option>';
                        echo ' <option value="0">Exento</option>';
                    } elseif ($servicios->impuesto == '10') {
                        echo ' <option  value="5">Iva 5%</option>';
                        echo ' <option selected value="10">Iva 10%</option>';
                        echo ' <option value="0">Exento</option>';
                    } elseif ($servicios->impuesto == '0') {
                        echo ' <option  value="5">Iva 5%</option>';
                        echo ' <option value="10">Iva 10%</option>';
                        echo ' <option selected value="0">Exento</option>';
                    }
                    ?>

                </select>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Precio Compra</label>
                <div class="input-group">
                    <span class="input-group-addon">Gs.</span>
                    <input type="number" min="0" class="form-control" placeholder="Precio de compra"
                        value="<?php echo $servicios->precio_compra; ?>" aria-label="Ingrese precio en Gs."
                        name="edit_precio_compra">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="timesheetinput1">Precio Venta</label>
                <div class="input-group">
                    <span class="input-group-addon">Gs.</span>
                    <input type="number" min="0" class="form-control" placeholder="Precio de Venta"
                        value="<?php echo $servicios->precio_venta; ?>" aria-label="Ingrese precio en Gs."
                        name="edit_precio_venta">
                </div>
            </div>
        </div>
    </div>


</div><!-- end div class FORM body-->