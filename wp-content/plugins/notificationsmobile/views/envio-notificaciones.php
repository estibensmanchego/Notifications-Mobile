				<p>Envio de notificacion</p>

				<form action="#">
					<div class="alumcampos">
						<div class="aluminputs">
							<div style="width: 20%;"><label>Búsqueda de dispositivo</label></div>
							<div class="form-field"><input type="text" name="codigo" id="" placeholder="por código"></div>
							<div class="form-field"><input type="text" name="nombre" id="" placeholder="por nombre"></div>
							<div style="width: 13%;"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><span class="ui-button-text">Agregar</span></button></div>
						</div>
						<div class="alumlabels"> 
							<div>Alumno</div>
							<div>Nombre y Apellido</div>
							<div>12345678</div>
						</div>
					</div>
					<div class="alumcampos">
						<div class="aluminputs">
							<div style="width: 20%;"><label>Búsqueda de Alumnos</label></div>
							<div class="form-field"><input type="text" name="nro_matricula" id="" placeholder="por número de matricula"></div>
							<div class="form-field"><input type="text" name="nombre" id="" placeholder="por nombre de alumno"></div>
							<div style="width: 13%;"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><span class="ui-button-text">Agregar</span></button></div>
						</div>
						<div class="alumlabels"> 
							<div>Alumno</div>
							<div>Nombre y Apellido</div>
							<div>12345678</div>
						</div>
					</div>
					<div class="categorias">
				  		<div class="cat_col">
							<label for="speed">Academico:</label>
							<select name="academico" id="academico">
								<option value="0">--Seleccionar--</option>
								<option value="1">Academico</option>
							</select>
							<button class="add-cat" title="Agregar">+</button>
						</div>
				 		<div class="cat_col">
							<label for="files">Categoría:</label>
							<select name="cat" id="cat">
								<option value="0">--Seleccionar--</option>
							    <option value="1">Primaria</option>
							</select>		
							<button class="add-cat" title="Agregar">+</button>		 			
				 		</div>
						<div class="cat_col">
							<label for="number">Sub Categoría:</label>
							<select name="subcat" id="subcat">
								<option value="0">--Seleccionar--</option>
								<option value="1">Piano</option>
							</select>
							<button class="add-cat" title="Agregar">+</button>
						</div>
						<div class="cat_col">
							<label for="number">Nivel:</label>
							<select name="nivel" id="nivel">
								<option value="0">--Seleccionar--</option>
								<option value="1">1ro Primaria</option>
							</select>	
							<button class="add-cat" title="Agregar">+</button>						
						</div>
						<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><span class="ui-button-text">Confirmar</span></button>				
						<div class="vistprev">
							<strong>Vista previa:</strong><br>
							<i>Academico > Primaria > Piano > 1ro Primaria</i>
						</div>
					</div>
					<div class="clear"></div>					
				</form>

				<div class="crudtable">
					<table class="widefat" id="mobitable">
						<thead>
							<tr bgcolor="#007aff">
								<th>Destino</th>
								<th>Mensaje</th>
								<th>Facha</th>
								<th>Opciones</th>
							</tr>			
						</thead>
						<tbody>
							<tr>
								<td><input type="text" name="destino" placeholder="Destino del mensaje" class="full"></td>
								<td><textarea name="destino" placeholder="Mensaje - maximo 200 caracteres" class="full"></textarea></td>
								<td><input type="text" name="fecha" placeholder="14/08/2014" id="datepicker"></td>
								<td><button type="button">Enviar</button></td>
							</tr>
						</tbody>
					</table>
				</div>				