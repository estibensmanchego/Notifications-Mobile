<?php  
/**
 * @package Notifications_Mobile
 * @version 1.0
 */
/*
Plugin Name: Notifications Mobile
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
register_activation_hook( NOTIMOBILE_URI, 'notificationsmobile_install' );

function notificationsmobile_admin_menu()
{
	$page = add_menu_page( 'Notifications Mobile', 'Notifications Mobile', 'manage_options', __FILE__, 'notificationsmobile_page', plugins_url( 'notificationsmobile/inc/img/messages.png' ), 10 ); 	
	add_action( 'admin_print_styles-' . $page, 'notificationsmobile_admin_enqueue_script' );
}

function notificationsmobile_admin_enqueue_script() {
	wp_deregister_script( 'jquery' );
	wp_enqueue_style("jquery-ui-css", "http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/flick/jquery-ui.min.css");
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-tabs' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'jquery-ui-dialog' );

	wp_enqueue_style( 'notificationsmobile_css', NOTIMOBILE_URI. '/inc/css/notificationsmobile.css', false ); 
	wp_enqueue_script( 'notificationsmobile_js', NOTIMOBILE_URI. '/inc/js/notificationsmobile.js', false );	
}

function notificationsmobile_page()
{
?>
	<div class="wrap">
		<h2>Notifications Mobile</h2>
		<h3>Description pluing</h3>
		<p>Texto de Ayuda</p>
		<div id="tabs">
		    <ul>
		        <li><a href="#tabs-1">Alta áreas</a></li>
		        <li><a href="<?php echo NOTIMOBILE_URI; ?>/views/asignacion-alumnos.php">Asignacion de alumnos</a></li>
		        <li><a href="<?php echo NOTIMOBILE_URI; ?>/views/asignacion-dispositivos.php">Asignacion de dispositivos</a></li>
		        <li><a href="<?php echo NOTIMOBILE_URI; ?>/views/envio-notificaciones.php">Envio de avisos</a></li>
		        <li><a href="<?php echo NOTIMOBILE_URI; ?>/views/estadisticas.php">Estadisticas</a></li>
		    </ul>
		    <div id="tabs-1">
		        <p>Descripcion de...</p>

				<form action="#">
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

		    </div>	    
		</div>		
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