<?php  
/**
 * @package Visor_Notificaciones
 * @version 1.0
 */
/*
Plugin Name: Visor Notificaciones
Plugin URI: http://disenodesarrolloweb.com/
Description: This plugin provides the user or administrator can send push notifications to one or more segmented user filtered.
Author: Estibens Manchego
Version: 1.0
Author URI: http://estibensmanchego.me/
*/

global $notificationsmobile_db_version;
$notificationsmobile_db_version = '1.0';

define('NOTIMOBILE_URI', plugins_url('',__FILE__));
add_action('admin_menu', 'notificationsmobile_admin_menu');

wp_deregister_script( 'jquery' );
wp_enqueue_style("jquery-ui-css", "http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/flick/jquery-ui.min.css");
wp_enqueue_script( 'jquery-ui-core' );
wp_enqueue_script( 'jquery-ui-tabs' );
wp_enqueue_script( 'jquery-ui-dialog' );
wp_enqueue_script( 'jquery-ui-datepicker' );

wp_enqueue_style( 'notificationsmobile_css', NOTIMOBILE_URI. '/inc/css/notificationsmobile.css', false ); 
wp_enqueue_script( 'notificationsmobile_js', NOTIMOBILE_URI. '/inc/js/notificationsmobile.js', false );	

register_activation_hook( NOTIMOBILE_URI, 'notificationsmobile_install' );

function notificationsmobile_admin_menu()
{
	$page = add_menu_page( 'Visor Notificaciones', 'Visor Notificaciones', 'manage_options', 'areas-generales', 'notificationsmobile_page', plugins_url( 'notificationsmobile/inc/img/messages.png' ), 10 ); 	
	add_submenu_page( 'areas-generales', 'Áreas generales', 'Áreas generales', 'manage_options', 'areas-generales', 'notificationsmobile_page');	
	add_submenu_page( 'areas-generales', 'Asignaci&oacute;n de alumnos', 'Asignaci&oacute;n de alumnos', 'manage_options', 'asignacion-alumnos', 'notificationsmobile_alumnos');
	add_submenu_page( 'areas-generales', 'Asignaci&oacute;n de dispositivo', 'Asignaci&oacute;n de dispositivo', 'manage_options', 'asignacion-dispositivos', 'notificationsmobile_dispositivos');
	add_submenu_page( 'areas-generales', 'Envio de aviso', 'Envio de aviso', 'manage_options', 'envio-aviso', 'notificationsmobile_avisos');
	add_submenu_page( 'areas-generales', 'Estad&iacute;sticas', 'Estad&iacute;sticas', 'manage_options', 'estadisticas', 'notificationsmobile_estadisticas');

	//add_action( 'admin_print_styles-' . $page, 'notificationsmobile_admin_enqueue_script' );
}

/* function notificationsmobile_admin_enqueue_script() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_style("jquery-ui-css", "http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/flick/jquery-ui.min.css");
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-dialog' );
	wp_enqueue_script( 'jquery-ui-datepicker' );

	wp_enqueue_style( 'notificationsmobile_css', NOTIMOBILE_URI. '/inc/css/notificationsmobile.css', false ); 
	wp_enqueue_script( 'notificationsmobile_js', NOTIMOBILE_URI. '/inc/js/notificationsmobile.js', false );	
} */

function notificationsmobile_page()
{
?>
	<div class="wrap">
		<h2>Visor Notificaciones</h2>
		<div id="tabs" >
		    <div id="tabs-1">
		    <?php  
		    	$name_page = $_GET['page'];
		    	notificationsmobile_header($name_page);
		    ?>
				<form action="#">
					<div class="categorias">
				  		<div class="cat_col area">
							<label for="speed">Academico:</label>
							<select name="academico" id="academico">
								<option value="0">--Seleccionar--</option>
								<option value="1">Academico</option>
							</select>
							<button class="add-cat" title="Agregar">+</button>
						</div>
				 		<div class="cat_col area">
							<label for="files">Categoría:</label>
							<select name="cat" id="cat">
								<option value="0">--Seleccionar--</option>
							    <option value="1">Primaria</option>
							</select>		
							<button class="add-cat" title="Agregar">+</button>		 			
				 		</div>
						<div class="cat_col area">
							<label for="number">Sub Categoría:</label>
							<select name="subcat" id="subcat">
								<option value="0">--Seleccionar--</option>
								<option value="1">Piano</option>
							</select>
							<button class="add-cat" title="Agregar">+</button>
						</div>
						<div class="cat_col area">
							<label for="number">Nivel:</label>
							<select name="nivel" id="nivel">
								<option value="0">--Seleccionar--</option>
								<option value="1">1ro Primaria</option>
							</select>	
							<button class="add-cat" title="Agregar">+</button>						
						</div>	

						<div class="clear"></div>				
					</div>
				</form>
		    </div>	    
		</div>
		<?php  
			notificationsmobile_dialog();
		?>
	</div>
<?php
}

