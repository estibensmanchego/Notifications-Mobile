			<p>Descripcion de...</p>

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
					<div class="crudtable">
						<table class="widefat" id="mobitable">
							<thead>
								<tr bgcolor="#007aff">
									<th>Nro.</th>
									<th>Destinatario</th>
									<th>Matrícula</th>
									<th>Estado</th>
									<th>Opciones</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Jaime Perez</td>
									<td>
										<ul id="listmatriculas">
											<li>Jhon Snow <span>x</span></li>
											<li>Jhon Snow <span>x</span></li>
											<li>Jhon Snow <span>x</span></li>
											<li>Jhon Snow <span>x</span></li>
										</ul>
									</td>
									<td>Activo: Si</td>
									<td><a href="">Eliminar</a></td>
								</tr>	
								<tr>
									<td>1</td>
									<td>Jaime Perez</td>
									<td>
										<ul id="listmatriculas">
											<li>Jhon Snow <span>x</span></li>
											<li>Jhon Snow <span>x</span></li>
											<li>Jhon Snow <span>x</span></li>
											<li>Jhon Snow <span>x</span></li>
										</ul>
									</td>
									<td>Activo: No</td>
									<td><a href="">Eliminar</a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>