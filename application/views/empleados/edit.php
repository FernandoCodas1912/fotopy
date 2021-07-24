   <div class="form-group">
       <label for="timesheetinput1">Nombre y Apellido</label>
       <div class="position-relative has-icon-left">
           <input type="text" value="<?php echo $empleados->nomape ?>" id="timesheetinput1" class="form-control" placeholder="Nombre y Apellido" name="edit_nomape" required="">
           <div class="form-control-position">
               <i class="icon-android-cart"></i>
           </div>
       </div>
   </div>

   <div class="row">

       <div class="col-md-6">
           <div class="form-group">
               <label for="timesheetinput1">Nro. Documento</label>
               <div class="position-relative has-icon-left">
                   <input type="hidden" name="edit_id" value="<?php echo $empleados->id_empleado ?>">
                   <input type="text" value="<?php echo $empleados->nrodocumento ?>" id="timesheetinput1" class="form-control" placeholder="Documento" name="edit_nrodocumento" required="">
                   <div class="form-control-position">
                       <i class="icon-android-cart"></i>
                   </div>
               </div>
           </div>
       </div>

       <div class="col-md-6">
           <div class="form-group">
               <label for="timesheetinput1">Telefono</label>
               <div class="position-relative has-icon-left">
                   <input type="text" value="<?php echo $empleados->telefono ?>" id="timesheetinput1" class="form-control" placeholder="Telefono" name="edit_telefono" required="">
                   <div class="form-control-position">
                       <i class="icon-android-cart"></i>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div class="form-group">
       <label for="timesheetinput1">Email</label>
       <div class="position-relative has-icon-left">
           <input type="email" value="<?php echo $empleados->email ?>" id="timesheetinput1" class="form-control" placeholder="Email" name="edit_email" required="">
           <div class="form-control-position">
               <i class="icon-android-cart"></i>
           </div>
       </div>
   </div>



   <div class="row">
       <div class="col-md-6">
           <div class="form-group">
               <label for="timesheetinput1">Departamento</label>
               <select id="mod_departamento_evento" name="id_departamento" class="form-control" required="">
                   <?php foreach ($departamentos as $departamento) : ?>
                       <?php
                        if ($departamento->id_departamento == $empleados->id_departamento) {
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
               <label for="projectinput5">Ciudad</label>
               <select id="ciudad_evento" name="edit_id_ciudad" class="form-control ciudad" required="">
                   <option value="<?php echo $empleados->id_ciudad ?>"><?php echo $empleados->ciudad ?></option>
               </select>
           </div>
       </div>
   </div>
   <div class="form-group">
       <label for="timesheetinput1">Direccion</label>
       <div class="position-relative has-icon-left">
           <input type="text" value="<?php echo $empleados->direccion ?>" id="timesheetinput1" class="form-control" placeholder="Direccion" name="edit_direccion" required="">
           <div class="form-control-position">
               <i class="icon-android-cart"></i>
           </div>
       </div>
   </div>
   <div class="row">

       <div class="col-md-6">
           <div class="form-group">
               <label for="timesheetinput1">Salario</label>
               <div class="position-relative has-icon-left">
                   <input type="number" value="<?php echo $empleados->salario ?>" min="0" id="timesheetinput1" class="form-control" placeholder="Salario" name="edit_salario" required="">
                   <div class="form-control-position">
                       <i class="icon-android-cart"></i>
                   </div>
               </div>
           </div>
       </div>
       <div class="col-md-6">
           <div class="form-group">
               <label for="projectinput5">Cargo</label>
               <select id="projectinput5" name="edit_id_cargo" class="form-control" required="">
                   <option value="" selected="" disabled="">Seleccione</option>
                   <?php foreach ($cargos as $cargo) : ?>
                       <?php
                        if ($cargo->id_cargo == $empleados->id_cargo) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                        ?>
                       <option <?php echo $selected; ?> value="<?php echo $cargo->id_cargo; ?>" <?php echo $selected; ?>>
                           <?php echo $cargo->descripcion; ?></option>
                   <?php endforeach; ?>
               </select>
           </div>
       </div>
   </div>