function notificationsmobile_header($page='')
{
	switch ($page) {
		case 'asignacion-alumnos':
			$title = "Asignaci&oacute;n de alumnos";
			break;

		case 'asignacion-dispositivos':
			$title = "Asignaci&oacute;n de dispositivos";
			break;		

		case 'envio-aviso':
			$title = "Envio de avisos";
			break;				

		case 'estadisticas':
			$title = "Estad&iacute;sticas";
			break;					
		
		default:
			$title = "Áreas generales";
			break;
	}
	$html = "<h3>" . $title . "</h3>";
	$html .= "<p>Texto de descrioci&oacute;n</p>";
	echo $html;
}

function notificationsmobile_dialog()
{
	$html = '
		<div id="dialog-form" title="Crear nueva categoría">
		  	<p class="validateTips">Campos requeridos.</p>
		  	<form>
		    	<fieldset>
		      		<label for="name">Categoría:</label>
		      		<input type="text" name="categoria" id="categoria" placeholder="Ingrese categoría" class="text ui-widget-content ui-corner-all">
		    	</fieldset>
		  	</form>
		</div>	
	';
	echo $html;
}

add_action( 'wp_ajax_my_action', 'my_action_callback' );

function my_action_callback() {
	global $wpdb; // this is how you get access to the database

	$whatever = intval( $_POST['whatever'] );

	$whatever += 10;

    echo $whatever;

	die(); // this is required to return a proper result
}

function notificationsmobile_alumnos()
{
?>
	<div class="wrap">
		<h2>Visor Notificaciones</h2>
		<div id="tabs" >
		    <div id="tabs-1">
		    <?php  
		    	$name_page = $_GET['page'];
		    	notificationsmobile_header($name_page);
		    ?>
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
						<button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"><span class="ui-button-text">Confirmar</span></button>				
						<div class="vistprev">
							<strong>Vista previa:</strong><br>
							<i>Academico > Primaria > Piano > 1ro Primaria</i>
						</div>
					</div>
					<div class="clear"></div>
				</form>		

			<div class="alumtable">
				<div class="secincritos">
						Incrito en:
				</div>
				<div class="secdescrip">
					<ul id="listtable">
						<li class="items">
							<div class="titcount">
								<span class="nomcategoria">Academico</span>
								<span class="counter">1</span>
							</div>
							<div class="desopts">
								<div class="descr">
									<span>Primaria>1ero>Salon A</span><br>
									<i>nombre de administrador que incribio</i>
								</div>
								<div class="opts">
									<div class="contsopts">
										<a href="">Editar</a>  <a href="">Eliminar</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<div>
								
							</div>
							<div>
								
							</div>
						</li>
					</ul>
				</div>

				<div class="clear"></div>
			</div>
		    </div>	    
		</div>
		<?php  
			notificationsmobile_dialog();
		?>
	</div>
<?php
}

function notificationsmobile_dispositivos()
{
?>
	<div class="wrap">
		<h2>Visor Notificaciones</h2>
		<div id="tabs" >
		    <div id="tabs-1">
		    <?php  
		    	$name_page = $_GET['page'];
		    	notificationsmobile_header($name_page);
		    ?>
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
		    </div>	    
		</div>
		<?php  
			notificationsmobile_dialog();
		?>
	</div>
<?php	
}

function notificationsmobile_avisos()
{
?>
	<div class="wrap">
		<h2>Visor Notificaciones</h2>
		<div id="tabs" >
		    <div id="tabs-1">
		    <?php  
		    	$name_page = $_GET['page'];
		    	notificationsmobile_header($name_page);
		    ?>
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
		    </div>	    
		</div>
		<?php  
			notificationsmobile_dialog();
		?>
	</div>
<?php	
}

