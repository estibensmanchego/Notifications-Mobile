		        <p>Descripcion de...</p>

				<form action="#">
					<div class="alumtitle"><p>Asignación de Grupos a Alumnos</p></div>
					<div class="alumcampos">
						<div class="aluminputs">
							<div><label>Búsqueda de Alumnos</label></div>
							<div class="form-field"><input type="text" name="nro_matricula" id="" placeholder="por número de matricula"></div>
							<div class="form-field"><input type="text" name="nombre" id="" placeholder="por nombre de alumno"></div>
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
					</div>
				</form>		
				
			<div id="dialog-form" title="Crear nueva categoría">
			  <p class="validateTips">Campos requeridos.</p>
			  <form>
			    <fieldset>
			      <label for="name">Categoría:</label>
			      <input type="text" name="categoria" id="categoria" placeholder="Ingrese categoría" class="text ui-widget-content ui-corner-all">
			    </fieldset>
			  </form>
			</div>