<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'euroamericano');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'i?#gD.f-:XVAsXXFN;eH1wQgJox(>YgEK%c3w_cTdf//1>1Nk>&5L+cpSwyD=-|-'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '-T`WUooW~DFX[T00,P0DD#&UbYbk<_^?}9BRmyp/^q#13/-J pKm^[w%>Tfx!aE{'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '.!~zR_45tt-0Ij+A>I.LJ+Iq@rc1g[EE{24-)6v~/]Z,C&Wn>b}i)RTm<c[;O `c'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', '!^:<NkPM il-!/xgT2S.f0|=z]bRALFR$Zg?O-%d*ZA=aO4co?.~Oq2OMA|Ggh3P'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', ' _&_e^w>2chl~+#I1/h+^2z|Ae@p_L,@QlY[Q +#_c5tliBy3pL-bvx-!onu7025'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', '_[KS+-Ky.hV+z{s&pRpPJyCDy<777%:l2`J>ZJGC5_C2#$QHlS9vY59Fj?+~AI#u'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '*eb&}y3gjZ;cd-VW ha|n}qhInX|okas[x7d-+7$jsn>cx5L*gvw>:-V0gr^Hq^w'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '%A]pAl#9F~5YnksSF+GYKXCB]H-V<XZAksc^1T-3Y(pqD=g%~Al&eW~aTl%zY<vU'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'ue_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