function notificationsmobile_estadisticas()
{
?>
	<div class="wrap">
		<h2>Visor Notificaciones</h2>
		<div id="tabs" >
		    <div id="tabs-1">
		    <?php  
		    	$name_page = $_GET['page'];
		    	notificationsmobile_header($name_page);
		    ?>
				<div class="alumtable">
				<div class="secincritos">
						Enviadas:
				</div>
				<div class="secdescrip">
					<ul id="listtable">
						<li class="items">
							<div class="titcount">
								<span class="nomcategoria">Academico</span>
								<span class="counter">1</span>
							</div>
							<div class="desopts">
								<div class="descr">
									<span>Primaria>1ero>Salon A</span><br>
									<i>nombre de administrador que incribio</i>
								</div>
								<div class="opts">
									<div class="contsopts">
										<a href="">Volver a enviar</a>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</li>
					</ul>
				</div>

				<div class="clear"></div>
			</div>

			<div class="alumtable">
				<div class="secincritos">
						Por enviar:
				</div>
				<div class="secdescrip">
					<ul id="listtable">
						<li class="items">
							<div class="titcount">
								<span class="nomcategoria">Academico</span>
								<span class="counter">1</span>
							</div>
							<div class="desopts">
								<div class="descr">
									<span>Primaria>1ero>Salon A</span><br>
									<i>nombre de administrador que incribio</i>
								</div>
								<div class="opts">
									<div class="contsopts">
										<a href="">Editar</a>  <a href="">Eliminar</a><br>
										<input type="text" name="fecha" placeholder="14/08/2014" id="datepicker">
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</li>
					</ul>
				</div>

				<div class="clear"></div>
			</div>	
		    </div>	    
		</div>
		<?php  
			notificationsmobile_dialog();
		?>
	</div>
<?php	
}

function notificationsmobile_install() {
	global $wpdb;
	global $notificationsmobile_db_version;

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	$sql = "
		-- -----------------------------------------------------
		-- Table `usuarios`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."usuarios` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `nombres` VARCHAR(150) NULL,
		  `apellidos` VARCHAR(150) NULL,
		  PRIMARY KEY (`id`))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `inscripciones_usuarios`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."inscripciones_usuarios` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `usuario_id` INT NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_inscripciones_usuarios_usuarios1_idx` (`usuario_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `especialidades`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."especialidades` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `nombre` VARCHAR(45) NULL,
		  `inscripcione_usuario_id` INT NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_especialidades_inscripciones_usuarios1_idx` (`inscripcione_usuario_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `categorias`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."categorias` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `especialidad_id` INT NOT NULL,
		  `parentId` INT NULL,
		  `nombre` VARCHAR(45) NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_categorias_especialidades_idx` (`especialidad_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `niveles`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."niveles` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `categoria_id` INT NOT NULL,
		  `nombre` VARCHAR(45) NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_niveles_categorias1_idx` (`categoria_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `matriculas`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."matriculas` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `usuario_id` INT NOT NULL,
		  `fecha` VARCHAR(45) NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_matriculas_usuarios1_idx` (`usuario_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `roles`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."roles` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `nombre` VARCHAR(45) NULL,
		  `usuario_id` INT NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_roles_usuarios1_idx` (`usuario_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "

		-- -----------------------------------------------------
		-- Table `dispositivos_destinos`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."dispositivos_destinos` (
		  `id` INT NOT NULL AUTO_INCREMENT,
		  `usuario_id` INT NOT NULL,
		  PRIMARY KEY (`id`),
		  INDEX `fk_dispositivos_destinos_usuarios1_idx` (`usuario_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
		";

	
	dbDelta( $sql );

	$sql = "
		-- -----------------------------------------------------
		-- Table `alumnos`
		-- -----------------------------------------------------
		CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."alumnos` (
		  `dispositivo_destino_id` INT NOT NULL,
		  INDEX `fk_alumnos_dispositivos_destinos1_idx` (`dispositivo_destino_id` ASC))
		ENGINE = MyISAM
		DEFAULT CHARACTER SET = utf8
		COLLATE = utf8_general_ci;
	";

	
	dbDelta( $sql );

	add_option( 'notificationsmobile_db_version', $notificationsmobile_db_version );
}

?>